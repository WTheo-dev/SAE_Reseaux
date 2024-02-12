<?php
include_once "../../APIFinale/fonctions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_apprenti = $_POST['id_apprenti'];
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrenom = $_POST['nouveauPrenom'];

    // Ajoutez des messages de débogage ici
    echo "ID Apprenti: $id_apprenti, Nouveau Nom: $nouveauNom, Nouveau Prénom: $nouveauPrenom";

    // Appelez votre fonction de mise à jour depuis votre API
    modifierApprenti($id_apprenti, $nouveauNom, $nouveauPrenom);
}
?>
