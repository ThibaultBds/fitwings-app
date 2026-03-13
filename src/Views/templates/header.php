<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= $pageTitle ?? 'Fitwings' ?></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

  <header class="header">
    <div class="logo">🔥 Fitwings</div>

    <nav id="nav-menu">
      <ul>
  <li><a href="/">Accueil</a></li>

  <li class="dropdown">
    <a href="#">Prestations ▾</a>
    <ul class="dropdown-menu">
      <li><a href="/programmes">Programmes</a></li>
      <li><a href="/salles">Salles</a></li>
      <li><a href="/pages/musculation">Musculation</a></li>
      <li><a href="/pages/cardio">Cardio</a></li>
      <li><a href="/pages/cours">Cours collectifs</a></li>
      <li><a href="/pages/coaching">Coachs</a></li>
    </ul>
  </li>

  <li><a href="/temoignages">Témoignages</a></li>
  <li><a href="/carriere">Carrière</a></li>
  <li><a href="/pages/contact">Contact</a></li>

  <?php if (isset($_SESSION['user'])): ?>

    <li>
      <a href="/account">
        👤 <?= htmlspecialchars($_SESSION['user']['username']) ?>
      </a>
    </li>

    <li>
      <a href="/logout">🚪 Déconnexion</a>
    </li>

  <?php else: ?>

    <li><a href="/login">Se connecter</a></li>
    <li><a href="/register">S'inscrire</a></li>

  <?php endif; ?>

      </ul>
    </nav>

    <div class="header-actions">
      <button id="dark-toggle" aria-label="Basculer mode sombre" title="Mode sombre">🌙</button>
      <button class="burger" id="burger" aria-label="Ouvrir le menu">
        <span class="material-symbols-outlined">menu</span>
      </button>
    </div>
  </header>

  <script src="/assets/js/navbar.js" defer></script>
  <script>
    (function() {
      const toggle = document.getElementById('dark-toggle');
      if (!toggle) return;
      const saved = localStorage.getItem('fitwings_theme');
      if (saved === 'light') document.body.classList.add('light-mode');
      toggle.textContent = document.body.classList.contains('light-mode') ? '☀️' : '🌙';
      toggle.style.cssText = 'background:transparent;border:none;color:inherit;cursor:pointer;font-size:1.2rem;margin-left:8px;';
      toggle.addEventListener('click', () => {
        const isLight = document.body.classList.toggle('light-mode');
        localStorage.setItem('fitwings_theme', isLight ? 'light' : 'dark');
        toggle.textContent = isLight ? '☀️' : '🌙';
      });
    })();
  </script>
