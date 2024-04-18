<?php
session_start();
include_once "../../APIFinale/fonctions.php";

if (!isset($_SESSION['superadmin'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste du personnel</title>
  <style>
    table {
      border-collapse: collapse;
      width: 50%;
      margin: 20px;
    }

    th,
    td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    button {
      padding: 5px;
      cursor: pointer;
    }

    .header_modifier_liste_eleve {
      background-color: rgb(130, 106, 251);
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .child-info {
      font-family: 'Cinzel', 'sans-serif';
      font-size: 25px;
      padding-right: 1em;
    }

    .body_page_modifier_liste_eleve {
      flex-direction: column;
      margin: 0;
      padding: 0;
      height: 100vh;
      background-color: #f0f0f0;
    }

    #btnretour {
      font-family: 'Cormorant', sans-serif;
      font-size: 25px;
      margin-top: 10rem;
      background-color: blue;
      cursor: pointer;
      color: white;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRybn" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRetP" crossorigin="anonymous"></script>

</head>

<body class="body_page_modifier_liste_eleve">

  <header class="header_modifier_liste_eleve">
    <div class="header_text">
      <img class="logo_modifier_liste_eleve" src="Image/APEAJ_color2.png" alt="pictogramme">
      <h2 class="header_text_postcoeleve"><?php echo $_SESSION['superadmin']; ?></h2>
    </div>
  </header>

  <?php
  include_once "../../APIFinale/fonctions.php";
  ?>
  <table>
  <caption>Modifier des Personnels</caption>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Récupération des données du personnel
      $personnels = listePersonnel();

      // Affichage des données dans votre interface utilisateur
      foreach ($personnels as $personnel) {
        echo '<tr>';
        echo '<td>' . $personnel['nom'] . '</td>';
        echo '<td>' . $personnel['prenom'] . '</td>';
        echo '<td>';
        echo '<form action="" method="post">';
        echo '<input type="hidden" name="idPersonnel" value="' . $personnel['id_personnel'] . '">';
        echo '<button class="btn btn-primary" type="submit" name="modifier">Modifier</button>';
        echo '<button class="btn btn-primary" type="submit" name="supprimer">Supprimer</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
      }

      // Modification ou suppression du personnel si le formulaire est soumis
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['idPersonnel'])) {
          $idPersonnel = $_POST['idPersonnel'];
          if (isset($_POST['modifier'])) {
            // Récupération de toutes les informations du personnel
            $bd = connexionBD();
            $requete = $bd->prepare('SELECT * FROM personnel WHERE id_personnel = ?');
            $requete->execute([$idPersonnel]);
            $personnel = $requete->fetch(PDO::FETCH_ASSOC);
            // Affichage d'un formulaire pré-rempli avec les données du personnel
            echo '<tr>';
            echo '<td colspan="3">';
            echo '<form action="modifier_personnel.php" method="post">';
            foreach ($personnel as $cle => $valeur) {
              echo '<input type="hidden" name="' . $cle . '" value="' . $valeur . '">';
            }
            echo '<button type="submit" name="modifier">Modifier</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
          } elseif (isset($_POST['supprimer'])) {
            $resultatSuppression = supprimerPersonnel($idPersonnel);
            if ($resultatSuppression) {
              echo '<tr><td colspan="3">Le personnel a été supprimé avec succès.</td></tr>';
            } else {
              echo '<tr><td colspan="3">La suppression a échoué.</td></tr>';
            }
          }
        } else {
          echo '<tr><td colspan="3">Identifiant du personnel manquant.</td></tr>';
        }
      }
      ?>
    </tbody>
  </table>

</body>

</html>

<button onclick="redirigerVersExportExcel()">Exporter vers Excel</button>

<script src="modifier_liste_eleve.js"></script>

<div class="bouton_retour">
  <button id="btnretour" onclick="goToPagePostCoSuperAdmin()">Retour</button>
</div>

</body>

</html>
