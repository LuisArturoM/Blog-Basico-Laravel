<x-app2>
    @csrf
    <div class="container">
        <h1 class="text-center mt-5">Lista de Posts</h1>
    
        <table id="posts-table" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- El cuerpo será llenado automáticamente por DataTables -->
            </tbody>
        </table>
    
    </div>
</x-app2>