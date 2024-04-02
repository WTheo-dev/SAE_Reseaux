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
     if (isset($_POST['nom']) && isset($_POST['mdp'])) {
         $login = $_POST['nom'];
         $mdp = $_POST['mdp'];
 
         if (connexionPersonnel($login, $mdp)) {
             $_SESSION['personnel'] = $login;
             header('Location: page_postco_personnel.php');
             exit();
         } else {
             echo "Identifiants invalides. Veuillez réessayer.";
         }
     }
 } else {
     header('Location: page_postco_personnel.php');
     exit();
 }
 
 $mdp = "";
 if (isset($_POST['mdp'])) {
     $mdp = $_POST['mdp'];
 }
 
 $idPersonnel = -1;
 $i = 0;
 while (true) {
     if (isset($_POST[$i])) {
         $idPersonnel = $i;
         break;
     }
     $i += 1;
 }
 
 $perso = unPersonnel($idPersonnel);
 
  ?>

  <form action="page_postco_admin.php" method="post">
    <div class="label_connexion_educ">
      <input type="text" id="nom" name="nom" value="<?php echo $perso["login"]; ?>" readonly />
    </div>
    <div class="content-container">
      <p class="p_connexion_eleve">Mettez votre code : </p>

      <div id="container">
            <div id="lock-container">
                <div id="lock-screen" class="lock-screen">
                    <?php for ($i = 1; $i <= 9; $i++) { ?>
                        <div class="lock-dot">
                            <input type="checkbox" id="<?php echo $i; ?>" name="digit<?php echo $i; ?>" style="display: none;">
                            <label for="<?php echo $i; ?>"><?php echo $i; ?></label>
                        </div>
                    <?php } ?>
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