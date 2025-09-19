<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: admin_citas.php");
    exit();
}

$id = intval($_GET['id']);

// Obtener datos del cliente para mostrar en confirmación
$result = $conn->query("SELECT nombre FROM clientes WHERE id=$id");
$cliente = $result->fetch_assoc();

if (!$cliente) {
    header("Location: admin_citas.php");
    exit();
}

// Procesar confirmación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->query("DELETE FROM citas WHERE cliente_id=$id");
    $conn->query("DELETE FROM clientes WHERE id=$id");
    header("Location: admin_citas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eliminar Cliente</title>
  <link rel="stylesheet" href="/../src/normalize.css">
  <link rel="stylesheet" href="/../src/styles.css">
</head>
<body>

  <section class="admin-section">
    <h1>⚠️ Eliminar Cliente</h1>
    <p>¿Estás seguro de que deseas eliminar al cliente <strong><?php echo htmlspecialchars($cliente['nombre']); ?></strong> y todas sus citas?</p>

    <form method="POST">
      <button type="submit" class="btn-eliminar">🗑 Confirmar Eliminación</button>
      <a href="admin_citas.php" class="btn-volver">🔙 Cancelar</a>
    </form>
  </section>

</body>
</html>
