<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des fiches d'intervention</title>
</head>
<body>
    <h1>Liste des fiches d'intervention</h1>

    <?php
  session_start();
  include_once '../../APIFinale/fonctions.php';

    $fiches = listeFiche();

    if (count($fiches) > 0) {
        echo '<table border="1">';
        echo '<tr><th>ID de la fiche</th><th>ID du personnel</th><th>ID de l\'apprenti</th></tr>';

        foreach ($fiches as $fiche) {
            echo '<tr>';
          
            echo '<td>' . $fiche['id_fiche'] . '</td>';
            echo '<td>' . $fiche['id_personnel'].'</td>';
            echo '<td>' . $fiche['id_apprenti'].'</td>'; 
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>Aucune fiche d\'intervention trouvée.</p>';
    }
    ?>


</body>
</html>
