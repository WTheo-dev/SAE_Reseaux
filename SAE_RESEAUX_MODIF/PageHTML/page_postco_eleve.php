<?php
  session_start();
  include_once "../../APIFinale/fonctions.php";
  
  if (!isset($_SESSION['apprenti'])) {
    header('Location: index.php');
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
            <h2 class="header_text_postcoeleve"><?php echo $_SESSION['apprenti']; ?></h2>
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
            <a href="listeFiche.php">
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
        <form method="post" action="deconnexion.php">
            <button id="btnDeconnexion" type="submit" class="bouton-deconnexion">Déconnexion</button>
        </form>
    </div>

</body>

</html>
