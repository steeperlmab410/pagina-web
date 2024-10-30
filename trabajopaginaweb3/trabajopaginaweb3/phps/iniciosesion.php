<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Posta Miraflores</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <section id="login-form">
        <h2>Iniciar Sesión</h2>
        <form action="procesar_iniciosesion.php" method="POST">
            <label for="rut">RUT:</label>
            <input type="text" name="rut" id="rut" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
            echo "<p style='color:red;'>RUT o contraseña incorrectos</p>";
        }
        ?>
    </section>
</body>
</html>
