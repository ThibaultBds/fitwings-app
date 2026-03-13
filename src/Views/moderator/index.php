<?php
$pageTitle = 'Fitwings - Modération';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="container">
  <section class="card">
    <h1>Espace modérateur</h1>
    <p class="muted-text moderator-subtitle">Témoignages en attente de validation</p>

    <?php if (empty($temoignages_attente)): ?>
      <p class="admin-empty">Aucun témoignage en attente.</p>
    <?php else: ?>
      <?php foreach ($temoignages_attente as $t): ?>
        <div class="admin-item">
          <strong><?= htmlspecialchars($t->username) ?></strong>
          <span class="admin-rating"><?= str_repeat('★', (int)$t->note) ?></span>
          <p><?= htmlspecialchars($t->contenu) ?></p>
          <form method="POST" action="/moderator/moderer" class="inline-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <input type="hidden" name="id" value="<?= $t->id ?>">
            <input type="hidden" name="statut" value="approuve">
            <button type="submit" class="prog-btn admin-btn-sm">Approuver</button>
          </form>
          <form method="POST" action="/moderator/moderer" class="inline-form inline-form-spaced">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <input type="hidden" name="id" value="<?= $t->id ?>">
            <input type="hidden" name="statut" value="refuse">
            <button type="submit" class="btn-danger admin-btn-sm">Refuser</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
