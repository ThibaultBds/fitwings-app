<?php
$pageTitle = 'Fitwings – Témoignages';
require_once __DIR__ . '/../templates/header.php';

$file = __DIR__ . '/../../../../storage/temoignages.json';
$dir  = dirname($file);
if (!is_dir($dir)) mkdir($dir, 0775, true);
if (!file_exists($file) || filesize($file) === 0) file_put_contents($file, '[]');

$temoignages = json_decode(file_get_contents($file), true) ?: [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $note    = max(1, min(5, (int)($_POST['note'] ?? 5)));
    if ($nom && $message) {
        $temoignages[] = ['nom' => $nom, 'message' => $message, 'note' => $note, 'date' => date('d/m/Y')];
        file_put_contents($file, json_encode($temoignages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: /temoignages');
        exit;
    }
}
?>

<main class="temoignages-main container">

  <h1>💬 Témoignages</h1>
  <p>Ce que nos membres disent de Fitwings.</p>

  <section class="card form-container">
    <h2>Laissez votre avis</h2>
    <form method="POST" action="" class="objectif-form">
      <label for="nom">Votre nom</label>
      <input type="text" name="nom" id="nom" required>
      <label for="message">Votre message (300 car. max)</label>
      <textarea name="message" id="message" maxlength="300" rows="4" required style="padding:10px;border-radius:8px;border:2px solid var(--primary);background:var(--bg);color:var(--text);font-size:1rem;resize:vertical;"></textarea>
      <label for="note">Note (1 à 5)</label>
      <input type="number" name="note" id="note" min="1" max="5" value="5" required>
      <button type="submit" class="prog-btn">Envoyer</button>
    </form>
  </section>

  <section class="temoignages">
    <?php if (!empty($temoignages)): ?>
      <?php foreach (array_reverse($temoignages) as $t): ?>
        <div class="temoignage-card temoignage">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
            <strong><?= $t['nom'] ?></strong>
            <span><?= str_repeat('⭐', $t['note']) ?><?= str_repeat('☆', 5 - $t['note']) ?></span>
          </div>
          <p><?= $t['message'] ?></p>
          <?php if (!empty($t['date'])): ?><small style="color:#888;"><?= $t['date'] ?></small><?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucun témoignage pour le moment. Soyez le premier !</p>
    <?php endif; ?>
  </section>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
