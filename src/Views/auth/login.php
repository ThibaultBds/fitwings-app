<?php
$pageTitle = 'Fitwings – Connexion';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="container">
  <section class="card form-container">
    <h2>Se connecter</h2>
    <form method="post" action="" class="objectif-form">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" required>
      <button type="submit" class="prog-btn">Connexion</button>
    </form>
    <p style="margin-top:16px;text-align:center;">
      Pas encore de compte ? <a href="/register" style="color:var(--primary)">S'inscrire</a>
    </p>
  </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
