<?php
include_once("../../APIFinale/fonctions.php");
$forms = listeFormations();
var_dump($forms);
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
        <div class="header_text"><img class="logo_page_creer_formation_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
        <div class="child-info">
            <h2 class="header_page_creer_formation_superadmin">Nom Prénom du SuperAdmin</h2>
        </div>
    </header>

    <h1>Choisissez la formation que vous voulez créer</h1>

<!--
Agent Maintenance de Batiment
Agent De Restauration
Employe Technicien Vendeur En Materiel de Sport
Ouvrier Paysage
-->

    <div class="button-container">
        <?php foreach ($forms as $form): ?>
        <button class="service-button" data-page="<?php echo $form['Intitulé de la Formation'] ?>"><?php echo $form['Intitulé de la Formation'] ?></button>
        <?php endforeach; ?>
        <!--
        <button class="service-button" data-page="Agent Maintenance de Batiment">Agent de maintenance des bâtiments</button>
        <button class="service-button" data-page="Agent De Restauration">Agent de restauration</button>
        <button class="service-button" data-page="Employe Technicien Vendeur En Materiel de Sport">Employé technicien vendeur en matériel de sport</button>
        <button class="service-button" data-page="Ouvrier Paysage">Ouvrier du paysage</button>
        -->
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
