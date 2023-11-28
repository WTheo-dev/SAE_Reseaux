<?php

require_once("jwt_util.php");
require_once("fonctions.php");

$header = array("alg" => "HS256", "typ" => "JWT");
$cle = "pass";
header("Content-Type:application/json");
$methodeHTTP = $_SERVER['REQUEST_METHOD'];

$STATUS_MESSAGE = "";

switch ($methodeHTTP) {

case "POST":
    try {
        $postedData = file_get_contents('php://input');
        $data = json_decode($postedData, true);

        if (empty($data['login']) || empty($data['mdp'])) {
            $body = array("role" => "", "utilisateur" => "", "exp" => (time() + 600));
            $RETURN_CODE = 201;
        } else {
            if (identification($data['login'], $data['mdp'])) {
                $RETURN_CODE = 201;
                $role = recuperation_role($data['login']);
                $body = array("role" => $role, "utilisateur" => $data['login'], "exp" => (time() + 600));

                // Créer un token JWT en utilisant la fonction generate_jwt (assurez-vous qu'elle est définie)
                $matchingData = generate_jwt($header, $body, $cle);
            } else {
                $RETURN_CODE = 400;
                $STATUS_MESSAGE = "Identifiant incorrect";
                $matchingData = null;
                echo "Identification a échoué.";
                var_dump($data['login'], $data['mdp']);
            }
        }

        if ($RETURN_CODE < 400) {
            $STATUS_MESSAGE = "Connection valide";
        }

    } catch (\Throwable $th) {
        $RETURN_CODE = $th->getCode();
        $STATUS_MESSAGE = $th->getMessage();
        $matchingData = null;
    } finally {
        deliver_response($RETURN_CODE, $STATUS_MESSAGE, $matchingData);
    }
    break;

default:
    deliver_response(405, "not implemented method", null);
    break;

?>
