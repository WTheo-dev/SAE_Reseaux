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
        
            if (isset($_GET['cours'])) {
                $STATUS_MESSAGE = "Voici un cours :";
                $matchingData = unCours($_GET['cours']);
                if ($matchingData === null) {
                    throw new UnexpectedValueException("Aucun Cours n'a été trouvé avec l'ID spécifié");
                }
            } else {
                $STATUS_MESSAGE = "Voici la liste des cours :";
                $matchingData = ListeCours();
            }
        } catch (\Throwable $th) {
            $RETURN_CODE = $th ->getCode();
            $STATUS_MESSAGE = $th->getMessage();
            $matchingData = null;
        } finally {
            deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        }
        break;

    case 'POST':
        $matchingData=null;
        if (CreationCours($data['theme'], $data['cours'], $data['duree'], $data['id_formation'])) {
            $RETURN_CODE = 200;
            $STATUS_MESSAGE = "Création de la session correctement effectué.";
        } else {
            $RETURN_CODE = 400;
            $STATUS_MESSAGE = "Création de la session d'intervention impossible ";
        }
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;
    
    
    case 'DELETE':
        if ($role == 2) {
            $id_session = $_GET['id_session'];
            if ($id_session) {
                $result = SuppressionCours($id_session);
                if ($result === true) {
                    $RETURN_CODE = 200;
                    $STATUS_MESSAGE = "La session a été correctement supprimée.";
                    $matchingData = null;
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Cette session n'existe pas ou a déjà été supprimée.";
                    $matchingData = null;
                }
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "L'ID de la session est requis.";
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
        if ($role == 2 || $role == 3) {
            $id_session = $_GET['id_session'];
            if (ModificationCours($id_session, $data['theme'], $data['cours'], $data['duree'], $data['id_formation'])) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour de la session effectuée";
                $matchingData = null;
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou id_session invalide";
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
