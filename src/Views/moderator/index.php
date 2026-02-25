<?php
$pageTitle = 'Fitwings – Modération';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login'); exit;
}
if (!in_array($_SESSION['role'], ['admin', 'moderateur'])) {
    header('Location: /'); exit;
}

require_once __DIR__ . '/../../templates/header.php';
// TODO: charger les signalements depuis la BDD
$signalements_demo = [
    ['id' => 1, 'user' => 'user123',  'raison' => 'Spam',              'date' => '2025-09-14'],
    ['id' => 2, 'user' => 'badguy42', 'raison' => 'Contenu offensant', 'date' => '2025-09-15'],
];
?>

<main class="container">
  <section class="card">
    <h1>🛡️ Espace Modérateur</h1>
    <p style="color:#aaa;margin-bottom:24px;">Gestion des signalements</p>

    <div style="overflow-x:auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th><th>Utilisateur</th><th>Raison</th><th>Date</th><th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($signalements_demo as $s): ?>
          <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['user']) ?></td>
            <td><?= htmlspecialchars($s['raison']) ?></td>
            <td><?= $s['date'] ?></td>
            <td>
              <button class="prog-btn" style="padding:4px 10px;background:linear-gradient(90deg,#e74c3c,#c0392b);">Traiter</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../../templates/footer.php'; ?>
