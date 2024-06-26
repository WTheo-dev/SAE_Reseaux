<?php ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <title>Formulaire de Reinitialisation</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body class ="body_mdpsoubliésuperadmin">
    <div class="reset-form_mdpsoubliésuperadmin">
        <h2 class="h2_mdpsoubliésuperadmin">Réinitialiser le mot de passe</h2>
        <form action="mot_de_passe_oublie_superadmin.php" method="post" id="reset-form">
            <input class="input_mdpsoubliésuperadmin" type="email" name="email" id="email" placeholder="Email" required>
            <input class="input_mdpsoubliésuperadmin2" type="reset" value="Réinitialiser" id="reset-button">
            <input class="input_mdpsoubliésuperadmin2" type="reset" value="Annuler" id="cancel-button">
        </form>
    </div>


 
    <div class="modal_mdpsoubliésuperadmin" id="myModal">
        <div class="modal_mdpsoubliésuperadmin-content">
            <span id="modal-close">&times;</span>
            <h3>Mot de passe réinitialise</h3>
            <p>Vous avez réçu un email pour réinitialiser votre mot de passe.</p>
            <a href="connexion_superadmin.php">Retour à la page de connexion</a>
        </div>
    </div>


 
<script src="mot_de_passe_oublie_superadmin.js"></script>
</body>
</html>
