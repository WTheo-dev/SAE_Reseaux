document.addEventListener("DOMContentLoaded", function() {
    let recognition;

    function initRecognition() {
        if ('webkitSpeechRecognition' in window) {
            recognition = new webkitSpeechRecognition();
        } else if ('SpeechRecognition' in window) {
            recognition = new SpeechRecognition();
        } else {
            alert("La reconnaissance vocale n'est pas prise en charge par votre navigateur.");
            return;
        }

        recognition.lang = 'fr-FR';

        recognition.onresult = function(event) {
            const evaluationTextarea = document.getElementById('evaluation');
            evaluationTextarea.value = event.results[0][0].transcript;
        };
    }

    function startRecording() {
        if (!recognition) {
            initRecognition();
        }
        recognition.start();
        alert("Enregistrement vocal en cours...");
    }

    function stopRecording() {
        if (recognition) {
            recognition.stop();
            alert("Enregistrement vocal arrêté.");
        }
    }

    function reecouterEvaluation() {
        const evaluationTextarea = document.getElementById('evaluation');
        const evaluation = evaluationTextarea.value;

        if (evaluation.trim() !== '') {
            // Code pour réécouter l'évaluation
            alert("Réécoute de l'évaluation : " + evaluation);
        } else {
            alert("Aucune évaluation à réécouter.");
        }
    }

    function supprimerEvaluation() {
        const evaluationTextarea = document.getElementById('evaluation');
        evaluationTextarea.value = '';
        alert("Évaluation supprimée avec succès!");
    }

    // Événements des boutons
    document.getElementById('startRecordingBtn').addEventListener('click', startRecording);
    document.getElementById('stopRecordingBtn').addEventListener('click', stopRecording);
    document.getElementById('reecouterBtn').addEventListener('click', reecouterEvaluation);
    document.getElementById('supprimerBtn').addEventListener('click', supprimerEvaluation);
});
