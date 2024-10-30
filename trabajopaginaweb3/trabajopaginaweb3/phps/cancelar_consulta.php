<?php
session_start();
require_once 'Conexion.php';

if (!isset($_SESSION['usuario_id']) || !isset($_POST['consulta_id'])) {
    header('Location: ../mis_consultas.php');
    exit();
}

$conexion = new Conexion();
$pdo = $conexion->getPDO();

$stmt = $pdo->prepare("DELETE FROM solicitud_hora WHERE id = :id AND usuario_id = :usuario_id");
$resultado = $stmt->execute([
    'id' => $_POST['consulta_id'],
    'usuario_id' => $_SESSION['usuario_id']
]);

if ($resultado) {
    $_SESSION['mensaje'] = "La consulta ha sido cancelada exitosamente.";
} else {
    $_SESSION['mensaje'] = "Hubo un error al cancelar la consulta.";
}

header('Location: ../mis_consultas.php');
exit();
?>