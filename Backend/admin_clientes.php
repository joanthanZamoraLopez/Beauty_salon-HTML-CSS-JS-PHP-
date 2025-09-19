<?php
include 'db.php';

$sql = "SELECT c.id, cl.nombre, c.fecha, c.hora, c.servicio
        FROM citas c
        JOIN clientes cl ON c.cliente_id = cl.id
        ORDER BY c.fecha, c.hora";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Citas</title>
    <link rel="preload" href="/../src/normalize.css" as="style">
    <link rel="stylesheet" href="/../src/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="/../src/styles.css"> <!-- ✅ Aquí conectas tu CSS principal -->
</head>

<body class="contenedor_login">

    <h1 class="login_title">Lista de Citas</h1>

    <table>
        <tr>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Servicio</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['hora'] ?></td>
                <td><?= htmlspecialchars($row['servicio']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="admin_clientes.php" class="btn-volver">🔙 Volver a Clientes</a>

    <?php $conn->close(); ?>

</body>

</html>