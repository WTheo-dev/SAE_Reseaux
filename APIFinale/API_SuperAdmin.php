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
        if ($role == 2) {
            switch ($utilisateur) {
                case 'apprenti':
                    $matchingData = listeApprenti();
                    break;
                case 'personnel':
                    $matchingData = listePersonnel();
                    break;
                default:
                    $matchingData = null;
            }
        }
        try {
            $RETURN_CODE = 200;
            $STATUS_MESSAGE = "Succes ! Les donnees autorisees pour votre role sont accessibles";
        } catch (\Throwable $th) {
            $RETURN_CODE = $th->getCode();
            $STATUS_MESSAGE = $th->getMessage();
            $matchingData = null;
        } finally {
            deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        }
        break;


    case 'POST':
        $matchingData = null;
        $utilisateur = isset($_GET['apprenti']) ? $_GET['personnel'] : '';

        if ($role == 2) {
            switch ($utilisateur) {
                case 'apprenti':
                    if (inscriptionApprenti($data['nom'],$data['prenom'],$data['photo'])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Ajout Apprenti effectué";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur de syntaxe";
                    }
                    break;

                case 'personnel':
                    if (inscriptionPersonnel($data)) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Ajout Personnel effectué";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur de syntaxe";
                    }
                    break;

                default:
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Type d'utilisateur non valide";
                    break;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
        }

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);

    case 'DELETE':
        $matchingData = null;
        $utilisateur = isset($_GET['apprenti']) ? $_GET['personnel'] : '';
        if ($role == 2) {
            switch ($utilisateur) {
                case 'apprenti':
                    if (supprimerApprenti($_GET['id_apprenti'])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Suppression Apprenti effectuée";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur de Syntaxe";
                    }
                    break;

                case 'personnel':
                    if (supprimerPersonnel($_GET['id_personnel'])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Suppression Personnel effectuée";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur de Syntaxe";
                    }
                    break;

                default:
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Type d'utilisateur non valide";
                    break;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
        }

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);

        break;




    case 'PUT':


}