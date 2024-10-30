<?php
// Incluir la clase de conexión
require_once 'Conexion.php';
require_once 'registrar_usuario.php';

$conexion = new Conexion();

$pdo = $conexion->getPDO();

$usuario = new Usuario($pdo);

// Comprobar si los datos se han enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    
    $checkrut = "SELECT id FROM usuarios WHERE rut = :rut";
    $stmt = $pdo->prepare($checkrut);
    $stmt->bindParam(':rut', $rut);
    $stmt->execute();

    if ($stmt->rowCount()>0) {
        header('Location: ../registro.php?error=rut'); 
        die();       
    }
    
    $checkcorreo = "SELECT id FROM usuarios WHERE correo = :correo";
    $stmt = $pdo->prepare($checkcorreo);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    
    if ($stmt->rowCount()>0) {
        header('Location: ../registro.php?error=email'); 
        die();       
    }
    // Crear una instancia de la clase Conexion

    // Llamar al método registrarUsuario
    $usuario->registrarUsuario($nombre, $rut, $correo, $telefono, $contrasena);
    header('Location: ../registroexitoso.html');
    exit();
}

?>