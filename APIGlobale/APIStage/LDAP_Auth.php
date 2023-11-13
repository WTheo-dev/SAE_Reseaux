<?php
include_once("../config.php");
include_once("apitoken.class.php");
include_once("rest.class.php");

//manages the connection to LDAP server 
class LDAPCalc extends Rest
{

	// Logs a given action (uses UTC date format)
	public function logAction($source, $action, $result)
	{
		date_default_timezone_set('UTC');
		$path = LOG_PATH . "/ldap-" . date("Y-m-d") . ".log";
		$line = "[" . date('d-m-y h:i:s') . "]" . "\t" . $source . "\t" . $action . "\t" . $result . PHP_EOL;
		$ret = file_put_contents($path, $line, FILE_APPEND);
		if ($ret === false) {
			$http_def = $this->setHttpHeaders("text/plain", 500);
			echo "Failed to create log" . PHP_EOL;
		}
	}


	// logs in a user by the credentials given in json to LDAP
	public function LDAPConnect()
	{
		$function = __FUNCTION__;
		$jsonResult = array();
		//extracting user and password from request's body (json format)
		$inputFD = fopen("php://input", "r");
		if ($inputFD === false) {
			$this->logAction("No user", $function, "error 400: No data given");
			$http_def = $this->setHttpHeaders("text/json", 400);
			$jsonResult['code'] = 400;
			$jsonResult['error'] .= " No data received";
			return;
		}

		$json = "";
		while ($data = fread($inputFD, 1024)) {
			$json .= $data;
		}
		$content = json_decode($json, true);

		if (is_null($content)) {
			$this->logAction("No user", $function, "error 406: content not in JSON format");
			$http_def = $this->setHttpHeaders("text/json", 406);
			$jsonResult['code'] = 406;
			$jsonResult['error'] .= " Received data is not in a JSON format";
			echo json_encode($jsonResult);
			return;
		}

		if (empty($content['user']) || empty($content['passwd'])) {
			$this->logAction("No user", $function, "error 412: user or password is empty");
			$http_def = $this->setHttpHeaders("text/json", 412);
			$jsonResult['code'] = 412;
			$jsonResult['error'] .= " One or more attributes are empty";
			echo json_encode($jsonResult);
			return;
		}
		$user = $content['user'];
		$passwd = $content['passwd'];


		//connecting to LDAP server and adding configuration
		$ldapconn = ldap_connect(LDAP_SERVER) or die("Could not connect to LDAP server.");
		$jsonResult = array('LDAPConfig' => '');
		if (!is_resource($ldapconn)) {
			$jsonResult['LDAPConfig'] .= "Unable to connect to " . LDAP_SERVER;

		}

		ldap_set_option($ldapconn, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_NEVER);
		if (!ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3)) {
			$jsonResult['LDAPConfig'] .= " Failed to set LDAP Protocol version to 3, TLS not supported";
		}

