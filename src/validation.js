// Mostrar tooltip avanzado con degradado y sombra
function mostrarError(input, mensaje, tipo = "error") {
  // Eliminar tooltip previo
  let tooltip = input.parentElement.querySelector(".error-tooltip");
  if (tooltip) tooltip.remove();

  if (mensaje) {
    tooltip = document.createElement("div");
    tooltip.classList.add("error-tooltip", tipo);
    tooltip.innerHTML = `<div class="tooltip-arrow"></div><span class="tooltip-text">${mensaje}</span>`;
    input.parentElement.appendChild(tooltip);

    input.classList.add("input-error");

    // Detectar si el input está cerca del borde derecho de la pantalla
    const rect = tooltip.getBoundingClientRect();
    if (rect.right > window.innerWidth) {
      tooltip.style.right = "auto";
      tooltip.style.left = "-10px";
      tooltip.style.transform = "translateX(-105%) translateY(-50%)";
    }

    // Animación “temblor” del input
    input.animate(
      [
        { transform: "translateX(0)" },
        { transform: "translateX(-2px)" },
        { transform: "translateX(2px)" },
        { transform: "translateX(0)" }
      ],
      { duration: 200 }
    );
  } else {
    input.classList.remove("input-error");
  }
}

// Validar formulario
function validarFormularioContacto() {
  let esValido = true;
  const nombre = document.getElementById("nombre");
  const email = document.getElementById("email");
  const telefono = document.getElementById("telefono");

  // Nombre solo letras y espacios
  const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
  if (!nombre.value.trim()) {
    mostrarError(nombre, "El nombre es obligatorio", "error");
    esValido = false;
  } else if (!nombreRegex.test(nombre.value.trim())) {
    mostrarError(nombre, "Solo letras y espacios", "warning");
    esValido = false;
  } else {
    mostrarError(nombre, "");
  }

  // Email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email.value.trim()) {
    mostrarError(email, "El correo es obligatorio", "error");
    esValido = false;
  } else if (!emailRegex.test(email.value.trim())) {
    mostrarError(email, "Correo no válido", "warning");
    esValido = false;
  } else {
    mostrarError(email, "");
  }

  // Teléfono mínimo 10 dígitos
  const telValor = telefono.value.trim();
  const telRegex = /^\d{10,}$/;
  if (!telValor) {
    mostrarError(telefono, "El teléfono es obligatorio", "error");
    esValido = false;
  } else if (!telRegex.test(telValor)) {
    mostrarError(telefono, "Debe tener al menos 10 dígitos", "warning");
    esValido = false;
  } else {
    mostrarError(telefono, "");
  }

  return esValido;
}

// Validación en tiempo real
document.addEventListener("DOMContentLoaded", () => {
  ["nombre", "email", "telefono"].forEach(id => {
    const input = document.getElementById(id);
    input.addEventListener("input", () => validarFormularioContacto());

    // Tooltip se mueve suavemente al pasar el mouse
    input.addEventListener("mouseenter", () => {
      const tooltip = input.parentElement.querySelector(".error-tooltip");
      if (tooltip) tooltip.style.transform += " translateX(2px)";
    });
    input.addEventListener("mouseleave", () => {
      const tooltip = input.parentElement.querySelector(".error-tooltip");
      if (tooltip) tooltip.style.transform = tooltip.style.transform.replace(" translateX(2px)", "");
    });
  });
});

// Mostrar formulario de reserva solo si campos válidos
function mostrarReserva() {
  if (!validarFormularioContacto()) return;

  document.getElementById("res-nombre").value = document.getElementById("nombre").value;
  document.getElementById("res-email").value = document.getElementById("email").value;
  document.getElementById("res-telefono").value = document.getElementById("telefono").value;
  document.getElementById("res-mensaje").value = document.getElementById("mensaje").value;

  document.getElementById("form-reserva").style.display = "block";
  window.scrollTo({ top: document.getElementById("form-reserva").offsetTop - 20, behavior: "smooth" });
}

// Enviar por WhatsApp
function enviarWhatsApp() {
  if (!validarFormularioContacto()) return;

  const nombre = document.getElementById("nombre").value;
  const email = document.getElementById("email").value;
  const mensaje = document.getElementById("mensaje").value;

  const texto = `Nombre: ${nombre}%0AEmail: ${email}%0AMensaje: ${mensaje}`;
  const url = `https://api.whatsapp.com/send?phone=+5211234567890&text=${texto}`;
  window.open(url, "_blank");
}
