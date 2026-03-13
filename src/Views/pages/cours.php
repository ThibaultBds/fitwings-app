<?php
$pageTitle = 'Fitwings – Cours Collectifs';
require_once __DIR__ . '/../templates/header.php';
?>

<header class="page-banner">
  <h1>Cours <span>Collectifs</span></h1>
  <p>Progressez ensemble dans une ambiance motivante et conviviale 💪</p>
</header>

<main class="cc-main">

  <section class="cc-list">
    <div class="cc-card">
      <h3>🧘 Yoga</h3>
      <p>Détente, respiration et mobilité pour un corps et un esprit équilibrés.</p>
    </div>
    <div class="cc-card">
      <h3>🔥 HIIT</h3>
      <p>Des séances courtes et intenses pour brûler un maximum de calories.</p>
    </div>
    <div class="cc-card">
      <h3>🥊 Boxe Fitness</h3>
      <p>Défoulez-vous avec une combinaison de cardio et de mouvements de boxe.</p>
    </div>
    <div class="cc-card">
      <h3>💪 Cross Training</h3>
      <p>Un entraînement complet et varié pour travailler force et endurance.</p>
    </div>
  </section>

  <section class="card form-container">
    <h2>Réserver une place</h2>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success">Votre réservation a bien été envoyée, on vous recontacte rapidement !</div>
    <?php endif; ?>
    <?php if (!empty($erreur)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <form method="POST" action="/pages/cours" class="objectif-form">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

      <label for="nom">Votre nom *</label>
      <input type="text" name="nom" id="nom" required maxlength="120">

      <label for="email">Votre email *</label>
      <input type="email" name="email" id="email" required>

      <label for="cours">Cours souhaité *</label>
      <select name="cours" id="cours" required>
        <option value="">-- Choisir un cours --</option>
        <option value="Yoga">Yoga</option>
        <option value="HIIT">HIIT</option>
        <option value="Boxe Fitness">Boxe Fitness</option>
        <option value="Cross Training">Cross Training</option>
      </select>

      <label for="message">Message (facultatif)</label>
      <textarea name="message" id="message" rows="3" maxlength="1000"></textarea>

      <button type="submit" class="prog-btn">Envoyer ma demande</button>
    </form>
  </section>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
