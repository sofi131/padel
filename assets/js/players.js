// Controlar el modal para mostrar mensaje de éxito
document.addEventListener('DOMContentLoaded', () => {
    const modalTrigger = document.querySelector('button[data-bs-target="#successModal"]');

    if (modalTrigger) {
        modalTrigger.addEventListener('click', () => {
            const modal = new bootstrap.Modal(document.querySelector('#successModal'));
            modal.show();
        });
    }
});
