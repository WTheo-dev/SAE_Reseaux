<?php
require_once "jwt_util.php";
require_once "fonctions.php";
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
    default:
    case 'GET':
        try {
            $RETURN_CODE = 200;

            if (isset($_GET['id_fiche'])) {
                $STATUS_MESSAGE = "Voici une fiche :";
                $matchingData = uneFicheIntervention($_GET['id_fiche']);
                if ($matchingData === null) {
                    throw new UnexpectedValueException("Aucune fiche n'a été trouvé avec l'ID spécifié");
                }
            } else {
                $STATUS_MESSAGE = "Voici la liste des fiches :";
                $matchingData = listeFiche();
            }
        } catch (\Throwable $th) {
            $RETURN_CODE = $th->getCode();
            $STATUS_MESSAGE = $th->getMessage();
            $matchingData = null;
        } finally {
            deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        }
        $STATUS_MESSAGE = "Méthode HTTP non autorisée";
        $matchingData = null;
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

    case 'POST':
        $matchingData = null;
        if (ficheInterventionDejaExistante($data['numero'])) {
            $RETURN_CODE = 400;
            $STATUS_MESSAGE = "Création Impossible de la fiche pour cause de fiche déjà existante";
        } else {
            if (
                creationFiche(
                    $data['numero'],
                    $data['nom_du_demandeur'],
                    $data['date_demande'],
                    $data['date_intervention'],
                    $data['duree_intervention'],
                    $data['localisation'],
                    $data['description_demande'],
                    $data['degre_urgence'],
                    $data['type_intervention'],
                    $data['nature_intervention'],
                    $data['couleur_intervention'],
                    $data['etat_fiche'],
                    $data['date_creation'],
                    $data['id_apprenti'],
                    $data['id_personnel']
                )
            ) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Création de la fiche d'intervention correctement effectué.";
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Création de la fiche d'intervention impossible ";
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
            if (
                modifierFiche(
                    $id_fiche,
                    $data['numero'],
                    $data['nom_du_demandeur'],
                    $data['date_demande'],
                    $data['date_intervention'],
                    $data['duree_intervention'],
                    $data['localisation'],
                    $data['description_demande'],
                    $data['degre_urgence'],
                    $data['type_intervention'],
                    $data['nature_intervention'],
                    $data['couleur_intervention'],
                    $data['etat_fiche'],
                    $data['date_creation'],
                    $data['id_apprenti'],
                    $data['id_personnel']
                )
            ) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour de la fiche effectuée";
                $matchingData = null;
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou id_fiche invalide";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié, 
            la méthode HTTP appropriée, ou l'id_fiche est manquant";
        }
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

}