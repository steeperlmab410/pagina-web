<?php
session_start();
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];

    $conexion = new Conexion();
    $pdo = $conexion->getPDO();

    $sql = "SELECT id, contrasena FROM usuarios WHERE correo = :correo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password, $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            header('Location: ../inicioexitoso.php');
            exit();
        } else {
            header('Location: ../iniciosesion.php?error=invalid');
            exit();
        }
    } else {
        // Usuario no encontrado, redirigir a avisoregistrarse.html
        header('Location: ../avisoregistrarse.html');
        exit();
    }
} else {
    header('Location: ../iniciosesion.php');
    exit();
}
?>