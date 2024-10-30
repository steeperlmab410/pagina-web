<?php
class Conexion {
    private $host = "localhost";
    private $db = "posta_miraflores";
    private $user = "root";
    private $password = "";
    private $charset = "utf8mb4";
    private $pdo;

    public function __construct() {
        $this->conectar();
    }

    public function conectar() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    // Método para obtener el PDO
    public function getPDO() {
        return $this->pdo;
    }
}
?>
