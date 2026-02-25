<?php
$titles = ['legal' => 'Mentions légales', 'privacy' => 'Politique de confidentialité', 'terms' => "Conditions d'utilisation"];
$key = 'legal';
$pageTitle = 'Fitwings – ' . $titles[$key];
require_once __DIR__ . '/../templates/header.php';
?>
<main class="container">
  <section class="card">
    <h1><?= $titles[$key] ?></h1>
    <p style="color:#888;margin-bottom:24px;">Dernière mise à jour : février 2025</p>
    <p>Ce contenu sera complété prochainement. Pour toute question, contactez-nous à <a href="/pages/contact" style="color:var(--primary)">contact@fitwings.fr</a>.</p>
  </section>
</main>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
