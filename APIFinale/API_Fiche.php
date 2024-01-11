<?php
require_once("jwt_util.php");
require_once("fonctions.php");
header("Content-Type:application/json");
$http_method = $_SERVER['REQUEST_METHOD'];

$bearer_token = get_bearer_token();
if (is_jwt_valid($bearer_token, "pass")) {
    $decoded_jwt = get_body_token($bearer_token);
    $role = $decoded_jwt['role'];
    $utilisateur = $decoded_jwt['utilisateur'];
} else {
    deliver_response(403, "Connexion obligatoire", null);
    die("Acces echoue");
}

$postedData = file_get_contents('php://input');
$data = json_decode($postedData, true);

switch ($http_method) {

    case 'GET':
        try {
            $RETURN_CODE = 200;
            $STATUS_MESSAGE = "Voici la liste des fiches :";
            $matchingData = listeFiche();
        } catch (\Throwable $th) {
            $RETURN_CODE = $th->getCode();
            $STATUS_MESSAGE = $th->getMessage();
            $matchingData = null; 
        }
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;


    case 'POST':
        if ($role == 3) {
            // Récupérer les données du formulaire
            $numero = $_POST['numero']; // Assurez-vous que les noms correspondent à ceux du formulaire
            $nom_du_demandeur = $_POST['nom_du_demandeur'];
            $date_demande = $_POST['date_demande'];
            $date_intervention = $_POST['date_intervention'];
            $duree_intervention = $_POST['duree_intervention'];
            $localisation = $_POST['localisation'];
            $description_demande = $_POST['description_demande'];
            $degre_urgence = $_POST['degre_urgence'];
            $type_intervention = $_POST['type_intervention'];
            $nature_intervention = $_POST['nature_intervention'];
            $couleur_intervention = $_POST['couleur_intervention'];
            $etat_fiche = $_POST['etat_fiche'];
            $date_creation = $_POST['date_creation'];

            // Appeler la fonction pour créer la fiche d'intervention
            $resultat_creation = creerFiche($numero, $nom_du_demandeur, $date_demande, $date_intervention, $duree_intervention, $localisation, $description_demande, $degre_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_creation);

            // Vérifier le résultat de la création de la fiche
            if ($resultat_creation === true) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "La fiche a été correctement créée.";
                $matchingData = null;
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Cette fiche existe déjà.";
                $matchingData = null;
            }
        }
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;



    case 'DELETE':
        if ($role == 2) {
            $id_fiche = $_GET['id_fiche'];
            if ($id_fiche) {
                $result = supprimerFiche($id_fiche);
                if ($result === true) {
                    $RETURN_CODE = 200;
                    $STATUS_MESSAGE = "La fiche a été correctement supprimée.";
                    $matchingData = null;
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Cette fiche n'existe pas ou a déjà été supprimée.";
                    $matchingData = null;
                }
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "L'ID de la fiche est requis.";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié.";
        }
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;


    case 'PUT':
        $matchingData = null;
        if ($role == 1 || $role == 3) {
            $id_fiche = $_GET['id_fiche'];
            $data = array(
                'numero' => $numero,
                'nom_du_demandeur' => $nom_du_demandeur,
                'date_demande' => $date_demande,
                'date_intervention' => $date_intervention,
                'duree_intervention' => $duree_intervention,
                'localisation' => $localisation,
                'description_demande' => $description_demande,
                'degre_urgence' => $degre_urgence,
                'type_intervention' => $type_intervention,
                'nature_intervention' => $nature_intervention,
                'couleur_intervention' => $couleur_intervention,
                'etat_fiche' => $etat_fiche,
                'date_creation' => $date_creation
            );

            if (modifierFiche($id_fiche, $data)) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour de la fiche effectuée";
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou id_fiche invalide";
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié, la méthode HTTP appropriée, ou l'id_fiche est manquant";
        }
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

}
