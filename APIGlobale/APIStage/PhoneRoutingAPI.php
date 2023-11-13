<?php
require_once("PhoneRoutingProvider.php");
require_once("LDAPPhoneRoutingProvider.class.php");
require_once("APIRest_CommonFunction.php");

header("Content-type:application/json");
$http_method = $_SERVER['REQUEST_METHOD'];
$phoneRoutingProvider = new LDAPPhoneRoutingProvider();
$authData = checkAuth();

if($authData['auth'] == true)
{
    $phoneRoutingProvider->Connect();
    switch ($http_method) {

        case "GET":
            if (isset($_GET['distinguishedName'])) {
                // Récupérer un endpoint individuel par son ID
                try {
                    $result = $phoneRoutingProvider->readEndpoint($_GET['distinguishedName']);
                    deliver_response(200, "Phone EndPoint found...", $authData, $result);
                } catch (Exception $e) {
                    echo ("GET Exception\n");
                    deliver_response($e->getCode(), $e->getMessage(), $authData);
                }
                echo json_encode($result);
            } else {
                // Récupérer la liste des endpoints
                try {
                    $result = $phoneRoutingProvider->readEndpointList();
                    deliver_response(200, "Phone Endpoint List found...", $authData, $result);

                } catch (Exception $e) {
                    echo ("GET Exception\n");
                    deliver_response($e->getCode(), $e->getMessage(), $authData);
                }

                echo json_encode($result);
            }
            break;

        case "PUT":
            // Read the JSON payload from the request body
            $put_vars = json_decode(file_get_contents("php://input"), true);
            // Check if the JSON payload is valid
            if ($put_vars !== null) {
                // Check if any required parameters are missing
                $required_params = array('lineNumber', 'displayName', 'lineType', 'lineManager', 'lineUsage', 'lineLocation', 'lineInternalNumber');
                $missing_params = array();
                foreach ($required_params as $param) {
                    if (!isset($put_vars[$param]) || empty($put_vars[$param])) {
                        $missing_params[] = $param;
                    }
                }

                if (count($missing_params) === 0) {
                    try {
                        $result = $phoneRoutingProvider->createEndpoint($put_vars['lineNumber'],$put_vars['displayName'], $put_vars['lineType'], $put_vars['lineManager'], $put_vars['lineUsage'], $put_vars['lineLocation'], $put_vars['lineInternalNumber'], $put_vars['lineRedirectionNumber']);
                        deliver_response(200, "PhoneEndPoint has been created...", $authData, $result);
                    }catch(Exception $e) {
                        echo"PUT Exception\n";
                        deliver_response($e->getCode(), $e->getMessage(), $authData);
                    }
                    echo json_encode($result);
                } else {
                    deliver_response(400, "Bad Request", "Missing Parameters", $authData);
                }
            } else {
                deliver_response(500, "Bad Request", "Invalid JSON payload.", $authData); 
            }
            break;


        case "POST":
            // Read the JSON payload from the request body
            $post_vars = json_decode(file_get_contents("php://input"), true);
            // Check if the JSON payload is valid
            if ($post_vars !== null) {
                // Check if any required parameters are missing
                $required_params = array('displayName', 'lineRedirectionNumber', 'lineType', 'lineManager', 'lineUsage', 'lineLocation', 'lineInternalNumber');
                $missing_params = array();
            
                foreach ($required_params as $param) {
                    if (!isset($post_vars[$param]) || empty($post_vars[$param])) {
                        $missing_params[] = $param;
                    }
                }
                
                if (count($missing_params) === 0 && isset($_GET['distinguishedName'])) {
                    try {
                        $result =$phoneRoutingProvider->updateEndpoint($_GET['distinguishedName'], $post_vars['displayName'],$post_vars['lineRedirectionNumber'], $post_vars['lineType'], $post_vars['lineManager'], $post_vars['lineUsage'], $post_vars['lineLocation'], $post_vars['lineInternalNumber']);
                        deliver_response(200, "PhoneEndpoint has been modify...", $authData, $result);
                    }catch(Exception $e) {
                        echo"POST Exception\n";
                        deliver_response($e->getCode(), $e->getMessage(), $authData);
                    }
                    echo json_encode($result);
                } else {
                    deliver_response(400, "Bad Request", "Missing Parameters : " . join(", ", $missing_params), $authData);
                }
            } else {
                deliver_response(500, "Bad Request", "Invalid JSON payload.", $authData);
            }
            break;

        case "DELETE":
            // Check if distinguishedName is defined in the request
            if (isset($_GET['distinguishedName'])) {
                try {
                    $result = $phoneRoutingProvider->deleteEndpoint($_GET['distinguishedName']);
                    deliver_response(200, "Phone EndPoint has been deleted.",$authData, $result);
                } catch (Exception $e) {
                    echo "DELETE Exception\n";
                    deliver_response($e->getCode(), $e->getMessage(), $authData);
                }
                echo json_encode($result);
            } else {
                deliver_response(400, "Bad Request", "The entryID' parameter is missing in the request.", $authData);
            }
            break;

        default:
            header("HTTP/1.1 405 Method Not Allowed");
            header("Allow: GET, POST, PUT, DELETE");
            break;
    }
}
else
{
    deliver_response(500, "Not authentificate", $authData);
}

?>