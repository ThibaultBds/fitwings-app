<section class="card">
  <h2>Gestion des utilisateurs</h2>

  <form method="POST" action="/admin/users/create" class="admin-grid-form admin-form-spacing">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input class="admin-input" type="text" name="username" placeholder="Pseudo" required>
    <input class="admin-input" type="email" name="email" placeholder="Email" required>
    <input class="admin-input" type="password" name="password" placeholder="Mot de passe (8+)" minlength="8" required>
    <select class="admin-input" name="role">
      <option value="user">user</option>
      <option value="moderateur">moderateur</option>
      <option value="admin">admin</option>
    </select>
    <button type="submit" class="prog-btn">Creer utilisateur</button>
  </form>

  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th><th>Pseudo</th><th>Email</th><th>Role</th><th>Inscription</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u->id ?></td>
          <td><?= htmlspecialchars($u->username) ?></td>
          <td><?= htmlspecialchars($u->email) ?></td>
          <td>
            <?php if ($u->id !== $_SESSION['user']['id']): ?>
            <form method="POST" action="/admin/role" class="inline-form">
              <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
              <input type="hidden" name="role_id" value="<?= $u->id ?>">
              <select name="new_role" class="admin-input admin-input--sm" onchange="this.form.submit()">
                <option value="user"       <?= $u->role === 'user'       ? 'selected' : '' ?>>user</option>
                <option value="moderateur" <?= $u->role === 'moderateur' ? 'selected' : '' ?>>moderateur</option>
                <option value="admin"      <?= $u->role === 'admin'      ? 'selected' : '' ?>>admin</option>
              </select>
            </form>
            <?php else: ?>
            <span class="badge niveau-avance"><?= $u->role ?></span>
            <?php endif; ?>
          </td>
          <td><?= $u->created_at ?></td>
          <td>
            <?php if ($u->id !== $_SESSION['user']['id']): ?>
            <form method="POST" action="/admin/delete" class="inline-form">
              <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
              <input type="hidden" name="delete_id" value="<?= $u->id ?>">
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
