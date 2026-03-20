<?php
$pageTitle = 'Fitwings - Programmes';
require_once __DIR__ . '/../templates/header.php';
?>

<header class="prog-banner">
  <h1>Nos <span>Programmes</span> Fitwings</h1>
  <p>Trouvez l'entrainement adapte a vos objectifs</p>
</header>

<main class="prog-container">

  <p class="prog-filters-label">Filtrer par objectif ou niveau</p>
  <div class="prog-objectifs-buttons">
    <button type="button" data-filter="all" class="active">Tout</button>
    <button type="button" data-filter="perte-de-poids">Perte de poids</button>
    <button type="button" data-filter="force">Force</button>
    <button type="button" data-filter="cardio">Cardio</button>
    <button type="button" data-filter="bienetre">Bien-etre</button>
    <button type="button" data-filter="debutant">Debutant</button>
    <button type="button" data-filter="intermediaire">Intermediaire</button>
    <button type="button" data-filter="avance">Avance</button>
  </div>


  <section class="prog-grid">
    <h2>Programmes officiels Fitwings</h2>
    <div class="cards-grid">
      <?php if (!empty($programmes)) : ?>
        <?php foreach ($programmes as $programme) : ?>
          <?php
            $niveau = strtolower($programme->niveau);
            $objectif = strtolower($programme->objectif);
            $objectifData = str_replace(' ', '-', $objectif);
          ?>
          <div class="programme-card" data-category="<?= htmlspecialchars($objectifData) ?> <?= htmlspecialchars($niveau) ?>">
            <h3><?= htmlspecialchars($programme->title) ?></h3>
            <p><?= htmlspecialchars($programme->description) ?></p>
            <span class="badge niveau-<?= htmlspecialchars($niveau) ?>"><?= htmlspecialchars($programme->niveau) ?></span>
            <a href="/programmes/show?id=<?= (int)$programme->id ?>" class="prog-btn">Voir detail</a>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <p>Aucun programme en base pour le moment.</p>
      <?php endif; ?>
    </div>
    <div id="no-results" class="hidden-by-default">Aucun programme correspondant.</div>
  </section>

  <div class="prog-cta-final">
    <h2>Votre transformation commence ici !</h2>
    <a href="/pages/contact" class="prog-btn">Rejoindre Fitwings</a>
  </div>

  <script defer src="/assets/js/script.js"></script>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
