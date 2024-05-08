document.addEventListener('DOMContentLoaded', () => {
    // Controla el modal para mostrar mensaje de éxito
    const modalTrigger = document.querySelector('button[data-bs-target="#successModal"]');
    const modalCloseButton = document.querySelector('#successModal .btn-close');
    const modalCloseFooter = document.querySelector('#successModal .btn-secondary');

    if (modalTrigger) {
        modalTrigger.addEventListener('click', () => {
            const modal = new bootstrap.Modal(document.querySelector('#successModal'));
            modal.show();
        });
    }

    if (modalCloseButton && modalCloseFooter) {
        const redirectToIndex = () => {
            const modal = new bootstrap.Modal(document.querySelector('#successModal'));
            modal.hide(); // Cierra el modal
            window.location.href = 'index.php'; // Redirige a index.php
        };

        modalCloseButton.addEventListener('click', redirectToIndex); // Redirige al hacer clic en "Cerrar"
        modalCloseFooter.addEventListener('click', redirectToIndex); // Redirige al hacer clic en "Cerrar" del footer
    }
});
