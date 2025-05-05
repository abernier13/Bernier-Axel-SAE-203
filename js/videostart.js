function videoduration() {
  // Cette animation ne se joue qu'une seule fois par session grâce à la propriété 'sessionStorage'.
  const videoElement = document.getElementById('player');
  const backVideo = document.querySelector('.backvideo');
  const clickableLogo = document.getElementById('logstart');

  // 1. Faire disparaître immédiatement le logo cliquable
  clickableLogo.style.opacity = '0';
  clickableLogo.style.transition = 'opacity 0.3s ease-out';

  // 2. Préparer et lancer la vidéo
  videoElement.classList.add('visible');
  videoElement.removeAttribute('controls');
  videoElement.play();

  // 3. Gestion du clic sur la vidéo (disparition immédiate + redirection)
  videoElement.addEventListener('click', () => {
    // Arrêter la vidéo immédiatement
    videoElement.pause();
    // Faire disparaître instantanément tous les éléments
    backVideo.style.display = 'none';
    sessionStorage.setItem('videoAlreadyPlayed', 'true'); // Marquer comme vue
  });

  // 4. Fin de la vidéo (après 12s)
  setTimeout(() => {
    videoElement.pause();
    videoElement.style.opacity = '0';
    backVideo.style.opacity = '0';
    backVideo.style.transition = 'opacity 0.3s ease-out';
    backVideo.style.display = 'none'; 
      // Stocker dans sessionStorage que la vidéo a été jouée
      sessionStorage.setItem('videoAlreadyPlayed', 'true');
  }, 13000);
}
