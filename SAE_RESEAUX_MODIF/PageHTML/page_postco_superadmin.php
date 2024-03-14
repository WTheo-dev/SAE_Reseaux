<?php
    include_once "../../APIFinale/fonctions.php";
    $persos = listeSuperAdmin();

    list($prenom, $nom) = explode('.', $_POST["id"]);
    $mdp = $_POST["mdp"];

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
        header("Location: connexion_superadmin.php");
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
            <div class="header_text"><img class="logo_page_postco_superadmin"
            src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_postcoeleve"><?php echo $prenom." ".strtoupper($nom); ?></h2>
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
            <button id="btnredirection"
            onclick="goToPageBanque()">Cliquez ici pour accéder a la banque de données</button>
        </div>
    </div>
<div class="colonne_liste">
    <button id="btnDeconnexion" onclick="deconnecter()">Déconnexion</button>
</div>


        <script src="page_postco_superadmin.js"></script>
