export function initLoadMoreButton() {
    const loadMoreButton = document.querySelector('#load-more-button'); // Asegúrate de que el botón tenga este ID.
    let currentPage = 2; // Inicia en la página 2, ya que la 1 ya está cargada.
    const authorId = document.querySelector('#author-select').value; // Asumiendo que hay un select para autor.
    const loadingSpinner = document.getElementById('loading-spinner'); // Obtener el spinner.

    if (!loadMoreButton) return;

    loadMoreButton.addEventListener('click', () => {
        console.log('Cargando más posts...'); // Verificar si se activa el evento

        // Mostrar el spinner
        loadingSpinner.classList.remove('hidden');

        fetch(`/blog/load-more?page=${currentPage}&author_id=${authorId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verifica la respuesta de la API
                const postsContainer = document.querySelector('.posts-container');

                if (!postsContainer) {
                    throw new Error('No se encontró el contenedor de posts.');
                }

                if (data.posts.length > 0) {
                    data.posts.forEach(post => {
                        postsContainer.insertAdjacentHTML('beforeend', post);
                    });
                    currentPage++;
                } else {
                    loadMoreButton.style.display = 'none'; // Oculta el botón si no hay más posts
                }
            })
            .catch(error => console.error('Error al cargar más posts:', error))
            .finally(() => {
                // Ocultar el spinner
                loadingSpinner.classList.add('hidden');
            });
    });
}
