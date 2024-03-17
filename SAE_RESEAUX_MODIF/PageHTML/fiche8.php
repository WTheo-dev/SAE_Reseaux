<?php
include_once "fiche_base.php";
$numpage=8;
include_once "fiche_head.php";
?>
<?php include_once "../../APIFinale/fonctions.php"; ?>
<body class="body_fiche">
    


<?php ifform() ?>

    <div class="block bordure" id="mat_util">
    <div class="text-page8">
    <p >Matériaux utilisés</p>
</div>
    <div id="mat_droit">
    <?php
    for ($i=0; $i<5; $i++) {
        afficherMateriaux($description_demande, $i);
    }
    ?>
    </div>
    <div id="mat_gauche">
    <?php
    for ($i=0; $i<5; $i++) {
        afficherMateriaux($description_demande, $i+5);
    }
    ?>
    </div>
    </div>

    <?php
    $end="true";
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
