<?php
$pageTitle = 'Fitwings – Coaching';
require_once __DIR__ . '/../layouts/header.php';
?>

<header class="page-banner">
  <h1>Coaching <span>Fitwings</span></h1>
  <p>Atteins tes objectifs plus vite grâce à nos coachs certifiés</p>
</header>

<main class="cw-main">

  <section class="cw-team">
    <h2>Nos Coachs</h2>
    <div class="cw-cards">
      <div class="cw-card">
        <img src="/assets/images/alex.jpg" alt="Coach Alex" class="cw-img">
        <h3>Alex</h3>
        <p>Spécialiste en musculation & prise de masse</p>
      </div>
      <div class="cw-card">
        <img src="/assets/images/sarah.jpg" alt="Coach Sarah" class="cw-img">
        <h3>Sarah</h3>
        <p>Experte cardio & perte de poids</p>
      </div>
      <div class="cw-card">
        <img src="/assets/images/karim.jpg" alt="Coach Karim" class="cw-img">
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
