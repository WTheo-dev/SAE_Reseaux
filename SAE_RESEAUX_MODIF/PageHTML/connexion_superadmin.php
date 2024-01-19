<?php
// Inclure les dépendances nécessaires (jwt_utils.php et fonctions.php)
require_once("../../APIFinale/jwt_util.php");
require_once("../../APIFinale/fonctions.php");

    // Définir l'algorithme de signature, la clé secrète, et initialiser la session
    $header = array("alg" => "HS256", "typ" => "JWT");
    $key = "pass";
    session_start();

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            // Récupérer les données du formulaire
            $nom_utilisateur = isset($_POST['nom_utilisateur']) ? $_POST['nom_utilisateur'] : '';
            $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

            // Vérifier les champs du formulaire
            if (empty($nom_utilisateur) || empty($mdp)) {
                throw new Exception("Veuillez remplir tous les champs du formulaire.");
            }

            // Vérifier les informations d'identification
            if (identification($nom_utilisateur, $mdp)) {
                // Créer le corps du JWT
                $duree = 2592000; // Durée du token en secondes (30 jours dans cet exemple)
                $body = array(
                    "role" => recuperation_role($nom_utilisateur),
                    "utilisateur" => $nom_utilisateur,
                    "exp" => (time() + $duree)
                );

                // Générer le token JWT
                $token = generate_jwt($header, $body, $key);

                // Stocker le token dans la session
                $_SESSION['jwt_token'] = $token;

                // Rediriger vers index.php
                header("Location: index.php");
                exit;
            } else {
                throw new Exception("Identifiant incorrect. Veuillez vérifier vos informations de connexion.");
            }
        } catch (Exception $e) {
            $erreur_message = $e->getMessage();
        }
    }
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">  
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<header class="header-connexion-eleve">
    <div class="logo">
      <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
    </div>
  </header>
<body class="body-superadmin">
    <div class="superadmin-wrapper">
        <form action="page_postco_superadmin.php" method="post">
            <h1>Se connecter</h1>
            <div class="superadmin-input-box">
                <input type="text" placeholder="prenom.nom" name="id" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="superadmin-input-box">
                <input type="password" placeholder="Mot de passe" name="mdp" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="superadmin-remember-forgot">
                <label><input type="checkbox" name="remember"> Se souvenir de moi</label>
                <a href="mot_de_passe_oublie_superadmin.html"> Mot de passe oublié ?</a>
            </div>

            <button a type="submit" class="superadmin-btn">Se connecter</button>
           
            <script src="connexion_superadmin.js"></script>
            <button id="back-button" onclick="goBack()">Retour</button>
            </div>
        </form>
       
    </div>
    
</body>
</html>