<?php
include_once "../../APIFinale/fonctions.php";

$materiau = $_POST['materiau'];
$numero = $_POST['numero'];

$conn = connexionBD();
$sql = "INSERT INTO materiaux table (materiau, numero) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$materiau, $numero]);
$conn = null;

echo "Matériau enregistré avec succès !";
?>
