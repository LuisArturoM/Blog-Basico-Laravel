<div class="bg-gray-200 rounded-lg shadow-md p-6">
    <h3 class="text-lg font-bold mb-2">{{ $post->title }}</h3>
    <p class="text-gray-600 mb-4">Autor: {{ $post->user->rpe }}</p>
    <p class="text-gray-800">{{ Str::limit($post->content, 100) }}</p>
    <a href="{{ route('blog.show', $post->id) }}" class="text-blue-500 hover:underline mt-4 block">Ver Más</a>
</div>
