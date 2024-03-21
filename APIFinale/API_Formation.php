<?php
require_once "jwt_util.php";
require_once "fonctions.php";
header("Content-Type:application/json");
$http_method = $_SERVER['REQUEST_METHOD'];

$bearer_token = getBearerToken();
if (isJwtValid($bearer_token, "pass")) {
    $decoded_jwt = getBodyToken($bearer_token);
    $role = $decoded_jwt['role'];
    $utilisateur = $decoded_jwt['utilisateur'];
} else {
    deliverResponse(403, "Connexion obligatoire", null);
    die("Acces echoue");
}

$postedData = file_get_contents('php://input');
$data = json_decode($postedData, true);

switch ($http_method) {
    default:
    case 'GET':
        try {
            $RETURN_CODE = 200;

            if (isset($_GET['id_formation'])) {
                $STATUS_MESSAGE = "Voici la formation :";
                $matchingData = UneFormation($_GET['id_formation']);
                if ($matchingData === null) {
                    throw new UnexpectedValueException("Aucune Formation n'a été trouvé avec l'ID spécifié");
                }
            } else {
                $STATUS_MESSAGE = "Voici la liste des formations :";
                $matchingData = listeFormations();
            }
        } catch (\Throwable $th) {
            $RETURN_CODE = $th->getCode();
            $STATUS_MESSAGE = $th->getMessage();
            $matchingData = null;
        } finally {
            deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        }
        break;

    case 'POST':
        $matchingData = null;
        if (ajouterFormation($data['intitule'], $data['niveau_qualif'], $data['groupe'])) {
            $RETURN_CODE = 200;
            $STATUS_MESSAGE = "Création de la formation correctement effectué.";
        } else {
            $RETURN_CODE = 400;
            $STATUS_MESSAGE = "Création de la formation impossible ";
        }
        deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;


    case 'DELETE':
        if ($role == 2) {
            $id_formation = $_GET['id_formation'];
            if ($id_formation) {
                $result = suppresionFormation($id_formation);
                if ($result === true) {
                    $RETURN_CODE = 200;
                    $STATUS_MESSAGE = "La formation a été correctement supprimée.";
                    $matchingData = null;
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Cette formation n'existe pas ou a déjà été supprimée.";
                    $matchingData = null;
                }
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "L'ID de la formation est requis.";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié.";
        }
        deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

    case 'PUT':
        $matchingData = null;
        if ($role == 2) {
            $id_formation = $_GET['id_formation'];
            if (modifierFormation($id_formation, $data['intitule'], $data['niveau_qualif'], $data['groupe'])) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour de la formation effectuée";
                $matchingData = null;
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou id_formation invalide";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié, 
            la méthode HTTP appropriée, ou l'id_fiche est manquant";
        }
        deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;
}