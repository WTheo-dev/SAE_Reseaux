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
  include_once '../../APIFinale/fonctions.php';

  if (!isset($_SESSION['personnel'])) {
    if (isset($_POST['id']) && isset($_POST['mdp'])) {
      $login = $_POST['id'];
      $mdp = $_POST['mdp'];
      if (connexionPersonnel($login, $mdp)) {
        $_SESSION['personnel'] = $login;
        header('Location: page_postco_admin.php');
        exit();
      } else {
        echo "Identifiants invalides. Veuillez réessayer.";
      }
    }
  } else {
    header('Location: page_postco_admin.php');
    exit();
  }
  $id = -1;
  $i = 0;
  while (true) {
    if (isset($_POST[$i])) {
      $id = $i;
      break;
    }
    $i += 1;
  }
  $perso = unPersonnel($id);
  $nomperso = $perso[0]["nom"];
  $prenomperso = $perso[0]["prenom"];
  ?>

  <form action="page_postco_admin.php" method="post">

    <div class="label_connexion_educ">
      <input type="text" id="nom" name="nom" value="<?php echo $nomperso . " " . $prenomperso; ?>" readonly />
    </div>
    <div class="content-container">
      <p class="p_connexion_eleve">Mettez votre code : </p>

      <div id="container">
        <div id="lock-container">
          <div id="lock-screen" class="lock-screen">
            <div class="lock-dot">
              <input type="checkbox" id="1" name="1" style="display: none;" />
              <label for="1">1</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="2" name="2" style="display: none;" />
              <label for="2">2</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="3" name="3" style="display: none;" />
              <label for="3">3</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="4" name="4" style="display: none;" />
              <label for="4">4</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="5" name="5" style="display: none;" />
              <label for="5">5</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="6" name="6" style="display: none;" />
              <label for="6">6</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="7" name="7" style="display: none;" />
              <label for="7">7</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="8" name="8" style="display: none;" />
              <label for="8">8</label>
            </div>

            <div class="lock-dot">
              <input type="checkbox" id="9" name="9" style="display: none;" />
              <label for="9">9</label>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" id="connect-button_educ">Se connecter</button>

    </div>
  </form>
  <div class="btn_connexion_educ">
    <button id="a" onclick="clearSelection()">Effacer</button>
    <button id="back-button" onclick="goBack()">Retour</button>
  </div>
  <script src="connexion_educateur.js"></script>
</body>

</html>