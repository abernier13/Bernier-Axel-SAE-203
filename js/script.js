/*// Définissez l'album spécifique que vous souhaitez afficher
let albumSpecifique = "Album1";
let listesong = "";

// Vérifiez si l'album spécifique existe dans l'objet musique
if (musique[albumSpecifique]) {
    // Itérer sur les chansons de l'album spécifique
    Object.keys(musique[albumSpecifique]['song1']).forEach(function (titre) {
        // Créez une div séparée pour chaque chanson avec un lien cliquable
        listesong += `<div class="div-song">
            <a href='https://open.spotify.com/intl-fr/artist/3AA28KZvwAUcZuOKwyblJQ' class='lien' target='_blank'>
                ${titre} : ${musique[albumSpecifique]['song1'][titre].join(', ')}
            </a>
        </div>`;
    });

    let liste = musique[albumSpecifique].style ? musique[albumSpecifique].style.join(', ') : ''; // Si `style` est un tableau

    console.log(albumSpecifique);
    document.querySelector("main").innerHTML += `
        <div class="song">
        <div class="div-album">
            <a href='https://open.spotify.com/intl-fr/artist/3AA28KZvwAUcZuOKwyblJQ' class='link-album' target='_blank'>${albumSpecifique}: Gorillaz</a>
            </div>
            <div class="listesong">${listesong}</div>
            <div class="style">Style: ${liste}</div>
        </div>
    `;
} else {
    console.log("L'album spécifié n'existe pas dans l'objet musique.");
}




// Initialisation de l'album spécifique à afficher
let albumSpecifique = "Album1";
let listesong = "";

// Vérifi si l'album spécifique existe dans l'objet musique
if (musique[albumSpecifique]) {
    Object.keys(musique[albumSpecifique]['song1']).forEach(function (titre) {
        // Création d'une div séparée pour chaque chanson avec un lien cliquable et un lecteur audio
        const song = musique[albumSpecifique]['song1'][titre][0];
        listesong += `<div class="div-song">
            <a href='${song.spotifyUrl}' class='lien' target='_blank'>
                ${titre} : ${song.name}
            </a>
            <audio controls>
                <source src='${song.audioUrl}' type='audio/mpeg'>
                Votre navigateur ne supporte pas la lecture audio.
            </audio>
        </div>`;
    });

    let liste = musique[albumSpecifique].style ? musique[albumSpecifique].style.join(', ') : ''; // Si `style` est un tableau

    console.log(albumSpecifique);
    document.querySelector("main").innerHTML += `
        <div class="song">
        <div class="div-album">
            <a href='https://open.spotify.com/intl-fr/album/4tUxQkrduOE8sfgwJ5BI2F' class='link-album' target='_blank'>${albumSpecifique}: Gorillaz</a>
            </div>
            <div class="listesong">${listesong}</div>
            <div class="style">Style: ${liste}</div>
        </div>
    `;
} else {
    console.log("L'album spécifié n'existe pas dans l'objet musique.");
}
*/
