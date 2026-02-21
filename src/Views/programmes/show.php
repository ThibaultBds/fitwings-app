<?php
$pageTitle = 'Fitwings – Détail programme';
require_once __DIR__ . '/../layouts/header.php';

// TODO: requête BDD quand les models seront prêts
// Pour l'instant, données statiques selon l'id
$id = (int)($_GET['id'] ?? 0);

$programmes_demo = [
    1 => ['titre' => '🔥 Brûleur Débutant', 'niveau' => 'Débutant', 'objectif' => 'Perte de poids', 'type' => 'Cardio', 'duree' => '4 semaines', 'description' => 'Programme cardio progressif pour débuter en douceur. 3 séances de 30 min par semaine, adapté aux personnes sédentaires souhaitant se remettre en forme.', 'materiel' => 'Tapis de course, vélo elliptique', 'conseils' => 'Hydratez-vous bien et échauffez-vous 5 min avant chaque séance.'],
    2 => ['titre' => '💪 Force Intermédiaire', 'niveau' => 'Intermédiaire', 'objectif' => 'Force', 'type' => 'Musculation', 'duree' => '8 semaines', 'description' => 'Programme Full Body 3 fois par semaine pour développer votre force générale et gagner en masse musculaire de façon équilibrée.', 'materiel' => 'Barre olympique, haltères, banc', 'conseils' => 'Augmentez les charges progressivement de 2,5 kg par semaine.'],
    3 => ['titre' => '⚡ HIIT Intense', 'niveau' => 'Avancé', 'objectif' => 'Perte de poids', 'type' => 'HIIT', 'duree' => '6 semaines', 'description' => 'Séances de 20 min à haute intensité. Alternance 40s effort / 20s repos. Idéal pour brûler un maximum de calories en peu de temps.', 'materiel' => 'Aucun matériel nécessaire', 'conseils' => 'Respectez impérativement les temps de repos pour éviter le surentraînement.'],
];

$programme = $programmes_demo[$id] ?? null;
?>

<main class="container">
  <?php if ($programme): ?>
    <div class="programme-detail card">
      <h1><?= $programme['titre'] ?></h1>
      <div style="display:flex;gap:10px;flex-wrap:wrap;margin:16px 0;">
        <span class="badge niveau-<?= strtolower(str_replace('é','e',$programme['niveau'])) ?>"><?= $programme['niveau'] ?></span>
        <span class="badge niveau-intermediaire"><?= $programme['objectif'] ?></span>
        <span class="badge niveau-debutant"><?= $programme['type'] ?></span>
      </div>
      <p style="font-size:1.1rem;margin-bottom:20px;"><?= $programme['description'] ?></p>
      <p>📅 <strong>Durée :</strong> <?= $programme['duree'] ?></p>
      <p>🏋️ <strong>Matériel :</strong> <?= $programme['materiel'] ?></p>
      <div class="card" style="margin-top:20px;">
        <h3>💡 Conseils du coach</h3>
        <p><?= $programme['conseils'] ?></p>
      </div>
      <a href="/programmes" class="prog-btn" style="margin-top:24px;display:inline-block;">⬅ Retour aux programmes</a>
    </div>
  <?php else: ?>
    <div class="card" style="text-align:center;">
      <p>❌ Programme introuvable.</p>
      <a href="/programmes" class="prog-btn">⬅ Retour aux programmes</a>
    </div>
  <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
