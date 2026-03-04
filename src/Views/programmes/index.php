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

  <section class="prog-grid">
    <div class="cards-grid">
      <?php foreach ($programmes as $programme) : ?>
        <?php
          $niveau = strtolower($programme['niveau']);
          $objectif = strtolower($programme['objectif']);
        ?>
        <div class="programme-card" data-category="<?= htmlspecialchars($objectif) ?> <?= htmlspecialchars($niveau) ?>">
          <h3><?= htmlspecialchars($programme['title']) ?></h3>
          <p><?= htmlspecialchars($programme['description']) ?></p>
          <span class="badge niveau-<?= htmlspecialchars($niveau) ?>"><?= htmlspecialchars($programme['niveau']) ?></span>
          <a href="/programmes/show?id=<?= $programme['id'] ?>" class="prog-btn">Voir détail</a>
        </div>
      <?php endforeach; ?>
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