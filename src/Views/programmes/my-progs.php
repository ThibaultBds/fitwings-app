<?php
$pageTitle = 'Fitwings – Mes programmes';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="container">
  <section class="card">
    <h2>Mes programmes</h2>
      <?php if (!empty($programmes)): ?>
        <?php foreach ($programmes as $p): ?>
          <div class="programme-card">
            <h3><?= htmlspecialchars($p['title']) ?></h3>
            <span class="badge"><?= htmlspecialchars($p['statut']) ?></span>
            <a href="/programmes/show?id=<?= $p['id'] ?>" class="prog-btn">Voir</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Vous n'êtes inscrit à aucun programme pour le moment.</p>
        <a href="/programmes" class="prog-btn">Voir les programmes</a>
      <?php endif; ?>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
