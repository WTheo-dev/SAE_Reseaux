<?php
  session_start();
  include_once "../../APIFinale/fonctions.php";
  
  if (!isset($_SESSION['personnel'])) {
    header('Location: index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang= fr>
  <head>
    <title>Page éducateur technique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <header class="header-voir_com_educ">
      <div class="logo">
        <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
      </div>
      <div class="child-info">
                <h2 class="header_text_postcoeleve"><?php echo $_SESSION['personnel']; ?></h2>
            </div>
    </header>
  </head>
  <body class="body-voircom">

  <?PHP

  $sql = "SELECT commentaire_texte FROM laisser_trace";

 
  ?>

    <div class="w3-container-voircom">

      <h2 class="h2-voircom">Commentaires de la fiche</h2>
      
      <label class="label-voircom" for="comment">Ajouter un commentaire:</label>
      <textarea class="textarea-voircom" id="comment-voircom" name="comment-voircom" rows="4" cols="50"></textarea><br>
      
      <button class="button-voircom" onclick="ajouterCommentaire()">Ajouter un commentaire</button>
      
      <div class="w3-responsive-voircom">
        <table id="commentTablevoircom" class="w3-table-all-voircom">
          <caption>table</caption>
          <tr>
            <th class="th-voircom">Nom Educateur</th>
            <th class="th-voircom">Prénom Educateur</th>
            <th class="th-voircom">Commentaires </th>
            <th class="th-voircom">Action</th>
          </tr>
        </table>
      </div>
      
      
      
    </div>
    <button class="buton_deconnexion-voircom" onclick="deconnecter()">Déconnexion</button>
    
    <script src="voir_commentaire_educ.js"></script>

  </body>
</html>
