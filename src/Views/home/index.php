<?php
$pageTitle = 'Fitwings - Accueil';
require_once __DIR__ . '/../templates/header.php';
?>

<main>
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title">Depassez vos limites.<br>Chaque jour.</h1>
      <p class="hero-sub">Programmes sur mesure, coachs certifies, 3 salles en France.</p>
      <div class="hero-ctas">
        <a href="/programmes" class="prog-btn">Voir les programmes</a>
        <a href="/register" class="hero-btn-outline">Rejoindre Fitwings</a>
      </div>
    </div>
  </section>

  <section class="stats-bar">
    <div class="stat">
      <span class="stat-number">2 400+</span>
      <span class="stat-label">Membres actifs</span>
    </div>
    <div class="stat">
      <span class="stat-number">18</span>
      <span class="stat-label">Coachs certifies</span>
    </div>
    <div class="stat">
      <span class="stat-number">40+</span>
      <span class="stat-label">Programmes disponibles</span>
    </div>
    <div class="stat">
      <span class="stat-number">3</span>
      <span class="stat-label">Salles en France</span>
    </div>
  </section>

  <section class="container card form-container section-top-spacing">
    <h2>Trouver une salle pres de chez vous</h2>
    <form method="get" action="/salles" class="search-form">
      <input type="text" name="ville" placeholder="Ex : Paris, Lyon, Marseille..." required />
      <button type="submit" class="btn-search">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
  </section>

  <section class="container valeurs">
    <h2 class="section-title">Pourquoi Fitwings ?</h2>
    <div class="valeurs-grid">
      <div class="valeur-card card">
        <span class="material-symbols-outlined valeur-icon">emoji_events</span>
        <h3>Resultats prouves</h3>
        <p>Programmes concus par des experts pour des resultats visibles en 4 semaines.</p>
      </div>
      <div class="valeur-card card">
        <span class="material-symbols-outlined valeur-icon">groups</span>
        <h3>Communaute soudee</h3>
        <p>Entraide, motivation collective et esprit d'equipe au coeur de chaque seance.</p>
      </div>
      <div class="valeur-card card">
        <span class="material-symbols-outlined valeur-icon">fitness_center</span>
        <h3>Equipements premium</h3>
        <p>Machines recente generation, entretenues quotidiennement pour votre confort.</p>
      </div>
    </div>
  </section>

  <section class="home-abos container">
    <h2 class="section-title">Nos abonnements</h2>
    <p class="home-abos-sub">Un tarif adapte a chaque objectif, sans mauvaises surprises.</p>
    <div class="home-abos-grid">
      <div class="home-abo-card">
        <h3>Essentiel</h3>
        <div class="home-abo-price">29<span>EUR/mois</span></div>
        <p>Acces salle, cardio, vestiaires</p>
      </div>
      <div class="home-abo-card home-abo-card--featured">
        <div class="home-abo-badge">Populaire</div>
        <h3>Premium</h3>
        <div class="home-abo-price">49<span>EUR/mois</span></div>
        <p>Cours collectifs et coaching mensuel</p>
      </div>
      <div class="home-abo-card">
        <h3>Elite</h3>
        <div class="home-abo-price">79<span>EUR/mois</span></div>
        <p>Coach dedie, seances illimitees</p>
      </div>
    </div>
    <div class="home-abos-cta">
      <a href="/abonnements" class="btn-primary">Voir tous nos abonnements</a>
    </div>
  </section>

  <section class="container section-bottom-spacing">
    <h2 class="section-title">Ce que disent nos membres</h2>
    <div class="temoignages">
      <div class="temoignage">
        <p>"Ambiance motivante et coachs a l'ecoute."</p>
        <strong>Sarah, 28 ans</strong>
      </div>
      <div class="temoignage">
        <p>"Salle propre, materiel neuf, suivi personnalise."</p>
        <strong>Julien, 35 ans</strong>
      </div>
      <div class="temoignage">
        <p>"Diversite des cours et esprit d'equipe."</p>
        <strong>Amine, 41 ans</strong>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
