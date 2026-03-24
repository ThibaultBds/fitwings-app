<?php
$pageTitle = 'Fitwings - Carriere';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="carriere-main">
  <section class="carriere-hero">
    <h1>Rejoindre l'equipe Fitwings</h1>
    <p>Partage notre passion du sport et aide-nous a accompagner nos membres dans leur progression.</p>
  </section>

  <section class="card form-container">
    <h2>Deposez votre candidature</h2>
    <?php if ($success): ?>
      <div class="form-success">Votre candidature a bien ete envoyee.</div>
    <?php elseif ($erreur): ?>
      <div class="form-error"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>
    <form method="POST" action="" class="objectif-form">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
      <label for="nom">Votre nom</label>
      <input type="text" name="nom" id="nom" required>
      <label for="email">Votre email</label>
      <input type="email" name="email" id="email" required>
      <label for="telephone">Votre telephone</label>
      <input type="tel" name="telephone" id="telephone" required>
      <label for="message">Votre motivation</label>
      <textarea name="message" id="message" rows="5" required class="textarea-field"></textarea>
      <button type="submit" class="prog-btn">Envoyer ma candidature</button>
    </form>
  </section>

  <section class="carriere-postes card">
    <h2>Postes disponibles</h2>
    <div class="poste-grid">
      <div class="poste-card">
        <h3>Coach musculation</h3>
        <p>CDI · Paris · Experience 2 ans minimum</p>
      </div>
      <div class="poste-card">
        <h3>Coach cardio</h3>
        <p>CDI · Lyon · Diplome BPJEPS requis</p>
      </div>
      <div class="poste-card">
        <h3>Animateur yoga</h3>
        <p>CDD · Marseille · Certification yoga appreciee</p>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
