function videoduration() {
    const videoElement = document.getElementById('player');
    const logoContainer = document.querySelector('.logostart');
    
    // 1. Faire disparaître en douceur
    logoContainer.style.opacity = '0';
    logoContainer.style.transition = 'opacity 0.5s ease-out';
    
    // 2. Supprimer définitivement après la transition
    setTimeout(() => {
        logoContainer.remove(); // <- Suppression totale du DOM
    }, 500);
    
    // 3. Lancer la vidéo
    videoElement.play();
    
    // 4. Gérer la fin de la vidéo
    videoElement.addEventListener('click', () => {
        videoElement.pause();
        document.querySelector('.backvideo').style.display = 'none';
        sessionStorage.setItem('videoAlreadyPlayed', 'true');
    });
    
    // 5. Fin automatique après 13s
    setTimeout(() => {
        videoElement.pause();
        document.querySelector('.backvideo').style.display = 'none';
        sessionStorage.setItem('videoAlreadyPlayed', 'true');
    }, 13000);
}