<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir la URL base para enlaces y assets
define('BASE_URL', '/'); // Ajustar si el proyecto está en un subdirectorio

$is_logged_in = isset($_SESSION['usuario_id']);
$user_role = $_SESSION['usuario_rol'] ?? null;
$user_name = $_SESSION['usuario_nombre'] ?? '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Sistema de Reservas UTP'; ?></title>
    <link rel="icon" href="<?php echo BASE_URL; ?>Imagenes/utpcad.ico">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Nuestro CSS unificado -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<header class="main-header">
    <div class="container">
        <a href="<?php echo BASE_URL; ?>Principal.php" class="logo">
            <img src="<?php echo BASE_URL; ?>Imagenes/logo_utp.png" alt="Logo UTP">
            <span>Sistema de Reservas</span>
        </a>
        <nav class="main-nav">
            <ul>
                <?php if ($is_logged_in): ?>
                    <?php if ($user_role === 'administrador'): ?>
                        <li><a href="<?php echo BASE_URL; ?>admin_dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin_usuarios.php"><i class="fa-solid fa-users"></i> Usuarios</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin_recursos.php"><i class="fa-solid fa-book"></i> Recursos</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin_reservas.php"><i class="fa-solid fa-calendar-days"></i> Reservas</a></li>
                    <?php else: // Rol 'profesor' ?>
                        <li><a href="<?php echo BASE_URL; ?>Principal.php"><i class="fa-solid fa-house"></i> Inicio</a></li>
                        <li><a href="<?php echo BASE_URL; ?>mis_reservas.php"><i class="fa-solid fa-calendar-check"></i> Mis Reservas</a></li>
                        <li><a href="<?php echo BASE_URL; ?>Formulario.php"><i class="fa-solid fa-plus"></i> Nueva Reserva</a></li>
                    <?php endif; ?>

                    <li class="user-menu">
                        <span><i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($user_name); ?></span>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>CerrarSesion.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo BASE_URL; ?>Login.php">Iniciar Sesión</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Registro.html">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="container">
        <!-- El contenido específico de la página irá aquí -->
