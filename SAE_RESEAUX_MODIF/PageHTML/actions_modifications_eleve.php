<?php
// Inclure votre fichier contenant les fonctions
include_once '../../APIFinale/fonctions.php';

// Vérifier si l'action est définie et effectuer l'action appropriée
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'modifier':
            if (isset($_POST['idApprenti'])) {
                $idApprenti = $_POST['idApprenti'];
                modifierApprenti($idApprenti,$nom, $prenom, $photo);
                // Répondre si nécessaire
            }
            break;

        case 'supprimer':
            if (isset($_POST['idApprenti'])) {
                $idApprenti = $_POST['idApprenti'];
                $resultat = supprimerApprenti($idApprenti);
                // Répondre à la demande Ajax avec le résultat
                if ($resultat) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false));
                }
            }
            break;

        default:
            // Gérer les actions inconnues si nécessaire
            break;
    }
}
?>