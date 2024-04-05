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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Création du compte Educateur</title>
    <h2 class="header_text_postcoeleve"><?php echo $_SESSION['superadmin']; ?></h2>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="body-creer-compte-educateur">
    <section class="creer_compte_educateur-container">
      <header>Création du compte Educateur</header>
      <form action="creer_compte_educateur_traitement.php" method="post" class="creer_compte_educateur-form">
        <div class="creer_compte_educateur-input-box">
          <label for="nom">Nom</label>
          <input name="nom" type="text" placeholder="Entrez un nom" required />
        </div>

        <div class="creer_compte_educateur-input-box">
            <label for="prenom">Prénom</label>
            <input name="prenom" type="text" placeholder="Entrez un prénom" required />
          </div>
        
          <div class="creer_compte_educateur-input-box">
          <label for="mdp">Mot de passe</label>
          <input name="mdp" type="password" inputmode="numeric" pattern="[0-9]{4}" 
          placeholder="Entrez un mot de passe (4 chiffres)" maxlength="4" required />

          </div>

        <div class="creer_compte_educateur-gender-box">
            <h3>Type Educateur</h3>
            <div class="creer_compte_educateur-gender-option">
              <div class="creer_compte_educateur_simple">
                <input type="radio" id="creer_compte_educateur_simple" name="educ-type" value="simp" checked />
                <label for="creer_compte_educateur_simple">Educateur technique</label>
              </div>
              <div class="creer_compte_educateur_tech">
                <input type="radio" id="creer_compte_educateur_tech" name="educ-type" value="tech" checked />
                <label for="creer_compte_educateur_tech">Educateur simple</label>
              </div>
              <div class="creer_compte_CIP">
                <input type="radio" id="creer_compte_CIP" name="educ-type" value="CIP" />
                <label for="creer_compte_CIP">CIP</label>
              </div>
          </div>

       
        <button type="submit">Créer compte educateur</button>
        <button type="button" onclick="redirectToPostcoAdmin()">Annuler</button>
      </form>
    </section>
  </body>
  <script src="creer_compte_educateur.js"></script></html>
