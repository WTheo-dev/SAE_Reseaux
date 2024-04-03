<?php
session_start();
include_once "../../APIFinale/fonctions.php";
if (!isset($_SESSION['superadmin'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Creation compte eleve</title>
</head>

<body class="body_creercompteleve">

  <!-- Header -->
  <header class="header-connexion-eleve">
    <div class="logo">
      <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <form action="creer_compte_eleve_traitement.php" method="post" enctype="multipart/form-data">
      <!-- Section pour sélectionner une photo -->
      <div class="rectangle2_creercompteeleve">
        <input name="etu-photo" type="file" id="file-input" style="display: none;">
        <div id="image-container">
          <img id="selected-image" src="" alt="Sélectionnée">
          <div id="container-buttons-page-creation-eleve"> <!-- Nouveau conteneur pour les boutons -->
          </div>
        </div>
      </div>
      <div class="button-container">
        <button type="button" class="boutons-create" onclick="openFileExplorer()">Sélectionner une photo</button>
        <button type="button" class="boutons-delete" onclick="deleteSelectedPhoto()" style="display: none;">Supprimer la
          photo</button>
      </div>

      <!-- Section pour le nom et prénom de l'élève -->
      <div class="rectangle3_creercompteeleve">
        <label class="nom_prenom_creereleve" for="nom-prenom">Nom et Prénom de l'élève:</label>
        <input name="nom-prenom" class="input_creercompteeleve" type="text" id="nom-prenom">
      </div>

      <!-- Section pour le schéma de connexion et le formulaire -->
      <p class="p_creation_eleve">Creez le code de l'élève: </p>

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
      <div class="btn_creercompteleve2">
        <button type="submit" id="btn-valider-creation-eleve">Créer le compte de l'élève</button>
      </div>
      <div class="btn_creercompteleve">
        <button type="button" id="a" onclick="clearSelection()">Effacer</button>
        <button type="button" id="back-button" onclick="goBack()">Retour</button>
      </div>
      </div>
      </div>
    </form>
  </main>

  <script src="creer_compte_eleve.js"></script>
</body>

</html>