function validarFormulario(event) {
    event.preventDefault(); // Prevenir el envío del formulario hasta que se realice la validación
    
    // Limpiar mensajes de error anteriores
    var errorElements = document.getElementsByClassName("error");
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].innerHTML = "";
    }

    // Obtener los valores de los campos
    var username = document.getElementById("username").value.trim();
    var dni = document.getElementById("dni").value.trim();
    var newPassword = document.getElementById("newPassword").value.trim();
    var confirmPassword = document.getElementById("confirmPassword").value.trim();

    // Variable para saber si hay errores
    var hayErrores = false;
    
    if (!/^[^\s@]+@utp\.edu\.pe$/.test(username)) {
        document.getElementById("error-username").innerText = "Por favor, introduce un correo electrónico válido de la UTP (terminando en @utp.edu.pe).";
        hayErrores = true;
    }
    // Validar que todos los campos requeridos estén llenos
    if (!dni) {
        document.getElementById("error-dni").innerText = "Por favor, introduce tu DNI.";
        hayErrores = true;
    } else if (!/^\d{8}$/.test(dni)) {
        document.getElementById("error-dni").innerText = "El DNI debe tener 8 dígitos.";
        hayErrores = true;
    }
    if (!newPassword) {
        document.getElementById("error-newPassword").innerText = "Por favor, introduce tu nueva contraseña.";
        hayErrores = true;
    }else{
        if (newPassword.length < 6) {
            document.getElementById("error-newPassword").innerText = "La contraseña debe tener al menos 6 caracteres.";
            hayErrores = true;
        }
    }
    
    if (newPassword !== confirmPassword) {
        document.getElementById("error-confirmPassword").innerText = "Las contraseñas no coinciden.";
        hayErrores = true;
    }

    if (!hayErrores) { 
        document.getElementById("formulario").submit();
    }
        
}
    

