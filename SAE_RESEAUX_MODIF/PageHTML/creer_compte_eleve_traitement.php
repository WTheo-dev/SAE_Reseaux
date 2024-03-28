<?php
session_start();
include_once "../../APIFinale/fonctions.php";

$succes = false;

if (!isset($_SESSION['superadmin'])) {
    header('Location: index.php');
    exit();
}

// Création du répertoire pour les images si inexistant
$imgdir = "Image/etu/";
if (!is_dir($imgdir)) {
    mkdir($imgdir);
    shell_exec("chmod 777 " . $imgdir);
    shell_exec("chown www-data " . $imgdir);
    shell_exec("chgrp www-data " . $imgdir);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomPrenom = $_POST['nom-prenom'];
    list($nom, $prenom) = explode(' ', $nomPrenom, 2);

    // Autres champs de formulaire
    $photo = basename($_FILES["etu-photo"]["name"]);
    $target_file = $imgdir . $photo;

    try {
        // Déplacement du fichier téléchargé vers le répertoire de destination
        $succes = move_uploaded_file($_FILES["etu-photo"]["tmp_name"], $target_file);
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }

    if (!$succes) {
        echo "<br>Erreur lors de l'enregistrement, veuillez vérifier que l'image est correcte.<br>";
    } else {
        // Création de l'utilisateur
        $schemaMotDePasse = '';
        for ($i = 1; $i <= 9; $i++) {
            if (isset($_POST[$i])) {
                $schemaMotDePasse .= $i;
            }
        }
        $utilisateur = array(
            'login' => $nomPrenom,
            'mdp' => $schemaMotDePasse,
            'id_role' => 1
        );

        // Appel de la fonction inscriptionApprenti pour insérer les données dans la base de données
        $InscriptionInscrit = inscriptionApprenti($nom, $prenom, $photo, $utilisateur);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Résultat de l'inscription</title>
</head>
<body>
<main>
    <?php if ($succes): ?>
        <h1 style="text-align: center;">Succès</h1>
    <?php else: ?>
        <h1 style="text-align: center;">Erreur</h1>
    <?php endif; ?>
</main>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Création compte eleve</title>
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
            <h1 style="text-align: center;">Succès</h1>
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
