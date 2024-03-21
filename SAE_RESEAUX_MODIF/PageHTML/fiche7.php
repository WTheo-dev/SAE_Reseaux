<?php include_once "fiche_base.php"; ?>
<?php $numpage=7; ?>
<?php include_once "fiche_head.php"; ?>
<?php
define("NEED_NEW_INTERVENTION", "Nécessite_une_nouvelle_intervention");
?>
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
    <style>
        p, label, span, input, .fa{
            font-size:<?php echo matchFontSize(); ?> !important;
        }
        {
            font-family:<?php echo getFontName(); ?>;
        }
    </style>
</head>
<body class="body_fiche">

<?php include_once "../../APIFinale/fonctions.php"; ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $travaux_non_realises = $_POST["TravauxNonRealises"];
    }
    ?>

    <audio id="nuni">
        <source src="audio/NécessiteUneNouvelleIntervention.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>



<?php ifform() ?>

    <div class="block" style="height:85%;">
    <p class="text-fiche7">Travaux non réalisés</p>
    <div class="label-fiche7">
    <textarea id="travauxNonRealises" name="travauxNonRealises" rows="10">
        <?php if (isset($_COOKIE['travauxNonRealises'])) { echo $_COOKIE['travauxNonRealises']; } ?></textarea>
    </div>
    </div>
    <input type="checkbox" name="<?php echo NEED_NEW_INTERVENTION; ?>" id="<?php echo NEED_NEW_INTERVENTION; ?>"
    <?php if (isset($_COOKIE[NEED_NEW_INTERVENTION])) {echo "checked";} ?> />
    <label for="<?php echo NEED_NEW_INTERVENTION; ?>">
    <?php addIcon(NEED_NEW_INTERVENTION, "fa-refresh"); ?>
    <?php addTexteBox(NEED_NEW_INTERVENTION, "Nécessite un nouvelle intervention"); ?>
    </label>
    <?php addAudio(NEED_NEW_INTERVENTION, "nuni"); ?>

    <?php
    $numpage=7;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>

