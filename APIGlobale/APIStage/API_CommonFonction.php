<?php

require_once("LDAPPhoneRoutingProvider.class.php");
require_once("PhoneRoutingProvider.php");
require_once("LDAP_Auth.class.php");
require_once("LDAP_Auth.php");
function checkAuth()
{
    $gestAuth = new LDAPAuthentificate();
    $resCheckAuth['token'] = getToken();
    if ($resCheckAuth['token'] === null) {
        $gestAuth->logAction("No user", __FUNCTION__, "error 400: Token is null");
        $resCheckAuth['auth'] = false;
        $resCheckAuth['userId'] = null;
    } else {
        $userId = $gestAuth->verifToken($resCheckAuth['token']);
        if($userId === null)
        {
            $gestAuth->logAction("No user", __FUNCTION__, "error 400: Token is wrong");
            $resCheckAuth['auth'] = false;
            $resCheckAuth['userId'] = $userId;
        }
        else
        {
            $resCheckAuth['auth'] = true;
            $resCheckAuth['userId'] = $userId ;
        }
    }

    return $resCheckAuth;
}

function deliver_response($status, $status_message, $authdata, $data = null)
{
    header("HTTP/1.1 $status $status_message");
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
    $response['authentification'] = $authdata;
    // print_r($response);
    try {
        $json_response = json_encode($response);
        echo $json_response;
    } catch (Exception $e) {
        echo ("deliver_response Exception\n");
        echo ($e->getCode() . " : " . $e->getMessage() . "\n");
    }

    exit();
}

?>