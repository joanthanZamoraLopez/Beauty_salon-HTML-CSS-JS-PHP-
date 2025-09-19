function enviarPorWhatsApp() {
  const nombre = document.getElementById('nombre').value;
  const email = document.getElementById('email').value;
  const mensaje = document.getElementById('mensaje').value;

  if (!nombre || !email || !mensaje) {
    alert('Por favor completa todos los campos antes de enviar.');
    return;
  }

  const texto = `Nombre: ${nombre}%0AEmail: ${email}%0AMensaje: ${mensaje}`;
  const url = `https://api.whatsapp.com/send?phone=+5211234567890&text=${texto}`;
  window.open(url, '_blank');
}

function mostrarFormularioReserva() {
  if(!validarFormularioContacto())return;
  document.getElementById('form-reserva').style.display = 'block';
}

