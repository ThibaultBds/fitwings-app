<?php
$pageTitle = 'Fitwings – Témoignages';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="temoignages-main container">

  <h1>Témoignages</h1>
  <p>Ce que nos membres disent de Fitwings.</p>

  <?php if ($success): ?>
    <div class="alert alert-success">Votre témoignage a été envoyé et sera visible après modération.</div>
  <?php endif; ?>
  <?php if ($erreur): ?>
    <div class="alert alert-error"><?= htmlspecialchars($erreur) ?></div>
  <?php endif; ?>

  <?php if (isset($_SESSION['user'])): ?>
  <section class="card form-container">
    <h2>Laissez votre avis</h2>
    <form method="POST" action="/temoignages" class="objectif-form">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
      <label for="note">Note (1 à 5)</label>
      <input type="number" name="note" id="note" min="1" max="5" value="5" required>
      <label for="contenu">Votre message (300 car. max)</label>
      <textarea name="contenu" id="contenu" maxlength="300" rows="4" required></textarea>
      <button type="submit" class="prog-btn">Envoyer</button>
    </form>
  </section>
  <?php else: ?>
    <p><a href="/login">Connectez-vous</a> pour laisser un témoignage.</p>
  <?php endif; ?>

  <section class="temoignages">
    <?php if (!empty($temoignages)): ?>
      <?php foreach ($temoignages as $t): ?>
        <div class="temoignage-card temoignage">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
            <strong><?= htmlspecialchars($t['username']) ?></strong>
            <span><?= str_repeat('⭐', (int)$t['note']) ?><?= str_repeat('☆', 5 - (int)$t['note']) ?></span>
          </div>
          <p><?= htmlspecialchars($t['contenu']) ?></p>
          <small style="color:#888;"><?= date('d/m/Y', strtotime($t['created_at'])) ?></small>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucun témoignage pour le moment. Soyez le premier !</p>
    <?php endif; ?>
  </section>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
