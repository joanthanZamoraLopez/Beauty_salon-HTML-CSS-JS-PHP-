<?php
include 'db.php';

$sql = "SELECT c.id, cl.nombre, cl.email, cl.telefono, c.fecha, c.hora, c.servicio
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
  <link rel="stylesheet" href="/../src/normalize.css">
  <link rel="stylesheet" href="/../src/styles.css">
</head>
<body>

  <h1 class="title_listaCitas">Lista de Citas</h1>
  <a href="/../contacto.html" class="btn-nuevo">➕ Nueva Cita</a>

  <table>
    <tr>
      <th>Cliente</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Servicio</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Acciones</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nombre']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['telefono']) ?></td>
        <td><?= htmlspecialchars($row['servicio']) ?></td>
        <td><?= htmlspecialchars($row['fecha']) ?></td>
        <td><?= htmlspecialchars($row['hora']) ?></td>
        <td>
          <a href="editar_cliente.php?id=<?= $row['id'] ?>">✏️ Editar</a> |
          <a href="eliminar_cliente.php?id=<?= $row['id'] ?>">🗑 Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <a href="/../contacto.html" class="btn-volver">🔙 Volver</a>

<?php $conn->close(); ?>
</body>
</html>
