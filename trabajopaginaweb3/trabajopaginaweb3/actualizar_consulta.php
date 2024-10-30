<?php
session_start();
require_once 'phps/Conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: iniciosesion.php');
    exit();
}

if (!isset($_GET['consulta_id'])) {
    header('Location: mis_consultas.php');
    exit();
}

$conexion = new Conexion();
$pdo = $conexion->getPDO();

// Obtener la consulta actual
$stmt = $pdo->prepare("SELECT * FROM solicitud_hora WHERE id = :id AND usuario_id = :usuario_id");
$stmt->execute([
    'id' => $_GET['consulta_id'],
    'usuario_id' => $_SESSION['usuario_id']
]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$consulta) {
    header('Location: mis_consultas.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Consulta - Posta Miraflores</title>
    <link rel="stylesheet" href="css/agendamiento.css">
    <style>
        .nav-button {
            text-align: center;
            margin-bottom: 10px;
        }
        .nav-button a {
            display: inline-block;
            padding: 5px 15px;
            text-decoration: none;
            color: white;
            background: none;
            transition: background-color 0.3s;
        }
        .nav-button a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>POSTA MIRAFLORES</h1>
        <div class="nav-button">
            <a href="index.php">Inicio</a>
            <a href="mis_consultas.php">Mis Consultas</a>
        </div>
    </header>

    <section id="agendar-hora">
        <h2>Actualizar Consulta</h2>
        <p>Actualiza los datos de tu consulta médica.</p>
        
        <form action="phps/procesar_actualizacion.php" method="post">
            <input type="hidden" name="consulta_id" value="<?= $consulta['id'] ?>">
            
            <label for="fecha">Fecha de la Consulta</label>
<input type="date" id="fecha" name="fecha" 
       min="<?php echo date('Y-m-d'); ?>" 
       value="<?= $consulta['fecha_consulta'] ?>" 
       required>

<label for="hora">Hora de la Consulta</label>
<input type="time" id="hora" name="hora" 
       min="08:00" max="20:00" 
       value="<?= $consulta['hora_consulta'] ?>" 
       required>
            
            <label for="motivo">Motivo de la Consulta</label>
            <textarea id="motivo" name="motivo" required><?= htmlspecialchars($consulta['motivo']) ?></textarea>
            
            <button class="button" type="submit">Guardar Cambios</button>
        </form>
    </section>

    <footer>
        <p>2024 - Posta Miraflores - Política de Privacidad</p>
    </footer>
    // Agregar este script en agendamiento.php y actualizar_consulta.php
<script>
document.getElementById('fecha').addEventListener('change', function() {
    const fechaSeleccionada = new Date(this.value);
    const fechaActual = new Date();
    
    if (fechaSeleccionada < fechaActual) {
        alert('No se pueden seleccionar fechas pasadas');
        this.value = '';
    }
});

document.getElementById('hora').addEventListener('change', function() {
    const hora = this.value;
    if (hora < '08:00' || hora > '20:00') {
        alert('El horario de atención es de 8:00 a 20:00');
        this.value = '';
    }
});
</script>
</body>
</html>