<?php
session_start();

require_once 'config/Database.php';

// Limpiar errores de sesión anteriores
unset($_SESSION['errors']);
unset($_SESSION['success_message']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    // 1. Recoger y sanear los datos del formulario
    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contrasenia = $_POST['contrasenia'] ?? '';
    $confirmpassword = $_POST['confirmpassword'] ?? '';

    // 2. Validar los datos
    if (empty($nombres) || empty($apellidos) || empty($email) || empty($contrasenia)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@utp\.edu\.pe$/', $email)) {
        $errors[] = "Por favor, ingrese un correo electrónico válido con el dominio @utp.edu.pe.";
    }

    if ($contrasenia !== $confirmpassword) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (strlen($contrasenia) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    // 3. Verificar si el correo ya existe en la BD (solo si no hay otros errores)
    if (empty($errors)) {
        try {
            $database = new Database();
            $pdo = $database->getConnection();

            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = :correo");
            $stmt->bindParam(':correo', $email);
            $stmt->execute();

            if ($stmt->fetch()) {
                $errors[] = "El correo electrónico ya está registrado.";
            }
        } catch (PDOException $e) {
            $errors[] = "Error en la base de datos: " . $e->getMessage();
        }
    }

    // 4. Procesar el registro o mostrar errores
    if (!empty($errors)) {
        // Redirigir de vuelta al formulario de registro con errores
        $_SESSION['errors'] = $errors;
        // Opcional: guardar los datos del post para rellenar el formulario
        $_SESSION['post_data'] = $_POST;
        header('Location: Registro.html'); // Idealmente, sería a Registro.php para mostrar errores
        exit();
    } else {
        // Proceder con la inserción en la base de datos
        try {
            $nombre_completo = $nombres . ' ' . $apellidos;
            $password_hashed = password_hash($contrasenia, PASSWORD_DEFAULT);
            $rol = 'profesor'; // Rol por defecto para nuevos registros

            $stmt = $pdo->prepare(
                "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (:nombre, :correo, :password, :rol)"
            );

            $stmt->bindParam(':nombre', $nombre_completo);
            $stmt->bindParam(':correo', $email);
            $stmt->bindParam(':password', $password_hashed);
            $stmt->bindParam(':rol', $rol);

            if ($stmt->execute()) {
                // Registro exitoso
                $_SESSION['success_message'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
                header('Location: Login.php');
                exit();
            } else {
                $_SESSION['errors'] = ["Error: No se pudo completar el registro."];
                header('Location: Registro.html');
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['errors'] = ["Error en la base de datos al registrar: " . $e->getMessage()];
            header('Location: Registro.html');
            exit();
        }
    }
} else {
    // Si no es POST, redirigir al formulario
    header('Location: Registro.html');
    exit();
}
?>
