<?php
$pageTitle = 'FitWings - Salles de sport';
require_once __DIR__ . '/../templates/header.php';
$count = count($salles ?? []);
?>

<header class="salles-banner">
  <div class="salles-banner__inner">
    <span class="salles-banner__label">Reseau FitWings</span>
    <h1>
      <?php if (!empty($ville)): ?>
        Salles a <span><?= htmlspecialchars($ville) ?></span>
      <?php else: ?>
        Trouvez votre salle
      <?php endif; ?>
    </h1>
    <p>Acces a toutes nos salles partout en France avec votre abonnement</p>
  </div>
</header>

<main class="prog-container">

  <div class="salles-search-wrap">
    <form action="/salles" method="GET" class="salles-search-form">
      <span class="material-symbols-outlined">search</span>
      <input type="text" name="ville" id="ville"
             placeholder="Paris, Lyon, Marseille..."
             value="<?= htmlspecialchars($ville ?? '') ?>">
      <button type="submit">Rechercher</button>
    </form>
  </div>

  <?php if (!empty($salles)): ?>

    <div class="salles-results-header">
      <span class="salles-count"><?= $count ?> salle<?= $count > 1 ? 's' : '' ?> trouvee<?= $count > 1 ? 's' : '' ?></span>
      <?php if (!empty($ville)): ?>
        <span class="salles-results-city">dans "<?= htmlspecialchars($ville) ?>"</span>
      <?php else: ?>
        <span class="salles-results-city">dans toute la France</span>
      <?php endif; ?>
    </div>

    <div class="salles-grid">
      <?php foreach ($salles as $s): ?>
        <article class="salle-card">

          <div class="salle-card__top">
            <div class="salle-card__icon-wrap">
              <span class="material-symbols-outlined">fitness_center</span>
            </div>
            <div>
              <h3 class="salle-card__name"><?= htmlspecialchars($s->nom) ?></h3>
              <span class="salle-card__city">
                <span class="material-symbols-outlined">location_on</span>
                <?= htmlspecialchars($s->ville) ?>
              </span>
            </div>
          </div>

          <address class="salle-card__address">
            <?= htmlspecialchars($s->adresse) ?>
            <?php if (!empty($s->code_postal)): ?>
              - <?= htmlspecialchars($s->code_postal) ?>
            <?php endif; ?>
          </address>

          <div class="salle-card__chips">
            <?php if (!empty($s->telephone)): ?>
              <a href="tel:<?= htmlspecialchars($s->telephone) ?>" class="salle-chip salle-chip--phone">
                <span class="material-symbols-outlined">call</span>
                <?= htmlspecialchars($s->telephone) ?>
              </a>
            <?php endif; ?>
            <?php if (!empty($s->horaires)): ?>
              <span class="salle-chip salle-chip--hours">
                <span class="material-symbols-outlined">schedule</span>
                <?= htmlspecialchars($s->horaires) ?>
              </span>
            <?php endif; ?>
          </div>

          <a href="/salles/show?id=<?= (int)$s->id ?>" class="salle-card__btn">
            Voir les details
            <span class="material-symbols-outlined">arrow_forward</span>
          </a>

        </article>
      <?php endforeach; ?>
    </div>

  <?php elseif (!empty($ville)): ?>

    <div class="salle-empty">
      <span class="material-symbols-outlined">search_off</span>
      <p>Aucune salle trouvee pour "<strong><?= htmlspecialchars($ville) ?></strong>".</p>
      <p class="salle-empty__sub">Essayez une autre ville ou verifiez l'orthographe.</p>
    </div>

  <?php else: ?>

    <div class="salle-empty">
      <span class="material-symbols-outlined">location_city</span>
      <p>Entrez le nom d'une ville pour trouver une salle FitWings.</p>
      <p class="salle-empty__sub">Nous sommes presents a Paris, Lyon, Marseille et plus encore.</p>
    </div>

  <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
