
// --- Gestion du filtrage ---
const objectifValues = ["perte-de-poids", "force", "cardio", "bienetre"];
const niveauValues   = ["debutant", "intermediaire", "avance"];

const filterButtons = document.querySelectorAll(".prog-objectifs-buttons button");
const cards         = document.querySelectorAll(".programme-card");
const noResults     = document.getElementById("no-results");

let activeObjectif = null;
let activeNiveau   = null;

function applyFilters() {
  let visible = 0;

  cards.forEach(card => {
    const categories = (card.getAttribute("data-category") || "").split(" ");
    const matchObjectif = !activeObjectif || categories.includes(activeObjectif);
    const matchNiveau   = !activeNiveau   || categories.includes(activeNiveau);
    const show = matchObjectif && matchNiveau;
    card.style.display = show ? "block" : "none";
    if (show) visible++;
  });

  if (noResults) noResults.style.display = visible === 0 ? "block" : "none";
}

filterButtons.forEach(button => {
  button.addEventListener("click", () => {
    const filter = button.getAttribute("data-filter") || "all";

    if (filter === "all") {
      activeObjectif = null;
      activeNiveau   = null;
      filterButtons.forEach(b => b.classList.remove("active"));
      button.classList.add("active");
    } else if (objectifValues.includes(filter)) {
      // Toggle objectif
      if (activeObjectif === filter) {
        activeObjectif = null;
        button.classList.remove("active");
      } else {
        filterButtons.forEach(b => {
          if (objectifValues.includes(b.getAttribute("data-filter"))) b.classList.remove("active");
        });
        activeObjectif = filter;
        button.classList.add("active");
      }
      // Retirer "Tout" si un filtre est actif
      document.querySelector('[data-filter="all"]')?.classList.remove("active");
    } else if (niveauValues.includes(filter)) {
      // Toggle niveau
      if (activeNiveau === filter) {
        activeNiveau = null;
        button.classList.remove("active");
      } else {
        filterButtons.forEach(b => {
          if (niveauValues.includes(b.getAttribute("data-filter"))) b.classList.remove("active");
        });
        activeNiveau = filter;
        button.classList.add("active");
      }
      document.querySelector('[data-filter="all"]')?.classList.remove("active");
    }

    // Si plus aucun filtre actif, reactiver "Tout"
    if (!activeObjectif && !activeNiveau) {
      document.querySelector('[data-filter="all"]')?.classList.add("active");
    }

    applyFilters();
  });
});
