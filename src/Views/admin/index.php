<?php
$pageTitle = 'Fitwings – Administration';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="container">
  <h1 class="admin-title">Panneau d'administration</h1>

  <?php require __DIR__ . '/_users.php'; ?>
  <?php require __DIR__ . '/_temoignages.php'; ?>
  <?php require __DIR__ . '/_programmes.php'; ?>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
