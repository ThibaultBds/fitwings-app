<?php
$pageTitle = 'Fitwings – Accueil';
require_once __DIR__ . '/../templates/header.php';

$ville = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $villeBrut = isset($_POST['ville']) ? trim($_POST['ville']) : '';
    if ($villeBrut !== '') {
        $ville = htmlspecialchars($villeBrut, ENT_QUOTES, 'UTF-8');
        switch (strtolower($villeBrut)) {
            case 'paris':
                $message = "Salle Fitwings Paris : 10 rue du Sport, Paris 15e. Ouvert 6h-23h.";
                break;
            case 'lyon':
                $message = "Salle Fitwings Lyon : 25 avenue du Fitness, Lyon 3e. Cours collectifs tous les jours.";
                break;
            case 'marseille':
                $message = "Salle Fitwings Marseille : 8 boulevard du Gym, Marseille 6e. Vue mer, muscu & cardio.";
                break;
            default:
                $message = "Aucune salle Fitwings trouvée pour cette ville. Essayez Paris, Lyon ou Marseille.";
        }
    }
}
?>

<main>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title">Dépassez vos limites.<br>Chaque jour.</h1>
      <p class="hero-sub">Programmes sur mesure, coachs certifiés, 3 salles en France.</p>
      <div class="hero-ctas">
        <a href="/programmes" class="prog-btn">Voir les programmes</a>
        <a href="/register" class="hero-btn-outline">Rejoindre Fitwings</a>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="stats-bar">
    <div class="stat">
      <span class="stat-number">2 400+</span>
      <span class="stat-label">Membres actifs</span>
    </div>
    <div class="stat">
      <span class="stat-number">18</span>
      <span class="stat-label">Coachs certifiés</span>
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

  <!-- RECHERCHE -->
  <section class="container card form-container" style="margin-top:40px;">
    <h2>Trouver une salle près de chez vous</h2>
    <form method="post" action="" class="search-form">
      <input type="text" name="ville" placeholder="Ex : Paris, Lyon, Marseille..." value="<?= $ville ?>" required />
      <button type="submit" class="btn-search">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
    <?php if ($ville !== ''): ?>
      <div class="resultat-ville">
        <span class="material-symbols-outlined">location_on</span>
        <strong><?= ucfirst($ville) ?></strong> : <?= $message ?>
      </div>
    <?php endif; ?>
  </section>

  <!-- POURQUOI FITWINGS -->
  <section class="container valeurs">
    <h2 class="section-title">Pourquoi Fitwings ?</h2>
    <div class="valeurs-grid">
      <div class="valeur-card card">
        <span class="material-symbols-outlined valeur-icon">emoji_events</span>
        <h3>Résultats prouvés</h3>
        <p>Programmes conçus par des experts pour des résultats visibles en 4 semaines.</p>
      </div>
      <div class="valeur-card card">
        <span class="material-symbols-outlined valeur-icon">groups</span>
        <h3>Communauté soudée</h3>
        <p>Entraide, motivation collective et esprit d'équipe au cœur de chaque séance.</p>
      </div>
      <div class="valeur-card card">
        <span class="material-symbols-outlined valeur-icon">fitness_center</span>
        <h3>Équipements premium</h3>
        <p>Machines dernière génération, entretenues quotidiennement pour votre confort.</p>
      </div>
    </div>
  </section>

  <!-- TÉMOIGNAGES -->
  <section class="container" style="margin-bottom:60px;">
    <h2 class="section-title">Ce que disent nos membres</h2>
    <div class="temoignages">
      <div class="temoignage">
        <p>"Ambiance motivante et coachs à l'écoute !"</p>
        <strong>— Sarah, 28 ans</strong>
      </div>
      <div class="temoignage">
        <p>"Salle propre, matériel neuf, suivi personnalisé."</p>
        <strong>— Julien, 35 ans</strong>
      </div>
      <div class="temoignage">
        <p>"Diversité des cours et esprit d'équipe, top !"</p>
        <strong>— Amine, 41 ans</strong>
      </div>
    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
