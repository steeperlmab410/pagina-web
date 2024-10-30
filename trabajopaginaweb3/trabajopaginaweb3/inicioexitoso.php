<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Exitoso - Posta Miraflores</title>
    <link rel="stylesheet" href="css/inicioexitoso.css">
    <script>
        // Función para redirigir a la página de inicio
        function agendar() {
            window.location.href = 'agendamiento.php';
        }
    </script>
</head>
<body>
    <section id="success-message">
        <h2>¡Inicio Exitoso!</h2>
        <p>Has iniciado sesión correctamente. Ahora puedes acceder a todas nuestras funcionalidades.</p>
        <button onclick="agendar()">agendar</button>
    </section>
</body>
</html>