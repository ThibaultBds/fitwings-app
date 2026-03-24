<?php
$pageTitle = 'Fitwings - Connexion';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="auth-main">
  <div class="auth-card">
    <div class="auth-logo">Fitwings</div>
    <h1>Bon retour</h1>
    <p>Connectez-vous à votre espace membre</p>

    <?php if (!empty($error)): ?>
      <div class="form-error auth-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="/login" class="auth-form">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
      <div class="auth-field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required placeholder="vous@exemple.fr">
      </div>
      <div class="auth-field">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required placeholder="Votre mot de passe">
      </div>
      <button type="submit" class="auth-btn">Se connecter</button>
    </form>

    <p class="auth-switch">Pas encore de compte ? <a href="/register">S'inscrire</a></p>
  </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
