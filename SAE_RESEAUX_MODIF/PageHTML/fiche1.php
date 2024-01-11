<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche1-1.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>
<body>
 <?php include_once("fiche_base.php"); ?>

    <audio id="nomInterv">
        <source src="audio/NomIntervenant.mp3" type="audio/mp3">
    </audio>
    <audio id="prenomInterv">
        <source src="audio/PrenomIntervenant.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->
<?php ifform() ?>
    <!-- Informations sur l'intervenant -->
    <div class="block bordure">
    <header class="header_page_postco_superadmin">
            <div class="header_text"><img class="logo_page_postco_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_postcoeleve">Nom Prénom de l'admin</h2>
            </div>
        </header>
    <p class="texte-page1">Intervenant</p>

    <div class="jsp">
    <?php addIcon("NomIntervenant", "fa-user"); ?>
    <?php addTexte("nomIntervenant", "Nom de l'intervenant") ?>
    <input type="text" name="nomIntervenant" value="<?php if (isset($_COOKIE['nomIntervenant'])){ echo $_COOKIE['nomIntervenant']; } ?>">
    <?php addAudio("NomIntervenant", "nomInterv"); ?>
    </div>

    <div class="jsp">
    <?php addIcon("PrenomIntervenant", "fa-address-card"); ?>
    <?php addTexte("prenomIntervenant", "Prénom de l'intervenant") ?>
    <input type="text" name="prenomIntervenant" value="<?php if (isset($_COOKIE['prenomIntervenant'])) { echo $_COOKIE['prenomIntervenant']; } ?>">
    <?php addAudio("PrenomIntervenant", "prenomInterv"); ?>
    </div>

    </div>

    <?php 
    $numpage=1;
    $begin="true";
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>