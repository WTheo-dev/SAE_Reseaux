<?php

$succes = false;

$imgdir = "Image/etu/";
if (!is_dir($imgdir)) {
    mkdir($imgdir);
    shell_exec("chmod 777 ".$imgdir);
    shell_exec("chown www-data ".$imgdir);
    shell_exec("chgrp www-data ".$imgdir);
}

$photo=basename($_FILES["etu-photo"]["name"]);
$target_file=$imgdir.$photo;

try {
    $succes=move_uploaded_file($_FILES["etu-photo"]["tmp_name"], $target_file);
} catch (Exception $e) {
    echo "Erreur : ".$e->getMessage();
}
if (!$succes) {
    echo "<br>erreur a l'enregistrement, verifier que l'image est bonne.<br>";
}

list($nom, $prenom) = explode(" ", $_POST["nom-prenom"]);

$mdp = "";
for ($i=0; $i<=9; $i++) {
  if (isset($_POST[$i])) {
    $mdp = $mdp.$i;
  }
}

echo "photo: ".$photo;
echo "<br>";
echo "nom: ".$nom;
echo "<br>";
echo "prenom: ".$prenom;
echo "<br>";
echo "mdp: ".$mdp;
echo "<br>";

include_once "../../APIFinale/fonctions.php";
ajouterApprenti($nom, $prenom, $photo, $mdp);
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
