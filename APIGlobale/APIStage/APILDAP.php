<?php
require_once("ldap.class.php");

header("Content-Type:application/json");
$http_method = $_SERVER['REQUEST_METHOD'];

if (!isset($_SERVER['REQUEST_METHOD']) || empty($_SERVER['REQUEST_METHOD'])) {
    http_response_code(500);
    echo json_encode(["error" => "REQUEST_METHOD is not set"]);
    exit();
}

// Fonction pour récupérer le header Authorization
function getAuthorizationHeader()
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } else if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return is_string($headers) ? $headers : null;
}

// Fonction pour extraire le token à partir du header Authorization
function getToken() {
    $headers = getAuthorizationHeader();

    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/WebAdminLDAPPhoneRouting\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}


$gest = new LDAPCalc();

try {
    switch ($http_method) {
        case 'GET':
            $token = getToken(); 
            if ($token === null) {
                $gest->logAction("No user", __FUNCTION__, "error 400: Token is null");
                throw new Exception("Token not found", 400);
            } else {
                echo $gest->verifToken($token);
            }
            break;
        case 'POST':
            $gest->authentication();
            break;
        default:
            header("HTTP/1.1 405 Method Not Allowed");
            header("Allow: GET, POST");
            break;
    }
} catch (Exception $e) {
    $gest->logAction("No user", __FUNCTION__, "error " . $e->getCode() . ": " . $e->getMessage());
    $http_def = $gest->setHttpHeaders("text/json", $e->getCode());
    echo json_encode(array("error" => $e->getMessage()));
}
?>