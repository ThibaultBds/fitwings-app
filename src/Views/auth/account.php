<?php
$pageTitle = 'Fitwings – Mon compte';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login'); exit;
}

require_once __DIR__ . '/../templates/header.php';
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

    <!-- Carte abonné -->
    <?php
      // TODO: récupérer le vrai plan depuis la BDD (ex: $user['plan'] = 'Premium')
      $plan = $user['plan'] ?? null;
      $membre_depuis = date('m/y', strtotime($user['created_at']));
      $expire = date('m/y', strtotime($user['created_at'] . ' +1 year'));
      $numero = 'FW-' . str_pad($_SESSION['user_id'] ?? 0, 6, '0', STR_PAD_LEFT);
    ?>
    <div style="margin-top:28px;">
      <h2 style="margin-bottom:12px;font-size:1rem;opacity:.7;">Carte abonné</h2>
      <?php if ($plan): ?>
        <div class="membre-card">
          <div class="membre-card-top">
            <span class="membre-card-logo">Fitwings</span>
            <span class="membre-card-plan"><?= htmlspecialchars($plan) ?></span>
          </div>
          <div class="membre-card-chip"></div>
          <div class="membre-card-bottom">
            <div class="membre-card-name"><?= htmlspecialchars($user['username']) ?></div>
            <div class="membre-card-number"><?= $numero ?></div>
            <div class="membre-card-meta">
              <span>Membre depuis <?= $membre_depuis ?></span>
              <span>Expire <?= $expire ?></span>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="membre-card" style="justify-content:center;align-items:center;">
          <div class="membre-card-no-plan">
            <p>Aucun abonnement actif</p>
            <p style="margin-top:8px;"><a href="/abonnements">Voir nos offres →</a></p>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="/mes-programmes" class="prog-btn">📋 Mes programmes</a>
      <a href="/abonnements" class="btn-primary">Gérer mon abonnement</a>
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

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
