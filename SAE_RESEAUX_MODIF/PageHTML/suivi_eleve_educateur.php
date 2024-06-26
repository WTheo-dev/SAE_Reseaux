<?php
  session_start();
  include_once "../../APIFinale/fonctions.php";
  
  if (!isset($_SESSION['personnel'])) {
    header('Location: index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="suivi_eleve_educateur.css">
    <title>Évaluation des fiches</title>
</head>

<body class="body_page_suivi_eleve_educateur">
        <header class="header_page_suivi_eleve_educateur">
            <div class="header_text"><img class="logo_page_suivi_eleve_educateur"
            src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_postcoeleve"><?php echo $_SESSION['personnel']; ?></h2>
            </div>
        </header>

    <h1 class="h1_eval_fiches_suivi_eleve_educateur">Évaluation des fiches</h1>

    <label for="ficheDropdown" id="ficheLabel">Fiche:</label>
    <select id="ficheDropdown">
        <option value="fiche1">Fiche 1</option>
        <option value="fiche2">Fiche 2</option>
    </select>

    <button id="recordButton" onclick="startRecording()">Enregistrer</button>
    <button id="stopButton" onclick="stopRecording()" disabled>Arrêter</button>
    <button id="playButton" onclick="playRecording()" disabled>Écouter</button>
    <button id="deleteButton" onclick="deleteRecording()" disabled>Supprimer</button>
    <button id="saveButton" onclick="saveRecording()">Valider et sauvegarder</button>
    
    <audio id="audioPlayer" controls></audio>

    <br>
    <button type="button" onclick="window.location.href = 'page_postco_admin.php';">retour</button>

    <script>

        const audioPlayer = document.getElementById('audioPlayer');
        const ficheDropdown = document.getElementById('ficheDropdown');
        const saveButton = document.getElementById('saveButton');

        function saveRecording() {
            const recordingData = {
                audioSrc: audioPlayer.src,
                selectedFiche: ficheDropdown.value
            };

            localStorage.setItem('savedRecording', JSON.stringify(recordingData));
            alert('Enregistrement sauvegardé avec succès!');
        }

        function restoreRecording() {
            const savedRecording = localStorage.getItem('savedRecording');
            if (savedRecording) {
                const recordingData = JSON.parse(savedRecording);
                audioPlayer.src = recordingData.audioSrc;
                ficheDropdown.value = recordingData.selectedFiche;
                enableControls();
            }
        }

        function enableControls() {
            document.getElementById('playButton').disabled = false;
            document.getElementById('deleteButton').disabled = false;
        }

        function playRecording() {
            audioPlayer.play();
        }

        function deleteRecording() {
            audioPlayer.src = '';
            document.getElementById('playButton').disabled = true;
            document.getElementById('deleteButton').disabled = true;
            localStorage.removeItem('savedRecording');
        }

        window.onload = function () {
            restoreRecording();
        };

        let mediaRecorder;
        let recordedChunks = [];

        const recordButton = document.getElementById('recordButton');
        const stopButton = document.getElementById('stopButton');
        const playButton = document.getElementById('playButton');
        const deleteButton = document.getElementById('deleteButton');

        recordButton.addEventListener('click', startRecording);
        stopButton.addEventListener('click', stopRecording);
        playButton.addEventListener('click', playRecording);
        deleteButton.addEventListener('click', deleteRecording);

        async function startRecording() {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = event => {
                if (event.data.size > 0) {
                    recordedChunks.push(event.data);
                }
            };

            mediaRecorder.onstop = () => {
                const blob = new Blob(recordedChunks, { type: 'audio/wav' });
                const url = URL.createObjectURL(blob);
                audioPlayer.src = url;
                playButton.disabled = false;
                deleteButton.disabled = false;
            };

            recordedChunks = [];
            mediaRecorder.start();
            recordButton.disabled = true;
            stopButton.disabled = false;
        }

        function stopRecording() {
            mediaRecorder.stop();
            recordButton.disabled = false;
            stopButton.disabled = true;
        }

        function playRecording() {
            audioPlayer.play();
        }

        function deleteRecording() {
            audioPlayer.src = '';
            playButton.disabled = true;
            deleteButton.disabled = true;
        }
    </script>
</body>
</html>
