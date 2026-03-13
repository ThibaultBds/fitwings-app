<section class="card">
  <h2>Temoignages en attente</h2>
  <?php if (empty($temoignages_attente)): ?>
    <p class="admin-empty">Aucun temoignage en attente.</p>
  <?php else: ?>
    <?php foreach ($temoignages_attente as $t): ?>
      <div class="admin-item">
        <strong><?= htmlspecialchars($t->username) ?></strong>
        <span class="admin-rating"><?= str_repeat('★', (int)$t->note) ?></span>
        <p><?= htmlspecialchars($t->contenu) ?></p>
        <form method="POST" action="/admin/moderer" class="inline-form">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
          <input type="hidden" name="id" value="<?= $t->id ?>">
          <input type="hidden" name="statut" value="approuve">
          <button type="submit" class="prog-btn admin-btn-sm">Approuver</button>
        </form>
        <form method="POST" action="/admin/moderer" class="inline-form inline-form-spaced">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
          <input type="hidden" name="id" value="<?= $t->id ?>">
          <input type="hidden" name="statut" value="refuse">
          <button type="submit" class="btn-danger admin-btn-sm">Refuser</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>
