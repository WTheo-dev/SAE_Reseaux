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
    <link rel="stylesheet" href="page_postco_superadmin.css">
    <title>Accueil SuperAdmin</title>

</head>

<body class="body_page_postco_superadmin">

    <header class="header_page_postco_superadmin">
        <div class="header_text"><img class="logo_page_postco_superadmin" src="Image/APEAJ_color2.png"
                alt="pictogramme"></div>
        <div class="child-info">
            <h2 class="header_text_postcoeleve"><?php echo $_SESSION['superadmin']; ?></h2>
        </div>
    </header>

    <div class="colonne_creation">
        <h2 class="h2_pagepostco_superadmin">Vous êtes connecté en tant que Super Administrateur</h2>

    </div>


    <div class="container_central">
        <div class="container_2">
            <label for="actions"> Que voulez vous faire?</label>
        </div>
        <div class="btnaction">
            <select class="actions" id="actions" onchange="showSection()">
                <option value="creer">Créer</option>
                <option value="modifier">Modifier / Supprimer</option>
            </select>
            <div class="btnliste">
                <select class="liste" id="liste" onchange="showSection()">
                    <option value="eleves">Elèves</option>
                    <option value="cours">Cours</option>
                    <option value="educateurs">Educateurs</option>
                    <option value="formations">Formations</option>
                </select>
            </div>
        </div>

        <div class="container_4">
            <button class="btnGO" onclick="goToPage()">GO</button>
        </div>
        <div class="colonne_liste">
            <button id="btnredirection" onclick="goToPageBanque()">Cliquez ici pour accéder a la banque de
                données</button>
        </div>
    </div>
   <div class="colonne_liste">
        <form method="post" action="deconnexion.php">
            <button id="btnDeconnexion" type="submit">Déconnexion</button>
        </form>
    </div>

    <script src="page_postco_superadmin.js"></script>
