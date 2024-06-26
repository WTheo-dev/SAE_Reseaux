
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="fiche_button.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>
<?php if (! (isset($nobutton))): ?>

    <div class="fiche_button">
    <?php if (! isset($begin)) : ?>
        <button class="btn-precedent"type="submit" name="precedent" value="<?php echo $numpage; ?>">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
        <span>Page précédente</span>
    </button>
    <?php else : ?>
        <!-- boutton de menu -->
    <?php endif; ?>
    
    <?php if (! isset($end)) : ?>
        
        <button class="btn-suivant" type="submit" name="suivant" value="<?php echo $numpage; ?>">
                <i class="fa fa-arrow-right"  aria-hidden="true"></i>
                <span>Page suivante</span>
            </button>
            <?php else : ?>
                <!-- boutton de retour -->
                <button class="btn-suivant" type="submit" name="quitter" value="<?php echo $numpage; ?>">
                <i class="fa fa-arrow-right"  aria-hidden="true"></i>
                <span>Enregistrer et quitter</span>
            </button>
    <?php endif; ?>
    </div>
    <div class="div-btn-fiche">
    <button class="fa fa_button" id="btn-save" type="submit" name="sauvegarder" value="<?php echo $numpage; ?>">
        <i class="fa fa-check" aria-hidden="true"></i>
        <span>Sauvegarder</span>
    </button>
</div>
<?php endif; ?>

