<?php
$titles = ['legal' => 'Mentions legales', 'privacy' => 'Politique de confidentialite', 'terms' => "Conditions d'utilisation"];
$key = 'terms';
$pageTitle = 'Fitwings - ' . $titles[$key];
require_once __DIR__ . '/../templates/header.php';
?>
<main class="container">
  <section class="card">
    <h1><?= $titles[$key] ?></h1>
    <p class="muted-text legal-updated">Derniere mise a jour : fevrier 2025</p>
    <p>Ce contenu sera complete prochainement. Pour toute question, contactez-nous a <a href="/pages/contact" class="legal-link">contact@fitwings.fr</a>.</p>
  </section>
</main>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
