// contacto.js

// Enviar formulario a Netlify
function enviarFormulario(event) {
  event.preventDefault();
  const form = event.target;

  fetch("/", {
    method: "POST",
    body: new FormData(form)
  })
  .then(() => {
    document.getElementById("mensaje-confirmacion").style.display = "block";
    form.reset();
  })
  .catch((error) => alert("Hubo un error al enviar el mensaje: " + error));
}

// Enviar datos por WhatsApp
function enviarPorWhatsApp() {
  const nombre = document.getElementById("nombre").value;
  const email = document.getElementById("email").value;
  const asunto = document.getElementById("asunto").value;
  const mensaje = document.getElementById("mensaje").value;

  if (!nombre || !email || !asunto || !mensaje) {
    alert("Por favor completa todos los campos antes de enviar por WhatsApp.");
    return;
  }

  const numero = "523326678151"; // <-- Cambia a tu número de WhatsApp con lada
  const texto = `Hola, soy ${nombre} (${email}).%0AAsunto: ${asunto}%0A${mensaje}`;
  const url = `https://wa.me/${numero}?text=${texto}`;

  window.open(url, "_blank");
}
