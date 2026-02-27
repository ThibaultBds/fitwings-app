<?php
$pageTitle = 'Fitwings – ' . htmlspecialchars($salle['nom'] ?? 'Détail salle');
require_once __DIR__ . '/../templates/header.php';
?>

<header class="prog-banner">
  <h1><?= htmlspecialchars($salle['nom'] ?? 'Salle de sport') ?></h1>
  <p><?= htmlspecialchars($salle['ville'] ?? '') ?></p>
</header>

<main class="prog-container">

  <?php if (!empty($salle)): ?>

    <section class="card form-container">
      <h2>Informations</h2>

      <p><strong>Adresse :</strong> <?= htmlspecialchars($salle['adresse']) ?></p>

      <?php if (!empty($salle['telephone'])): ?>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($salle['telephone']) ?></p>
      <?php endif; ?>

      <?php if (!empty($salle['email'])): ?>
        <p><strong>Email :</strong> <?= htmlspecialchars($salle['email']) ?></p>
      <?php endif; ?>

      <?php if (!empty($salle['horaires'])): ?>
        <p><strong>Horaires :</strong> <?= htmlspecialchars($salle['horaires']) ?></p>
      <?php endif; ?>

      <?php if (!empty($salle['description'])): ?>
        <p><strong>Description :</strong> <?= htmlspecialchars($salle['description']) ?></p>
      <?php endif; ?>
    </section>

  <?php else: ?>
    <p>Salle introuvable.</p>
  <?php endif; ?>

  <div class="prog-cta-final">
    <a href="javascript:history.back()" class="prog-btn">Retour aux résultats</a>
  </div>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
