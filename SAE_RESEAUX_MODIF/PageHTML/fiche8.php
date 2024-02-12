<?php include_once "fiche_base.php"; ?>
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
    <header class="header_fiche">
            <div class="header_text"><img class="logo_page_postco_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_postcoeleve">Nom Prénom de l'admin</h2>
            </div>
        </header>
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
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
