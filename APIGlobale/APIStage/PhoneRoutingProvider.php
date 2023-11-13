<?php
abstract class PhoneRoutingProvider
{
    abstract function createEndpoint($lineNumber, $displayName, $lineType, $lineManager, $lineUsage, $lineLocation, $lineInternalNumber, $lineRedirectionNumber);
    abstract function readEndpoint($entryID);
    abstract function readEndpointList();
    abstract function updateEndpoint($entryID, $displayName, $lineType, $lineManager, $lineUsage, $lineLocation, $lineInternalNumber,$lineRedirectionNumber);
    abstract function deleteEndpoint($entryID);

}
?>