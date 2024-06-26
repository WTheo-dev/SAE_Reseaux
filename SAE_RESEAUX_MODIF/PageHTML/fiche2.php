<?php include_once "fiche_base.php"; ?>
<?php $numpage=2; ?>
<?php include_once "fiche_head.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche2.css">
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
<?php include_once "../../APIFinale/fonctions.php"; ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom_du_demandeur = $_POST["NomDemandeur"];
        $date_demande = $_POST["DateDemande"];
        $localisation = $_POST["Localisation"];
        $description_demande = $_POST["DescriptionDemande"];
        $degre_urgence = $_POST["DegréUrgence"];
    }
    ?>

    <audio id="nomDem">
        <source src="audio/NomDemandeur.mp3" type="audio/mp3">
    </audio>
    <audio id="dateDem">
        <source src="audio/DateDemande.mp3" type="audio/mp3">
    </audio>
    <audio id="local">
        <source src="audio/Localisation.mp3" type="audio/mp3">
    </audio>
    <audio id="descDem">
        <source src="audio/DescriptionDemande.mp3" type="audio/mp3">
    </audio>
    <audio id="degre">
        <source src="audio/DegréUrgence.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>


<?php ifform() ?>

    <div class="block bordure">
    <p class="texte-page2">Demande</p>

     <div class="jsp">
    <div class="icon-page2">
    <?php addIcon("NomDemandeur", "fa-user"); ?>
    <?php addAudio("NomDemandeur", "nomDem"); ?>
</div>
<?php addTexte("nomDemandeur", "Nom du demandeur") ?>
<input disabled type="text" id="nomDemandeur" value=
"<?php if (isset($_COOKIE['nomDemandeur'])) { echo $_COOKIE['nomDemandeur']; } ?>">
    </div>

    <br>
    
    <div class="jsp">
    <div class="icon-page2">
    <?php addIcon("DateDemande", "fa-calendar-o"); ?>
    <?php addAudio("DateDemande", "dateDem"); ?>
</div>
<?php addTexte("dateDemande", "Date de la demande") ?>
<input disabled type="date" id="dateDemande"
value="<?php if (isset($_COOKIE['dateDemande'])) { echo $_COOKIE['dateDemande']; } ?>">
  
    <br>
<div class="jsp">
    <div class="icon-page2">
    <?php addIcon("Localisation", "fa-map-marker"); ?>
    <?php addAudio("Localisation", "local"); ?>
</div>
<?php addTexte("localisation", "Localisation") ?>
<input disabled type="text" id="localisation"
value="<?php if (isset($_COOKIE['localisation'])) { echo $_COOKIE['localisation']; } ?>">
</div>
<br>
    <div class="jsp">
    <div class="icon-page2">
    <?php addIcon("descDemande", "fa-info-circle"); ?>
    <?php addAudio("descDemande", "descDem"); ?>
    </div>
    <?php addTexte("descDemande", "Description de la demande") ?>
    <br>
    <textarea disabled id="descDemande" rows="4"><?php
        if (isset($_COOKIE['descDemande'])) {
             echo $_COOKIE['descDemande'];
    }
?></textarea>
    </div>

    <br>

    <div class="jsp">
    <div class="icon-page2">

    <?php addIcon("DegreeUrgence", "fa-exclamation-triangle"); ?>
    <?php addAudio("degreeUrgence", "degre"); ?>
</div>
<?php addTexte("degreeUrgence", "Degré d'urgence") ?>
<input disabled type="text" id="degreeUrgence"
value="<?php if (isset($_COOKIE['degreeUrgence'])) { echo $_COOKIE['degreeUrgence']; } ?>">

    </div>
    </div>


    <?php
    $numpage=2;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
