<?php include("fiche_head.php") ?>

    <?php include_once("fiche_base.php"); ?>

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

<!-- Formulaire -->
<?php ifform() ?>

    <div class="block bordure">
    <p>Nature de l'intervention</p>

    <div class="jsp">
    <input type="checkbox" name="Aménagement" id="Aménagement" <?php if(isset($_COOKIE['Aménagement'])) echo "checked"; ?> />
    <label for="Aménagement">
    <?php addIcon("Aménagement", "fa-building"); ?>
    <?php addTexteBox("Aménagement", "Aménagement"); ?>
    </label>
    <?php addAudio("Aménagement", "amen"); ?>
    </div>

    <div class="jsp">
    <input type="checkbox" name="Finitions" id="Finitions" <?php if(isset($_COOKIE['Finitions'])) echo "checked"; ?> />
    <label for="Finitions">
    <?php addIcon("Finitions", "fa-magic"); ?>
    <?php addTexteBox("Finitions", "Finitions"); ?>
    </label>
    <?php addAudio("Finitions", "fini"); ?>
    </div>
    
    <div class="jsp">
    <input type="checkbox" name="Installation_sanitaire" id="Installation_sanitaire" <?php if(isset($_COOKIE['Installation_sanitaire'])) echo "checked"; ?> />
    <label for="Installation_sanitaire">
    <?php addIcon("Installation_sanitaire", "fa-bath"); ?>
    <?php addTexteBox("Installation_sanitaire", "Installation sanitaire"); ?>
    </label>
    <?php addAudio("Installation_sanitaire", "inst_sani"); ?>
    </div>

    <div class="jsp">
    <input type="checkbox" name="Installation_électrique" id="Installation_électrique" <?php if(isset($_COOKIE['Installation_électrique'])) echo "checked"; ?> />
    <label for="Installation_électrique">
    <?php addIcon("Installation_électrique", "fa-bolt"); ?>
    <?php addTexteBox("Installation_électrique", "Installation électrique"); ?>
    </label>
    <?php addAudio("Installation_électrique", "inst_elec"); ?>
    </div>
    
    </div>

    <?php
    $numpage=5;
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>

<?php include("fiche_foot.php") ?>