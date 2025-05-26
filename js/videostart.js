function videoduration() {
    const videoElement = document.getElementById('player');
    const logoContainer = document.querySelector('.logostart');
    
    // Faire disparaître en douceur
    logoContainer.style.opacity = '0';
    logoContainer.style.transition = 'opacity 0.5s ease-out';
    
    // Supprimer définitivement après la transition
    setTimeout(() => {
        logoContainer.remove(); // <- Suppression totale du DOM
    }, 500);
    
    // Lancer la vidéo
    videoElement.play();
    
    // Gérer la fin de la vidéo
    videoElement.addEventListener('click', () => {
        videoElement.pause();
        document.querySelector('.backvideo').style.display = 'none';
        sessionStorage.setItem('videoAlreadyPlayed', 'true');
    });
    
    // Fin automatique après 13s
    setTimeout(() => {
        videoElement.pause();
        document.querySelector('.backvideo').style.display = 'none';
        sessionStorage.setItem('videoAlreadyPlayed', 'true');
    }, 13000);
}