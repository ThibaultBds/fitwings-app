<?php
$pageTitle = 'Fitwings – Inscription';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="container">
  <section class="card form-container">
    <h2>Créer un compte</h2>
    <form method="post" action="" class="objectif-form">
      <label for="username">Nom d'utilisateur</label>
      <input type="text" name="username" id="username" required>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" required>
      <button type="submit" class="prog-btn">S'inscrire</button>
    </form>
    <p style="margin-top:16px;text-align:center;">
      Déjà un compte ? <a href="/login" style="color:var(--primary)">Se connecter</a>
    </p>
  </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
