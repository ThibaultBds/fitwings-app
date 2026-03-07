<section class="card">
  <h2>Programmes</h2>

  <h3 class="admin-section-title">Créer un programme</h3>
  <form method="POST" action="/admin/programmes/create">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <div class="admin-form-grid">
      <input type="text" name="title" placeholder="Titre" required class="admin-input">
      <textarea name="description" placeholder="Description" required class="admin-input admin-textarea"></textarea>
      <input type="text" name="niveau" placeholder="Niveau (ex: débutant)" class="admin-input">
      <input type="text" name="objectif" placeholder="Objectif (ex: perte de poids)" class="admin-input">
      <button type="submit" class="prog-btn">Créer</button>
    </div>
  </form>

  <h3 class="admin-section-title">Liste des programmes</h3>
  <?php if (empty($programmes)): ?>
    <p class="admin-empty">Aucun programme.</p>
  <?php else: ?>
    <?php foreach ($programmes as $p): ?>
      <div class="admin-item">
        <form method="POST" action="/admin/programmes/update">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
          <input type="hidden" name="id" value="<?= $p['id'] ?>">
          <div class="admin-form-grid">
            <input type="text" name="title" value="<?= htmlspecialchars($p['title']) ?>" required class="admin-input">
            <textarea name="description" required class="admin-input admin-textarea"><?= htmlspecialchars($p['description']) ?></textarea>
            <input type="text" name="niveau" value="<?= htmlspecialchars($p['niveau'] ?? '') ?>" class="admin-input">
            <input type="text" name="objectif" value="<?= htmlspecialchars($p['objectif'] ?? '') ?>" class="admin-input">
            <button type="submit" class="prog-btn">Modifier</button>
          </div>
        </form>
        <form method="POST" action="/admin/programmes/delete" style="margin-top:8px;">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
          <input type="hidden" name="delete_programme" value="<?= $p['id'] ?>">
          <button type="submit" class="btn-danger admin-btn-sm">Supprimer</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>
