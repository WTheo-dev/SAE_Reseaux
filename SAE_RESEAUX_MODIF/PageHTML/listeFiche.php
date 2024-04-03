<?php
session_start();
include_once '../../APIFinale/fonctions.php';
if (!isset($_SESSION['apprenti'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_postco_eleve.css">
    <title>Page élève</title>
</head>

<body class="body_postcoeleve">

    <header class="main-header">
        <div class="logo">
            <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
        </div>
        <div class="child-info">
            <h2 class="header_text_postcoeleve"><?php echo $_SESSION['apprenti']; ?></h2>
        </div>
    </header>

    <h1>Liste des fiches d'intervention</h1>

    <?php
    $fiches = listeFiche();

    if (count($fiches) > 0) {
        echo '<table border="1">';
        echo '<tr><th>ID de la fiche</th><th>ID du personnel</th><th>ID de l\'apprenti</th></tr>';

        foreach ($fiches as $fiche) {
            echo '<tr>';
            echo '<td>' . $fiche['id_fiche'] . '</td>';
            echo '<td>' . $fiche['id_personnel'] . '</td>';
            echo '<td>' . $fiche['id_apprenti'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>Aucune fiche d\'intervention trouvée.</p>';
    }
    ?>

    <a href="page_postco_eleve.php" class="btn-retour">Retour</a>

</body>

</html>

