// src/login.js

document.addEventListener("DOMContentLoaded", () => {
  const btnClientes = document.getElementById("btn-clientes");
  const btnLogout = document.getElementById("btn-logout");
  const modal = document.getElementById("login-modal");
  const closeBtn = document.getElementById("close-login");
  const loginBtn = document.getElementById("modal-login-btn");
  const errorMsg = document.getElementById("login-error");

  const adminUser = "admin";
  const adminPass = "123456";

  // Restaurar estado si ya está logueado
  if (localStorage.getItem("adminLogged")) {
    btnClientes.href = "/Backend/admin_citas.php";
    btnLogout.style.display = "inline-block";
  } else {
    btnClientes.href = "#";
  }

  // Mostrar modal solo cuando NO esté logueado
  btnClientes.addEventListener("click", (e) => {
    if (!localStorage.getItem("adminLogged")) {
      e.preventDefault();
      modal.style.display = "block";
    }
  });

  // Cerrar modal al presionar la X o fuera del modal
  closeBtn.addEventListener("click", () => (modal.style.display = "none"));
  window.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
  });

  // Login
  loginBtn.addEventListener("click", () => {
    const user = document.getElementById("modal-username").value.trim();
    const pass = document.getElementById("modal-password").value.trim();

    if (user === adminUser && pass === adminPass) {
      localStorage.setItem("adminLogged", "true");
      modal.style.display = "none";
      btnLogout.style.display = "inline-block";
      errorMsg.style.display = "none";
      alert("✅ Login exitoso. Ahora puedes acceder a Clientes.");
      window.location.href = "/Backend/admin_citas.php";
       
    } else {
      errorMsg.style.display = "block";
      errorMsg.textContent = "❌ Usuario o contraseña incorrectos";
    }
  });

  // Logout
  btnLogout.addEventListener("click", () => {
    localStorage.removeItem("adminLogged");
    btnLogout.style.display = "none";
    btnClientes.href = "#";
    alert("🔒 Has cerrado sesión. El acceso a Clientes está bloqueado.");
  });
});
