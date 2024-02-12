<?php include_once "fiche_base.php"; ?>
<?php $numpage=3; ?>
<?php include_once "fiche_head.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche3.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <style>
        p, label, span, input, .fa{
            font-size:<?php echo matchFontSize(); ?> !important;
        }
        *{
            font-family:<?php echo getFontName(); ?>;
        }
    </style>
</head>
<body class="body_fiche">
    

    <?php include_once "fiche_base.php"; ?>

    <audio id="dateInt">
        <source src="audio/DateIntervention.mp3" type="audio/mp3">
    </audio>
    <audio id="dureeint">
        <source src="audio/DuréeOpération.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->
<?php ifform() ?>
    <!-- Informations sur l'intervention -->
    <div class="block bordure">
    <p class="p-fiche3">INTERVENTION</p>

    <div class="jsp">
    <?php addIcon("dateIntervention", "fa-calendar-o"); ?>
    <?php addTexte("dateIntervention", "Date d'intervention:") ?>
    <input type="date" id="dateIntervention" name="dateIntervention" value="<?php if (isset($_COOKIE['dateIntervention'])) { echo $_COOKIE['dateIntervention']; } ?>">
    <?php addAudio("dateIntervention", "dateInt"); ?>
    </div>

    <div class="jsp">
    <?php addIcon("dureeIntervention", "fa-clock-o"); ?>
    <?php addTexte("dureeIntervention", "Durée de l'opération:") ?>
    <select class="duree-select" id="dureeIntervention" name="dureeIntervention">
    <?php if(isset($_COOKIE['dureeIntervention'])): ?>
    <br><option><?php echo $_COOKIE['dureeIntervention']; ?></option>
    <?php else: ?>
    <br><option>-- Choisir une durée --</option>
    <?php endif; ?>
    <br><option>00H15</option>
    <br><option>00H30</option>
    <br><option>00H45</option>
    <br><option>01H00</option>
    <br><option>01H15</option>
    <br><option>01H30</option>
    <br><option>01H45</option>
    <br><option>02H00</option>
    <br><option>02H15</option>
    <br><option>02H30</option>
    <br><option>02H45</option>
    <br><option>03H00</option>
    <br><option>03H15</option>
    <br><option>03H30</option>
    <br><option>03H45</option>
    <br><option>04H00</option>
    <br></select>
    <?php addAudio("dureeIntervention", "dureeint"); ?>
    </div>

    </div>

    <?php
    $numpage=3;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>