const burger = document.getElementById("burger");
const navMenu = document.querySelector("nav ul");

if (burger && navMenu) {
  burger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });
}

const dropdown = document.querySelector(".dropdown");
const dropdownMenu = document.querySelector(".dropdown-menu");

if (dropdown && dropdownMenu) {
  dropdown.addEventListener("mouseenter", () => {
    dropdownMenu.classList.add("show");
  });

  dropdown.addEventListener("mouseleave", () => {
    dropdownMenu.classList.remove("show");
  });

  const dropdownToggle = dropdown.querySelector("a");
  if (dropdownToggle) {
    dropdownToggle.addEventListener("click", (e) => {
      if (dropdownToggle.getAttribute("href") === "#") {
        e.preventDefault();
        dropdownMenu.classList.toggle("show");
      }
    });
  }
}



