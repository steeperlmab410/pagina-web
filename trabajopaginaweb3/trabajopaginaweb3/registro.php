<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posta Miraflores - Registro</title>
    <link rel="stylesheet" href="css/registro.css">
    <style>
        .nav-buttons {
            text-align: center;
            margin-bottom: 10px; /* Reducido de 20px a 10px */
        }
        .nav-buttons a {
            display: inline-block;
            padding: 5px 15px; /* Reducido el padding vertical */
            text-decoration: none;
            color: white;
            background: none;
            margin: 0 10px;
            transition: background-color 0.3s;
        }
        .nav-buttons a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        header {
            padding-bottom: 10px; /* Añadido para reducir el espacio debajo del header */
        }
    </style>
</head>
<body>
    <header>
        <h1>POSTA MIRAFLORES</h1>
        <div class="nav-buttons">
            <a href="index.php">Inicio</a>
            <a href="iniciosesion.php">Iniciar Sesión</a>
        </div>
    </header>

    <section id="registro">
        <div class="container">
            <?php   
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'rut') {
                    echo "<p class='error'>El rut ingresado ya está registrado.</p>";
                } elseif ($_GET['error'] == 'email') {
                    echo "<p class='error'>El correo ingresado ya está registrado.</p>";
                }
            }
            ?>
            <h2>Regístrate</h2>
            <form action="phps/procesar_registro.php" method="post">
                <label for="nombre">Escribe tu nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="rut">Rut</label>
                <input maxlength="10" type="text" id="rut" name="rut" required>

                <label for="correo">Escribe tu correo</label>
                <input type="email" id="correo" name="correo" required>

                <label for="telefono">Escribe tu teléfono</label>
                <input type="tel" id="telefono" name="telefono" required>

                <label for="contrasena">Escribe tu contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn-enviar">Enviar</button>
            </form>
        </div>
    </section>

    <footer>
        <p>2024 - Posta Miraflores - Política de Privacidad</p>
    </footer>
</body>
</html>