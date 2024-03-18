<?php include_once "fiche_base.php"; ?>
<?php $numpage=5; ?>
<?php include_once "fiche_head.php"; ?>
<?php
define("TYPE_AMENAGEMENT", "Aménagement");
define("TYPE_FINITIONS", "Finitions");
define("TYPE_SANITAIRE", "Installation_sanitaire");
define("TYPE_ELECTRIQUE", "Installation_électrique");
?>
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

<?php include_once "../../APIFinale/fonctions.php"; ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nature_intervention = $_POST["NatureIntervention"];
    }
    ?>

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


    <?php ifform() ?>

    <div class="block bordure">
    <p class="text-fiche5">Nature de l'intervention</p>

    <div class="jsp">
    <input type="checkbox" name="<?php echo TYPE_AMENAGEMENT; ?>"
    id="<?php echo TYPE_AMENAGEMENT; ?>" <?php if (isset($_COOKIE[TYPE_AMENAGEMENT])) {echo "checked";} ?> />
    <label for="<?php echo TYPE_AMENAGEMENT; ?>">
    <?php addIcon(TYPE_AMENAGEMENT, "fa-building"); ?>
    <?php addTexteBox(TYPE_AMENAGEMENT, TYPE_AMENAGEMENT); ?>
    </label>
    <?php addAudio(TYPE_AMENAGEMENT, "amen"); ?>
</div>

<div class="jsp">
    <input type="checkbox" name="<?php echo TYPE_FINITIONS; ?>"
    id="<?php echo TYPE_FINITIONS; ?>" <?php if (isset($_COOKIE[TYPE_FINITIONS])) {echo "checked";} ?> />
    <label for="<?php echo TYPE_FINITIONS; ?>">
    <?php addIcon(TYPE_FINITIONS, "fa-magic"); ?>
    <?php addTexteBox(TYPE_FINITIONS, TYPE_FINITIONS); ?>
    </label>
    <?php addAudio(TYPE_FINITIONS, "fini"); ?>
</div>
    
<div class="jsp">
    <input type="checkbox" name="<?php echo TYPE_SANITAIRE; ?>"
    id="<?php echo TYPE_SANITAIRE; ?>" <?php if (isset($_COOKIE[TYPE_SANITAIRE])) {echo "checked";} ?> />
    <label for="<?php echo TYPE_SANITAIRE; ?>">
    <?php addIcon(TYPE_SANITAIRE, "fa-bath"); ?>
    <?php addTexteBox(TYPE_SANITAIRE, "Installation sanitaire"); ?>
    </label>
    <?php addAudio(TYPE_SANITAIRE, "inst_sani"); ?>
</div>

<div class="jsp">
    <input type="checkbox" name="<?php echo TYPE_ELECTRIQUE; ?>"
    id="<?php echo TYPE_ELECTRIQUE; ?>" <?php if (isset($_COOKIE[TYPE_ELECTRIQUE])) {echo "checked";} ?> />
    <label for="<?php echo TYPE_ELECTRIQUE; ?>">
    <?php addIcon(TYPE_ELECTRIQUE, "fa-bolt"); ?>
    <?php addTexteBox(TYPE_ELECTRIQUE, "Installation électrique"); ?>
    </label>
    <?php addAudio(TYPE_ELECTRIQUE, "inst_elec"); ?>
</div>
    
    </div>

    <?php
    $numpage=5;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
