document.addEventListener("DOMContentLoaded", () => {
  const notif = document.getElementById("notif");
  if (notif) {
    const msg = notif.dataset.message;

    // Crée une popup style toast
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = msg;
    document.body.appendChild(toast);

    setTimeout(() => toast.classList.add("show"), 100);
    setTimeout(() => toast.classList.remove("show"), 4000);
    setTimeout(() => toast.remove(), 4500);
  }
});