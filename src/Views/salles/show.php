<?php
$pageTitle = 'FitWings – ' . htmlspecialchars($salle['nom'] ?? 'Détail salle');
require_once __DIR__ . '/../templates/header.php';
?>

<?php if (!empty($salle)): ?>

<header class="salle-show-hero">
  <div class="salle-show-hero__inner">
    <a href="javascript:history.back()" class="salle-show-back">
      <span class="material-symbols-outlined">arrow_back</span> Retour aux résultats
    </a>
    <div class="salle-show-hero__badge">
      <span class="material-symbols-outlined">fitness_center</span>
      Salle FitWings
    </div>
    <h1><?= htmlspecialchars($salle['nom']) ?></h1>
    <p class="salle-show-hero__loc">
      <span class="material-symbols-outlined">location_on</span>
      <?= htmlspecialchars($salle['code_postal'] ?? '') ?> <?= htmlspecialchars($salle['ville'] ?? '') ?>
    </p>
  </div>
</header>

<main class="prog-container">

  <!-- Blocs infos rapides -->
  <div class="salle-show-quickinfo">
    <?php if (!empty($salle['telephone'])): ?>
    <a href="tel:<?= htmlspecialchars($salle['telephone']) ?>" class="salle-qi-block">
      <span class="material-symbols-outlined">call</span>
      <div>
        <span class="salle-qi-label">Téléphone</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle['telephone']) ?></span>
      </div>
    </a>
    <?php endif; ?>
    <?php if (!empty($salle['email'])): ?>
    <a href="mailto:<?= htmlspecialchars($salle['email']) ?>" class="salle-qi-block">
      <span class="material-symbols-outlined">mail</span>
      <div>
        <span class="salle-qi-label">Email</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle['email']) ?></span>
      </div>
    </a>
    <?php endif; ?>
    <?php if (!empty($salle['horaires'])): ?>
    <div class="salle-qi-block">
      <span class="material-symbols-outlined">schedule</span>
      <div>
        <span class="salle-qi-label">Horaires</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle['horaires']) ?></span>
      </div>
    </div>
    <?php endif; ?>
    <div class="salle-qi-block">
      <span class="material-symbols-outlined">location_on</span>
      <div>
        <span class="salle-qi-label">Adresse</span>
        <span class="salle-qi-value"><?= htmlspecialchars($salle['adresse']) ?>, <?= htmlspecialchars($salle['code_postal'] ?? '') ?> <?= htmlspecialchars($salle['ville'] ?? '') ?></span>
      </div>
    </div>
  </div>

  <!-- Description -->
  <?php if (!empty($salle['description'])): ?>
  <section class="salle-show-desc card">
    <div class="salle-show-desc__icon">
      <span class="material-symbols-outlined">info</span>
    </div>
    <div>
      <h2>À propos de cette salle</h2>
      <p><?= htmlspecialchars($salle['description']) ?></p>
    </div>
  </section>
  <?php endif; ?>

  <!-- CTA -->
  <section class="salle-show-cta">
    <div class="salle-show-cta__text">
      <h3>Prêt à rejoindre cette salle ?</h3>
      <p>Tous nos abonnements donnent accès à l'ensemble du réseau FitWings.</p>
    </div>
    <a href="/abonnements" class="prog-btn salle-show-cta__btn">Voir les abonnements</a>
  </section>

</main>

<?php else: ?>

<main class="prog-container">
  <div class="salle-empty" style="margin-top:80px;">
    <span class="material-symbols-outlined">error</span>
    <p>Salle introuvable.</p>
    <a href="/salles" class="prog-btn" style="margin-top:1rem;">Retour à la recherche</a>
  </div>
</main>

<?php endif; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
