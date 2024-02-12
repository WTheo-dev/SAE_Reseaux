<?php include_once "fiche_base.php"; ?>
<?php $numpage=4; ?>
<?php include_once "fiche_head.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche4.css">
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

    <audio id="amel">
        <source src="audio/Améliorative.mp3" type="audio/mp3">
    </audio>
    <audio id="prev">
        <source src="audio/Préventive.mp3" type="audio/mp3">
    </audio>
    <audio id="corr">
        <source src="audio/Corrective.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->
<?php ifform() ?>

    <div class="block bordure">
    <p class="p-fiche4">Type de maintenance</p>

    <div class="jsp">
    <input class="check-amel" type="checkbox" name="Améliorative" id="Améliorative" <?php if(isset($_COOKIE['Améliorative'])) echo "checked"; ?> />
    <label for="Améliorative">
        <?php addTexteBox("Améliorative", "Améliorative"); ?>
        <?php addIcon("Améliorative", "fa-arrow-circle-up","amel-icon"); ?>
    </label>
    <?php addAudio("Améliorative", "amel"); ?>
    </div>

    <div class="jsp">
    <input class="check-amel" type="checkbox" name="Préventive" id="Préventive" <?php if(isset($_COOKIE['Préventive'])) echo "checked"; ?> />
    <label for="Préventive">
    <?php addTexteBox("Préventive", "Préventive"); ?>
    <?php addIcon("Préventive", "fa-eye"); ?>
    </label>
    <?php addAudio("Préventive", "prev"); ?>
    </div>
    <div class="jsp">
    <input class="check-amel" type="checkbox" name="Corrective" id="Corrective" <?php if(isset($_COOKIE['Corrective'])) echo "checked"; ?> />
    <label for="Corrective">
    <?php addTexteBox("Corrective", "Corrective"); ?>
    <?php addIcon("Corrective", "fa-pencil-square-o"); ?>
    </label>
    <?php addAudio("Corrective", "corr"); ?>
    </div>

    </div>

    <?php
    $numpage=4;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
