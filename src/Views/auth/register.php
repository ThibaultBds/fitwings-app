<?php
$pageTitle = 'Fitwings – Inscription';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="auth-main">
  <div class="auth-card">
    <div class="auth-logo">🔥 Fitwings</div>
    <h1>Créer un compte</h1>
    <p>Rejoignez la communauté Fitwings</p>

    <?php if (!empty($error)): ?>
  <div class="form-error" style="margin-bottom:16px;">⚠️ <?= htmlspecialchars($error) ?></div>
<?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="form-success" style="margin-bottom:16px;">✅ <?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post" action="/register" class="auth-form">
      <div class="auth-field">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required placeholder="Pseudo">
      </div>
      <div class="auth-field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required placeholder="vous@exemple.fr">
      </div>
      <div class="auth-field">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required placeholder="••••••••">
      </div>
      <button type="submit" class="auth-btn">Créer mon compte</button>
    </form>

    <p class="auth-switch">Déjà un compte ? <a href="/login">Se connecter</a></p>
  </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
