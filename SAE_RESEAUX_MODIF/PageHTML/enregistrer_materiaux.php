<?php
include_once "../../APIFinale/fonctions.php";

// Vérification de l'existence des données POST
if(isset($_POST['materiau']) && isset($_POST['numero'])) {
    $materiau = $_POST['materiau'];
    $numero = $_POST['numero'];

    // Connexion à la base de données
    $conn = connexionBD();
    
    // Préparation de la requête SQL
    $sql = "INSERT INTO materiaux (materiau, numero) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Exécution de la requête avec les données fournies
    $stmt->execute([$materiau, $numero]);

    // Vérification de l'opération d'insertion
    if($stmt->rowCount() > 0) {
        echo "Matériau enregistré avec succès !";
    } else {
        echo "Erreur lors de l'enregistrement du matériau.";
    }

    // Fermeture de la connexion à la base de données
    $conn = null;
} else {
    echo "Erreur : données manquantes.";
}
?>
