// --- Gestion du popup ---
const popup = document.getElementById("prog-popup");
const popupText = document.getElementById("prog-popup-text");
const closeBtn = document.querySelector(".prog-close");

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
document.querySelectorAll(".prog-btn-popup").forEach(btn => {
  btn.addEventListener("click", () => {
    const infoKey = btn.getAttribute("data-info");
    popupText.innerHTML = programmeInfos[infoKey];
    popup.style.display = "block";
  });
});

// Fermer popup
closeBtn.addEventListener("click", () => {
  popup.style.display = "none";
});
window.addEventListener("click", (e) => {
  if (e.target === popup) popup.style.display = "none";
});

// --- Gestion du filtrage ---
const filterButtons = document.querySelectorAll(".prog-objectifs-buttons button");
const cards = document.querySelectorAll(".prog-card");

filterButtons.forEach(button => {
  button.addEventListener("click", () => {
    const filter = button.getAttribute("data-filter");

    cards.forEach(card => {
      if (card.getAttribute("data-type").includes(filter) || filter === "all") {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});
""  