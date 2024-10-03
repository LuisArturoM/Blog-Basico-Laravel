<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{


    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|max:500',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comentario agregado exitosamente.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comentario eliminado exitosamente.');
    }
}
