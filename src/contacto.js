// contacto.js
function mostrarConfirmacion(event) {
  event.preventDefault(); // evita recargar la página
  const form = event.target;

  // Enviar datos a Netlify
  fetch("/", {
    method: "POST",
    body: new FormData(form)
  })
  .then(() => {
    document.getElementById("mensaje-confirmacion").style.display = "block"; // mostrar mensaje
    form.reset(); // limpiar formulario
  })
  .catch((error) => alert("Hubo un error al enviar el mensaje: " + error));
}
