<?php
$pageTitle = 'Fitwings - ' . htmlspecialchars($salle->nom ?? 'Detail salle');
require_once __DIR__ . '/../templates/header.php';
?>

<?php if (!empty($salle)): ?>

<header class="salle-show-hero">
  <div class="salle-show-hero__inner">
    <a href="javascript:history.back()" class="salle-show-back">
      <span class="material-symbols-outlined">arrow_back</span> Retour aux resultats
    </a>
    <div class="salle-show-hero__badge">
      <span class="material-symbols-outlined">fitness_center</span>
      Salle Fitwings
    </div>
    <h1><?= htmlspecialchars($salle->nom) ?></h1>
    <p class="salle-show-hero__loc">
      <span class="material-symbols-outlined">location_on</span>
      <?= htmlspecialchars($salle->code_postal ?? '') ?> <?= htmlspecialchars($salle->ville ?? '') ?>
    </p>
  </div>
</header>

<main class="prog-container">
  <div class="salle-show-quickinfo">
    <?php if (!empty($salle->telephone)): ?>
    <a href="tel:<?= htmlspecialchars($salle->telephone) ?>" class="salle-qi-block">
      <span class="material-symbols-outlined">call</span>
      <div>
        <span class="salle-qi-label">Telephone</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle->telephone) ?></span>
      </div>
    </a>
    <?php endif; ?>
    <?php if (!empty($salle->email)): ?>
    <a href="mailto:<?= htmlspecialchars($salle->email) ?>" class="salle-qi-block">
      <span class="material-symbols-outlined">mail</span>
      <div>
        <span class="salle-qi-label">Email</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle->email) ?></span>
      </div>
    </a>
    <?php endif; ?>
    <?php if (!empty($salle->horaires)): ?>
    <div class="salle-qi-block">
      <span class="material-symbols-outlined">schedule</span>
      <div>
        <span class="salle-qi-label">Horaires</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle->horaires) ?></span>
      </div>
    </div>
    <?php endif; ?>
    <div class="salle-qi-block">
      <span class="material-symbols-outlined">location_on</span>
      <div>
        <span class="salle-qi-label">Adresse</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle->adresse) ?>, <?= htmlspecialchars($salle->code_postal ?? '') ?> <?= htmlspecialchars($salle->ville ?? '') ?></span>
      </div>
    </div>
  </div>

  <?php if (!empty($salle->description)): ?>
  <section class="salle-show-desc card">
    <div class="salle-show-desc__icon">
      <span class="material-symbols-outlined">info</span>
    </div>
    <div>
      <h2>A propos de cette salle</h2>
      <p><?= htmlspecialchars($salle->description) ?></p>
    </div>
  </section>
  <?php endif; ?>

  <section class="salle-show-cta">
    <div class="salle-show-cta__text">
      <h3>Pret a rejoindre cette salle ?</h3>
      <p>Tous nos abonnements donnent acces a l'ensemble du reseau Fitwings.</p>
    </div>
    <a href="/abonnements" class="prog-btn salle-show-cta__btn">Voir les abonnements</a>
  </section>
</main>

<?php else: ?>

<main class="prog-container">
  <div class="salle-empty salle-empty--spaced">
    <span class="material-symbols-outlined">error</span>
    <p>Salle introuvable.</p>
    <a href="/salles" class="prog-btn salle-empty__action">Retour a la recherche</a>
  </div>
</main>

<?php endif; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
