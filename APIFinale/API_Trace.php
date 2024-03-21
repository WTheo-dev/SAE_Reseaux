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

            if (isset($_GET['intitule'])) {
                $STATUS_MESSAGE = "Voici une trace pour une fiche :";
                $matchingData = UneTrace($_GET['intitule']);
                if ($matchingData === null) {
                    throw new UnexpectedValueException("Aucune Trace n'a été trouvé avec l'ID spécifié");
                }
            } else {
                $STATUS_MESSAGE = "Voici la liste des traces :";
                $matchingData = listeTrace();
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
        if (
            ajouterTrace(
                $data['id_personnel'],
                $data['horadatage'],
                $data['intitule'],
                $data['eval_texte'],
                $data['commentaire_texte'],
                $data['eval_audio'],
                $data['commentaire_audio'],
                $data['id_fiche']
            )
        ) {
            $RETURN_CODE = 200;
            $STATUS_MESSAGE = "Création de la trace correctement effectué.";
        } else {
            $RETURN_CODE = 400;
            $STATUS_MESSAGE = "Création de la trace impossible ";
        }
        deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

    case 'PUT':
        $matchingData = null;
        if ($$role == 3) {
            $intitule = $_GET['intitule'];
            if (
                modificationTrace(
                    $data['id_personnel'],
                    $data['horadatage'],
                    $data['intitule'],
                    $data['eval_texte'],
                    $data['commentaire_texte'],
                    $data['eval_audio'],
                    $data['commentaire_audio'],
                    $data['id_fiche']
                )
            ) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour de la trace effectuée";
                $matchingData = null;
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou intitule invalide";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié,
            la méthode HTTP appropriée, ou l'id_fiche est manquant";
        }
        deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

    case 'DELETE':
        if ($role == 3 || $role == 5) {
            $intitule = $_GET['intitule'];
            if ($intitule) {
                $result = supprimerTrace($intitule);
                if ($result === true) {
                    $RETURN_CODE = 200;
                    $STATUS_MESSAGE = "La trace a été correctement supprimée.";
                    $matchingData = null;
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Cette trace n'existe pas ou a déjà été supprimée.";
                    $matchingData = null;
                }
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "L'ID de la trace est requis.";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié.";
        }
        deliverResponse($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;
}
