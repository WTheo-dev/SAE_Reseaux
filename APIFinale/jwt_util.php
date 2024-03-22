<?php

function generateJwt($headers, $payload, $secret = 'secret')
{
    $headersEncoded = base64url_encode(json_encode($headers));

    $payloadEncoded = base64url_encode(json_encode($payload));

    $signature = hash_hmac('SHA256', "$headersEncoded.$payloadEncoded", $secret, true);
    $signatureEncoded = base64url_encode($signature);

    return "$headersEncoded.$payloadEncoded.$signatureEncoded";
}

function isJwtValid($jwt, $secret = 'secret')
{
    // split the jwt
    $tokenParts = explode('.', $jwt);
    $header = base64_decode($tokenParts[0]);
    $payload = base64_decode($tokenParts[1]);
    $signatureProvided = $tokenParts[2];

    // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
    $expiration = json_decode($payload)->exp;
    $isTokenExpired = ($expiration - time()) < 0;

    // build a signature based on the header and payload using the secret
    $base64UrlHeader = base64url_encode($header);
    $base64UrlPayload = base64url_encode($payload);
    $signature = hash_hmac('SHA256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
    $base64UrlSignature = base64url_encode($signature);

    // verify it matches the signature provided in the jwt
    $isSignatureValid = ($base64UrlSignature === $signatureProvided);

    return (!$isTokenExpired && $isSignatureValid) ? true : false;
}

function base64urlEncode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function getAuthorizationHeader()
{
    $headers = null;

    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions
        // (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords',array_keys($requestHeaders)),array_values($requestHeaders));
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }

    return $headers;
}

function getBearerToken()
{
    $headers = getAuthorizationHeader();

    // HEADER: Get the access token from the header
    if (!empty($headers) && preg_match('/Apeaj\s(\S+)/', $headers, $matches)) {
        return $matches[1];
    }
    return null;
}


