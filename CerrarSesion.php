<?php
// Iniciar la sesión para poder acceder a ella
session_start();

// 1. Desvincular todas las variables de sesión
$_SESSION = array();

// 2. Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no solo los datos de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Finalmente, destruir la sesión.
session_destroy();

// 4. Redirigir a la página de login
header("Location: Login.php");
exit;
?>
