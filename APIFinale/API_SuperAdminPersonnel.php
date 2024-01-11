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
            if(isset($_GET['id_personnel'])) {
                try {
                    $RETURN_CODE = 200;
                    $STATUS_MESSAGE= "Voici le personnel :";
                    $matchingData = unPersonnel($_GET['id_personnel']);
                } catch (\Throwable $th) {
                    $RETURN_CODE = $th ->getCode();
                    $STATUS_MESSAGE = $th ->getMessage();
                    $matchingData =null;
                } finally {
                    deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
                }
            } else {
            try {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Voici la liste des Personnel :";
                $matchingData = listePersonnel();
            } catch (\Throwable $th) {
                $RETURN_CODE = $th->getCode();
                $STATUS_MESSAGE = $th->getMessage();
                $matchingData = null;
            } finally {
                deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
            }
           }
        } else {
            deliver_response(403, "Echec, le rôle n'est pas autorisé pour avoir accès à ces données", null);
        }
        break;



        case 'POST':
            $matchingData = null;
        
            // Vérifiez si l'utilisateur a le rôle approprié (supposons que $role et $id_utilisateur soient définis)
            if ($role == 2) {
                // Assurez-vous que les clés nécessaires existent dans $data
                if (isset($data['nom'], $data['prenom'], $data['login'], $data['mdp'], $data['id_role'])) {
                    // Appel à la fonction inscriptionPersonnel
                    if (inscriptionPersonnel($data['nom'], $data['prenom'], [
                        'login' => $data['login'],
                        'mdp' => $data['mdp'],
                        'id_role' => $data['id_role']
                    ])) {
                        $RETURN_CODE = 200;
                        $STATUS_MESSAGE = "Ajout Personnel effectué";
                    } else {
                        $RETURN_CODE = 400;
                        $STATUS_MESSAGE = "Erreur lors de l'ajout de l'apprenti";
                    }
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Données manquantes dans la requête";
                }
            } else {
                $RETURN_CODE = 403;
                $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
            }
        
            // Envoi de la réponse
            deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
            break;

    case 'DELETE':
        if ($role == 2) {
            $id_personnel = $_GET['id_personnel'];

            if ($id_personnel) {
                $result = supprimerPersonnel($id_personnel);
                if ($result === true) {
                    $RETURN_CODE = 200; 
                    $STATUS_MESSAGE = "Le personnel a été supprimé avec succès.";
                    $matchingData = null;
                } else {
                    $RETURN_CODE = 400;
                    $STATUS_MESSAGE = "Le personnel n'existe pas ou à déjà été supprimé";
                    $matchingData = null;
                }
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "L'ID du personnel est requis.";
                $matchingData = null;
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié";
        }

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;

    case 'PUT':
        $matchingData = null;

        if ($role == 2) {
            $id_personnel = $_GET['id_personnel'];
            if (modifierPersonnel($id_personnel, $data['nom'], $data['prenom'])) {
                $RETURN_CODE = 200;
                $STATUS_MESSAGE = "Mise à jour du Personnel effectuée";
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Erreur de syntaxe ou id_personnel invalide";
            }
        } else {
            $RETURN_CODE = 403;
            $STATUS_MESSAGE = "Vous ne possédez pas le rôle approprié, la méthode HTTP appropriée ou l'id_personnel est manquant";
        }

        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
        break;
}