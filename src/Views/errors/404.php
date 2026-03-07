<?php 

$pageTitle = 'Fitwings - Page introuvable';
require_once __DIR__ . '/../templates/header.php';
?>

<main class="error-404">
    <div class="error-404__inner">
        <span class="error-404__code">404</span>
        <h1 class="error-404__title">Page introuvable</h1>
        <p class="error-404__text">Cette page n'existe pas ou a été déplacée.</p>
        <a href="/" class="btn-primary">Retour à l'accueil</a>
    </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>