<?php
$pageTitle = 'Fitwings – Programmes';
require_once __DIR__ . '/../templates/header.php';
?>

<header class="prog-banner">
  <h1>Nos <span>Programmes</span> Fitwings</h1>
  <p>Trouvez l'entraînement adapté à vos objectifs</p>
</header>

<main class="prog-container">

  <!-- Filtres -->
  <p class="prog-filters-label">Filtrer par objectif ou niveau</p>
  <div class="prog-objectifs-buttons">
    <button type="button" data-filter="all" class="active">Tout</button>
    <button type="button" data-filter="perte-de-poids">Perte de poids</button>
    <button type="button" data-filter="force">Force</button>
    <button type="button" data-filter="cardio">Cardio</button>
    <button type="button" data-filter="bienetre">Bien-être</button>
    <button type="button" data-filter="debutant">Débutant</button>
    <button type="button" data-filter="intermediaire">Intermédiaire</button>
    <button type="button" data-filter="avance">Avancé</button>
  </div>

  <!-- Formulaire programme personnalisé -->
  <section class="card form-container">
    <h2>🎯 Recevez un programme personnalisé</h2>
    <form method="post" action="" class="objectif-form">
      <label for="email">Votre email :</label>
      <input type="email" name="email" id="email" required>

      <label for="objectif">Votre objectif :</label>
      <select name="objectif" id="objectif" required>
        <option value="poids">🔥 Perte de poids</option>
        <option value="force">💪 Force & Musculation</option>
        <option value="cardio">🏃 Endurance & Cardio</option>
        <option value="bienetre">😊 Bien-être & Santé</option>
      </select>

      <label for="niveau">Votre niveau :</label>
      <select name="niveau" id="niveau" required>
        <option value="debutant">Débutant</option>
        <option value="intermediaire">Intermédiaire</option>
        <option value="avance">Avancé</option>
      </select>

      <label for="type">Type de programme :</label>
      <select name="type" id="type" required>
        <option value="hiit">🔥 HIIT</option>
        <option value="musculation">💪 Musculation</option>
        <option value="yoga">🧘 Yoga</option>
        <option value="cardio">🏃 Cardio classique</option>
      </select>

      <button type="submit" class="prog-btn">Recevoir mon programme</button>
    </form>
  </section>

  <!-- Grille de programmes -->
  <section class="prog-grid">
    <h2>Programmes disponibles</h2>
    <div class="cards-grid">

      <div class="programme-card" data-category="perte-de-poids cardio debutant">
        <h3>🔥 Brûleur Débutant</h3>
        <p>Programme cardio doux pour débuter en douceur et perdre du poids progressivement.</p>
        <span class="badge niveau-debutant">Débutant</span>
        <a href="#" class="prog-btn">👀 Voir détail</a>
      </div>

      <div class="programme-card" data-category="force intermediaire">
        <h3>💪 Force Intermédiaire</h3>
        <p>Développez votre force avec un programme Full Body structuré 3 fois par semaine.</p>
        <span class="badge niveau-intermediaire">Intermédiaire</span>
        <a href="#" class="prog-btn">👀 Voir détail</a>
      </div>

      <div class="programme-card" data-category="perte-de-poids cardio avance">
        <h3>⚡ HIIT Intense</h3>
        <p>Séances courtes et explosives pour brûler un maximum de calories en peu de temps.</p>
        <span class="badge niveau-avance">Avancé</span>
        <a href="#" class="prog-btn">👀 Voir détail</a>
      </div>

      <div class="programme-card" data-category="force avance">
        <h3>🏋️ Split Push/Pull/Legs</h3>
        <p>Programme avancé 5 jours par semaine pour maximiser la prise de masse musculaire.</p>
        <span class="badge niveau-avance">Avancé</span>
        <a href="#" class="prog-btn">👀 Voir détail</a>
      </div>

      <div class="programme-card" data-category="bienetre debutant intermediaire">
        <h3>🧘 Yoga & Bien-être</h3>
        <p>Retrouvez l'équilibre corps-esprit avec nos séances de yoga et mobilité guidées.</p>
        <span class="badge niveau-debutant">Débutant</span>
        <a href="#" class="prog-btn">👀 Voir détail</a>
      </div>

      <div class="programme-card" data-category="cardio intermediaire">
        <h3>🚴 Endurance Vélo</h3>
        <p>Améliorez votre cardio et sculputez vos jambes avec nos séances de biking collectif.</p>
        <span class="badge niveau-intermediaire">Intermédiaire</span>
        <a href="#" class="prog-btn">👀 Voir détail</a>
      </div>

    </div>
    <div id="no-results" style="display:none;">Aucun programme correspondant.</div>
  </section>

  <div class="prog-cta-final">
    <h2>Votre transformation commence ici !</h2>
    <a href="/pages/contact" class="prog-btn">🔥 Rejoindre Fitwings</a>
  </div>

  <script defer src="/assets/js/script.js"></script>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
