<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $asunto = strip_tags(trim($_POST["asunto"]));
    $mensaje = trim($_POST["mensaje"]);

    // Validar campos
    if ( empty($nombre) || empty($asunto) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        echo "Por favor completa todos los campos correctamente.";
        exit;
    }

    // Destinatario (tu correo)
    $destinatario = "animetrix_1102@hotmail.com";  // <- Cambia esto por tu correo
    $titulo = "Nuevo mensaje de tu web: $asunto";

    // Contenido del correo
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    // Cabeceras
    $cabeceras = "From: $nombre <$email>";

    // Enviar correo
    if (mail($destinatario, $titulo, $contenido, $cabeceras)) {
        echo "¡Gracias! Tu mensaje ha sido enviado correctamente.";
    } else {
        echo "Lo sentimos, ocurrió un error al enviar el mensaje.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
