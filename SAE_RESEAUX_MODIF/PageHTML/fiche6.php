<?php include_once "fiche_base.php"; ?>
<?php $numpage=6; ?>
<?php include_once "fiche_head.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche6.css">
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
        $travaux_realises = $_POST["TravauxRealises"];
    }
    ?>

<?php ifform() ?>

    <div class="block">
    <p class="text-fiche6">Travaux réalisés</p>
    <textarea id="travauxRealises" name="travauxRealises" rows="10">
        <?php if (isset($_COOKIE['travauxRealises'])) { echo $_COOKIE['travauxRealises']; } ?></textarea>
    </div>

    <?php
    $numpage=6;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
