<?php
$pageTitle = 'Fitwings – Coaching';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="cw-main">

  <section class="cw-hero">
    <h1>🏋️ Coaching Fitwings</h1>
    <p>Atteins tes objectifs plus vite grâce à nos coachs certifiés</p>
  </section>

  <section class="cw-team">
    <h2>Nos Coachs</h2>
    <div class="cw-cards">
      <div class="cw-card">
        <div class="cw-avatar">💪</div>
        <h3>Alex</h3>
        <p>Spécialiste en musculation & prise de masse</p>
      </div>
      <div class="cw-card">
        <div class="cw-avatar">🏃</div>
        <h3>Sarah</h3>
        <p>Experte cardio & perte de poids</p>
      </div>
      <div class="cw-card">
        <div class="cw-avatar">🧘</div>
        <h3>Karim</h3>
        <p>Coach bien-être, mobilité & renforcement</p>
      </div>
    </div>
  </section>

  <div class="fw-cta">
    <h2>Prêt à être accompagné ?</h2>
    <a href="/pages/contact" class="btn-primary">📩 Contacte un coach</a>
  </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
