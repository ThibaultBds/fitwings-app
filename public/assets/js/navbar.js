// === NAVBAR.JS ===

// Gestion du burger menu (mobile)
const burger = document.getElementById("burger");
const navMenu = document.querySelector("nav ul");

if (burger && navMenu) {
  burger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });
}

// Gestion du dropdown Prestations
const dropdown = document.querySelector(".dropdown");
const dropdownMenu = document.querySelector(".dropdown-menu");

// Mode desktop : ouverture au survol
if (dropdown && dropdownMenu) {
  dropdown.addEventListener("mouseenter", () => {
    dropdownMenu.classList.add("show");
  });

  dropdown.addEventListener("mouseleave", () => {
    dropdownMenu.classList.remove("show");
  });

  // Mode mobile : ouverture au clic sur le lien toggle uniquement
  const dropdownToggle = dropdown.querySelector("a");
  if (dropdownToggle) {
    dropdownToggle.addEventListener("click", (e) => {
      // éviter de suivre le lien "#" mais laisser passer les clics sur les sous-liens
      if (dropdownToggle.getAttribute("href") === "#") {
        e.preventDefault();
        dropdownMenu.classList.toggle("show");
      }
    });
  }
}