<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Posta Miraflores</title>
    <link rel="stylesheet" href="css/iniciosesion.css">
</head>
<body>
    <header>
        <h1>POSTA MIRAFLORES</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="registro.php">Registro</a></li>
            </ul>
        </nav>
    </header>

    <section id="login">
        <h2>Iniciar Sesión</h2>
        <form action="phps/procesar_iniciosesion.php" method="POST">
            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'invalid') {
                echo "<p class='error'>Los datos ingresados no son correctos. Por favor, inténtalo de nuevo.</p>";
            } elseif ($_GET['error'] == 'notfound') {
                echo "<p class='error'>No se encontró una cuenta asociada a este correo electrónico.</p>";
            }
        }
        ?>
    </section>

    <footer>
        <p>2024 - Posta