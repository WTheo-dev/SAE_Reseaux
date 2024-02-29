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
    <h2 >Liste des Éducateurs</h2>
  </div>
<form action="connexion_educateur.php" method="post">

<table>
  <caption>Table</caption>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

    <?php
      $persos = listeEducateur();
      foreach ($persos as $perso){
        echo "<tr>";
        echo "<td>".$perso["nom"]."</td>";
        echo "<td>".$perso["prenom"]."</td>";
        echo "<td><button name='".$perso["id_personnel"]."'>Se connecter</button></td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

</form>

<button type="button" onclick="window.location.href = 'index.php';">retour</button>

</body>
</html>
