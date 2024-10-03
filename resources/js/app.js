require('./bootstrap');

import Likes from './likeBtn';
import { toggleTheme, applySavedTheme } from './theme';

import Alpine from 'alpinejs';

import { initLikeButtons } from './likeBtn';
import { initLoadMoreButton } from './cargarMas';
import { initDataTable } from './dataTables';

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#load-more-button')) {
        initLoadMoreButton(); // Cargar mas con AJAX solo si el boton existe
    }
    initLikeButtons();

    if (document.querySelector('#posts-table')) {
        initDataTable(); // Inicializa DataTable
    }
});



window.Alpine = Alpine;

Alpine.start();


