<section class="card">
  <h2>Programmes</h2>

  <h3 class="admin-section-title">Creer un programme</h3>
  <form method="POST" action="/admin/programmes/create">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <div class="admin-form-grid admin-form-grid--programme">
      <input type="text" name="title" placeholder="Titre" required class="admin-input">
      <textarea name="description" placeholder="Description" required class="admin-input admin-textarea admin-span-2"></textarea>
      <input type="text" name="niveau" placeholder="Niveau (ex: debutant)" class="admin-input">
      <input type="text" name="objectif" placeholder="Objectif (ex: perte de poids)" class="admin-input">
      <input type="number" name="duree_semaines" placeholder="Duree (semaines)" class="admin-input">
      <input type="text" name="seances_par_semaine" placeholder="Seances / semaine (ex: 3)" class="admin-input">
      <input type="number" name="duree_seance_minutes" placeholder="Duree d'une seance (minutes)" class="admin-input">
      <textarea name="materiel" placeholder="Materiel recommande" class="admin-input admin-textarea admin-span-2"></textarea>
      <textarea name="structure_plan" placeholder="Structure du plan" class="admin-input admin-textarea admin-span-2"></textarea>
      <textarea name="benefices" placeholder="Benefices attendus" class="admin-input admin-textarea"></textarea>
      <textarea name="conseils" placeholder="Conseils d'execution" class="admin-input admin-textarea"></textarea>
      <button type="submit" class="prog-btn admin-submit-row">Creer</button>
    </div>
  </form>

  <h3 class="admin-section-title">Liste des programmes</h3>
  <?php if (empty($programmes)): ?>
    <p class="admin-empty">Aucun programme.</p>
  <?php else: ?>
    <div class="admin-programmes-stack">
    <?php foreach ($programmes as $p): ?>
      <details class="admin-programme-panel">
        <summary class="admin-programme-summary">
          <div class="admin-programme-summary-main">
            <strong>#<?= (int)$p->id ?> - <?= htmlspecialchars($p->title) ?></strong>
            <small><?= htmlspecialchars($p->description) ?></small>
          </div>
          <div class="admin-programme-summary-meta">
            <span class="badge niveau-<?= ($p->niveau ?? '') === 'avance' ? 'avance' : (($p->niveau ?? '') === 'intermediaire' ? 'intermediaire' : 'debutant') ?>">
              <?= htmlspecialchars($p->niveau ?? 'n/a') ?>
            </span>
            <span class="admin-chip"><?= htmlspecialchars($p->objectif ?? 'n/a') ?></span>
          </div>
        </summary>

        <div class="admin-item admin-programme-card">
          <form method="POST" action="/admin/programmes/update">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="id" value="<?= (int)$p->id ?>">
            <div class="admin-form-grid admin-form-grid--programme">
              <input type="text" name="title" value="<?= htmlspecialchars($p->title) ?>" placeholder="Titre" required class="admin-input">
              <textarea name="description" placeholder="Description" required class="admin-input admin-textarea admin-span-2"><?= htmlspecialchars($p->description) ?></textarea>
              <input type="text" name="niveau" value="<?= htmlspecialchars($p->niveau ?? '') ?>" placeholder="Niveau (ex: debutant)" class="admin-input">
              <input type="text" name="objectif" value="<?= htmlspecialchars($p->objectif ?? '') ?>" placeholder="Objectif (ex: perte de poids)" class="admin-input">
              <input type="number" name="duree_semaines" value="<?= htmlspecialchars($p->duree_semaines ?? '') ?>" placeholder="Duree (semaines)" class="admin-input">
              <input type="text" name="seances_par_semaine" value="<?= htmlspecialchars($p->seances_par_semaine ?? '') ?>" placeholder="Seances / semaine (ex: 3)" class="admin-input">
              <input type="number" name="duree_seance_minutes" value="<?= htmlspecialchars($p->duree_seance_minutes ?? '') ?>" placeholder="Duree d'une seance (minutes)" class="admin-input">
              <textarea name="materiel" placeholder="Materiel recommande" class="admin-input admin-textarea admin-span-2"><?= htmlspecialchars($p->materiel ?? '') ?></textarea>
              <textarea name="structure_plan" placeholder="Structure du plan" class="admin-input admin-textarea admin-span-2"><?= htmlspecialchars($p->structure_plan ?? '') ?></textarea>
              <textarea name="benefices" placeholder="Benefices attendus" class="admin-input admin-textarea"><?= htmlspecialchars($p->benefices ?? '') ?></textarea>
              <textarea name="conseils" placeholder="Conseils d'execution" class="admin-input admin-textarea"><?= htmlspecialchars($p->conseils ?? '') ?></textarea>
              <button type="submit" class="prog-btn admin-submit-row">Modifier</button>
            </div>
          </form>
          <form method="POST" action="/admin/programmes/delete" class="stack-form">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="delete_programme" value="<?= (int)$p->id ?>">
            <button type="submit" class="btn-danger admin-btn-sm">Supprimer</button>
          </form>
        </div>
      </details>
    <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
