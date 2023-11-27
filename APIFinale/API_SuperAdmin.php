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

    case 'POST':
        $utilisateur = isset($_GET['apprenti']) ? $_GET['personnel'] : ''; 
        switch ($_GET['utilisateur']) {
            case 'apprenti':
                if ($role == 2) {
                    if (inscriptionApprenti($data[''])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Ajout Apprenti effectué";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur de syntaxe";
                    }
                } else {
                    $RETURN_CODE = 403;
                    $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
                }
                break;
        
            case 'educateur':
                if ($role == 2) {
                    if (inscriptionEducateur($data[''])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Ajout Educateur effectué";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur de syntaxe";
                    }
                } else {
                    $RETURN_CODE = 403;
                    $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
                }
                break;
        
            default:
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Type d'utilisateur non valide";
                break;
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
        
                case 'educateur':
                    if (supprimerEducateur($_GET['id_personnel'])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Suppression Educateur effectuée";
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