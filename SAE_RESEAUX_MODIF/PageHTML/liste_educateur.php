<?php
session_start();
include_once "../../APIFinale/fonctions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="liste_educateur.css">
  <title>Liste des Éducateurs</title>
  <header class="header-connexion-eleve">
    <div class="logo">
      <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
    </div>
  </header>
</head>


<body class="body-liste-educateur">
  <div class="liste-educ">
    <h2>Liste des Éducateurs</h2>
  </div>
  <form action="connexion_educateur.php" method="post">

    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Rôle</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $persos = listePersonnel();
        foreach ($persos as $perso) {
          echo "<tr>";
          echo "<td>" . $perso["nom"] . "</td>";
          echo "<td>" . $perso["prenom"] . "</td>";
          echo "<td>" . $perso['description'] . "</td>";
          echo "<td><button type='submit' class='educateur_button' name='id_personnel' value='" . $perso["id_personnel"] . "'>Se connecter</button></td>";
          echo "</tr>";
        }
        ?>


      </tbody>
    </table>

  </form>

  <script>
    document.querySelectorAll('.educateur_button').forEach(item => {
      item.addEventListener('click', event => {
        var idEducateur = event.target.value;
        document.getElementById('id_educateur_input').value = idEducateur;
        document.getElementById('educateur_form').submit();
      });
    });
  </script>



  <button type="button" onclick="window.location.href = 'index.php';">Retour</button>

</body>

</html>