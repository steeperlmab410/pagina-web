<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Posta Miraflores</title>
    <link rel="stylesheet" href="css/bienvenida.css">
    <script>
        // Función para redirigir a la página de inicio de sesión
        function iniciarSesion() {
            window.location.href = 'iniciosesion.php';
        }

        // Función para redirigir a la página de registro
        function registrarse() {
            window.location.href = 'registro.php';
        }
    </script>
</head>
<body>

    <header>
        <h1>POSTA MIRAFLORES</h1>
    </header>

    <section id="welcome">
        <h2 style="color: white;">Bienvenido a Posta Miraflores</h2>
        <p style="color: white;">Nos alegra que estés aquí. Nuestro objetivo es cuidar de tu salud y bienestar. Utiliza las opciones de abajo para iniciar sesión o registrarte, y comienza a gestionar tus citas médicas con nosotros.</p>
        <button onclick="iniciarSesion()">Iniciar Sesión</button>
        <button onclick="registrarse()">Registrarse</button>
    </section>

    <footer>
        <p>2024 - Posta Miraflores - Política de Privacidad</p>
    </footer>

</body>
</html>



