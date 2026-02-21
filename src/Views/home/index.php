<?php
$pageTitle = 'Fitwings – Accueil';
require_once __DIR__ . '/../layouts/header.php';

$ville = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $villeBrut = isset($_POST['ville']) ? trim($_POST['ville']) : '';
    if ($villeBrut !== '') {
        $ville = htmlspecialchars($villeBrut, ENT_QUOTES, 'UTF-8');
        switch (strtolower($villeBrut)) {
            case 'paris':
                $message = "Salle Fitwings Paris : 10 rue du Sport, Paris 15e. Ouvert 6h-23h.";
                break;
            case 'lyon':
                $message = "Salle Fitwings Lyon : 25 avenue du Fitness, Lyon 3e. Cours collectifs tous les jours.";
                break;
            case 'marseille':
                $message = "Salle Fitwings Marseille : 8 boulevard du Gym, Marseille 6e. Vue mer, muscu & cardio.";
                break;
            default:
                $message = "Aucune salle Fitwings trouvée pour cette ville. Essayez Paris, Lyon ou Marseille.";
        }
    }
}
?>

<main class="container">

  <!-- HERO / RECHERCHE -->
  <section class="card form-container">
    <h2>Rechercher une salle</h2>
    <form method="post" action="" class="search-form">
      <input
        type="text"
        name="ville"
        placeholder="Ex : Paris, Lyon, Marseille..."
        value="<?= $ville ?>"
        required
      />
      <button type="submit" class="btn-search">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
    <?php if ($ville !== ''): ?>
      <div class="resultat-ville">
        <span class="material-symbols-outlined">location_on</span>
        <strong><?= ucfirst($ville) ?></strong> : <?= $message ?>
      </div>
    <?php endif; ?>
  </section>

  <!-- PRÉSENTATION -->
  <section class="card">
    <h2>Bienvenue chez Fitwings</h2>
    <p>Bougez, vivez, progressez !</p>
    <ul class="fw-list">
      <li>Un espace lumineux et moderne</li>
      <li>Équipements dernière génération</li>
      <li>Coachs diplômés à l'écoute</li>
      <li>Valeurs : respect, entraide, dépassement</li>
    </ul>
  </section>

  <!-- TÉMOIGNAGES -->
  <section class="card">
    <h2>Témoignages</h2>
    <div class="temoignages">
      <div class="temoignage">
        <p>"Ambiance motivante et coachs à l'écoute !"</p>
        <strong>— Sarah, 28 ans</strong>
      </div>
      <div class="temoignage">
        <p>"Salle propre, matériel neuf, suivi personnalisé."</p>
        <strong>— Julien, 35 ans</strong>
      </div>
      <div class="temoignage">
        <p>"Diversité des cours et esprit d'équipe, top !"</p>
        <strong>— Amine, 41 ans</strong>
      </div>
    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
