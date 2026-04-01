document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll(".prog-objectifs-buttons button");
  const cards = document.querySelectorAll(".cards-grid .programme-card");


  let activeFilters = [];

  const allBtn = document.querySelector('[data-filter="all"]');
  if (allBtn) allBtn.classList.add("active");

  function applyFilters() {
    cards.forEach(card => {
      const raw = (card.dataset.category || "").toLowerCase().trim();
      const categories = raw.split(/\s+/);
      const match = activeFilters.length === 0 || activeFilters.some(f => categories.includes(f));
      card.classList.toggle("hidden", !match);
    });
    const visible = Array.from(cards).filter(c => !c.classList.contains('hidden')).length;
    const noEl = document.getElementById('no-results');
    if (noEl) {
      noEl.style.display = visible === 0 ? 'block' : 'none';
    }
  }

  const btnContainer = document.querySelector('.prog-objectifs-buttons');
  if (btnContainer) {
    btnContainer.addEventListener('click', (ev) => {
      const btn = ev.target.closest('button');
      if (!btn || !btnContainer.contains(btn)) return;
      const filter = btn.dataset.filter;

      if (filter === "all") {
        activeFilters = [];
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
      } else {
        // bascule du filtre
        if (activeFilters.includes(filter)) {
          activeFilters = activeFilters.filter(f => f !== filter);
          btn.classList.remove("active");
        } else {
          activeFilters.push(filter);
          btn.classList.add("active");
          if (allBtn) allBtn.classList.remove("active");
        }
      }

      if (activeFilters.length === 0 && allBtn) {
        buttons.forEach(b => b.classList.remove("active"));
        allBtn.classList.add("active");
      }

      applyFilters();
    });
  } else {
  }

  applyFilters();
});


