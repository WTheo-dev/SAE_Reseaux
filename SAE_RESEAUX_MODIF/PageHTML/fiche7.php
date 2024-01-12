<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche7.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <header class="header_fiche">
            <div class="header_text"><img class="logo_page_postco_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_postcoeleve">Nom Prénom de l'admin</h2>
            </div>
        </header>
</head>
<body class="body_fiche">

    <?php include_once("fiche_base.php"); ?>

    <audio id="nuni">
        <source src="audio/NécessiteUneNouvelleIntervention.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->

<?php ifform() ?>

    <div class="block" style="height:85%;">
    <p>Travaux non réalisés</p>
    <textarea id="travauxNonRealises" name="travauxNonRealises" rows="10"><?php if (isset($_COOKIE['travauxNonRealises'])) { echo $_COOKIE['travauxNonRealises']; } ?></textarea>
    </div>
    <input type="checkbox" name="Nécessite_un_nouvelle_intervention" id="Nécessite_un_nouvelle_intervention" <?php if(isset($_COOKIE['Nécessite_un_nouvelle_intervention'])) echo "checked"; ?> />
    <label for="Nécessite_un_nouvelle_intervention">
    <?php addIcon("Nécessite_un_nouvelle_intervention", "fa-refresh"); ?>
    <?php addTexteBox("Nécessite_un_nouvelle_intervention", "Nécessite un nouvelle intervention"); ?>
    </label>
    <?php addAudio("Nécessite_un_nouvelle_intervention", "nuni"); ?>

    <?php
    $numpage=7;
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>

