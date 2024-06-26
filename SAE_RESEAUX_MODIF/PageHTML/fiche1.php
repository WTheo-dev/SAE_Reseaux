<?php include_once "fiche_base.php"; ?>
<?php $numpage=1; ?>
<?php include_once "fiche_head.php"; ?>
<?php include_once "../../APIFinale/fonctions.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomIntervenant = $_POST["nomIntervenant"];
    $prenomIntervenant = $_POST["prenomIntervenant"];
}
?>

<body class="body_fiche">

    <audio id="nomInterv">
        <source src="audio/NomIntervenant.mp3" type="audio/mp3">
    </audio>
    <audio id="prenomInterv">
        <source src="audio/PrenomIntervenant.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>


<?php ifform() ?>

    <div class="block bordure">
    <p class="texte-page1">Intervenant</p>
    
    <div class="jsp">
        <div class="audio-fiche-1">
        <?php addAudio("NomIntervenant", "nomInterv"); ?>
        </div>
    <?php addIcon("NomIntervenant", "fa-user"); ?>
    <?php addTexte("nomIntervenant", "Nom de l'intervenant") ?>
    <input type="text" name="nomIntervenant" value="<?php if
    (isset($_COOKIE['nomIntervenant'])) { echo $_COOKIE['nomIntervenant']; } ?>">
</div>
    <div class="jsp">
    <div class="audio-fiche-1">
        <?php addAudio("PrenomIntervenant", "prenomInterv"); ?>
        </div>
    <?php addIcon("PrenomIntervenant", "fa-address-card"); ?>
    <?php addTexte("prenomIntervenant", "Prénom de l'intervenant") ?>
    <input type="text" name="prenomIntervenant" value="<?php if
    (isset($_COOKIE['prenomIntervenant'])) { echo $_COOKIE['prenomIntervenant']; } ?>">
    </div>

    </div>

    <?php
    $numpage=1;
    $begin="true";
    include_once "fiche_button.php";
    ?>

<?php ifformfin() ?>
