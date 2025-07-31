function validarFormulario(event) {
event.preventDefault(); // Prevenir el envío del formulario hasta que se realice la validación

    // Limpiar mensajes de error anteriores
    var errorElements = document.getElementsByClassName("error");
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].innerHTML = "";
    }

    // Obtener los valores de los campos
    var modalidad = document.getElementById("modalidad").value;
    var tipo_taller = document.getElementById("tipo_taller").value;
    var fecha = document.getElementById("fecha_inscripcion").value;
    var nombre = document.getElementById("nombre").value.trim();
    var apellido = document.getElementById("apellido").value.trim();
    var celular = document.getElementById("celular").value.trim();
    var dni = document.getElementById("dni").value.trim();
    var email = document.getElementById("email").value.trim();
    var campus = document.getElementById("campusutp").value;

    // Variable para saber si hay errores
    var hayErrores = false;
    
    // Validar que todos los campos requeridos estén llenos
    if (!modalidad) {
        document.getElementById("error-modalidad").innerText = "Por favor, selecciona tu modalidad.";
        hayErrores = true;
    }
    if (!tipo_taller) {
        document.getElementById("error-tipo_taller").innerText = "Por favor, selecciona un tipo de taller.";
        hayErrores = true;
    }
    if (!fecha) {
        document.getElementById("error-fecha").innerText = "Por favor, selecciona una fecha.";
        hayErrores = true;
    }
    if (!nombre) {
        document.getElementById("error-nombre").innerText = "Por favor, introduce tu nombre.";
        hayErrores = true;
    }
    if (!apellido) {
        document.getElementById("error-apellido").innerText = "Por favor, introduce tu apellido.";
        hayErrores = true;
    }
    if (!celular) {
        document.getElementById("error-celular").innerText = "Por favor, introduce tu número de celular.";
        hayErrores = true;
    } else if (!/^\d{9}$/.test(celular)) {
        document.getElementById("error-celular").innerText = "El número de celular debe tener 9 dígitos.";
        hayErrores = true;
    }
    if (!dni) {
        document.getElementById("error-dni").innerText = "Por favor, introduce tu DNI.";
        hayErrores = true;
    } else if (!/^\d{8}$/.test(dni)) {
        document.getElementById("error-dni").innerText = "El DNI debe tener 8 dígitos.";
        hayErrores = true;
    }
    if (!email) {
        document.getElementById("error-email").innerText = "Por favor, introduce tu correo electrónico.";
        hayErrores = true;
    } else if (!/^[^\s@]+@utp\.edu\.pe$/.test(email)) {
        document.getElementById("error-email").innerText = "Por favor, introduce un correo electrónico válido de la UTP (terminando en @utp.edu.pe).";
        hayErrores = true;
    }
    if (!campus) {
        document.getElementById("error-campus").innerText = "Por favor, selecciona un campus.";
        hayErrores = true;
    }

    // Si no hay errores, mostrar un mensaje de éxito
    if (!hayErrores) {
        document.getElementById("mensaje-exito").innerText = "Reserva realizada con éxito.";
        //document.getElementById("recuadro-exito").style.display = "block";
    }

    if (!hayErrores) { 
        document.getElementById("formulario").submit();
    }
    
}