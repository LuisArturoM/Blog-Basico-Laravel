export function initDataTable() {
    $(document).ready(function() {
        $('#posts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/posts-data',  // Cambiar a la ruta correcta
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'tittle', name: 'tittle' },
                { data: 'user.rpe', name: 'user.rpe' }, 
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <form action="/blog/${row.id}" method="POST" style="display:inline;">
                                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <a href="/blog/${row.id}" class="btn btn-primary">Ver</a>
                            <a href="/admin/posts/pdf/${row.id}" class="btn btn-primary">Generar PDF</a>
                        `;
                    }
                }
            ]
        });
    });
}
