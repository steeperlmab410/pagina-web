<?php
session_start();
require_once 'phps/Conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: iniciosesion.php');
    exit();
}

$conexion = new Conexion();
$pdo = $conexion->getPDO();

// Obtener las consultas del usuario
$stmt = $pdo->prepare("SELECT * FROM solicitud_hora WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['usuario_id']]);
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Consultas - Posta Miraflores</title>
    <link rel="stylesheet" href="css/mis_consultas.css">
</head>
<body>
    <header>
        <h1>POSTA MIRAFLORES</h1>
        <div class="nav-button">
            <a href="index.php">Inicio</a>
            <a href="agendamiento.php">Agendar Consulta</a>
        </div>
    </header>

    <section id="mis-consultas">
        <h2>Mis Consultas Agendadas</h2>
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<p class='mensaje'>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
            unset($_SESSION['mensaje']);
        }
        ?>
        <?php if (empty($consultas)): ?>
            <p>No tienes consultas agendadas.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Motivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $consulta): ?>
                        <tr>
                            <td><?= htmlspecialchars($consulta['fecha_consulta']) ?></td>
                            <td><?= htmlspecialchars($consulta['hora_consulta']) ?></td>
                            <td><?= htmlspecialchars($consulta['motivo']) ?></td>
                            <td class="acciones">
                                <form action="phps/cancelar_consulta.php" method="post" style="display: inline;">
                                    <input type="hidden" name="consulta_id" value="<?= $consulta['id'] ?>">
                                    <button type="submit" class="btn-cancelar">Cancelar</button>
                                </form>
                                <form action="actualizar_consulta.php" method="get" style="display: inline;">
                                    <input type="hidden" name="consulta_id" value="<?= $consulta['id'] ?>">
                                    <button type="submit" class="btn-cancelar">Actualizar</button> <!-- Cambiado a btn-cancelar -->
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

    <footer>
        <p>2024 - Posta Miraflores - Política de Privacidad</p>
    </footer>
</body>
</html>