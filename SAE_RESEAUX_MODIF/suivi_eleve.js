let speeches = {};

function playText(commentId) {
    // Récupérer le texte du commentaire spécifique
    const commentText = document.getElementById(commentId).innerText;

    // Vérifier si une synthèse vocale est déjà en cours
    if (speeches[commentId]) {
        // Arrêter la synthèse vocale existante
        window.speechSynthesis.cancel();
    }

    // Utiliser l'API SpeechSynthesis pour la synthèse vocale
    speeches[commentId] = new SpeechSynthesisUtterance();
    speeches[commentId].text = commentText;

    // Lire le commentaire à voix haute
    window.speechSynthesis.speak(speeches[commentId]);

    // Afficher la transcription dans la zone dédiée
    speeches[commentId].onend = function() {
        document.getElementById('transcription').innerText = '';
    };
}

function pauseText() {
    // Mettre en pause ou reprendre la synthèse vocale
    if (!window.speechSynthesis.paused) {
        window.speechSynthesis.pause();
    } else {
        window.speechSynthesis.resume();
    }
}

function pauseComment(commentId) {
    // Mettre en pause ou reprendre la synthèse vocale du commentaire spécifique
    if (speeches[commentId]) {
        if (!speeches[commentId].paused) {
            speeches[commentId].pause();
        } else {
            speeches[commentId].resume();
        }
    }
}