<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche8.css">
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

<!-- Formulaire -->
<?php ifform() ?>

    <div class="block bordure" id="mat_util">
    <p>Matériaux utilisés</p>
    <div id="mat_droit">
    <?php
    for ($i=0; $i<5; $i++){
        echoMateriaux($i);
    }
    ?>
    </div>
    <div id="mat_gauche">
    <?php
    for ($i=0; $i<5; $i++){
        echoMateriaux($i+5);
    }
    ?>
    </div>
    </div>

    <?php
    $numpage=8;
    $end="true";
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>
