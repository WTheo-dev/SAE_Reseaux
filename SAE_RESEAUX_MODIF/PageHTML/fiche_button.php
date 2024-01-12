
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
    <button type="submit" name="precedent" value="<?php echo $numpage; ?>">
        <i class="fafa-arrow-left" aria-hidden="true"></i>
        <span>Page précédente</span>
    </button>
    <?php else : ?>
        <!-- boutton de menu -->
    <?php endif; ?>
    <button class="fafa_button" type="submit" name="sauvegarder" value="<?php echo $numpage; ?>">
        <i class="fafa-check" aria-hidden="true"></i>
        <span>Sauvegarder</span>
    </button>
    <?php if (! isset($end)) : ?>
    <button type="submit" name="suivant" value="<?php echo $numpage; ?>">
        <span>Page suivante</span>
        <i class="fafa-arrow-right" aria-hidden="true"></i>
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