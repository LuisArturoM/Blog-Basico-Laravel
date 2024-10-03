<x-app2>

@if (session('success'))
    <script>
        alert(" Se creo el Post ");
    </script>
@endif

<div class=" text-center mb-8 text-3xl font-bold mt-3"><h2>CREA TU POST</h2></div>
<div class="md:flex md:justify-center md:mb-5">
    
    <div class="md:w-1/2 bg-white p-8 rounded-md shadow-lg md:gap-5">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="tittle" class="mb-2 block uppercase text-gray-800 font-bold">Titulo</label>
                <input id="tittle" name="tittle" type="text" placeholder="Escribe el titulo del Post" class="border p-3 w-full rounded-md shadow-sm @error('tittle')
                border-red-500    
                @enderror">
                @error('tittle')
                    <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center font-bold"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="mb-2 block uppercase text-gray-800 font-bold">Contenido</label>
                <input id="content" name="content" type="text" placeholder="Escribe aqui el contenido del Post" class=" h-48 border p-3 w-full rounded-md shadow-sm @error('content') border-red-500    
                @enderror">
                @error('content')
                    <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center font-bold"> {{ $message }} </p>
                @enderror
            </div>

            <div>
                <label for="image">Imagen</label>
                <input type="file" id="image" name="image" accept="image/*" @error('image') border-red-500    
                @enderror>
                @error('image')
                <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center font-bold"> {{ $message }} </p>
                @enderror
            </div>

            <input type="submit" value="Publicar" name="Crear Post" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor cursor-pointer uppercase font-bold w-full p-3 text-white rounded-md">

        </form>
    </div>
</div>

</x-app2>