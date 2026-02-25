<?php
$pageTitle = 'Fitwings – Administration';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login'); exit;
}
if ($_SESSION['role'] !== 'admin') {
    header('Location: /'); exit;
}

require_once __DIR__ . '/../../templates/header.php';
// TODO: $users = User::findAll(); depuis le Model
$users_demo = [
    ['id' => 1, 'username' => 'admin',   'email' => 'admin@fitwings.fr',   'role' => 'admin',      'created_at' => '2025-01-01'],
    ['id' => 2, 'username' => 'jean',    'email' => 'jean@mail.fr',         'role' => 'user',       'created_at' => '2025-02-10'],
    ['id' => 3, 'username' => 'modo1',   'email' => 'modo@fitwings.fr',     'role' => 'moderateur', 'created_at' => '2025-03-05'],
];
?>

<main class="container">
  <section class="card">
    <h1>⚙️ Panneau d'administration</h1>
    <p style="color:#aaa;margin-bottom:24px;">Gestion des utilisateurs</p>

    <div style="overflow-x:auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th><th>Pseudo</th><th>Email</th><th>Rôle</th><th>Inscription</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users_demo as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><span class="badge niveau-<?= $u['role'] === 'admin' ? 'avance' : ($u['role'] === 'moderateur' ? 'intermediaire' : 'debutant') ?>"><?= $u['role'] ?></span></td>
            <td><?= $u['created_at'] ?></td>
            <td>
              <form method="POST" action="" style="display:inline;">
                <input type="hidden" name="role_id" value="<?= $u['id'] ?>">
                <select name="new_role" style="padding:4px 8px;border-radius:6px;background:var(--bg);color:var(--text);border:1px solid var(--primary);">
                  <option value="user" <?= $u['role']==='user'?'selected':'' ?>>user</option>
                  <option value="moderateur" <?= $u['role']==='moderateur'?'selected':'' ?>>moderateur</option>
                  <option value="admin" <?= $u['role']==='admin'?'selected':'' ?>>admin</option>
                </select>
                <button type="submit" class="prog-btn" style="padding:4px 10px;margin:0;">Changer</button>
              </form>
              <?php if ($u['id'] !== $_SESSION['user_id']): ?>
              <form method="POST" action="" style="display:inline;margin-left:8px;">
                <input type="hidden" name="delete_id" value="<?= $u['id'] ?>">
                <button type="submit" style="background:#e74c3c;color:#fff;border:none;padding:4px 10px;border-radius:6px;cursor:pointer;">Supprimer</button>
              </form>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../../templates/footer.php'; ?>
