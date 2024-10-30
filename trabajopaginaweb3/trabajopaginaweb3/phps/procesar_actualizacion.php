<?php
session_start();
require_once 'Conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../iniciosesion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $consulta_id = $_POST['consulta_id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Validar que la fecha no sea anterior a hoy
    $fecha_actual = date('Y-m-d');
    $hora_actual = date('H:i');
    
    if ($fecha < $fecha_actual || 
        ($fecha == $fecha_actual && $hora < $hora_actual)) {
        $_SESSION['mensaje'] = "No se pueden agendar horas para fechas u horas pasadas.";
        header('Location: ../mis_consultas.php');
        exit();
    }

    $conexion = new Conexion();
    $pdo = $conexion->getPDO();

    // Verificar que la consulta pertenezca al usuario
    $stmt = $pdo->prepare("SELECT id FROM solicitud_hora WHERE id = :id AND usuario_id = :usuario_id");
    $stmt->execute([
        'id' => $consulta_id,
        'usuario_id' => $_SESSION['usuario_id']
    ]);

    if ($stmt->fetch()) {
        // Actualizar la consulta
        $stmt = $pdo->prepare("UPDATE solicitud_hora SET fecha_consulta = :fecha, hora_consulta = :hora, motivo = :motivo WHERE id = :id");
        $stmt->execute([
            'fecha' => $fecha,
            'hora' => $hora,
            'motivo' => $motivo,
            'id' => $consulta_id
        ]);

        $_SESSION['mensaje'] = "La consulta se ha actualizado correctamente.";
    }
}

header('Location: ../mis_consultas.php');
exit();
?>