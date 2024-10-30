<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Hora</title>
</head>
<body>
    <h2>Agendar Hora</h2>
    <form action="procesar_agendamiento.php" method="POST">
        <label for="rut">RUT:</label>
        <input type="text" id="rut" name="rut" required><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required><br><br>

        <input type="submit" value="Agendar">
    </form>
</body>
</html>
