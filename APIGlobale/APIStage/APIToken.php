<?php
// Manages the API Token for clients
class ApiToken
{
    // Constant separator used to split token fields
    const FIELD_SEPARATOR = '*';

    // Generates a 16-byte (128-bit) initialization vector (IV) for AES encryption
    public static function buildAESIV() 
    {
        $iv_key = random_bytes(12);
        return base64_encode($iv_key);
    }

    // Generates a 256-bit encryption key for AES encryption
    public static function buildAESKey() 
    {
        $encrypt_key = random_bytes(32);
        return base64_encode($encrypt_key);
    }

    // Builds the token string using username, application, and expiry date
    public static function build($username, $application)
    {
        // Get current UTC date and time
        $date = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        // Add 1 hour to current date and time
        $expiryDate = $date->add(new DateInterval('PT1H'))->format('Y-m-d H:i:s T');
        // Build the token string by concatenating fields with separator
        $token = $application . ApiToken::FIELD_SEPARATOR . $username . ApiToken::FIELD_SEPARATOR . $expiryDate;
        return $token;
    }

    // Checks the validity of the given token string
    public static function check($token)
    {
        // Initialize result array with default values
        $result = ["success" => false, "errorCode" => -1, "errorMsg" => "", "username" =>"", "application" =>""];
        // If token is null, set error code and message and return
        if ($token == null)
        {
            $result['errorCode'] = -1;
            $result['errorMsg'] = "No token";
            return $result;
        }
        // Split token string into fields using separator
        $fields = explode(ApiToken::FIELD_SEPARATOR, $token);
        // If token has invalid number of fields, set error code and message and return
        if (count($fields) != 3)
        {
            $result['errorCode'] = -2;
            $result['errorMsg'] = "Invalid token";
            return $result;
        }
        // Extract the fields from token and store in result array
        $result['application'] = $fields[0];
        $result['username'] = $fields[1];
        $expiryDate = new DateTimeImmutable($fields[2]);
        // Calculate time difference between expiry date and current UTC date and time
        $date = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $timeDiff = $expiryDate->getTimestamp() - $date->getTimestamp();
        // If token has expired, set error code and message, else set success flag and error code
        if ($timeDiff < 0) 
        {
            $result['errorCode'] = -3;
            $result['errorMsg'] = "Token expired";
        } 
        else 
        {
            $result['success'] = true;
            $result['errorCode'] = 0;
        }
        return $result;
    }

    // Encrypts the given value using AES encryption with the specified method, IV, and key
    public static function encrypt($value, $method, $iv, $key)
    {
        $output = openssl_encrypt($value, $method, $key, 0, $iv);
        return base64_encode($output);
    }
    
    // Decrypts the given value using AES encryption with the specified method, IV, and key
    public static function decrypt($value, $method, $iv, $key)
    {
        $str = base64_decode($value);
        if ($str !== false) 
        {
            return openssl_decrypt($str, $method, $key, 0, $iv);
        }
        else 
        {
            return false;
        }
    }
}

?>