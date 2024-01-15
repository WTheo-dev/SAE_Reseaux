<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
  <title>Connexion Élève</title>
</head>
<body class="body-connexion-eleve">
  <header class="header-connexion-eleve">
    <div class="logo">
      <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
    </div>
  </header>

  <?php
  include_once("../../APIFinale/fonctions.php");
  $idetu = -1;
  $i = 0;
  while (true){
    if (isset($_POST[$i])){
      $idetu = $i;
      break;
    }
    $i += 1;
  }
  $etu = unApprenti($idetu);
  $photoetu = $etu[0]["photo"]
  ?>

  <div class="content-container">
    <div class="rectangle2-connexion-eleve">
      <img id="Imageenfant-connexion-eleve" src="Image/etu/<?php echo $photoetu; ?>" alt="Description de l'image">
    </div>
    <p class="p_connexion_eleve">Mettez votre code : </p>
    
    <div id="container">
      <div id="lock-container">
        <div id="lock-screen" class="lock-screen">
          <div class="lock-dot" data-dot="1">1</div>
          <div class="lock-dot" data-dot="2">2</div>
          <div class="lock-dot" data-dot="3">3</div>
          <div class="lock-dot" data-dot="4">4</div>
          <div class="lock-dot" data-dot="5">5</div>
          <div class="lock-dot" data-dot="6">6</div>
          <div class="lock-dot" data-dot="7">7</div>
          <div class="lock-dot" data-dot="8">8</div>
          <div class="lock-dot" data-dot="9">9</div>
        </div>
      </div>
    </div>
  
    <button id="connect-button" onclick="connect()" style="display: none;">Se connecter</button>
    <button id="a" onclick="clearSelection()">Effacer</button>
    <button id="back-button" onclick="goBack()">Retour</button>
  </div>
  
  <script src="connexion_eleve.js"></script>
</body>
</html>
  