<?php
session_start();
require_once 'Conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../iniciosesion.php');
    exit();
}

$conexion = new Conexion();
$pdo = $conexion->getPDO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rut = $_POST['rut'];
    $fecha_agendamiento = $_POST['fecha'];
    $hora_agendamiento = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Validar que la fecha no sea anterior a hoy
    $fecha_actual = date('Y-m-d');
    $hora_actual = date('H:i');
    
    if ($fecha_agendamiento < $fecha_actual || 
        ($fecha_agendamiento == $fecha_actual && $hora_agendamiento < $hora_actual)) {
        echo "No se pueden agendar horas para fechas u horas pasadas.";
        exit();
    }


    // Consulta para obtener el ID del usuario a partir del RUT
    $sql = "SELECT id FROM usuarios WHERE rut = :rut";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':rut', $rut);

    if ($stmt->execute()) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Ahora usamos el ID del usuario en lugar del RUT
            $sqlAgendar = "INSERT INTO solicitud_hora (usuario_id, fecha_consulta, hora_consulta, motivo, fecha_solicitud) 
                            VALUES (:usuario_id, :fecha, :hora, :motivo, NOW())";
            $stmtAgendar = $pdo->prepare($sqlAgendar);
            $stmtAgendar->bindParam(':usuario_id', $usuario['id']);
            $stmtAgendar->bindParam(':fecha', $fecha_agendamiento);
            $stmtAgendar->bindParam(':hora', $hora_agendamiento);
            $stmtAgendar->bindParam(':motivo', $motivo);

            if ($stmtAgendar->execute()) {
                // Redirigir a la página de agradecimiento
                header("Location: ../agradecimiento.html");
                exit(); // Es importante salir del script después de la redirección
            } else {
                echo "Error al agendar la hora.";
            }
        } else {
            echo "No se encontró el usuario con el RUT proporcionado.";
        }
    } else {
        echo "Error en la consulta para obtener el usuario.";
    }
}
?>