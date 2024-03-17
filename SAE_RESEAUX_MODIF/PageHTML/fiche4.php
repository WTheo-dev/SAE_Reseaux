<?php include_once "fiche_base.php"; ?>
<?php $numpage=4; ?>
<?php include_once "fiche_head.php"; ?>

<?php
define("TYPE_MAINTENANCE", "Améliorative");
define("TYPE_PREVENTIVE", "Préventive");
define("TYPE_CORRECTIVE", "Corrective");
?>

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

<?php include_once "../../APIFinale/fonctions.php"; ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type_intervention = $_POST["TypeIntervention"];
    }
    ?>


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


<?php ifform() ?>

    <div class="block bordure">
    <p class="p-fiche4">Type de maintenance</p>

    <div class="jsp">
        <input class="check-amel" type="checkbox"
        name="<?php echo TYPE_MAINTENANCE; ?>"
        id="<?php echo TYPE_MAINTENANCE; ?>"
        <?php if (isset($_COOKIE[TYPE_MAINTENANCE])) {echo "checked";} ?> />
        <label for="<?php echo TYPE_MAINTENANCE; ?>">
            <?php addTexteBox(TYPE_MAINTENANCE, TYPE_MAINTENANCE); ?>
            <?php addIcon(TYPE_MAINTENANCE, "fa-arrow-circle-up", "amel-icon"); ?>
        </label>
        <?php addAudio(TYPE_MAINTENANCE, "amel"); ?>
    </div>

    <div class="jsp">
    <input class="check-amel" type="checkbox"
           name="<?php echo TYPE_PREVENTIVE; ?>"
           id="<?php echo TYPE_PREVENTIVE; ?>"
           <?php if (isset($_COOKIE[TYPE_PREVENTIVE])) {echo "checked";} ?> />
    <label for="<?php echo TYPE_PREVENTIVE; ?>">
        <?php addTexteBox(TYPE_PREVENTIVE, TYPE_PREVENTIVE); ?>
        <?php addIcon(TYPE_PREVENTIVE, "fa-eye"); ?>
    </label>
    <?php addAudio(TYPE_PREVENTIVE, "prev"); ?>
</div>

<div class="jsp">
    <input class="check-amel" type="checkbox"
           name="<?php echo TYPE_CORRECTIVE; ?>"
           id="<?php echo TYPE_CORRECTIVE; ?>"
           <?php if (isset($_COOKIE[TYPE_CORRECTIVE])) {echo "checked";} ?> />
    <label for="<?php echo TYPE_CORRECTIVE; ?>">
        <?php addTexteBox(TYPE_CORRECTIVE, TYPE_CORRECTIVE); ?>
        <?php addIcon(TYPE_CORRECTIVE, "fa-pencil-square-o"); ?>
    </label>
    <?php addAudio(TYPE_CORRECTIVE, "corr"); ?>
</div>

    </div>

    <?php
    $numpage=4;
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
