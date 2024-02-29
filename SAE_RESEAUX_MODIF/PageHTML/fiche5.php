<?php include_once "fiche_base.php"; ?>
<?php $numpage=5; ?>
<?php include_once "fiche_head.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche5.css">
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

    <audio id="amen">
        <source src="audio/Aménagement.mp3" type="audio/mp3">
    </audio>
    <audio id="fini">
        <source src="audio/Finitions.mp3" type="audio/mp3">
    </audio>
    <audio id="inst_elec">
        <source src="audio/InstallationElectrique.mp3" type="audio/mp3">
    </audio>
    <audio id="inst_sani">
        <source src="audio/InstallationSanitaire.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->
<?php ifform() ?>

    <div class="block bordure">
    <p class="text-fiche5">Nature de l'intervention</p>

    <div class="jsp">
    <input type="checkbox" name="Aménagement"
    id="Aménagement" <?php if(isset($_COOKIE['Aménagement'])) {echo "checked";} ?> />
    <label for="Aménagement">
    <?php addIcon("Aménagement", "fa-building"); ?>
    <?php addTexteBox("Aménagement", "Aménagement"); ?>
    </label>
    <?php addAudio("Aménagement", "amen"); ?>
    </div>

    <div class="jsp">
    <input type="checkbox" name="Finitions" id="Aménagement"
     <?php if(isset($_COOKIE['Finitions'])) {echo "checked";}?> />
    <label for="Finitions">
    <?php addIcon("Finitions", "fa-magic"); ?>
    <?php addTexteBox("Finitions", "Finitions"); ?>
    </label>
    <?php addAudio("Finitions", "fini"); ?>
    </div>
    
    <div class="jsp">
    <input type="checkbox" name="Installation_sanitaire"
    id="Aménagement" <?php if(isset($_COOKIE['Installation_sanitaire'])) {echo "checked";} ?> />
    <label for="Installation_sanitaire">
    <?php addIcon("Installation_sanitaire", "fa-bath"); ?>
    <?php addTexteBox("Installation_sanitaire", "Installation sanitaire"); ?>
    </label>
    <?php addAudio("Installation_sanitaire", "inst_sani"); ?>
    </div>

    <div class="jsp">
    <input type="checkbox" name="Installation_électrique"
    id="Aménagement" <?php if(isset($_COOKIE['Installation_électrique'])) {echo "checked";} ?> />
    <label for="Installation_électrique">
    <?php addIcon("Installation_électrique", "fa-bolt"); ?>
    <?php addTexteBox("Installation_électrique", "Installation électrique"); ?>
    </label>
    <?php addAudio("Installation_électrique", "inst_elec"); ?>
    </div>
    
    </div>

    <?php
    $numpage=5;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
