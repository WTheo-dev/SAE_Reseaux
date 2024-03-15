<?php
include_once "../../APIFinale/fonctions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idApprenti = $_POST['id_apprenti'];
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrenom = $_POST['nouveauPrenom'];
    $nouvellePhoto = $_POST['nouvellephoto'];

    // Ajoutez des messages de débogage ici
    echo "ID Apprenti: $idApprenti, Nouveau Nom: $nouveauNom, Nouveau Prénom: $nouveauPrenom, Nouvelle photo: $nouvellePhoto";

    // Appelez votre fonction de mise à jour depuis votre API
    modifierApprenti($idApprenti, $nouveauNom, $nouveauPrenom, $nouvellePhoto);
}
?>
