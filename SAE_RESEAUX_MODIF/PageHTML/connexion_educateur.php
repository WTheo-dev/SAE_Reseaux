<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

  <title>Connexion Educateur</title>
</head>
<body class="body-connexion-eleve">
  <header class="header-connexion-eleve">
    <div class="logo">
      <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
    </div>
  </header>
  <?php
  session_start();
  include_once("../../APIFinale/fonctions.php");
  $id = -1;
  $i = 0;
  while (true){
    if (isset($_POST[$i])){
      $id = $i;
      break;
    }
    $i += 1;
  }
  $perso = unPersonnel($id);
  $nomperso = $perso[0]["nom"];
  ?>

    <div class="label_connexion_educ">
        <input type="text" id="nom" name="nom" disabled placeholder="<?php echo $nomperso; ?>" />
    </div>
  <div class="content-container">
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
  
    <button id="connect-button_educ" onclick="connect()" style="display: none;">Se connecter</button>
</div>
    <div class="btn_connexion_educ">
    <button id="a" onclick="clearSelection()">Effacer</button>
    <button id="back-button" onclick="goBack()">Retour</button>
    </div>
  <script src="connexion_educateur.js"></script>
</body>
</html>
  
