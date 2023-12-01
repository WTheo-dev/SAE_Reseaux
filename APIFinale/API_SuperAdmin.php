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
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Voici la liste des Apprentis :";
                $matchingData = listeApprenti();
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



    case 'POST':
        $matchingData = null;

        if ($role == 2) {
            if (inscriptionApprenti($data['nom'], $data['prenom'], $data['photo'])) {
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

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);

    case 'DELETE':
        if ($role == 2) {
            // Récupérer l'ID de l'apprenti depuis les paramètres de l'URL
            $id_apprenti = $_GET['id_apprenti'];

            // Vérifier si l'ID de l'apprenti est fourni
            if ($id_apprenti) {
                // Appeler la fonction de suppression
                $result = supprimerApprenti($id_apprenti);
                // Vérifier le résultat de la fonction
                if ($result === true) {
                    // Réponse en cas de succès
                    $RETURN_CODE = 200; // No Content
                    $STATUS_MESSAGE = "L'apprenti a été supprimé avec succès.";
                    $matchingData = null;
                } else {
                    // Réponse en cas d'échec
                    $RETURN_CODE = 400; // Not Found
                    $STATUS_MESSAGE = "L'apprenti n'existe pas ou à déjà été supprimé";
                    $matchingData = null;
                }
            } else {
                // Réponse en cas de manque d'ID de l'apprenti
                $RETURN_CODE = 400; // Bad Request
                $STATUS_MESSAGE = "L'ID de l'apprenti est requis.";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
        }


        // Appeler la fonction deliver_response
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);

    case 'PUT':
        $matchingData = null;

        if ($role == 2) {
            $id_apprenti = $_GET['id_apprenti'];


            if (modifierApprenti($id_apprenti, $data['nom'], $data['prenom'], $data['photo'])) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour de l'Apprenti effectuée";
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou id_apprenti invalide";
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié, la méthode HTTP appropriée ou l'id_apprenti est manquant";
        }

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);


        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);


}