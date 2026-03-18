<?php
$pageTitle = 'Fitwings - Detail programme';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="container">
  <?php if ($programme): ?>
    <div class="programme-detail card">
      <h1><?= htmlspecialchars($programme->title) ?></h1>

      <div class="programme-tags">
        <?php if (!empty($programme->niveau)): ?>
          <span class="badge"><?= htmlspecialchars($programme->niveau) ?></span>
        <?php endif; ?>
        <?php if (!empty($programme->objectif)): ?>
          <span class="badge"><?= htmlspecialchars($programme->objectif) ?></span>
        <?php endif; ?>
      </div>

      <p class="programme-intro"><?= htmlspecialchars($programme->description) ?></p>

      <div class="programme-meta-grid">
        <?php if (!empty($programme->duree_semaines)): ?>
          <div class="programme-meta-item">
            <span class="programme-meta-label">Duree</span>
            <strong><?= (int)$programme->duree_semaines ?> semaines</strong>
          </div>
        <?php endif; ?>

        <?php if (!empty($programme->seances_par_semaine)): ?>
          <div class="programme-meta-item">
            <span class="programme-meta-label">Frequence</span>
            <strong><?= htmlspecialchars($programme->seances_par_semaine) ?> seances / semaine</strong>
          </div>
        <?php endif; ?>

        <?php if (!empty($programme->duree_seance_minutes)): ?>
          <div class="programme-meta-item">
            <span class="programme-meta-label">Duree seance</span>
            <strong><?= (int)$programme->duree_seance_minutes ?> min</strong>
          </div>
        <?php endif; ?>
      </div>

      <?php if (!empty($programme->structure_plan)): ?>
        <section class="programme-block">
          <h2>Structure du plan</h2>
          <p><?= nl2br(htmlspecialchars($programme->structure_plan)) ?></p>
        </section>
      <?php endif; ?>

      <?php if (!empty($programme->materiel)): ?>
        <section class="programme-block">
          <h2>Materiel recommande</h2>
          <p><?= nl2br(htmlspecialchars($programme->materiel)) ?></p>
        </section>
      <?php endif; ?>

      <?php if (!empty($programme->benefices)): ?>
        <section class="programme-block">
          <h2>Benefices attendus</h2>
          <p><?= nl2br(htmlspecialchars($programme->benefices)) ?></p>
        </section>
      <?php endif; ?>

      <?php if (!empty($programme->conseils)): ?>
        <section class="programme-block">
          <h2>Conseils d execution</h2>
          <p><?= nl2br(htmlspecialchars($programme->conseils)) ?></p>
        </section>
      <?php endif; ?>

      <div class="programme-actions">
        <?php if (isset($_SESSION['user'])): ?>
          <?php if ($alreadyEnrolled): ?>
            <form method="POST" action="/mes-programmes/desinscrire">
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
              <input type="hidden" name="programme_id" value="<?= (int)$programme->id ?>">
              <button type="submit" class="btn-danger">Se desinscrire</button>
            </form>
          <?php else: ?>
            <form method="POST" action="/programmes/inscrire">
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
              <input type="hidden" name="programme_id" value="<?= (int)$programme->id ?>">
              <button type="submit" class="prog-btn">S inscrire</button>
            </form>
          <?php endif; ?>
        <?php else: ?>
          <a href="/login" class="prog-btn">Connectez-vous pour vous inscrire</a>
        <?php endif; ?>

        <a href="/programmes" class="prog-btn">Retour aux programmes</a>
      </div>
    </div>
  <?php else: ?>
    <div class="card text-center">
      <p>Programme introuvable.</p>
      <a href="/programmes" class="prog-btn">Retour aux programmes</a>
    </div>
  <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
