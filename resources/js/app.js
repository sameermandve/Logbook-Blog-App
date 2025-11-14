import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// For login and register loading
document.addEventListener('alpine:init', () => {
    Alpine.data("formLoading", () => ({
        loading: false,
        start() {
            this.loading = true;
        }
    }));
});

Alpine.start();