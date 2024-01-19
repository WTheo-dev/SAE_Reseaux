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
  require_once("./APIFinale/jwt_util.php");
  require_once("./APIFinale/fonctions.php");

  // Définir l'algorithme de signature, la clé secrète, et initialiser la session
  $header = array("alg" => "HS256", "typ" => "JWT");
  $key = "pass";
  session_start();

  // Vérifier si le formulaire a été soumis
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
      // Récupérer les données du formulaire
      $nom_utilisateur = isset($_POST['nom_utilisateur']) ? $_POST['nom_utilisateur'] : '';
      $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

      // Vérifier les champs du formulaire
      if (empty($nom_utilisateur) || empty($mdp)) {
        throw new Exception("Veuillez remplir tous les champs du formulaire.");
      }

      // Vérifier les informations d'identification
      if (identification($nom_utilisateur, $mdp)) {
        // Créer le corps du JWT
        $duree = 2592000; // Durée du token en secondes (30 jours dans cet exemple)
        $body = array(
          "role" => recuperation_role($nom_utilisateur),
          "utilisateur" => $nom_utilisateur,
          "exp" => (time() + $duree)
        );

        // Générer le token JWT
        $token = generate_jwt($header, $body, $key);

        // Stocker le token dans la session
        $_SESSION['jwt_token'] = $token;

        // Rediriger vers index.php
        header("Location: index.php");
        exit;
      } else {
        throw new Exception("Identifiant incorrect. Veuillez vérifier vos informations de connexion.");
      }
    } catch (Exception $e) {
      $erreur_message = $e->getMessage();
    }
  }
  ?>
  <?php
  include_once("../../APIFinale/fonctions.php");
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
      <input type="text" id="nom" name="nom" value="<?php echo $prenomperso . " " . $nomperso; ?>" />
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
      <!--
    <button id="connect-button_educ" onclick="connect()" style="display: none;">Se connecter</button>
    -->

    </div>
  </form>
  <div class="btn_connexion_educ">
    <button id="a" onclick="clearSelection()">Effacer</button>
    <button id="back-button" onclick="goBack()">Retour</button>
  </div>
  <script src="connexion_educateur.js"></script>
</body>

</html>