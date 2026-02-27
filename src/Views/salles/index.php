<?php
$pageTitle = 'Fitwings – Salles de sport';
require_once __DIR__ . '/../templates/header.php';

$ville = htmlspecialchars($_GET['ville'] ?? '');
?>

<header class="prog-banner">
  <h1>Salles de sport à <span><?= $ville ?: 'votre ville' ?></span></h1>
  <p>Trouvez la salle qu'il vous faut près de chez vous</p>
</header>

<main class="prog-container">

  <!-- Formulaire de recherche -->
  <section class="card form-container">
    <form action="/salles" method="GET" class="objectif-form">
      <label for="ville">Rechercher une autre ville :</label>
      <div style="display:flex; gap:1rem;">
        <input type="text" name="ville" id="ville" placeholder="Ex : Paris, Lyon..." value="<?= $ville ?>" required>
        <button type="submit" class="prog-btn">Rechercher</button>
      </div>
    </form>
  </section>

  <!-- Résultats -->
  <section class="prog-grid">

    <?php if (!empty($ville)): ?>
      <h2>Résultats pour "<?= $ville ?>"</h2>
    <?php endif; ?>

    <?php if (!empty($salles)): ?>
      <div class="cards-grid">
        <?php foreach ($salles as $salle): ?>
          <div class="programme-card">
            <h3><?= htmlspecialchars($salle['nom']) ?></h3>
            <p><?= htmlspecialchars($salle['adresse']) ?></p>
            <?php if (!empty($salle['telephone'])): ?>
              <p><?= htmlspecialchars($salle['telephone']) ?></p>
            <?php endif; ?>
            <a href="/salles/show?id=<?= (int)$salle['id'] ?>" class="prog-btn">Voir détails</a>
          </div>
        <?php endforeach; ?>
      </div>

    <?php elseif (!empty($ville)): ?>
      <p>Aucune salle trouvée pour "<?= $ville ?>".</p>

    <?php else: ?>
      <p>Entrez une ville pour lancer la recherche.</p>
    <?php endif; ?>

  </section>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
