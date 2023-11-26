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
            try {
                // Supposons que vous ayez des fonctions listeApprenti et listeEducateur
                $matchingData = [
                    'listeApprenti' => listeApprenti($role),
                    'listeEducateur' => listeEducateur($role),
                ];
    
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Succes ! Les données autorisées pour votre rôle sont accessibles";
            } catch (\Throwable $th) {
                $RETURN_CODE = $th->getCode();
                $STATUS_MESSAGE = $th->getMessage();
                $matchingData = null;
            } finally {
                deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
            }
        } else {
            // Gérer le cas où le rôle n'est pas égal à 2
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Accès refusé. Vous n'avez pas les autorisations nécessaires.";
            deliver_response($RETURN_CODE, $STATUS_MESSAGE, null);
        }
        break;
    
    case 'POST':

    case 'DELETE':

    case 'PUT':
}
