<x-app2>
    @csrf
    <body class="bg-gray-100">
        <header class="bg-gray-200 shadow-md ">
            <div class="container mx-auto px-4 py-6 ">
                <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
                <p class="text-gray-600 text-2xl font-bold">Autor del Post: {{ $post->user->rpe }}</p>
            </div>
        </header>
        <main class="container mx-auto px-4 py-6 ">
            <div class="bg-white rounded-lg shadow-md p-6 border-2 border-blue-200">
                <div class=" text-center mb-8 text-1xl font-bold mt-3"><h2> {{ $post->tittle }} </h2></div>
                @if ($post->image)
                <div class=" w-1/4 max-w-md mx-auto my-4 bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 transform hover:scale-105 cursor-pointer " id="expandir-imagen">
                    <img src="{{ asset($post->image) }}" alt="Imagen del post" class="w-full h-auto object-contain">
                </div>

                <div id="image-modal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-75 flex justify-center items-center z-50 hidden">
                    <img src="{{ asset($post->image) }}" alt="Imagen del post expandida" class="max-w-full max-h-full">
                    <button id="close-modal" class="absolute top-5 right-5 text-white text-2xl">&times;</button>
                </div>

                <script>
                    // Obtener la imagen y el modal
                    const image = document.getElementById('expandir-imagen');
                    const modal = document.getElementById('image-modal');
                    const closeModal = document.getElementById('close-modal');
                
                    image.addEventListener('click', () => {
                        modal.classList.remove('hidden');
                    });
                
                    closeModal.addEventListener('click', () => {
                        modal.classList.add('hidden');
                    });
                
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                        }
                    });
                </script>
                @endif
                <div class="flex justify-center items-center space-x-4">
                    <button class="like-button transition-transform duration-300 transform hover:scale-110" data-post-id="{{ $post->id }}" data-action="like">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>
                        </button>
                        <button class="dislike-button transition-transform duration-300 transform hover:scale-110" data-post-id="{{ $post->id }}" data-action="dislike">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                        </svg>                          
                        </button>
                </div>
                <div class="flex justify-center items-center space-x-6">
                    <p><span id="like-count">{{ $post->likes_count }}</span></p>
                    <p><span id="dislike-count">{{ $post->dislikes_count }}</span></p>
                </div>
                <h2 class="text-xl font-bold mb-4">Contenido</h2>
                <p>{{ $post->content }}</p>


                <h3 class="text-xl font-semibold mt-6">Comentarios ({{ $post->comments->count() }})</h3>
            <div class=" w-full mx-auto mt-8 p-6 bg-white shadow-md rounded-lg border-blue-300 border-2 mb-4">
                @foreach ($post->comments as $comment)
                    <div class="mb-4">
                        <p class="text-gray-700"><strong>{{ $comment->user->rpe }}:</strong> {{ $comment->comment }}</p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                
                        @if (auth()->check() && auth()->id() === $comment->user_id)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Eliminar</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            @if (auth()->check())
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Comentar:</label>
                        <textarea name="comment" id="comment" rows="4" class="w-full rounded-md border-gray-300 @error('comment') border-red-500    
                        @enderror" ></textarea>
                        @error('comment')
                        <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center font-bold"> Debes añadir un comentario para comentar </p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Comentar</button>
                </form>
            @endif

            </div>
            <div class="mt-4">
                <a href="{{ route('blog.index') }}" class="text-blue-500 hover:underline">Regresar</a>
            </div>
        </main>
        <footer class="bg-white shadow mt-6">
            <div class="container mx-auto px-4 py-6 text-center">
                <p class="text-gray-600">© 2024 CFE. Todos los derechos Reservados.</p>
            </div>
        </footer>
    
    </body>
</x-app2>