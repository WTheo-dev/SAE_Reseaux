<?php
  session_start();
  include_once "../../APIFinale/fonctions.php";
  
  if (!isset($_SESSION['personnel'])) {
    header('Location: index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page connectée éducateur technique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="page_postco_admin.css">
</head>
<body class="body-postco-admin">
<header class="header-connexion-eleve">
  <div class="logo">
    <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
    <div class="child-info">
    <h2 class="header_text_postcoeleve"><?php echo $_SESSION['personnel']; ?></h2>
    </div>
  </div>
</header>

<div class="zone-texte_page_postco-admin">
  <h1 class="h1_pagepostco-eleve">Bienvenue sur votre espace éducateur.</h1>
</div>

<div class="texte_pagepostco_educ">Selectionnez l'étudiant de votre choix</div>

<div class="class-container-profile-switch">

  <?php $etus = listeApprenti(); ?>
  <?php foreach($etus as $etu): ?>

      <div class="profile-switch-container" onclick="selectProfile(this, <?php echo $etu['id_apprenti'] ?>)">
      <div class="rectangle-container-photo-label">
        <label for="nom-prenom"><?php echo strtoupper($etu["nom"]) . " " . $etu["prenom"]; ?></label>
        <div class="rectangle-photo">
          <img class="image" src="Image/etu/<?php echo $etu["photo"] ?>" alt="utilisateur">
        </div>
      </div>
    </div>

  <?php endforeach; ?>

</div>

<form action="fiche_valeur.php" method="post">
    <div class="profile-buttons" id="profile_btn">
      <button id="button_creer_nouvelle_fiche" name="id_app" value="59">Créer une nouvelle fiche</button>
      <button type='button' onclick="accederEvaluation()">Evaluation des fiches</button>
      <button type='button' onclick="voirCommentaires()">Voir les commentaires sur la fiche en cours</button>
    </div>
</form>

<div class="btn-deconnexion_page_postco_admin">
        <form method="post" action="deconnexion.php">
            <button id="btnDeconnexion" type="submit" class="bouton-deconnexion">Déconnexion</button>
        </form>
    </div>
    
<script src="page_postco_admin.js"></script>
</body>
</html>
