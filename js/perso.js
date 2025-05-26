// Liste des membres de Gorillaz
const membres = ['2d', 'murdoc', 'noodle', 'russel', 'damon'];
let membreActuel = 0; // On commence par le premier membre (2-D)


// Fonction pour afficher un membre spécifique
function afficherMembre(index) {
    // Cacher tous les membres
    document.querySelectorAll('.member-content').forEach(element => {
        element.classList.add('hidden');
    });
    
    // Afficher seulement le membre choisi
    document.getElementById(membres[index]).classList.remove('hidden');
    
    // Mettre à jour les onglets
    // Désactiver tous les onglets
    document.querySelectorAll('.member-tab').forEach(onglet => {
        onglet.classList.remove('active');
    });
    // Activer seulement l'onglet du membre affiché
    document.querySelector(`.member-tab[data-target="${membres[index]}"]`).classList.add('active');
    
    // Mettre à jour l'index du membre actuel
    membreActuel = index;
}


// Flèche précédente
document.getElementById('prev').addEventListener('click', function() {
    // revenir d'un membre
    membreActuel = (membreActuel - 1 + membres.length) % membres.length;
    afficherMembre(membreActuel);
});

// Flèche suivante
document.getElementById('next').addEventListener('click', function() {
    // avancer d'un membre 
    membreActuel = (membreActuel + 1) % membres.length;
    afficherMembre(membreActuel);
});


// Gestion des clics sur les onglets
document.querySelectorAll('.member-tab').forEach(onglet => {
    onglet.addEventListener('click', function() {
        // Trouve l'index du membre correspondant à l'onglet cliqué
        const indexMembre = membres.indexOf(this.dataset.target);
        afficherMembre(indexMembre);
    });
});