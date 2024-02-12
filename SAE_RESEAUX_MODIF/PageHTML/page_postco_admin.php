  <?php
    include_once("../../APIFinale/fonctions.php");
    $persos = listeEducateur();
    $mdp = "";

    list($prenom, $nom) = explode(' ', $_POST["nom"]);

    for ($i=0; $i<=9; $i++){
      if (isset($_POST[$i])){
        $mdp = $mdp.$i;
      }
    }

    foreach ($persos as $perso){
      if ($perso["nom"] == $nom && $perso["prenom"] == $prenom){
        $idcorrect = "yes";
        $user = get_utilisateur($perso["id_utilisateur"]);
        if ($user["mdp"] == $mdp){
          $mpdcorrect = "yes";
        } else {
            $mpdcorrect = "no";
        }
        break;
      } else {
          $idcorrect = "no";
      }
    }

    if ($idcorrect == "no" || $mpdcorrect == "no"){
        header("Location: liste_educateur.php");
        exit();
    }
  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Page connectée éducateur technique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="page_postco_admin.css">
  </head>

  <header class="header-connexion-eleve">
    <div class="logo">
      <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
      <div class="child-info">
        <h2 class="header_text_postcoeleve"><?php echo $prenom." ".strtoupper($nom); ?></h2>
      </div>
    </div>
  </header>

  <body class="body-postco-admin">
    <div class="zone-texte_page_postco-admin">
      <h1 class="h1_pagepostco-eleve">Bienvenue sur votre espace éducateur.</h1>
    </div>

    <div class="texte_pagepostco_educ">Selectionnez l'étudiant de votre choix</div>

    <div class="class-container-profile-switch">

    <?php $etus = listeApprenti(); ?>
    <?php foreach($etus as $etu): ?>

    <div class="profile-switch-container" onclick="selectProfile(this)">
        <div class="rectangle-container-photo-label">
          <label for="nom-prenom"><?php echo strtoupper($etu["nom"]) . " " . $etu["prenom"]; ?></label>
          <div class="rectangle-photo">
              <img class="image" src="Image/etu/<?php echo $etu["photo"] ?>" alt="utilisateurphoto">
          </div>
      </div>
    </div>

    <?php endforeach; ?>
    
    </div>
    
      <!-- Ajoutez d'autres profils si nécessaire -->
      
  </div>
    <div class="profile-buttons" id="profile_btn">
      <button onclick="creerNouvelleFiche()">Créer une nouvelle fiche</button>
      <button onclick="accederEvaluation()">Evaluation des fiches</button>
      <button onclick="voirCommentaires()">Voir les commentaires sur la fiche en cours</button>
    </div>

    <div class="btn-deconnexion_page_postco_admin">
      <button onclick="deconnecter()">Deconnexion</button>  
    </div>

    <script src="page_postco_admin.js"></script>
  </body>
</html>
