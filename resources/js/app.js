import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        open: typeof window.openCartDrawer !== 'undefined' ? window.openCartDrawer : false,
        toggle() {
            this.open = !this.open;
            if (this.open) document.body.style.overflow = 'hidden';
            else document.body.style.overflow = '';
        }
    });
});

Alpine.start();

