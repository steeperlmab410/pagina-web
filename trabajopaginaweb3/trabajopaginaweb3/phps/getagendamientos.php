<?php
session_start();
if (!isset($_SESSION['usuario_id'])); {
    header('Location: index.php');
    exit();
}

require_once 'Conexion.php';

$db = new Conexion();
$conn = $db->getPDO();

$q = 'select * from solicitud_hora where id=:id';
$stmt = $conn->prepare($q);
$stmt->bindParam(':id', $_SESSION['usuario_id']);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // enlistar todas las citas registradas
    // y devolverlas en un <option>
}



?>