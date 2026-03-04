<?php
$pageTitle = 'Fitwings – Mes programmes';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="container">
  <section class="card">
    <h2>📋 Mes programmes</h2>
    <?php if (!isset($_SESSION['user'])): ?>
      <p>Vous devez être connecté pour accéder à vos programmes.</p>
      <a href="/login" class="prog-btn">Se connecter</a>
    <?php else: ?>
      <!-- TODO: charger les programmes de l'utilisateur depuis la BDD -->
      <p>Vous n'êtes inscrit à aucun programme pour le moment.</p>
      <a href="/programmes" class="prog-btn">Voir les programmes</a>
    <?php endif; ?>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
