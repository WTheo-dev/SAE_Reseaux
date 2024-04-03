<?php
session_start();
include_once "../../APIFinale/fonctions.php";
if (!isset($_SESSION['superadmin'])) {
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="creer_cours_superadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-FawF8f7ovfA67zceqO8n+J3/z21S0g9/jeLiNgO7tn5z1eGrLJpRgz7XKL2eJpaOkt2tsQv7GfADmACuRvZ2eQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header_page_creer_cours_superadmin">
        <div class="header_text"><img class="logo_page_creer_cours_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
        <div class="child-info">
            <h2 class="header_page_creer_cours_superadmin">Nom Prénom du SuperAdmin</h2>
        </div>
    </header>

    <h1>Choisissez le cours que vous voulez créer</h1>

    <form action="fiche_base.php" method="post">
    <label for="categorie">Choisissez la catégorie :</label>
    <select name="categorie" id="categorie">
        <option value="Finition">Finition</option>
        <option value="Plomberie">Plomberie</option>
        <option value="Aménagement d'intérieur">Aménagement d'intérieur</option>
        <option value="Serrurerie">Serrurerie</option>
        <option value="Electricite">Électricité</option>
    </select>
    <input type="hidden" name="description_demande" id="description_demande">
    <button type="submit">Créer le cours</button>
</form>

    

    <div class="btn_deconnexion-container">
        <button class="btn_deconnexion" onclick="redirectTo('page_postco_superadmin.php')">Retour</button>
    </div>

    <script>
    function updateDescriptionDemande() {
        var categorie = document.getElementById("categorie").value;
        document.getElementById("description_demande").value = categorie;
    }

    document.getElementById("categorie").addEventListener("change", updateDescriptionDemande);
    
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>

    

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js" integrity="sae_reseaux" crossorigin="anonymous"></script>

    

</body>

</html>
