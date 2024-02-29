<?php

require_once "jwt_util.php";
require_once "fonctions.php";

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
			if (empty($data['login']) and empty($data['mdp'])) {
				$body = array("role" => "", "utilisateur" => "", "exp" => (time() + 2592000)); // 1 mois = 30 jours * 24 heures * 60 minutes * 60 secondes
				$RETURN_CODE = 201;
			} else {
				if (identification($data['login'], $data['mdp'])) {
					$RETURN_CODE = 201;
					$duree = 2592000;
					$body = array(
						"role" => recuperation_role($data['login']),
						"utilisateur" => $data['login'],
						"exp" => (time() + $duree)
					);
				} else {
					$RETURN_CODE = 400;
					$STATUS_MESSAGE = "Identifiant incorrect";
					$matchingData = null;
				}
			}
			if ($RETURN_CODE < 400) {
				$STATUS_MESSAGE = "Connexion valide";
				$matchingData = generate_jwt($header, $body, $cle);
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
}
?>