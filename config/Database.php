<?php
// config/Database.php

class Database {
    // Parámetros de la base de datos
    private $host = 'localhost'; // O la IP donde esté tu base de datos XAMPP
    private $db_name = 'utp_sistema';
    private $username = 'utp_user';
    private $password = 'password';
    private $conn;

    // Método para obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8';
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // En un entorno de producción, no mostrarías el error detallado
            // podrías registrar el error en un archivo de log.
            die('Error de Conexión: ' . $e->getMessage());
        }

        return $this->conn;
    }
}
?>
