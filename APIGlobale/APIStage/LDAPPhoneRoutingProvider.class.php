<?php
include_once("PhoneRoutingProvider.php");
include_once("..\config.php");

class LDAPPhoneRoutingProviderException extends Exception
{
  public function __construct($message = NULL, $code = 0)
  {
    parent::__construct($message, $code);
  }
}

class LDAPPhoneRoutingProvider extends PhoneRoutingProvider
{
  protected $ldap_conn = null;
  public function logAction($source, $action, $result)
  {
    date_default_timezone_set('UTC');
    $path = LOG_PATH . "/ldap-" . date("Y-m-d") . ".log";
    $line = "[" . date('d-m-y h:i:s') . "]" . "\t" . $source . "\t" . $action . "\t" . $result . PHP_EOL;
    $ret = file_put_contents($path, $line, FILE_APPEND);
    if ($ret === false) {
      echo "Failed to create log" . PHP_EOL;
    }
  }
  function LDAPConnect()
  {

    $this->ldap_conn = ldap_connect(LDAP_SERV);

    if (!$this->ldap_conn) {
      throw (new LDAPPhoneRoutingProviderException("Unable to connect to LDAP server", 500));
    }

    ldap_set_option(null, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option(null, LDAP_OPT_REFERRALS, 0);

    $ldap_bind = ldap_bind($this->ldap_conn, LDAP_BIND_DN, LDAP_BIND_PASSWORD);

    if (!$ldap_bind) {
      $error_code = ldap_error($this->ldap_conn);
      if ($error_code == 49) {
        throw (new LDAPPhoneRoutingProviderException("Invalid username or password", 401));
      } else {
        throw (new LDAPPhoneRoutingProviderException("LDAP error: " . ldap_error($this->ldap_conn), 500));
      }
    }
  }

function createEndpoint($lineNumber, $displayName, $lineType, $lineManager, $lineUsage, $lineLocation, $lineInternalNumber, $lineRedirectionNumber)
{

  if (!$this->ldap_conn) {
    throw (new LDAPPhoneRoutingProviderException("Failed to establish connection to LDAP server", 500));
  }

  $entry = array(
    'displayName' => $displayName,
    'cn' => $lineNumber,
    'sn' => $lineRedirectionNumber,
    'name' => $lineNumber,
    'telephoneNumber' => $lineNumber,
    'endPointType' => $lineType,
    'endPointManager' => $lineManager,
    'endPointUsage' => $lineUsage,
    'location' => $lineLocation,
    'internalTelephoneNumber' => $lineInternalNumber,
    'objectclass' => array('top', 'person', 'phoneEndPoint')
  );

  try {
    $resultReqLDAP = ldap_add($this->ldap_conn, "CN=$lineNumber," . LDAP_DN, $entry);
  } catch (Exception $e) {
    throw(new LDAPPhoneRoutingProviderException($e->getMessage(),500));
  }

    if ($resultReqLDAP) {
      $result = array(
      'displayName'           => $entry['displayName'],
      'lineNumber'            => $entry['cn'],
      'lineRedirectionNumber' => $entry['sn'],
      'lineType'              => $entry['endPointType'],
      'lineManager'           => $entry['endPointManager'],
      'lineUsage'             => $entry['endPointUsage'],
      'lineLocation'          => $entry['location'],
      'lineInternalNumber'    => $entry['internalTelephoneNumber'],
      );
      return $result;
    } else {
      throw(new LDAPPhoneRoutingProviderException("PhoneEndPoint not created..."));
    }
}

function readEndpoint($entryID)
{
 
  if (!$this->ldap_conn) {
    throw new LDAPPhoneRoutingProviderException("Failed to establish connection to LDAP server", 500);
  }

  try {
    $filter = "(distinguishedName=$entryID)";
    $resultReqLDAP = ldap_search($this->ldap_conn, LDAP_DN, $filter, array("distinguishedName", "cn", "sn", "displayName", "endPointType", "endPointManager", "endPointUsage", "location", "internalTelephoneNumber"));
  } catch (Exception $e) {
    throw new LDAPPhoneRoutingProviderException($e->getMessage(), 500);
  }

  if ($resultReqLDAP) {
    $infoResLDAP = ldap_get_entries($this->ldap_conn, $resultReqLDAP);
    if ($infoResLDAP['count'] > 0) {

      $result = array(
        'id'                    => isset($infoResLDAP[0]['distinguishedname'][0]) ? $infoResLDAP[0]['distinguishedname'][0] : '',
        'displayName'           => isset($infoResLDAP[0]['displayname'][0]) ? $infoResLDAP[0]['displayname'][0]: '',
        'lineNumber'            => isset($infoResLDAP[0]['cn'][0]) ? $infoResLDAP[0]['cn'][0] : '',
        'lineRedirectionNumber' => isset($infoResLDAP[0]['sn'][0]) ? $infoResLDAP[0]['sn'][0] : '',
        'lineType'              => isset($infoResLDAP[0]['endpointtype'][0]) ? $infoResLDAP[0]['endpointtype'][0] : '',
        'lineManager'           => isset($infoResLDAP[0]['endpointmanager'][0]) ? $infoResLDAP[0]['endpointmanager'][0] : '',
        'lineUsage'             => isset($infoResLDAP[0]['endpointusage'][0]) ? $infoResLDAP[0]['endpointusage'][0] : '',
        'lineLocation'          => isset($infoResLDAP[0]['location'][0]) ? $infoResLDAP[0]['location'][0] : '',
        'lineInternalNumber'    => isset($infoResLDAP[0]['internaltelephonenumber'][0]) ? $infoResLDAP[0]['internaltelephonenumber'][0] : '',
      );
      return $result;
    } else {
      throw new LDAPPhoneRoutingProviderException("PhoneEndPoint not found", 404);
    }

  } else {
    throw new LDAPPhoneRoutingProviderException("PhoneEndPoint not found", 404);
  }
}


  function readEndpointList()
  {
      if (!$this->ldap_conn) {
          throw new LDAPPhoneRoutingProviderException("Failed to establish connection to LDAP server", 500);
      }
      try {
          $resultReqLDAP = ldap_search($this->ldap_conn, LDAP_DN, "(objectClass=phoneEndpoint)", array("distinguishedName", "cn", "sn", "displayName", "endPointType", "endPointManager", "endPointUsage", "location", "internalTelephoneNumber"));
      } catch (Exception $e) {
          throw new LDAPPhoneRoutingProviderException($e->getMessage(), 500);
      }
      if ($resultReqLDAP) {
          $infoResLDAP = ldap_get_entries($this->ldap_conn, $resultReqLDAP);
          $infoResLDAP = array_slice($infoResLDAP, 1);
          $result = array();
          foreach ($infoResLDAP as $entry) {
              $id = isset($entry['distinguishedname'][0]) ? $entry['distinguishedname'][0] : '';
              $displayName = isset($entry['displayname'][0]) ? $entry['displayname'][0] : '';
              $lineNumber = isset($entry['cn'][0]) ? $entry['cn'][0] : '';
              $lineRedirectionNumber = isset($entry['sn'][0]) ? $entry['sn'][0] : '';
              $lineType = isset($entry['endpointtype'][0]) ? $entry['endpointtype'][0] : '';
              $lineManager = isset($entry['endpointmanager'][0]) ? $entry['endpointmanager'][0] : '';
              $lineUsage = isset($entry['endpointusage'][0]) ? $entry['endpointusage'][0] : '';
              $lineLocation = isset($entry['location'][0]) ? $entry['location'][0] : '';
              $lineInternalNumber = isset($entry['internaltelephonenumber'][0]) ? $entry['internaltelephonenumber'][0] : '';
  
              $result[] = array(
                  'id' => $id,
                  'displayName' => $displayName,
                  'lineNumber' => $lineNumber,
                  'lineRedirectionNumber' => $lineRedirectionNumber,
                  'lineType' => $lineType,
                  'lineManager' => $lineManager,
                  'lineUsage' => $lineUsage,
                  'lineLocation' => $lineLocation,
                  'lineInternalNumber' => $lineInternalNumber,
              );
          }
          return $result;
      } else {
          throw new LDAPPhoneRoutingProviderException("PhoneEndpoint List not found.");
      }
  }
  


  function updateEndpoint($entryID, $displayName, $lineType, $lineManager, $lineUsage, $lineLocation, $lineInternalNumber,$lineRedirectionNumber)
  {

    if (!$this->ldap_conn) {
      throw (new LDAPPhoneRoutingProviderException("Failed to establish connection to LDAP server", 500));
    }

    $entry = array(
      'displayName' => $displayName,
      'sn' => $lineRedirectionNumber,
      'endPointType' => $lineType,
      'endPointManager' => $lineManager,
      'endPointUsage' => $lineUsage,
      'location' => $lineLocation,
      'internalTelephoneNumber' => $lineInternalNumber,
    );

    try {
      $filter = "(distinguishedName=$entryID)";
      $searchResult = ldap_search($this->ldap_conn, LDAP_DN, $filter);
      $infoResLDAP = ldap_get_entries($this->ldap_conn, $searchResult);

        if ($infoResLDAP['count'] === 1) {
          $resultReqLDAP = ldap_modify($this->ldap_conn, $entryID, $entry);
        } else {
          throw(new LDAPPhoneRoutingProviderException("PhoneEndpoint not found or multiple endpoints found with the provided entryID"));
        }
    } catch (Exception $e) {
      throw(new LDAPPhoneRoutingProviderException($e->getMessage(), 500));
    }

      if ($resultReqLDAP) {
        $result = array(
          'displayName'           => $infoResLDAP[0]['displayname'][0],
          'lineRedirectionNumber' => $infoResLDAP[0]['sn'][0],
          'lineType'              => $infoResLDAP[0]['endpointtype'][0],
          'lineManager'           => $infoResLDAP[0]['endpointmanager'][0],
          'lineUsage'             => $infoResLDAP[0]['endpointusage'][0],
          'lineLocation'          => $infoResLDAP[0]['location'][0],
          'lineInternalNumber'    => $infoResLDAP[0]['internaltelephonenumber'][0],
        );
        return $result;
      } else {
        throw(new LDAPPhoneRoutingProviderException("Failed to modify PhoneEndPoint"));
      }
  }

  function deleteEndpoint($entryID)
  {
    if (!$this->ldap_conn) {
      throw (new LDAPPhoneRoutingProviderException("Failed to establish connection to LDAP server", 500));
    }

    try {
      $filter = "(distinguishedName=$entryID)";
      $searchResult = ldap_search($this->ldap_conn, LDAP_DN, $filter);
      $info = ldap_get_entries($this->ldap_conn, $searchResult);

      if ($info['count'] > 0) {
        $deleteResult = ldap_delete($this->ldap_conn, $info[0]['dn']);

        if ($deleteResult) {
          return $deleteResult;
        } else {
          throw (new LDAPPhoneRoutingProviderException("Failed to delete PhoneEndPoint", 500));
        }
      } else {
        throw (new LDAPPhoneRoutingProviderException("PhoneEndPoint not found", 404));
      }
    }catch (Exception $e) {
      throw (new LDAPPhoneRoutingProviderException($e->getMessage(), 500));
    }
  }

  function Connect(): void
  {
    $function = __FUNCTION__;
    switch (strtolower(AUTH_MODE)) {
      case "ldap":
        $this->LDAPConnect();
        break;
      default:
        $this->logAction("Connect Error", $function, "error 405: Configuration error, attempted to log in with unknown mode");
        echo json_encode(array("error" => "Unknown Connect method"));
        break;
    }
  }
}
?>