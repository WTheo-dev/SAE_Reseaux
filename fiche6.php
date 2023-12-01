<?php include("fiche_head.php") ?>

    <?php include_once("fiche_base.php"); ?>

<!-- Formulaire -->
<?php ifform() ?>

    <div class="block">
    <p>Travaux réalisés</p>
    <textarea id="travauxRealises" name="travauxRealises" rows="10"><?php echo $_COOKIE['travauxRealises'] ?></textarea>
    </div>

    <?php
    $numpage=6;
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>

<?php include("fiche_foot.php") ?>