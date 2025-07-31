<?php
session_start();

// Si el usuario ya está logueado, redirigir al panel principal
if (isset($_SESSION['usuario_id'])) {
    header('Location: Principal.php');
    exit();
}

require_once 'config/Database.php';

$error_message = '';
$success_message = '';

// Mostrar mensaje de éxito si venimos del registro
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error_message = 'Por favor, ingrese su correo y contraseña.';
    } else {
        try {
            $database = new Database();
            $pdo = $database->getConnection();

            $stmt = $pdo->prepare("SELECT id, nombre, correo, password, rol FROM usuarios WHERE correo = :correo");
            $stmt->bindParam(':correo', $email);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                // Contraseña correcta, iniciar sesión
                session_regenerate_id(true); // Prevenir fijación de sesión

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_correo'] = $usuario['correo'];
                $_SESSION['usuario_rol'] = $usuario['rol'];

                header('Location: Principal.php');
                exit();
            } else {
                // Credenciales incorrectas
                $error_message = 'El correo electrónico o la contraseña son incorrectos.';
            }
        } catch (PDOException $e) {
            $error_message = "Error en la base de datos: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistema UTP</title>
    <link rel="stylesheet" href="css/styles_Log.css">
    <link rel="icon" href="Imagenes/utpcad.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
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

                <?php if ($error_message): ?>
                    <div class="error-notification"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <?php if ($success_message): ?>
                    <div class="success-notification"><?php echo htmlspecialchars($success_message); ?></div>
                <?php endif; ?>

                <form id="loginForm" action="Login.php" method="post">
                    <div class="form-group">
                        <i class="fas fa-user icon"></i>
                        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <br>
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
</body>
</html>
