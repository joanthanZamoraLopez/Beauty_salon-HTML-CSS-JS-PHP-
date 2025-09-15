// Selección de elementos
const modal = document.getElementById("modal");
const modalImg = document.getElementById("imagen-modal");
const cerrar = document.querySelector(".cerrar");

// Abre el modal al hacer clic en cualquier imagen
document.querySelectorAll(".galeria img").forEach(img => {
  img.addEventListener("click", () => {
    modal.style.display = "block";
    modalImg.src = img.src;
  });
});

// Cierra el modal al hacer clic en la X
cerrar.addEventListener("click", () => {
  modal.style.display = "none";
});

// Cierra el modal si se hace clic en el fondo oscuro
modal.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});
