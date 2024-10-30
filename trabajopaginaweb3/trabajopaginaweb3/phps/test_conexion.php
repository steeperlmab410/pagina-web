<?php
// Incluir la clase de conexión
require_once 'Conexion.php';

// Instanciar la clase para probar la conexión
$conexion = new Conexion();

// Probar una consulta simple
try {
    $pdo = $conexion->getPDO();
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->query($sql);
   
    // Mostrar los resultados de la consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id'] . " - Nombre: " . $row['nombre'] . " - Email: " . $row['email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
