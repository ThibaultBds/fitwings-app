<?php
$pageTitle = 'Fitwings - Contact';
require_once __DIR__ . '/../templates/header.php';
?>

<header class="page-banner">
  <h1>Contactez-<span>nous</span></h1>
  <p>Une question, un conseil ou envie de rejoindre Fitwings ? Écrivez-nous.</p>
</header>

<main class="contact-main">
  <section class="contact-form-section card">
    <h2>Envoyez-nous un message</h2>
    <?php if (!empty($success)): ?>
      <div class="form-success">Message envoyé. Nous vous répondrons sous 48h.</div>
    <?php elseif (!empty($error)): ?>
      <div class="form-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/pages/contact" class="objectif-form">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

      <label for="nom">Votre nom</label>
      <input type="text" name="nom" id="nom" required placeholder="Jean Dupont" value="<?= htmlspecialchars($old['nom'] ?? '') ?>">

      <label for="email">Votre email</label>
      <input type="email" name="email" id="email" required placeholder="vous@exemple.fr" value="<?= htmlspecialchars($old['email'] ?? '') ?>">

      <label for="message">Votre message</label>
      <textarea name="message" id="message" rows="5" required class="textarea-field" placeholder="Bonjour, je souhaite..."><?= htmlspecialchars($old['message'] ?? '') ?></textarea>

      <button type="submit" class="prog-btn">Envoyer le message</button>
    </form>
  </section>

  <section class="contact-infos">
    <h2>Nos coordonnees</h2>
    <div class="contact-grid">
      <div class="contact-item">
        <h3>Adresse</h3>
        <p>123 Rue de la Force, 75000 Paris</p>
      </div>
      <div class="contact-item">
        <h3>Téléphone</h3>
        <p>+33 1 23 45 67 89</p>
      </div>
      <div class="contact-item">
        <h3>Email</h3>
        <p>contact@fitwings.fr</p>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
