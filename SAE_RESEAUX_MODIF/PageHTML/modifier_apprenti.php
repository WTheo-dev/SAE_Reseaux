<?php
session_start();
include_once "../../APIFinale/fonctions.php";
if (!isset($_SESSION['superadmin'])) {
    header('Location: index.php');
    exit();
}

// Vérification si l'ID de l'élève est passé en paramètre
if(isset($_GET['id_apprenti'])) {
    // Récupération de l'ID de l'élève
    $idApprenti = $_GET['id_apprenti'];

    // Récupération des informations de l'élève depuis la base de données
    $bd = connexionBD();
    $requete = $bd->prepare('SELECT nom, prenom FROM apprenti WHERE id_apprenti = ?');
    $requete->execute([$idApprenti]);
    $eleve = $requete->fetch(PDO::FETCH_ASSOC);

    // Si l'élève existe, récupération de son nom et prénom
    if($eleve) {
        $ancienNom = $eleve['nom'];
        $ancienPrenom = $eleve['prenom'];
    } else {
        echo "L'élève avec l'ID spécifié n'existe pas.";
        exit();
    }
} else {
    echo "ID de l'élève non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modification compte élève</title>
</head>

<body class="body_creercompteleve">

    <header class="header-connexion-eleve">
        <div class="logo">
            <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
        </div>
    </header>

    <main>
        <form action="modifier_apprenti_traitement.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_apprenti" value="<?php echo $idApprenti; ?>">
            <div class="rectangle3_creercompteeleve">
                <label class="nom_prenom_creereleve" for="nom-prenom">Nom et Prénom de l'élève:</label>
                <input name="nouveauNom" class="input_creercompteeleve" type="text" id="nom-prenom" value="<?php echo $ancienNom; ?>">
                <input name="nouveauPrenom" class="input_creercompteeleve" type="text" id="nom-prenom" value="<?php echo $ancienPrenom; ?>">
            </div>

            <div id="container">
                <div id="lock-container">
                    <div id="lock-screen" class="lock-screen">
                        <?php for ($i = 1; $i <= 9; $i++) { ?>
                            <div class="lock-dot">
                                <input type="checkbox" id="<?php echo $i; ?>" name="digit<?php echo $i; ?>" style="display: none;">
                                <label for="<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="btn_creercompteleve2">
                <button type="submit" id="btn-valider-creation-eleve">Modifier le compte de l'élève</button>
            </div>
        </form>
    </main>

    <script src="creer_compte_eleve.js"></script>
</body>

</html>
