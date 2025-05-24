// Ajoute les écouteurs d'événements sur tous les <select>
document.querySelectorAll("select").forEach(select => {
  select.addEventListener("change", filtreAlbums);
});

function filtreAlbums() {
  const annee = document.getElementById("filtre-annee").value;
  const style = document.getElementById("filtre-style").value;
  const ambiance = document.getElementById("filtre-ambiance").value;

  document.querySelectorAll(".info .contain").forEach(album => {
    const hasAnnee = !annee || album.classList.contains(annee);
    const hasStyle = !style || album.classList.contains(style);
    const hasAmbiance = !ambiance || album.classList.contains(ambiance);

    if (hasAnnee && hasStyle && hasAmbiance) {
      album.classList.add("show");
    } else {
      album.classList.remove("show");
    }
  });
}

// Réinitialise les filtres et affiche tout au chargement de la page
window.addEventListener("DOMContentLoaded", () => {
  // Réinitialise les sélecteurs
  document.getElementById("filtre-annee").value = "";
  document.getElementById("filtre-style").value = "";
  document.getElementById("filtre-ambiance").value = "";
  
  // Affiche tous les albums
  document.querySelectorAll(".info .contain").forEach(album => album.classList.add("show"));
});