<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Yajra\DataTables\DataTables;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\PostLikes;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BlogController extends Controller
{
    public function index(Request $request){
        //$posts = Post::all();
        
        $query = Post::query();

        // Aplicar el filtro si existe  
        if ($request->filled('author_id')) {
            $query->byUser($request->author_id);
        }

        $posts = $query->with('user')->paginate(5);
        
        $users = User::all();

        return view('blog/blog', compact('posts', 'users'));
    }

    public function show($id)
    {
        $post = Post::withCount(['likes as likes_count', 'dislikes as dislikes_count'])->findOrFail($id);
    
        return view('blog.show', compact('post'));
    }

    public function create(){

        return view('blog.create');
    }
    
    public function store(Request $request){
                $validatedData = $request->validate([
                    'tittle' => 'required|max:50|min:4',
                    'content' => 'required|max:1000|min:10',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                $post = new Post();
                $post->tittle = $request->tittle;
                $post->content = $request->content;
                $post->author_id = Auth::id();

                if($request->hasFile('image')){
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/images'), $imageName); // Mover la imagen a assets/images
                    $post->image = 'assets/images/' . $imageName;
                }else{
                    $post->image = $imagePath = NULL;
                }

                $post->save();
    
                return redirect()->route('blog.index')->with('success', 'Post creado con éxito.');
    }

    public function loadMore(Request $request)
    {
        $query = Post::query();
    
        // Aplicar el filtro si existe
        if ($request->filled('author_id')) {
            $query->byUser($request->author_id);
        }
    
        // Obtener posts paginados
        $posts = $query->with('user')->paginate(5, ['*'], 'page', $request->page);
    
        if ($posts->isEmpty()) {
            return response()->json(['posts' => []]); // Retorna un array vacío si no hay más posts
        }
    
        // Generar el HTML para los posts
        $postsHtml = [];
        foreach ($posts as $post) {
            $postsHtml[] = view('blog.partials.post', compact('post'))->render();
        }
    
        return response()->json(['posts' => $postsHtml]);
    }


    public function like($id)
    {
        try {
            $post = Post::findOrFail($id);
            $userId = auth()->id();
    
            // Buscar el registro existente del usuario para este post
            $existingVote = PostLikes::where('post_id', $id)->where('user_id', $userId)->first();
    
            if ($existingVote) {
                // Si el usuario ya ha dado un like, eliminarlo
                if ($existingVote->is_like) {
                    $existingVote->delete();
                } else {
                    // Si el usuario ha dado un dislike, cambiarlo a like
                    $existingVote->is_like = true;
                    $existingVote->save();
                }
            } else {
                // Si no hay registro, crear uno nuevo con like
                PostLikes::create([
                    'post_id' => $id,
                    'user_id' => $userId,
                    'is_like' => true,
                ]);
            }
    
            // Contar los likes después de la acción
            $likesCount = $post->getLikesCount();
            $dislikesCount = $post->getDislikesCount(); // También puedes contar dislikes si es necesario
            return response()->json(['likes' => $likesCount, 'dislikes' => $dislikesCount]);
        } catch (\Exception $e) {
            // Registra el error si es necesario
            return response()->json(['error' => 'Error procesando la solicitud'], 500);
        }
    }
    
    public function dislike($id)
    {
        try {
            $post = Post::findOrFail($id);
            $userId = auth()->id(); 
    
            $existingVote = PostLikes::where('post_id', $id)->where('user_id', $userId)->first();
    
            if ($existingVote) {
                // Si el usuario ya ha dado un dislike, eliminarlo
                if (!$existingVote->is_like) {
                    $existingVote->delete();
                } else {
                    // Si el usuario ha dado un like, cambiarlo a dislike
                    $existingVote->is_like = false;
                    $existingVote->save();
                }
            } else {
                // Si no hay registro, crear uno nuevo con dislike
                PostLikes::create([
                    'post_id' => $id,
                    'user_id' => $userId,
                    'is_like' => false,
                ]);
            }
    

            $likesCount = $post->getLikesCount();
            $dislikesCount = $post->getDislikesCount();
            return response()->json(['likes' => $likesCount, 'dislikes' => $dislikesCount]);
        } catch (\Exception $e) {
            // Registra el error si es necesario
            return response()->json(['error' => 'Error procesando la solicitud'], 500);
        }
    }
    

    public function index_datatable()
    {
        return view('admin.posts.index');
    }

    public function getData()
    {
        $posts = Post::with('user')->get();

        return Datatables::of($posts)
            ->addColumn('action', function($post) {
                return '<a href="'.route('blog.show', $post->id).'" class="btn btn-xs btn-primary">Ver</a>
                        <form action="'.route('blog.destroy', $post->id).'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'¿Estás seguro?\')">Eliminar</button>
                        </form>';
            })
            ->editColumn('user_id', function($post) {
                return $post->user->rpe;
            })
            ->make(true);
    }
    

    public function destroy($id)
    {
        try {

            $post = Post::findOrFail($id);
            
            $post->delete();
            
            return redirect()->route('admin.posts.index')->with('success', 'Post eliminado exitosamente.');
        } catch (\Exception $e) {

            return redirect()->route('admin.posts.index')->with('error', 'Error al eliminar el post.');
        }
    }

    public function generatePDF($id)
    {
        $post = Post::findOrFail($id);

        $pdf = PDF::loadView('blog.pdf', compact('post'));

        return $pdf->download('Post:' . $id . '.pdf');
    }

}
