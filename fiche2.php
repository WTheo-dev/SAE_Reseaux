<?php include("fiche_head.php") ?>

    <?php include_once("fiche_base.php"); ?>

    <audio id="nomDem">
        <source src="audio/NomDemandeur.mp3" type="audio/mp3">
    </audio>
    <audio id="dateDem">
        <source src="audio/DateDemande.mp3" type="audio/mp3">
    </audio>
    <audio id="local">
        <source src="audio/Localisation.mp3" type="audio/mp3">
    </audio>
    <audio id="descDem">
        <source src="audio/DescriptionDemande.mp3" type="audio/mp3">
    </audio>
    <audio id="degre">
        <source src="audio/DegréUrgence.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->
<?php ifform() ?>
    <!-- Informations sur la demande -->
    <div class="block bordure">
    <p>Demande</p>

    <div class="jsp">
    <?php addIcon("NomDemandeur", "fa-user"); ?>
    <?php addTexte("nomDemandeur", "Nom du demandeur") ?>
    <input disabled type="text" id="nomDemandeur" value="<?php echo $_COOKIE['nomDemandeur'] ?>">
    <?php addAudio("NomDemandeur", "nomDem"); ?>
    </div>

    <br>
    
    <div class="jsp">
    <?php addIcon("DateDemande", "fa-calendar-o"); ?>
    <?php addTexte("dateDemande", "Date de la demande") ?>
    <input disabled type="date" id="dateDemande" value="<?php echo $_COOKIE['dateDemande'] ?>">
    <?php addAudio("DateDemande", "dateDem"); ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php addIcon("Localisation", "fa-map-marker"); ?>
    <?php addTexte("localisation", "Localisation") ?>
    <input disabled type="text" id="localisation" value="<?php echo $_COOKIE['localisation'] ?>">
    <?php addAudio("Localisation", "local"); ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php addIcon("descDemande", "fa-info-circle"); ?>
    <?php addTexte("descDemande", "Description de la demande") ?>
    <?php addAudio("descDemande", "descDem"); ?>
    <br><textarea disabled id="descDemande" rows="4"><?php echo $_COOKIE['descDemande'] ?></textarea>
    </div>

    <br>

    <div class="jsp">
    <?php addIcon("DegreeUrgence", "fa-exclamation-triangle"); ?>
    <?php addTexte("degreeUrgence", "Degré d'urgence") ?>
    <input disabled type="text" id="degreeUrgence" value="<?php echo $_COOKIE['degreeUrgence'] ?>">
    <?php addAudio("degreeUrgence", "degre"); ?>
    </div>

    </div>

    <?php
    $numpage=2;
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>

<?php include("fiche_foot.php") ?>