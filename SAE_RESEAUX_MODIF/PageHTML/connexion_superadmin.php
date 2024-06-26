<?php
session_start();
include_once '../../APIFinale/fonctions.php';

if (!isset($_SESSION['superadmin'])) {
    if (isset($_POST['id']) && isset($_POST['mdp'])) {
        $login = $_POST['id'];
        $mdp = $_POST['mdp'];
        if (connexionSuperAdmin($login, $mdp)) {
            $_SESSION['superadmin'] = $login;
            header('Location: page_postco_superadmin.php');
            exit();
        } else {
            echo "Identifiants invalides. Veuillez réessayer.";
        }
    }
} else {
    header('Location: page_postco_superadmin.php');
    exit();
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- Correction de l'action du formulaire -->
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
                <a href="mot_de_passe_oublie_superadmin.php"> Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="superadmin-btn">Se connecter</button> 

            <script src="connexion_superadmin.js"></script>
            <button type="button" id="back-button" onclick="goBack()">Retour</button>
            </div>
        </form>

    </div>

</body>
</html>
