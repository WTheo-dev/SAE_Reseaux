<?php
$nom    = $_POST["nom"];
$prenom = $_POST["prenom"];
$mdp    = $_POST["mdp"];
$num    = $_POST["num"];

if ($_POST["educ-type"] == "simp") {
    $type = 4;
}else {
    $type = 3;
}

include_once "../../APIFinale/fonctions.php";
$succes = ajouterEducateur($nom, $prenom, $mdp, $type, $num);
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
        <?php if ($succes): ?>
            <h1 style="text-align: center;">Succées</h1>
        <?php else: ?>
            <h1 style="text-align: center;">Erreur</h1>
        <?php endif; ?>

        <!-- menfou de la class, je veut juste le meme style que les autre bouton -->
        <div class="btn_creercompteleve">
            <button type="button" id="back-button"
            onclick="window.location.href = 'page_postco_superadmin.php';">Retour</button>
        </div>
    </main>
</body>
</html>
