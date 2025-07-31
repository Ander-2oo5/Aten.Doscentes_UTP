document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registro-form');
    const recuadroExito = document.getElementById('recuadro-exito');
    const botonAceptar = document.getElementById('boton-aceptar');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario para validar primero
        
        // Limpiar mensajes de error previos
        const errorElements = document.querySelectorAll('.error');
        errorElements.forEach(element => element.textContent = '');

        // Obtener los valores de los campos
        const nombres = document.getElementById('nombres').value.trim();
        const apellidos = document.getElementById('apellidos').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const email = document.getElementById('email').value.trim();
        const contrasenia = document.getElementById('contrasenia').value.trim();
        const confirmPassword = document.getElementById('confirmpassword').value.trim();

        let hasError = false;

        // Validar campos
        if (nombres === '') {
            document.getElementById('error-nombres').textContent = 'El nombre es obligatorio.';
            hasError = true;
        }

        if (apellidos === '') {
            document.getElementById('error-apellidos').textContent = 'El apellido es obligatorio.';
            hasError = true;
        }

        if (telefono === '') {
            document.getElementById('error-telefono').textContent = 'El teléfono es obligatorio.';
            hasError = true;
        } else if (!/^\d{9}$/.test(telefono)) {
            document.getElementById('error-telefono').textContent = 'El teléfono debe tener 9 dígitos.';
            hasError = true;
        }

        if (email === '') {
            document.getElementById('error-email').textContent = 'El correo electrónico es obligatorio.';
            hasError = true;
        } else if (!/^[^\s@]+@utp\.edu\.pe$/.test(email)) {
            document.getElementById('error-email').textContent = 'El correo electrónico debe ser del dominio @utp.edu.pe.';
            hasError = true;
        }

        if (contrasenia === '') {
            document.getElementById('error-contrasenia').textContent = 'La contraseña es obligatoria.';
            hasError = true;
        }

        if (confirmPassword === '') {
            document.getElementById('error-confirmpassword').textContent = 'La confirmación de la contraseña es obligatoria.';
            hasError = true;
        } else if (contrasenia !== confirmPassword) {
            document.getElementById('error-confirmpassword').textContent = 'Las contraseñas no coinciden.';
            hasError = true;
        }

        // Si no hay errores, mostrar el recuadro de éxito
        if (!hasError) {
            recuadroExito.style.display = 'block';            
        }
        if (!hasError) { 
            document.getElementById("registro-form").submit();
        }
    });

    botonAceptar.addEventListener('click', () => {
        recuadroExito.style.display = 'none';
    });
});
