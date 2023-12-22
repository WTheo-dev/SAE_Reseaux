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
        if ($role == 1 || 3 || 4) {
            try {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Voici la liste des Fiche :";
                $matchingData = listeFiche();
            } catch (\Throwable $th) {
                $RETURN_CODE = $th->getCode();
                $STATUS_MESSAGE = $th->getMessage();
                $matchingData = null;
            } finally {
                deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
            }
        } else {
            deliver_response(403, "Echec, le rôle n'est pas autorisé pour avoir accès à ces données", null);
        }
        break;


    case 'POST':

    case 'DELETE':
        if ($role == 1 || 3 || 4) {
            $id_fiche = $_GET['id_fiche'];

            if ($id_personnel) {
                $result = supprimerFiche($id_fiche);
                if ($result === true) {
                    $RETURN_CODE = 200; 
                    $STATUS_MESSAGE = "La fiche à correctement été supprimé.";
                    $matchingData = null;
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Cette fiche n'existe pas ou à déja été supprimé";
                    $matchingData = null;
                }
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "L'ID de la fiche est requise.";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
        }

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

    case 'PUT':
}
