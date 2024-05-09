document.addEventListener('DOMContentLoaded', () => {
    const guardarButton = document.querySelector('button[data-bs-target="#successModal"]'); // Botón para activar modal de éxito
    const errorModalTrigger = document.querySelector('#errorModal .btn-close, #errorModal .btn-secondary'); // Botón para cerrar el modal de error

    if (guardarButton) {
        guardarButton.addEventListener('click', (event) => {
           
            const inputs = document.querySelectorAll('input[name^="username"]'); // Todos los inputs de jugadores
            let allFilled = true; // Indicador de que todos están llenos

            // Verificar si todos los campos tienen texto
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    allFilled = false; // Si alguno está vacío, la condición es falsa
                }
            });

            if (!allFilled) {
                event.preventDefault(); // Impedir la acción del botón
                const errorModal = new bootstrap.Modal(document.querySelector('#errorModal'));
                errorModal.show(); // Mostrar modal de error si faltan campos
            } else {
                const successModal = new bootstrap.Modal(document.querySelector('#successModal'));
                successModal.show(); // Mostrar modal de éxito si están completos
            }
        });
    }

    if (errorModalTrigger) {
        const closeErrorModal = () => {
            const errorModal = new bootstrap.Modal(document.querySelector('#errorModal'));
            errorModal.hide(); // Cerrar el modal de error
        };

        errorModalTrigger.addEventListener('click', closeErrorModal); // Cerrar modal de error
    }

    // Redirigir a index.php al cerrar el modal de éxito
    const successModalClose = document.querySelector('#successModal .btn-secondary');
    if (successModalClose) {
        const redirectToIndex = () => {
            window.location.href = 'index.php'; // Redirigir a index.php
        };

        successModalClose.addEventListener('click', redirectToIndex); // Cerrar modal de éxito y redirigir
    }
});
