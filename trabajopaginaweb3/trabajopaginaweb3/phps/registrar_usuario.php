<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registrarUsuario($nombre, $rut, $correo, $telefono, $contrasena) {
        try {
            $hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, rut, correo, telefono, contrasena, fecha_registro)
                    VALUES (:nombre, :rut, :correo, :telefono, :contrasena, NOW())";
            $stmt = $this->pdo->prepare($sql);
           
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':rut', $rut);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':contrasena', $hashContrasena);

            if ($stmt->execute()) {
                echo "Usuario registrado correctamente.";
            } else {
                echo "Error al registrar el usuario.";
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}
?>
