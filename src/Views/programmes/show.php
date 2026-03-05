<?php
$pageTitle = 'Fitwings – Détail programme';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="container">
  <?php if ($programme): ?>
    <div class="programme-detail card">
      <h1><?= htmlspecialchars($programme['title']) ?></h1>
      <div style="display:flex;gap:10px;flex-wrap:wrap;margin:16px 0;">
        <?php if ($programme['niveau']): ?>
          <span class="badge"><?= htmlspecialchars($programme['niveau']) ?></span>
        <?php endif; ?>
        <?php if ($programme['objectif']): ?>
          <span class="badge"><?= htmlspecialchars($programme['objectif']) ?></span>
        <?php endif; ?>
      </div>
      <p style="font-size:1.1rem;margin-bottom:20px;"><?= htmlspecialchars($programme['description']) ?></p>

      <?php if (isset($_SESSION['user'])): ?>
        <?php if ($alreadyEnrolled): ?>
          <p class="badge statut-en_cours" style="display:inline-block;">Deja inscrit</p>
        <?php else: ?>
          <form method="POST" action="/programmes/inscrire">
            <input type="hidden" name="programme_id" value="<?= $programme['id'] ?>">
            <button type="submit" class="prog-btn">S'inscrire</button>
          </form>
        <?php endif; ?>
      <?php else: ?>
        <a href="/login" class="prog-btn">Connectez-vous pour vous inscrire</a>
      <?php endif; ?>

      <a href="/programmes" class="prog-btn" style="margin-top:24px;display:inline-block;">Retour aux programmes</a>
    </div>
  <?php else: ?>
    <div class="card" style="text-align:center;">
      <p>Programme introuvable.</p>
      <a href="/programmes" class="prog-btn">Retour aux programmes</a>
    </div>
  <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
