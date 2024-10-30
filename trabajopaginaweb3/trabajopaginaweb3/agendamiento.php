<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header('Location: iniciosesion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Hora Médica - Posta Miraflores</title>
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
        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 15px 30px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #218838;
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
        <h2>Agendar Hora Médica</h2>
        <p>Selecciona una fecha y hora para tu consulta médica.</p>
        
        <form action="./phps/procesar_agendamiento.php" method="post">
            <label for="rut">Rut</label>
            <input maxlength="10" type="text" id="rut" name="rut" required>

            <label for="fecha">Fecha de la Consulta</label>
            <input type="date" id="fecha" name="fecha" 
             min="<?php echo date('Y-m-d'); ?>" 
             required>

            <label for="hora">Hora de la Consulta</label>
            <input type="time" id="hora" name="hora" 
            min="08:00" max="20:00" 
            required>

            <label for="motivo">Motivo de la Consulta</label>
            <textarea id="motivo" name="motivo" required></textarea>

            <button class="button" type="submit">Confirmar Hora</button>
        </form>
    </section>

    <footer>
        <p>2024 - Posta Miraflores - Política de Privacidad</p>
    </footer>

</body>// Agregar este script en agendamiento.php y actualizar_consulta.php
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
</html>