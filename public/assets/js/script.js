// --- Gestion du popup ---
const popup = document.getElementById("prog-popup");
const popupText = document.getElementById("prog-popup-text");
const closeBtn = document.querySelector(".prog-close");

if (!popup || !closeBtn) { /* pas de popup sur cette page */ }

// Contenu détaillé pour chaque activité
const programmeInfos = {
  course: `
    <h3>🏃 Course sur tapis</h3>
    <p>Travaillez votre endurance et brûlez des calories.</p>
    <ul>
      <li>Durée : 20-45 min</li>
      <li>Intensité : variable</li>
      <li>Idéal pour débutants et confirmés</li>
    </ul>
  `,
  velo: `
    <h3>🚴 Vélo biking</h3>
    <p>Améliorez vos jambes et votre cardio en même temps.</p>
    <ul>
      <li>Durée : 30-60 min</li>
      <li>Idéal en groupe</li>
      <li>Moins d’impact articulaire</li>
    </ul>
  `,
  hiit: `
    <h3>🔥 HIIT</h3>
    <p>Séances courtes mais très intenses pour des résultats rapides.</p>
    <ul>
      <li>Durée : 15-25 min</li>
      <li>Résultats rapides</li>
      <li>Idéal pour perte de poids</li>
    </ul>
  `,
  boxe: `
    <h3>🥊 Cardio Boxe</h3>
    <p>Combine cardio et explosivité, défoulez-vous !</p>
    <ul>
      <li>Durée : 30-45 min</li>
      <li>Travail haut + bas du corps</li>
      <li>Excellent défouloir</li>
    </ul>
  `
};

// Ouvrir popup
if (popup && popupText && closeBtn) {
  document.querySelectorAll(".prog-btn-popup").forEach(btn => {
    btn.addEventListener("click", () => {
      const infoKey = btn.getAttribute("data-info");
      popupText.innerHTML = programmeInfos[infoKey];
      popup.style.display = "block";
    });
  });

  closeBtn.addEventListener("click", () => {
    popup.style.display = "none";
  });
  window.addEventListener("click", (e) => {
    if (e.target === popup) popup.style.display = "none";
  });
}

// --- Gestion du filtrage ---
const filterButtons = document.querySelectorAll(".prog-objectifs-buttons button");
const cards = document.querySelectorAll(".programme-card");
const noResults = document.getElementById("no-results");

filterButtons.forEach(button => {
  button.addEventListener("click", () => {
    const filter = button.getAttribute("data-filter");

    filterButtons.forEach(b => b.classList.remove("active"));
    button.classList.add("active");

    let visible = 0;
    cards.forEach(card => {
      const categories = card.getAttribute("data-category") || "";
      const show = filter === "all" || categories.split(" ").includes(filter);
      card.style.display = show ? "block" : "none";
      if (show) visible++;
    });

    if (noResults) noResults.style.display = visible === 0 ? "block" : "none";
  });
});