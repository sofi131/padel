/*document.addEventListener('DOMContentLoaded', () => {
    const guardarButton = document.querySelector('button[data-bs-target="#successModal"]'); // Botón para activar el modal
    const successModal = document.querySelector('#successModal'); // Elemento del modal de éxito
    const modalInstance = new bootstrap.Modal(successModal); // Instancia del modal de Bootstrap

    if (guardarButton) {
        guardarButton.addEventListener('click', (event) => {
            const usernames = document.querySelectorAll('input[name^="username"]'); // Todos los campos de usuario
            const anyFilled = Array.from(usernames).some(input => input.value.trim() !== ""); // Verificar si al menos uno tiene valor

            if (!anyFilled) { // Si todos están vacíos
                event.preventDefault(); // Evitar la acción por defecto (mostrar modal)
                alert("Por favor, rellene al menos un campo antes de continuar."); // Mensaje para el usuario
            } else {
                modalInstance.show(); // Mostrar el modal si hay campos llenos
            }
        });
    }

    // Si es necesario redirigir a la página principal al cerrar la modal
    const closeButtons = document.querySelectorAll('#successModal .btn-close, #successModal .btn-secondary');
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            modalInstance.hide(); // Cierra el modal
            window.location.href = 'index.php'; // Redirige a la página principal
        });
    });
});*/
