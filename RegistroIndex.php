<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Imagenes/utpcad.ico">
    <link rel="stylesheet" href="css/styles_Reg.css">
    <script src="Archivos/registro.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Registro</title>
</head>
<body>
    <div class="login-container">
        <h2>Registrarse</h2>
        <form action="Registro.php" method="POST" id="registro-form">
            <div class="form-row">
                <div class="form-column">
                    <div class="input-container">
                        <i class="fas fa-user icon"></i>
                        <input type="text" name="nombres" id="nombres" placeholder="Nombre" required>
                        <span class="error" id="error-nombres"></span>
                    </div>
                </div>
                <div class="form-column">
                    <div class="input-container">
                        <i class="fas fa-user icon"></i>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Apellido" required>
                        <span class="error" id="error-apellidos"></span>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="input-container">
                        <i class="fas fa-phone icon"></i>
                        <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
                        <span class="error" id="error-telefono"></span>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="input-container">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" name="email" id="email" placeholder="Correo Electrónico" required>
                        <span class="error" id="error-email"></span>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="input-container">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                        <span class="error" id="error-contraseña"></span>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="input-container">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmar Contraseña" required>
                        <span class="error" id="error-confirm-password"></span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn">Registrarse</button>
            <div class="signup-link">
                <p>¿Ya tienes una cuenta? <a href="Login.php">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>
    <div class="registro_imagen">
        <img src="Imagenes/loger.png" alt="imagen">
    </div>
    <div id="recuadro-exito">
        <div class="icono">
            <img src="Imagenes/icons8-aprobación.gif" alt="Éxito">
        </div>
        <div class="mensaje">
            Registro exitoso
        </div>
        <button class="boton-aceptar" id="boton-aceptar">Aceptar</button>
    </div>
</body>
</html>