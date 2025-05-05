 // Quand l'utilisateur ferme le site et revient plus tard, sessionStorage est réinitialisé donc l'animation se rejoue

 window.addEventListener('DOMContentLoaded', () => {
    const alreadyPlayed = sessionStorage.getItem('videoAlreadyPlayed') === 'true';
    const backVideo = document.querySelector('.backvideo');

    if (alreadyPlayed) {
      backVideo.style.display = 'none';
    }
  });
