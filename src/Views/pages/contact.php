<?php
$pageTitle = 'Fitwings – Contact';
require_once __DIR__ . '/../layouts/header.php';

$success = false;
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email   = htmlspecialchars(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if ($nom && $email && $message) {
        $to      = 'contact@fitwings.fr';
        $subject = "Message de $nom via Fitwings";
        $body    = "Nom : $nom\nEmail : $email\n\nMessage :\n$message";
        $headers = "From: $email\r\nReply-To: $email";
        mail($to, $subject, $body, $headers);
        $success = true;
    } else {
        $erreur = "Tous les champs sont obligatoires.";
    }
}
?>

<header class="page-banner">
  <h1>Contactez-<span>nous</span></h1>
  <p>Une question, un conseil ou envie de rejoindre Fitwings ? Écrivez-nous !</p>
</header>

<main class="contact-main">

  <section class="contact-form-section card">
    <h2>Envoyez-nous un message</h2>
    <?php if ($success): ?>
      <div class="form-success">✅ Message envoyé ! Nous vous répondrons sous 48h.</div>
    <?php elseif ($erreur): ?>
      <div class="form-error">⚠️ <?= $erreur ?></div>
    <?php endif; ?>
    <form method="POST" action="" class="objectif-form">
      <label for="nom">Votre nom</label>
      <input type="text" name="nom" id="nom" required placeholder="Jean Dupont">
      <label for="email">Votre email</label>
      <input type="email" name="email" id="email" required placeholder="vous@exemple.fr">
      <label for="message">Votre message</label>
      <textarea name="message" id="message" rows="5" required class="textarea-field" placeholder="Bonjour, je souhaite..."></textarea>
      <button type="submit" class="prog-btn">📨 Envoyer le message</button>
    </form>
  </section>

  <section class="contact-infos">
    <h2>Nos coordonnées</h2>
    <div class="contact-grid">
      <div class="contact-item">
        <h3>📍 Adresse</h3>
        <p>123 Rue de la Force, 75000 Paris</p>
      </div>
      <div class="contact-item">
        <h3>📞 Téléphone</h3>
        <p>+33 1 23 45 67 89</p>
      </div>
      <div class="contact-item">
        <h3>📧 Email</h3>
        <p>contact@fitwings.fr</p>
      </div>
    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
