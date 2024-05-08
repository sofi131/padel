
// Obtener el elemento de entrada de fecha
var fechaInput = document.getElementById("fecha");

// Almacenar la fecha seleccionada inicialmente
var fechaSeleccionadaInicial = fechaInput.value;

// Agregar un event listener para el evento change
fechaInput.addEventListener("change", function () {
    // Obtener el valor seleccionado (la fecha)
    var fechaSeleccionada = fechaInput.value;

    // Asignar la fecha al campo oculto del formulario
    document.getElementById("fecha_seleccionada").value = fechaSeleccionada;

    // Enviar el formulario
    document.getElementById("formulario").submit();

    // Restaurar la fecha seleccionada inicialmente después de enviar el formulario
    fechaInput.value = fechaSeleccionadaInicial;
});
