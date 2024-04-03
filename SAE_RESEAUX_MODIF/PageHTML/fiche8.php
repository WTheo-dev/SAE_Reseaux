<?php
include_once "fiche_base.php";
$numpage=8;
include_once "fiche_head.php";
include_once "enregistrer_materiaux.php";
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
        echoMateriaux($i);
    }
    ?>
    </div>
    <div id="mat_gauche">
    <?php
    for ($i=0; $i<5; $i++) {
        echoMateriaux($i+5);
    }
    ?>
    </div>
    </div>

    <?php
    $end="true";
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>

<script>
    function enregistrerMateriau(selection, numero) {
        var materiau = selection.value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "enregistrer_materiaux.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Matériau enregistré avec succès !");
            }
        };
        xhr.send("materiau=" + encodeURIComponent(materiau) + "&numero=" + numero);
    }
    
    var selects = document.querySelectorAll("select");
    selects.forEach(function(select, index) {
        select.addEventListener("change", function() {
            enregistrerMateriau(this, index);
        });
    });
</script>

