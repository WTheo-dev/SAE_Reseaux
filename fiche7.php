<?php include("fiche_head.php") ?>

    <?php include_once("fiche_base.php"); ?>

    <audio id="nuni">
        <source src="audio/NécessiteUneNouvelleIntervention.mp3" type="audio/mp3">
    </audio>
    <script src="fiche_audio.js"></script>

<!-- Formulaire -->

<?php ifform() ?>

    <div class="block" style="height:85%;">
    <p>Travaux non réalisés</p>
    <textarea id="travauxNonRealises" name="travauxNonRealises" rows="10"><?php echo $_COOKIE['travauxNonRealises']; ?></textarea>
    </div>
    <input type="checkbox" name="Nécessite_un_nouvelle_intervention" id="Nécessite_un_nouvelle_intervention" <?php if(isset($_COOKIE['Nécessite_un_nouvelle_intervention'])) echo "checked"; ?> />
    <label for="Nécessite_un_nouvelle_intervention">
    <?php addIcon("Nécessite_un_nouvelle_intervention", "fa-refresh"); ?>
    <?php addTexteBox("Nécessite_un_nouvelle_intervention", "Nécessite un nouvelle intervention"); ?>
    </label>
    <?php addAudio("Nécessite_un_nouvelle_intervention", "nuni"); ?>

    <?php
    $numpage=7;
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>

<?php include("fiche_foot.php") ?>