<section class="card from-container">
    <h2 class="muscu-title">Rechercher une salle</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="search-form">
        <input
            type="text"
            name="ville"
            placeholder="Ex : Paris, Lyon, Marseille..."
            value="<?php echo $ville; ?>
            required
        ?>

        <?php if ($ville !== ''): ?>
      <div class="resultat-ville">
        <span class="material-symbols-outlined">location_on</span>
        <strong><?php echo ucfirst($ville); ?></strong> : <?php echo $message; ?>
      </div>
    <?php endif; ?>
  </section>

  <!-- PRESENTATION -->
  <section class="card">
    <h2 class="muscu-title">Bienvenue chez Fitwings</h2>
    <p>Bougez, vivez, progressez !</p>
    <ul class="muscu-list">
      <li>Un espace lumineux et moderne</li>
      <li>Équipements dernière génération</li>
      <li>Coachs diplômés à l’écoute</li>
      <li>Valeurs : respect, entraide, dépassement</li>
    </ul>
    <div class="muscu-img-superpose">
      <img src="assets/images/salledesport.jpg" alt="Salle musculation" />
      <img src="assets/images/salledesport2.jpg" alt="Salle cardio" />
    </div>
  </section>

  <!-- TEMOIGNAGES -->
  <section class="card">
    <h2 class="muscu-title">Témoignages</h2>
    <div class="temoignages">
      <div class="temoignage">
        <p>“Ambiance motivante et coachs à l’écoute !”</p>
        <strong>— Sarah, 28 ans</strong>
      </div>
      <div class="temoignage">
        <p>“Salle propre, matériel neuf, suivi personnalisé.”</p>
        <strong>— Julien, 35 ans</strong>
      </div>
      <div class="temoignage">
        <p>“Diversité des cours et esprit d’équipe, top !”</p>
        <strong>— Amine, 41 ans</strong>
      </div>
    </div>
  </section>