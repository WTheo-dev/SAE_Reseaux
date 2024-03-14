<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="ficheens.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>
<body>

<h1>Cookie</h1>

<?php
foreach ($_COOKIE as $param => $value){
    echo $param.' : '.$value.'<br>';
}
?>

<audio id="myAudio">
    <source src="audio/NomIntervenant.mp3" type="audio/mp3">
</audio>
<button class="audiobutton" onclick="toggleAudio()"><i class="fa fa-volume-up" aria-hidden="true"></i>sound</button>
<script>
    var audio = document.getElementById("myAudio");
    function toggleAudio() {
        if (audio.paused) {
                audio.play();
        } else {
            audio.pause();
        }
    }
</script>

</body>
</html>

