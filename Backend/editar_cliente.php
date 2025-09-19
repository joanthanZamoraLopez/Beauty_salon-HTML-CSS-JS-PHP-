<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM clientes WHERE id=$id");
    $cliente = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);

    $sql = "UPDATE clientes SET nombre=?, email=?, telefono=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $email, $telefono, $id);
    $stmt->execute();

    header("Location: admin_citas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Cliente</title>
  <link rel="stylesheet" href="/../src/normalize.css">
  <link rel="stylesheet" href="/../src/styles.css">
</head>
<body>

  <section class="editar_contenedor">
    <h1>✏️ Editar Cliente</h1>

    <form method="POST" class="formulario-contacto">
      <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>">
      </div>

      <button type="submit" class="btn-enviar">💾 Guardar Cambios</button>
    </form>

    <a href="admin_citas.php" class="btn-volver">🔙 Volver</a>
  </section>

</body>
</html>
