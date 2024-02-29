<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Création du compte Educateur</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="body-creer-compte-educateur">
    <section class="creer_compte_educateur-container">
      <header>Création du compte Educateur</header>
      <form action="creer_compte_educateur_traitement.php" method="post" class="creer_compte_educateur-form">
        <div class="creer_compte_educateur-input-box">
          <label>Nom</label>
          <input name="nom" type="text" placeholder="Entrez un nom" required />
        </div>

        <div class="creer_compte_educateur-input-box">
            <label>Prénom</label>
            <input name="prenom" type="text" placeholder="Entrez un prénom" required />
          </div>
        
          <div class="creer_compte_educateur-input-box">
            <label>Mot de passe</label>
            <input name="mdp" type="password" placeholder="Entrez un mot de passe" required />
          </div>

        <div class="creer_compte_educateur-gender-box">
            <h3>Type Educateur</h3>
            <div class="creer_compte_educateur-gender-option">
              <div class="creer_compte_educateur-gender">
                <input type="radio" id="creer_compte_educateur-check-male" name="educ-type" value="simp" checked />
                <label for="creer_compte_educateur-check-male">Educateur simple</label>
              </div>
              <div class="creer_compte_educateur-gender">
                <input type="radio" id="creer_compte_educateur-check-female" name="educ-type" value="tech" />
                <label for="creer_compte_educateur-check-female">Educateur technique</label>
              </div>
            </div>
          </div>

          <div class="creer_compte_educateur-input-box">
            <label>Numéro de téléphone (Optionnel)</label>
            <input name="num" type="number" placeholder="Entrez un numéro de telephone (optionnel)" />
          </div>
       
        <button type="submit">Créer compte educateur</button>
        <button type="button" onclick="redirectToPostcoAdmin()">Annuler</button>
      </form>
    </section>
  </body>
  <script src="creer_compte_educateur.js"></script></html>
