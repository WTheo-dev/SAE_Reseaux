<?php
    include_once "../../APIFinale/fonctions.php";
    $etu = unApprenti($_POST["id"])[0];
    $mdp = "";

    for ($i=0; $i<=9; $i++){
      if (isset($_POST[$i])) {
        $mdp = $mdp.$i;
      }
    }

    $user = getUtilisateur($etu["id_utilisateur"]);

    if ($user["mdp"] != $mdp) {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_postco_eleve.css">
    <title>Page élève</title>
</head>

<body class="body_postcoeleve">

    <header class="main-header">
        <div class="logo">
            <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
        </div>
        <div class="child-info">
            <h2 class="header_text_postcoeleve"><?php echo $etu["prenom"]." ".strtoupper($etu["nom"]); ?></h2>
            <p class="header_text_postcoeleve">Formation de l'élève</p>
        </div>
    </header>

    <h1 class="h1-pagepostco">Mes fiches :</h1>

    <div class="bubbles-container">
        <div class="square2">
            <a href="../PageHTML/fiche1.php">
                <img src="Image/fiche.png" alt="fiche">
            </a>
            <button class="bouton-fiche-actuelle">Ma fiche actuelle</button>
        </div>

        <div class="square3">
            <a href="fiche1.php">
                <img src="Image/fiche.png" alt="fiche">
            </a>
            <button class="bouton-anciennes-fiches">Mes anciennes fiches</button>
        </div>
    </div>

    <div class="suivi-eleve">
        <h1 class="h1-pagepostco">Mon suivi :</h1>
        <a href="suivi_eleve.php">
            <img src="Image/image_suivi.png" alt="suivi">
        </a>
    </div>

    <div class="bouton-deconnexion-container">
        <a href="index.php" class="bouton-deconnexion">Déconnexion</a>
    </div>

</body>

</html>
