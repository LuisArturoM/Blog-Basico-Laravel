export function initLikeButtons() {
    // Manejar el evento de click para los botones de "like"
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', () => {
            const postId = button.getAttribute('data-post-id');

            fetch(`/post/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const likeCount = document.getElementById('like-count'); 
                const dislikeCount = document.getElementById('dislike-count'); // Obtener el contador de dislikes
                if (likeCount) likeCount.innerText = data.likes;
                if (dislikeCount) dislikeCount.innerText = data.dislikes; // Actualizar el contador de dislikes también
            })
            .catch(error => console.error('Error al dar like:', error));
        });
    });

    // Manejar el evento de click para los botones de "dislike"
    document.querySelectorAll('.dislike-button').forEach(button => {
        button.addEventListener('click', () => {
            const postId = button.getAttribute('data-post-id');

            fetch(`/post/${postId}/dislike`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                const likeCount = document.getElementById('like-count'); // Obtener el contador de likes
                const dislikeCount = document.getElementById('dislike-count'); 
                if (likeCount) likeCount.innerText = data.likes; // Actualizar el contador de likes
                if (dislikeCount) dislikeCount.innerText = data.dislikes;
            })
            .catch(error => console.error('Error al dar dislike:', error));
        });
    });
}
