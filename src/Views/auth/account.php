<?php
$pageTitle = 'Fitwings – Mon compte';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login'); exit;
}

require_once __DIR__ . '/../layouts/header.php';
// TODO: $user = User::findById($_SESSION['user_id']); depuis le Model
$user = [
    'username'   => $_SESSION['username'] ?? 'Utilisateur',
    'email'      => $_SESSION['email'] ?? '',
    'role'       => $_SESSION['role'] ?? 'user',
    'created_at' => $_SESSION['created_at'] ?? date('Y-m-d'),
];
?>

<main class="container">
  <section class="card" style="max-width:600px;margin:40px auto;text-align:center;">
    <h1>👤 Mon compte</h1>
    <p>Bienvenue, <strong style="color:var(--primary)"><?= htmlspecialchars($user['username']) ?></strong> !</p>

    <div class="card" style="margin-top:24px;text-align:left;">
      <h2>📋 Mes informations</h2>
      <p><strong>Pseudo :</strong> <?= htmlspecialchars($user['username']) ?></p>
      <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
      <p><strong>Rôle :</strong> <span class="badge niveau-debutant"><?= htmlspecialchars($user['role']) ?></span></p>
      <p><strong>Inscrit le :</strong> <?= htmlspecialchars($user['created_at']) ?></p>
    </div>

    <div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="/mes-programmes" class="prog-btn">📋 Mes programmes</a>
      <a href="/logout" style="display:inline-block;padding:10px 22px;background:#e74c3c;color:#fff;border-radius:8px;font-weight:bold;text-decoration:none;">🚪 Déconnexion</a>
    </div>

    <?php if (in_array($user['role'], ['admin', 'moderateur'])): ?>
    <div style="margin-top:20px;">
      <?php if ($user['role'] === 'admin'): ?>
        <a href="/admin" class="btn-primary">⚙️ Panneau Admin</a>
      <?php else: ?>
        <a href="/moderator" class="btn-primary">🛡️ Espace Modération</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
