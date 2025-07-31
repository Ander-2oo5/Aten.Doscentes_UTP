-- SQL script para crear la base de datos y las tablas para el sistema UTP.
-- Usar en XAMPP/MySQL.

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS utp_sistema CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE utp_sistema;

--
-- Estructura de la tabla `usuarios`
--
CREATE TABLE `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `rol` ENUM('administrador', 'profesor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de la tabla `recursos`
--
CREATE TABLE `recursos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de la tabla `reservas`
--
CREATE TABLE `reservas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NOT NULL,
  `recurso_id` INT NOT NULL,
  `fecha_reserva` DATE NOT NULL,
  `estado` ENUM('confirmada', 'cancelada', 'completada') NOT NULL DEFAULT 'confirmada',
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`recurso_id`) REFERENCES `recursos`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertar datos iniciales (opcional, pero recomendado para empezar)
--

-- Insertar algunos recursos de ejemplo
INSERT INTO `recursos` (`nombre`) VALUES
('Manejo de las TIC'),
('Técnicas de estudio'),
('Crecimiento personal'),
('Actividades Pedagógicas'),
('Manejo de la diversidad en el aula'),
('Elaboración de programación docente'),
('Juegos didácticos');

-- Nota: El usuario administrador y la migración de datos se manejarán con un script de PHP (seed.php).
