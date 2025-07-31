document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    const errorMessages = document.getElementById('errorMessages');

    loginButton.addEventListener('click', () => {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        errorMessages.innerHTML = '';

        if (validateEmail(email) && validatePassword(password)) {
            // Redirige a la página principal si la validación es exitosa
            window.location.href = 'Principal.html';
        }
    });

    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@utp\.edu\.pe$/;
        if (!emailPattern.test(email)) {
            errorMessages.innerHTML += '<p>Por favor, ingrese un correo electrónico válido que termine en @utp.edu.pe</p>';
            return false;
        }
        return true;
    }

    function validatePassword(password) {
        if (password.length === 0) {
            errorMessages.innerHTML += '<p>Por favor, ingrese una contraseña</p>';
            return false;
        }
        return true;
    }
});
