<?php
$pageTitle = 'Fitwings – Carrière';
require_once __DIR__ . '/../layouts/header.php';

$success = false;
$erreur  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email   = htmlspecialchars(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if ($nom && $email && $message) {
        // TODO: stocker en BDD (table candidatures) + upload CV
        $success = true;
    } else {
        $erreur = "Tous les champs obligatoires doivent être remplis.";
    }
}
?>

<main class="carriere-main">

  <section class="carriere-hero">
    <h1>🚀 Rejoindre l'équipe Fitwings</h1>
    <p>Partage notre passion du sport et aide-nous à accompagner nos membres dans leur transformation.</p>
  </section>

  <section class="card form-container">
    <h2>Déposez votre candidature</h2>
    <?php if ($success): ?>
      <div class="form-success">✅ Votre candidature a bien été envoyée ! Merci 🙌</div>
    <?php elseif ($erreur): ?>
      <div class="form-error">⚠️ <?= $erreur ?></div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data" class="objectif-form">
      <label for="nom">Votre nom</label>
      <input type="text" name="nom" id="nom" required>
      <label for="email">Votre email</label>
      <input type="email" name="email" id="email" required>
      <label for="message">Votre motivation</label>
      <textarea name="message" id="message" rows="5" required style="padding:10px;border-radius:8px;border:2px solid var(--primary);background:var(--bg);color:var(--text);font-size:1rem;resize:vertical;"></textarea>
      <label for="cv">CV (PDF, optionnel)</label>
      <input type="file" name="cv" id="cv" accept=".pdf" style="color:var(--text);">
      <button type="submit" class="prog-btn">📩 Envoyer ma candidature</button>
    </form>
  </section>

  <section class="carriere-postes card">
    <h2>Postes disponibles</h2>
    <div class="poste-grid">
      <div class="poste-card">
        <h3>💪 Coach Musculation</h3>
        <p>CDI · Paris · Expérience 2 ans min.</p>
      </div>
      <div class="poste-card">
        <h3>🏃 Coach Cardio</h3>
        <p>CDI · Lyon · Diplôme BPJEPS requis</p>
      </div>
      <div class="poste-card">
        <h3>🧘 Animateur Yoga</h3>
        <p>CDD · Marseille · Certification yoga appréciée</p>
      </div>
    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
