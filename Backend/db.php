<?php
$host = "localhost";
$user = "root";  // Usuario por defecto en XAMPP
$pass = "root";      // Contraseña vacía en XAMPP
$dbname = "beauty_salon";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
