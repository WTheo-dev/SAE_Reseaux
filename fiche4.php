<?php include("fiche_head.php") ?>

    <?php include_once("fiche_base.php"); ?>

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

<!-- Formulaire -->
<?php ifform() ?>

    <div class="block bordure">
    <p>Type de maintenance</p>

    <div class="jsp">
    <input type="checkbox" name="Améliorative" id="Améliorative" <?php if(isset($_COOKIE['Améliorative'])) echo "checked"; ?> />
    <label for="Améliorative">
    <?php addIcon("Améliorative", "fa-arrow-circle-up"); ?>
    <?php addTexteBox("Améliorative", "Améliorative"); ?>
    </label>
    <?php addAudio("Améliorative", "amel"); ?>
    </div>

    <div class="jsp">
    <input type="checkbox" name="Préventive" id="Préventive" <?php if(isset($_COOKIE['Préventive'])) echo "checked"; ?> />
    <label for="Préventive">
    <?php addIcon("Préventive", "fa-eye"); ?>
    <?php addTexteBox("Préventive", "Préventive"); ?>
    </label>
    <?php addAudio("Préventive", "prev"); ?>
    </div>
    <div class="jsp">
    <input type="checkbox" name="Corrective" id="Corrective" <?php if(isset($_COOKIE['Corrective'])) echo "checked"; ?> />
    <label for="Corrective">
    <?php addIcon("Corrective", "fa-pencil-square-o"); ?>
    <?php addTexteBox("Corrective", "Corrective"); ?>
    </label>
    <?php addAudio("Corrective", "corr"); ?>
    </div>

    </div>

    <?php
    $numpage=4;
    include_once("fiche_button.php");
    ?>

<?php ifformfin() ?>

<?php include("fiche_foot.php") ?>