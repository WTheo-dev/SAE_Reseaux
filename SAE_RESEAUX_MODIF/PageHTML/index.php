<?php
include_once "../../APIFinale/fonctions.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Page d'accueil</title>
</head>
<body class="body_p_d">
    <header class="header_p_d">
        <div class="header_text"><img class="logo_p_d" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
    </header>
   
    <main class="main_p_d">
        <h1 class="h1p_d">Bienvenue sur votre espace </h1>
        <h1 class="h1p_d_2"> scolaire !</h1>
        
        <div class="quoicoubeh">
            <p class= "test" id ="js-button-tts">Sélectionne ta photo</p>
        </div>

        <div id="liste_photo_p_d">
    <!-- Placeholder pour les photos d'élève -->
    <form id="apprenti_form" action="connexion_eleve.php" method="post">
        <?php
        $etus = listeApprenti();
        foreach ($etus as $etu) {
            echo "<button type='submit' name='id_apprenti' value='".$etu["id_apprenti"]."'>";
            echo "<img src='Image/etu/".$etu["photo"]."' alt='".$etu["prenom"]."'>";
            echo "<p class='p_pd'>" . strtoupper($etu["nom"]) . " " . $etu["prenom"] . "</p>";
            echo "</button>";
        }
        ?>
    </form>
</div>

<script>
    document.querySelectorAll('.apprenti_button').forEach(item => {
        item.addEventListener('click', event => {
            var idApprenti = event.target.value;
            document.getElementById('id_apprenti_input').value = idApprenti;
            document.getElementById('apprenti_form').submit();
        });
    });
</script>

    </main>
    <p class="p_p_d"> Ou connecte toi en tant que personnel</p>
    <div class="boutons">
        <button class="Connexion_admin"><a href="liste_educateur.php">Educateur</a></button>
        <button class="Connexion_superadmin"><a href="connexion_superadmin.php">Super-Admin</a></button>
    </div>
    <script src="page_daccueil.js"></script>
</body>
</html>
