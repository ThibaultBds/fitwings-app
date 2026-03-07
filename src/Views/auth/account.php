<?php
$pageTitle = 'Fitwings – Mon compte';

require_once __DIR__ . '/../templates/header.php';
?>

<main class="account-layout">

  <?php
    $plan = $user['plan'] ?? null;
    $membre_depuis = date('m/y', strtotime($user['created_at']));
    $expire = date('m/y', strtotime($user['created_at'] . ' +1 year'));
    $numero = 'FW-' . str_pad($_SESSION['user']['id'] ?? 0, 6, '0', STR_PAD_LEFT);
  ?>

  <!-- Colonne gauche -->
  <aside class="account-sidebar">

    <div class="account-avatar">
      <?= htmlspecialchars(strtoupper(substr($user['username'], 0, 1))) ?>
    </div>
    <h2 class="account-username"><?= htmlspecialchars($user['username']) ?></h2>
    <span class="badge niveau-debutant"><?= htmlspecialchars($user['role']) ?></span>

    <div class="account-info-block">
      <p><span>Email</span><?= htmlspecialchars($user['email']) ?></p>
      <p><span>Inscrit le</span><?= date('d/m/Y', strtotime($user['created_at'])) ?></p>
    </div>

    <div class="account-card-label">Carte abonné</div>
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

    <div class="account-actions">
      <a href="/mes-programmes" class="prog-btn">Mes programmes</a>
      <a href="/abonnements" class="btn-primary">Mon abonnement</a>
      <a href="/logout" class="btn-danger">Déconnexion</a>
      <?php if (in_array($user['role'], ['admin', 'moderateur'])): ?>
        <?php if ($user['role'] === 'admin'): ?>
          <a href="/admin" class="btn-primary">Panneau Admin</a>
        <?php else: ?>
          <a href="/moderator" class="btn-primary">Espace Modération</a>
        <?php endif; ?>
      <?php endif; ?>
    </div>

  </aside>

  <!-- Colonne droite -->
  <section class="account-main">

    <div class="card account-section">
      <h2>Ajouter une entrée de suivi</h2>
      <form method="post" action="/account/progression" class="progression-form">
        <div class="progression-fields">
          <label>Poids (kg)<input type="number" step="0.1" name="poids" placeholder="75.5" required></label>
          <label>Tour de taille (cm)<input type="number" step="0.1" name="tour_taille" placeholder="80" required></label>
          <label>Nombre de séances<input type="number" name="nombre_seances" placeholder="3" required></label>
        </div>
        <button type="submit" class="prog-btn">Enregistrer</button>
      </form>
    </div>

    <?php if (!empty($progressions)) : ?>
    <div class="card account-section">
      <h2>Historique de suivi</h2>
      <table class="progression-table">
        <tr>
          <th>Date</th>
          <th>Poids</th>
          <th>Tour de taille</th>
          <th>Séances</th>
        </tr>
        <?php foreach ($progressions as $p) : ?>
          <tr>
            <td><?= date('d/m/Y', strtotime($p['date_suivi'])) ?></td>
            <td><?= $p['poids'] ?> kg</td>
            <td><?= $p['tour_taille'] ?> cm</td>
            <td><?= $p['nombre_seances'] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php endif; ?>

    <?php if (!empty($progressions)) : ?>
    <div class="card account-section">
      <h2>Courbe de progression</h2>
      <canvas id="progressionChart"></canvas>
    </div>
    <?php endif; ?>

  </section>

</main>

<?php if (!empty($progressions)) : ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = <?= json_encode(array_map(fn($p) => date('d/m', strtotime($p['date_suivi'])), array_reverse($progressions))) ?>;
  const poids  = <?= json_encode(array_map(fn($p) => (float)$p['poids'], array_reverse($progressions))) ?>;
  const taille = <?= json_encode(array_map(fn($p) => (float)$p['tour_taille'], array_reverse($progressions))) ?>;

  new Chart(document.getElementById('progressionChart'), {
    type: 'line',
    data: {
      labels,
      datasets: [
        {
          label: 'Poids (kg)',
          data: poids,
          borderColor: '#e8a020',
          backgroundColor: 'rgba(232,160,32,0.1)',
          tension: 0.3,
          fill: true,
        },
        {
          label: 'Tour de taille (cm)',
          data: taille,
          borderColor: '#4fa3e0',
          backgroundColor: 'rgba(79,163,224,0.1)',
          tension: 0.3,
          fill: true,
        }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'top' } },
      scales: { y: { beginAtZero: false } }
    }
  });
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>