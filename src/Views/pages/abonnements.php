<?php
$pageTitle = 'Fitwings - Abonnements';
require_once __DIR__ . '/../templates/header.php';

$isLoggedIn = isset($_SESSION['user']);
$ctaHref = $isLoggedIn ? '/account' : '/register';
$ctaLabel = $isLoggedIn ? 'Choisir ce plan' : 'Commencer';
?>
<header class="page-banner">
  <h1>Nos <span>Abonnements</span></h1>
  <p>Choisissez la formule qui correspond à vos objectifs</p>
</header>

<main class="container">

  <!-- Toggle mensuel / annuel -->
  <div class="tarif-toggle">
    <span id="toggle-label-month" class="tarif-toggle-label active">Mensuel</span>
    <label class="tarif-switch">
      <input type="checkbox" id="billing-toggle">
      <span class="tarif-slider"></span>
    </label>
    <span id="toggle-label-year" class="tarif-toggle-label">Annuel <em class="tarif-promo">−20%</em></span>
  </div>

  <!-- Cartes tarifaires -->
  <div class="tarif-grid">

    <!-- Plan Essentiel -->
    <div class="tarif-card">
      <div class="tarif-header">
        <h2 class="tarif-name">Essentiel</h2>
        <p class="tarif-desc">Pour débuter ou maintenir une activité régulière</p>
      </div>
      <div class="tarif-price">
        <span class="tarif-amount" data-monthly="29" data-yearly="23">29</span>
        <span class="tarif-currency">€<small>/mois</small></span>
      </div>
      <ul class="tarif-features">
        <li class="ok">Accès illimité à la salle</li>
        <li class="ok">Espace cardio complet</li>
        <li class="ok">Vestiaires &amp; casiers</li>
        <li class="ok">Application Fitwings</li>
        <li class="ko">Cours collectifs</li>
        <li class="ko">Coaching personnalisé</li>
        <li class="ko">Accès invité</li>
      </ul>
      <a href="<?= $ctaHref ?>" class="tarif-btn tarif-btn-outline"><?= $ctaLabel ?></a>
    </div>

    <!-- Plan Premium (mis en avant) -->
    <div class="tarif-card tarif-card--featured">
      <div class="tarif-badge">Le plus populaire</div>
      <div class="tarif-header">
        <h2 class="tarif-name">Premium</h2>
        <p class="tarif-desc">L'équilibre parfait entre liberté et accompagnement</p>
      </div>
      <div class="tarif-price">
        <span class="tarif-amount" data-monthly="49" data-yearly="39">49</span>
        <span class="tarif-currency">€<small>/mois</small></span>
      </div>
      <ul class="tarif-features">
        <li class="ok">Accès illimité à la salle</li>
        <li class="ok">Espace cardio complet</li>
        <li class="ok">Vestiaires &amp; casiers</li>
        <li class="ok">Application Fitwings</li>
        <li class="ok">Cours collectifs illimités</li>
        <li class="ok">1 séance coaching / mois</li>
        <li class="ko">Accès invité</li>
      </ul>
      <a href="<?= $ctaHref ?>" class="tarif-btn tarif-btn-primary"><?= $ctaLabel ?></a>
    </div>

    <!-- Plan Elite -->
    <div class="tarif-card">
      <div class="tarif-header">
        <h2 class="tarif-name">Elite</h2>
        <p class="tarif-desc">Le suivi complet pour atteindre vos objectifs les plus ambitieux</p>
      </div>
      <div class="tarif-price">
        <span class="tarif-amount" data-monthly="79" data-yearly="63">79</span>
        <span class="tarif-currency">€<small>/mois</small></span>
      </div>
      <ul class="tarif-features">
        <li class="ok">Accès illimité à la salle</li>
        <li class="ok">Espace cardio complet</li>
        <li class="ok">Vestiaires &amp; casiers</li>
        <li class="ok">Application Fitwings</li>
        <li class="ok">Cours collectifs illimités</li>
        <li class="ok">Coach dédié (séances illimitées)</li>
        <li class="ok">1 accès invité / semaine</li>
      </ul>
      <a href="<?= $ctaHref ?>" class="tarif-btn tarif-btn-outline"><?= $ctaLabel ?></a>
    </div>

  </div>

  <!-- FAQ courte -->
  <section class="tarif-faq">
    <h2>Questions fréquentes</h2>
    <div class="tarif-faq-grid">
      <div class="tarif-faq-item">
        <h3>Puis-je changer de plan ?</h3>
        <p>Oui, vous pouvez passer à un plan supérieur ou inférieur à tout moment depuis votre espace compte, sans frais.</p>
      </div>
      <div class="tarif-faq-item">
        <h3>Y a-t-il un engagement ?</h3>
        <p>Les abonnements mensuels sont sans engagement. L'abonnement annuel est prépayé avec une réduction de 20%.</p>
      </div>
      <div class="tarif-faq-item">
        <h3>Comment fonctionne la carte abonné ?</h3>
        <p>À l'activation de votre abonnement, une carte abonné numérique est générée dans votre espace compte pour accéder à la salle.</p>
      </div>
      <div class="tarif-faq-item">
        <h3>Et si je veux annuler ?</h3>
        <p>Annulation en un clic depuis votre compte. L'accès reste actif jusqu'à la fin de la période payée.</p>
      </div>
    </div>
  </section>

</main>

<script>
(function () {
  const toggle   = document.getElementById('billing-toggle');
  const amounts  = document.querySelectorAll('.tarif-amount');
  const lblMonth = document.getElementById('toggle-label-month');
  const lblYear  = document.getElementById('toggle-label-year');

  toggle.addEventListener('change', () => {
    const isYearly = toggle.checked;
    lblMonth.classList.toggle('active', !isYearly);
    lblYear.classList.toggle('active', isYearly);
    amounts.forEach(el => {
      el.textContent = isYearly ? el.dataset.yearly : el.dataset.monthly;
    });
  });
})();
</script>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
