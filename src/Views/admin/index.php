<?php
$pageTitle = 'Fitwings – Administration';
require_once __DIR__ . '/../templates/header.php';
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
          <?php foreach ($users as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><span class="badge niveau-<?= $u['role'] === 'admin' ? 'avance' : ($u['role'] === 'moderateur' ? 'intermediaire' : 'debutant') ?>"><?= $u['role'] ?></span></td>
            <td><?= $u['created_at'] ?></td>
            <td>
              <form method="POST" action="/admin/role" style="display:inline;">
                <input type="hidden" name="role_id" value="<?= $u['id'] ?>">
                <select name="new_role" style="padding:4px 8px;border-radius:6px;background:var(--bg);color:var(--text);border:1px solid var(--primary);">
                  <option value="user" <?= $u['role']==='user'?'selected':'' ?>>user</option>
                  <option value="moderateur" <?= $u['role']==='moderateur'?'selected':'' ?>>moderateur</option>
                  <option value="admin" <?= $u['role']==='admin'?'selected':'' ?>>admin</option>
                </select>
                <button type="submit" class="prog-btn" style="padding:4px 10px;margin:0;">Changer</button>
              </form>
              <?php if ($u['id'] !== $_SESSION['user']['id']): ?>
              <form method="POST" action="/admin/delete" style="display:inline;margin-left:8px;">
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

  <section class="card" style="margin-top:32px;">
    <h2>Témoignages en attente</h2>
    <?php if (empty($temoignages_attente)): ?>
      <p style="color:#aaa;">Aucun témoignage en attente.</p>
    <?php else: ?>
      <?php foreach ($temoignages_attente as $t): ?>
        <div style="border:1px solid var(--primary);border-radius:8px;padding:16px;margin-bottom:16px;">
          <strong><?= htmlspecialchars($t['username']) ?></strong>
          <span style="margin-left:12px;"><?= str_repeat('⭐', (int)$t['note']) ?></span>
          <p><?= htmlspecialchars($t['contenu']) ?></p>
          <form method="POST" action="/admin/moderer" style="display:inline;">
            <input type="hidden" name="id" value="<?= $t['id'] ?>">
            <input type="hidden" name="statut" value="approuve">
            <button type="submit" class="prog-btn" style="padding:4px 12px;">Approuver</button>
          </form>
          <form method="POST" action="/admin/moderer" style="display:inline;margin-left:8px;">
            <input type="hidden" name="id" value="<?= $t['id'] ?>">
            <input type="hidden" name="statut" value="refuse">
            <button type="submit" style="background:#e74c3c;color:#fff;border:none;padding:4px 12px;border-radius:6px;cursor:pointer;">Refuser</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
