<?php
include 'db.php';

// Mostrar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir campos comunes
    $nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

    // Campos de reserva (opcionales)
    $fecha    = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
    $hora     = isset($_POST['hora']) ? trim($_POST['hora']) : '';
    $servicio = isset($_POST['servicio']) ? trim($_POST['servicio']) : '';

    // Validar campos obligatorios del cliente
    if (empty($nombre) || empty($email) || empty($telefono)) {
        die("❌ Por favor, completa todos los campos de información del cliente.");
        
    }

    // Validar campos de reserva si alguno se llenó
    $reservaCompleta = false;
    if (!empty($fecha) || !empty($hora) || !empty($servicio)) {
        if (empty($fecha) || empty($hora) || empty($servicio)) {
            die("❌ Para reservar una cita, todos los campos de servicio, fecha y hora son obligatorios.");
        }
        $reservaCompleta = true;
    }

    // Insertar cliente
    $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en preparación: " . $conn->error);
    }
    $stmt->bind_param("sss", $nombre, $email, $telefono);
    $stmt->execute();
    $cliente_id = $stmt->insert_id;
    $stmt->close();

    // Insertar cita solo si la reserva está completa
    if ($reservaCompleta) {
        $sqlCita = "INSERT INTO citas (cliente_id, fecha, hora, servicio) VALUES (?, ?, ?, ?)";
        $stmtCita = $conn->prepare($sqlCita);
        if (!$stmtCita) {
            die("Error en preparación cita: " . $conn->error);
        }
        $stmtCita->bind_param("isss", $cliente_id, $fecha, $hora, $servicio);
        $stmtCita->execute();
        $stmtCita->close();
        echo "✅ Cliente y cita registrados correctamente.<br>";
    } else {
        echo "✅ Cliente registrado correctamente.<br>";
    }

    header("Location: admin_citas.php");
    $conn->close();

} else {
    die("❌ Acceso inválido.");
}
?>
