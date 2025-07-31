<?php
// config/seed.php
// Script para inicializar la base de datos, crear tablas y migrar datos.
// Ejecutar desde la línea de comandos: php config/seed.php

require_once 'Database.php';

// --- Configuración ---
$admin_email = 'admin@utp.edu.pe';
$admin_password = 'admin_password_123'; // Cambiar en un entorno real

function execute_sql_file($pdo, $filepath) {
    try {
        $sql = file_get_contents($filepath);
        $pdo->exec($sql);
        echo "✅ Script SQL '$filepath' ejecutado correctamente.\n";
    } catch (PDOException $e) {
        die("❌ Error ejecutando el script SQL: " . $e->getMessage() . "\n");
    }
}

function migrate_users($pdo) {
    echo "\n--- Migrando usuarios de usuarios.txt ---\n";
    $file_path = __DIR__ . '/../usuarios.txt';

    if (!file_exists($file_path)) {
        echo "ℹ️  Archivo usuarios.txt no encontrado. Saltando migración de usuarios.\n";
        return;
    }

    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES (:nombre, :correo, :password, :rol)");

    $count = 0;
    foreach ($lines as $line) {
        $data = explode(',', $line);
        if (count($data) < 5) continue;

        $nombre = trim($data[0]) . ' ' . trim($data[1]);
        $correo = trim($data[3]);
        $password = trim($data[4]);

        // Verificar si el correo ya existe para evitar duplicados
        $check_stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $check_stmt->execute([$correo]);
        if ($check_stmt->fetch()) {
            echo "⚠️  Usuario con correo '$correo' ya existe. Saltando.\n";
            continue;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute([
            'nombre' => $nombre,
            'correo' => $correo,
            'password' => $hashed_password,
            'rol' => 'profesor'
        ]);
        $count++;
    }
    echo "✅ Migración de $count usuarios completada.\n";
}

function migrate_reservations($pdo) {
    echo "\n--- Migrando reservas de reservas.txt ---\n";
    $file_path = __DIR__ . '/../reservas.txt';

    if (!file_exists($file_path)) {
        echo "ℹ️  Archivo reservas.txt no encontrado. Saltando migración de reservas.\n";
        return;
    }

    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $stmt = $pdo->prepare("INSERT INTO reservas (usuario_id, recurso_id, fecha_reserva, estado) VALUES (:usuario_id, :recurso_id, :fecha_reserva, :estado)");

    $count = 0;
    foreach ($lines as $line) {
        // Parsear la línea con formato "key: value, key: value"
        $parts = explode(', ', $line);
        $reserva_data = [];
        foreach ($parts as $part) {
            list($key, $value) = explode(': ', $part, 2);
            $reserva_data[trim($key)] = trim($value);
        }

        // Obtener ID del usuario por email
        $user_email = $reserva_data['Email'] ?? null;
        if (!$user_email) continue;

        $user_stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $user_stmt->execute([$user_email]);
        $user = $user_stmt->fetch();
        $user_id = $user ? $user['id'] : null;

        if (!$user_id) {
             echo "⚠️  No se encontró usuario para la reserva con email '$user_email'. Saltando.\n";
             continue;
        }

        // Obtener ID del recurso por nombre
        $recurso_nombre = $reserva_data['Tipo de taller'] ?? null;
        if (!$recurso_nombre) continue;

        $recurso_stmt = $pdo->prepare("SELECT id FROM recursos WHERE nombre LIKE ?");
        $recurso_stmt->execute(["%$recurso_nombre%"]);
        $recurso = $recurso_stmt->fetch();
        $recurso_id = $recurso ? $recurso['id'] : null;

        if (!$recurso_id) {
            echo "⚠️  No se encontró recurso para la reserva con nombre '$recurso_nombre'. Saltando.\n";
            continue;
        }

        $fecha_inscripcion = $reserva_data['Fecha de inscripción'] ?? date('Y-m-d');

        $stmt->execute([
            'usuario_id' => $user_id,
            'recurso_id' => $recurso_id,
            'fecha_reserva' => $fecha_inscripcion,
            'estado' => 'completada' // Asumimos que las antiguas están completadas
        ]);
        $count++;
    }
    echo "✅ Migración de $count reservas completada.\n";
}


// --- Proceso Principal ---
try {
    // 1. Conectar a MySQL (sin seleccionar DB al principio)
    $db = new Database();
    // Usamos el nuevo usuario para crear la base de datos también.
    // Asumimos que el usuario 'utp_user' tiene permisos para crear bases de datos,
    // o que la base de datos ya existe. Le dimos todos los privilegios, así que debería funcionar.
    $pdo_admin = new PDO('mysql:host=localhost;charset=utf8', 'utp_user', 'password');
    $pdo_admin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Crear la base de datos
    $pdo_admin->exec("CREATE DATABASE IF NOT EXISTS utp_sistema CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "✅ Base de datos 'utp_sistema' asegurada.\n";
    $pdo_admin = null; // Cerrar conexión de admin

    // 3. Conectar a la DB 'utp_sistema' y crear tablas
    $pdo = $db->getConnection();
    echo "✅ Conexión a 'utp_sistema' establecida.\n";
    execute_sql_file($pdo, __DIR__ . '/database.sql');

    // 4. Crear usuario administrador
    echo "\n--- Creando usuario administrador ---\n";
    $admin_password_hashed = password_hash($admin_password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->execute([$admin_email]);

    if ($stmt->fetch()) {
        echo "ℹ️  El usuario administrador '$admin_email' ya existe.\n";
    } else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES ('Administrador', ?, ?, 'administrador')");
        $stmt->execute([$admin_email, $admin_password_hashed]);
        echo "✅ Usuario administrador creado con éxito.\n";
        echo "   - Email: $admin_email\n";
        echo "   - Contraseña: $admin_password\n";
    }

    // 5. Migrar datos de archivos .txt
    migrate_users($pdo);
    migrate_reservations($pdo);

    echo "\n🎉 ¡Proceso de inicialización completado!\n";

} catch (PDOException $e) {
    die("❌ Error en el proceso de inicialización: " . $e->getMessage() . "\n");
}
?>
