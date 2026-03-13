<section class="card">
  <h2>Salles</h2>

  <h3 class="admin-section-title">Creer une salle</h3>
  <form method="POST" action="/admin/salles/create">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <div class="admin-form-grid">
      <input type="text" name="nom" placeholder="Nom (ex: Fitwings Lille Centre)" required class="admin-input">
      <input type="text" name="ville" placeholder="Ville" required class="admin-input">
      <input type="text" name="adresse" placeholder="Adresse" required class="admin-input">
      <input type="text" name="code_postal" placeholder="Code postal" class="admin-input">
      <input type="text" name="telephone" placeholder="Telephone" class="admin-input">
      <input type="email" name="email" placeholder="Email" class="admin-input">
      <input type="text" name="horaires" placeholder="Horaires (ex: 6h-23h)" class="admin-input">
      <textarea name="description" placeholder="Description" class="admin-input admin-textarea"></textarea>
      <button type="submit" class="prog-btn">Creer</button>
    </div>
  </form>

  <h3 class="admin-section-title">Liste des salles</h3>
  <?php if (empty($salles)): ?>
    <p class="admin-empty">Aucune salle.</p>
  <?php else: ?>
    <?php foreach ($salles as $s): ?>
      <div class="admin-item">
        <form method="POST" action="/admin/salles/update">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
          <input type="hidden" name="id" value="<?= (int)$s->id ?>">
          <div class="admin-form-grid">
            <input type="text" name="nom" value="<?= htmlspecialchars($s->nom) ?>" required class="admin-input">
            <input type="text" name="ville" value="<?= htmlspecialchars($s->ville) ?>" required class="admin-input">
            <input type="text" name="adresse" value="<?= htmlspecialchars($s->adresse) ?>" required class="admin-input">
            <input type="text" name="code_postal" value="<?= htmlspecialchars($s->code_postal ?? '') ?>" class="admin-input">
            <input type="text" name="telephone" value="<?= htmlspecialchars($s->telephone ?? '') ?>" class="admin-input">
            <input type="email" name="email" value="<?= htmlspecialchars($s->email ?? '') ?>" class="admin-input">
            <input type="text" name="horaires" value="<?= htmlspecialchars($s->horaires ?? '') ?>" class="admin-input">
            <textarea name="description" class="admin-input admin-textarea"><?= htmlspecialchars($s->description ?? '') ?></textarea>
            <button type="submit" class="prog-btn">Modifier</button>
          </div>
        </form>

        <form method="POST" action="/admin/salles/delete" class="stack-form">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
          <input type="hidden" name="delete_salle" value="<?= (int)$s->id ?>">
          <button type="submit" class="btn-danger admin-btn-sm">Supprimer</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>
