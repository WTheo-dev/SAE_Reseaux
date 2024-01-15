<?php
session_start();
include_once("../../APIFinale/fonctions.php");
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

<h2>Liste des Éducateurs</h2>

<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

    <?php
      /*
      $persos = listeEducateur();
      var_dump($persos);
      */
    ?>

    <tr>
      <td>Jean-Charles</td>
      <td>Delcaste</td>
      <td><button onclick="window.location.href='connexion_educateur.html'">Se connecter</button></td>
    </tr>
    
    <tr>
      <td>Jean</td>
      <td>Neymar</td>
      <td><button onclick="window.location.href='connexion_educateur.html'">Se connecter</button></td>
    </tr>
    <!-- Ajoutez d'autres lignes d'éducateurs ici selon vos besoins -->
  </tbody>
</table>

</body>
</html>
