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
  session_start();
  include_once '../../APIFinale/fonctions.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mdp = $_POST['mdp']; 
  
    $idApprenti = 9; // You can replace 123 with any value you want


    $etu = unApprenti($idApprenti);
    $photoetu = $etu["photo"];

    $mdp = '';
    for ($i = 1; $i <= 9; $i++) {
      if (isset($_POST['digit' . $i])) {
        $mdp .= $i;
      }
    }


    if (connexionApprenti($mdp, $etu)) {
      $_SESSION['apprenti'] = $etu['login'];
      echo $etu['login'];
      header("Location: page_postco_eleve.php");
      exit();
    } else {
      echo "Identifiants invalides. Veuillez réessayer.";
    }
  }
  ?>


  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="content-container">
      <img id="Imageenfant-connexion-eleve" src="Image/etu/<?php echo $photoetu; ?>" alt="description">
      <div class="rectangle2-connexion-eleve">
        <input type="text" id="nom" name="nom" value="<?php echo $etu["login"]; ?>" readonly />
      </div>
      <p class="p_connexion_eleve">Mettez votre code : </p>
      <div id="container">
        <div id="lock-container">
          <div id="lock-screen" class="lock-screen">
            <?php for ($i = 1; $i <= 9; $i++) { ?>
              <div class="lock-dot">
                <input type="checkbox" id="<?php echo $i; ?>" name="digit<?php echo $i; ?>" style="display: none;">
                <label for="<?php echo $i; ?>">
                  <?php echo $i; ?>
                </label>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <input type="text" id="mdp" name="mdp" onclick="clearSelection()" value="">

      <button type="submit" id="connect-button_educ">Se connecter</button>
    </div>
  </form>

  <button id="a" onclick="clearSelection()">Effacer</button>

  <button id="back-button" onclick="goBack()">Retour</button>

  <script src="connexion_eleve.js"></script>
</body>

</html>