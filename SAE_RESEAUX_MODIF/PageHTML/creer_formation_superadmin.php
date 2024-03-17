<?php
include_once "../../APIFinale/fonctions.php";
$formcreer = false;
if (isset($_POST["nom-form"])) {
    ajouterFormation($_POST["nom-form"], null, null);
    $formcreer = true;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer formation</title>
    <link rel="stylesheet" href="creer_formation_superadmin.css">
</head>
<body>
    <header class="header_page_creer_formation_superadmin">
        <div class="header_text"><img class="logo_page_creer_formation_superadmin"
        src="Image/APEAJ_color2.png" alt="pictogramme"></div>
        <div class="child-info">
            <h2 class="header_page_creer_formation_superadmin">Nom Prénom du SuperAdmin</h2>
        </div>
    </header>

    <?php if ($formcreer): ?>
        <h2>Formations : "<?php echo $_POST["nom-form"]; ?>" crée avec succée.</h2>
    <?php endif; ?>

    <h1>Choisissez la formation que vous voulez créer</h1>

    <div class="button-container">

        <form action="creer_formation_superadmin.php" method="post">
            <input type="text" name="nom-form" value="Entrez nom formations"/>
            <button type="submit">enregistrez</button>
        </form>
    </div>

    <div class="btn_retour-container">
        <button class="btn_retour" onclick="redirectTo('page_postco_superadmin.php')">Retour</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var buttons = document.querySelectorAll('.service-button');
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    createFormation(button.getAttribute('data-page'));
                });
            });
        });

        function createFormation(page) {
            // You can customize the message as needed
            var message = "La formation " + page + " a bien été créée";

            // Display a popup with the message
            alert(message);

            // Optionally, you can redirect to the specified page
            // window.location.href = page;
        }

        function redirectTo(page) {
            window.location.href = page;
        }
    </script>

</body>
</html>
