<?php
session_start();
include_once "../../APIFinale/fonctions.php";

$succes = false;

if (!isset($_SESSION['superadmin'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mdp']; 

    $roles = array();
    if(isset($_POST['educ-type'])) {
        $type_educateur = $_POST['educ-type'];
        if ($type_educateur === "simp") {
            $roles[] = 3; 
        } elseif ($type_educateur === "tech") {
            $roles[] = 4; 
        } elseif ($type_educateur === "CIP") {
            $roles[] = 5; 
        }
    }

    $utilisateur = array(
        'login' => $nom . ' ' . $prenom,
        'mdp' => $mdp, 
        'id_role' => $roles[0] 
    );

    $InscriptionEducateur = inscriptionPersonnel($nom, $prenom, $utilisateur);
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