		//connecting as known user to check connection and search for user
		if (ldap_bind($ldapconn, LDAP_USER, LDAP_PASSWORD)) {
			$jsonResult = array('info' => '');
			$jsonResult['info'] .= " LDAP bind successful...";
			$result = ldap_search($ldapconn, USER_BASE_DN, '(samaccountname=' . $user . ')', array("dn", "memberOf"));

			if (ldap_count_entries($ldapconn, $result)) {
				//user exists, trying to connect with the given password to check credentials
				$info = ldap_get_entries($ldapconn, $result);
				$logindn = $info[0]['dn'];
				$bind_result = ldap_bind($ldapconn, $logindn, $passwd);
				if ($bind_result) {
					// if the user exists we look at the configuration constant
					// if enabled, the user will be able to connect only if he is part of the correct group
					if (GROUP_VERIFICATION) {
						$isGroupFound = false;
						foreach ($info[0]['memberof'] as $cngroup) {
							if ($cngroup == GROUP_FILTER_CN) {
								$isGroupFound = true;
								break;
							}
						}
					}
					if (!GROUP_VERIFICATION || $isGroupFound) {
						//creation of a session token
						$token =  ApiToken::encrypt(ApiToken::build($user,TOKEN_APPS), AES_METHOD,AES_IV, AES_KEY);
						
						if (!$token) {
							$this->logAction($user, $function, "error 500: Token creation failure");
							$http_def = $this->setHttpHeaders("text/json", 500);
							$jsonResult['code'] = 500;
							$jsonResult['error'] .= " Token encryption went wrong";
							echo json_encode($jsonResult);
						} else {
							$this->logAction($user, $function, "200: ok, connected successfully");
							$http_def = $this->setHttpHeaders("text/json", 200);
							$jsonResult['code'] = 200;
							$jsonResult['token'] = $token;
							echo json_encode($jsonResult);
						}
					} else {
						$this->logAction($user, $function, "error 401: Incorrect LDAP group");
						$http_def = $this->setHttpHeaders("text/json", 401);
						$jsonResult['code'] = 401;
						$jsonResult['error'] .= " The given user is not part of the authorized group";
						echo json_encode($jsonResult);
					}
				} else {
					$this->logAction($user, $function, "error 401: Wrong password given for this user");
					$http_def = $this->setHttpHeaders("text/json", 401);
					$jsonResult['code'] = 401;
					$jsonResult['error'] .= " Wrong username/password!";
					echo json_encode($jsonResult);
				}
			} else {
				$this->logAction($user, $function, "error 404: This user doesn't seem to exist");
				$http_def = $this->setHttpHeaders("text/json", 404);
				$jsonResult['code'] = 404;
				$jsonResult['error'] .= " User not found";
				echo json_encode($jsonResult);
			}
		} else {
			//couldn't connect with known user: connectivity problem server side
			if (ldap_get_option($ldapconn, LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error)) {
				$jsonResult['info'] = " Could not connect to LDAP server: $extended_error.";
			} else {
				$jsonResult['info'] .= " Could not connect to LDAP server: No additional information is available.";
			}
			$this->logAction($user, $function, "error 500:
					 LDAP server connection failed, see json object returned for more information");
			$http_def = $this->setHttpHeaders("text/json", 500);
			$jsonResult['code'] = 500;
			$jsonResult['error'] .= " LDAP bind to vitesco failed! : " . ldap_err2str(ldap_errno($ldapconn));
			echo json_encode($jsonResult);
		}
		ldap_close($ldapconn);
	}

	/* manages the login method based on the configuration constant.
	 *
	 * @return void
	 */
	public function authentication(): void
	{
		$function = __FUNCTION__;
		switch (strtolower(AUTH_MODE)) {
			case "ldap":
				$this->LDAPConnect();
				break;
			case "none":
				$token = ApiToken::encrypt(ApiToken::build("admin",TOKEN_APPS), AES_METHOD,AES_IV, AES_KEY);
				if ($token !== false) {
					$this->logAction("admin", $function, "200: ok, token created for admin user");
					$http_def = $this->setHttpHeaders("application/json", 200);
					echo json_encode(array("token" => $token));
				} else {
					$this->logAction("admin", $function, "error 500: Token creation failed");
					$http_def = $this->setHttpHeaders("application/json", 500);
					echo json_encode(array("error" => "Token encryption failed"));
				}
				break;
			default:
				$this->logAction("No user", $function, "error 405: Configuration error, attempted to log in with unknown mode");
				$http_def = $this->setHttpHeaders("application/json", 405);
				echo json_encode(array("error" => "Unknown authentication method"));
				break;
		}
	}

	// extracts the expiry date of a given token and checks its validity
	public function verifToken(string $encrypt_token): ?string
	{
		$function = __FUNCTION__;
		$this->logAction("No user", $function, "Token : $encrypt_token");
		// First decrypt the token
		$token = ApiToken::decrypt(urldecode($encrypt_token), AES_METHOD, AES_IV, AES_KEY);
		$check_result = ApiToken::check($token);

		if( $check_result['success'] == true)
		{
						
			$this->logAction($check_result['username'], $function, "200: ok, token is valid");
			$http_def = $this->setHttpHeaders("text/json", 200);
			return $check_result['username'];
		}
		else 
		{
			if( $check_result['errorCode'] == -1)
			{
				$this->logAction("No user", $function, "error 404: Unknown token construction");
				$http_def = $this->setHttpHeaders("text/json", 404);
				echo "Incorrect token" . PHP_EOL;
				return null;
			}
			elseif( $check_result['errorCode'] == -2)
			{
				$this->logAction("No user", $function, "error 400: Token does not contain user information");
				$http_def = $this->setHttpHeaders("text/json", 400);
				echo "Bad request: Token does not contain user information" . PHP_EOL;
				return null;
			}
			elseif( $check_result['errorCode'] == -3)
			{
				$this->logAction($check_result['username'], $function, "error 403: After verification, token expired");
				$http_def = $this->setHttpHeaders("text/json", 403);
				echo "Token expired" . PHP_EOL;
				return null;
			}
			else
			{
				$this->logAction("No user", $function, "error 500: Token creation failure ");
				$http_def = $this->setHttpHeaders("text/json", 500);
				echo "Bad request: Token encryption went wrong" . PHP_EOL;
				return null;
			}
		}
	}
}
?>