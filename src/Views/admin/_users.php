<section class="card">
  <h2>Gestion des utilisateurs</h2>

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
              <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
              <input type="hidden" name="role_id" value="<?= $u['id'] ?>">
              <select name="new_role" class="admin-input">
                <option value="user" <?= $u['role']==='user'?'selected':'' ?>>user</option>
                <option value="moderateur" <?= $u['role']==='moderateur'?'selected':'' ?>>moderateur</option>
                <option value="admin" <?= $u['role']==='admin'?'selected':'' ?>>admin</option>
              </select>
              <button type="submit" class="prog-btn admin-btn-sm">Changer</button>
            </form>
            <?php if ($u['id'] !== $_SESSION['user']['id']): ?>
            <form method="POST" action="/admin/delete" style="display:inline;margin-left:8px;">
              <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
              <input type="hidden" name="delete_id" value="<?= $u['id'] ?>">
              <button type="submit" class="btn-danger admin-btn-sm">Supprimer</button>
            </form>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
