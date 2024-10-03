<x-app2>
    @section('title' , 'Blog')
    @csrf()
    <main class="container mx-auto md:px-2 py-4">
        <div class="items-center bg-gray-200 rounded-lg shadow-md p-3 mb-3">

            <div class="flex items-center justify-between text-end">
                <h2 class="text-xl font-semibold mb-4">Filtros</h2>
                <a class="flex items-center text-2xl" href=" {{route('blog.create')}} "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                  </svg>
                  Crear Post</a>
            </div>
            <form method="GET" action="{{ route('blog.index') }}" class="flex space-x-4">
                <select id="author-select" name="author_id" class="border rounded p-2 md:w-2/12">
                    <option value="">Selecciona un Autor</option>
                    <option value="">Todos</option>
                    @foreach ($users as $user)

                        <option value="{{ $user->id }}" {{ request('author_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->rpe }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white rounded p-2">Filtrar</button>
            </form>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 posts-container">
        @if ($posts->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-6 col-span-1 md:col-span-2 lg:col-span-3">
                <p class="text-gray-500">No Hay Posts Para Mostrar.</p>
            </div>
        @else
            @foreach ($posts as $post)
                <div class="bg-gray-200 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-600 mb-4">Autor: {{ $post->user->rpe }}</p>
                    <p class="text-gray-800">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('blog.show', $post->id) }}" class="text-blue-500 hover:underline mt-4 block">Ver Mas</a>
                </div>
            @endforeach
        @endif
    </div>

    <div id="loading-spinner" class="loading-spinner hidden text-center">
        <div class="inline-block w-8 h-8 border-4 border-t-4 border-gray-300 rounded-full border-t-blue-500 animate-spin"></div>
    </div> 

@if ($posts->hasMorePages())
    <div class="text-center mt-6">
        <button id="load-more-button" class="bg-blue-500 text-white rounded p-2">Cargar Más</button>
    </div>
@endif

 </main>
</x-app2>