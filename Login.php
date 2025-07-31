<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Página Web</title>
    <link rel="stylesheet" href="css/styles_Log.css">
    <link rel="icon" href="Imagenes/utpcad.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php
session_start();   
$emailError = '';
$passwordError = '';
$email = '';
$password = '';

// Función para leer datos desde un archivo de texto
function leerDatosDesdeArchivo($nombreArchivo) {
    $lineas = file($nombreArchivo, FILE_IGNORE_NEW_LINES);
    $datos = [];
    foreach ($lineas as $linea) {
        $datos[] = explode(",", $linea);
    }
    return $datos;
}

// Función para validar las credenciales
function iniciarSesion($email, $password) {
    $usuarios = leerDatosDesdeArchivo('usuarios.txt');
    foreach ($usuarios as $usuario) {
        if ($usuario[3] === $email && $usuario[4] === $password) {
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores de los campos
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    // Validación básica del email 
    $emailPattern = '/^[a-zA-Z0-9._%+-]+@utp\.edu\.pe$/';
    if (!preg_match($emailPattern, $email)) {
        $emailError = 'Por favor, ingrese un correo electrónico válido que termine en @utp.edu.pe';
    }
    // Validación básica de la contraseña
    if (strlen($password) == 0) {
        $passwordError = 'Por favor, ingrese una clave';
    }
    // Verificar credenciales
    if (empty($emailError) && empty($passwordError)) {
        if (iniciarSesion($email, $password)) {
            $_SESSION['email'] = $email;
            header('Location: Principal.php');
            exit();
        } else {
            $passwordError = 'Usuario o contraseña incorrecta';
        }
    }
}
?>
<form id="loginForm" action="Login.php" method="post" >
    <div class="container">
        <div class="loginColumn">
            <div class="column image-section">
                <img class="imagen1"
                    src="https://sso.utp.edu.pe/auth/resources/qyyyj/login/utp-pao/images/web-login-pao.svg"
                    alt="Logo_Cad">
            </div>
            <div class="column form-section">
                <div class="login-container">
                    <div class="image-section">
                        <img id="imgUTP"
                            src="https://comunidaria.com/wp-content/uploads/2021/05/utp-ofrece-becas-completas-a-alumnos-de-colegios-emblematicos.jpg"
                            alt="Logoutp">
                    </div>
                    <h2>Centro de Atención al Docente</h2>
                        <div class="form-group">
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="Correo Electrónico">
                        </div>
                        <span class="error" id="error-email"><?php echo $emailError; ?></span>
                        <div class="form-group">
                            <i class="fas fa-lock icon"></i>
                        <input type="password" id="password" name="password" value="<?php echo $password; ?>" placeholder="Contraseña">
                        </div>
                        <span class="error" id="error-password"><?php echo $passwordError; ?></span>
                        <br><br>
                        <div class="form-group forgot-password">
                            <a href="Contraseña.html">¿Te olvidaste la contraseña?</a>
                        </div>
                        <button type="submit" class="btn" id="loginButton">Iniciar Sesión</button>
                        <div class="signup-link">
                            ¿No eres miembro? <a href="Registro.html">¡Regístrate ahora!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>   
</body>
</html>