<?php if (! (isset($nobutton))): ?>

    <div class="fiche_button">
    <?php if (! isset($begin)) : ?>
    <button type="submit" name="precedent" value="<?php echo $numpage; ?>">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        <span>précédent</span>
    </button>
    <?php else : ?>
        <!-- boutton de menu -->
    <?php endif; ?>
    <button type="submit" name="sauvegarder" value="<?php echo $numpage; ?>">
        <i class="fa fa-check" aria-hidden="true"></i>
        <span>sauvegarder</span>
    </button>
    <?php if (! isset($end)) : ?>
    <button type="submit" name="suivant" value="<?php echo $numpage; ?>">
        <span>suivant</span>
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </button>
    <?php else : ?>
        <!-- boutton de retour -->
    <?php endif; ?>
    </div>

<?php endif; ?>

<!-- boutton d'impression
    <button type="submit" name="imprimer" onClick="window.print()">
        <i class="fa fa-print" aria-hidden="true"></i>
        <span>imprimer</span>
    </button>
-->