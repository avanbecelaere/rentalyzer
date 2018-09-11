<?php
include_once("../config");
$zwsid = $zid;

$prefixurl = "http://www.zillow.com/webservice/GetDeepSearchResults.htm";
$addr = urlencode("3227 Lockridge Ave");
$cit = urlencode("Kansas City");
$stat = urlencode("MO");
$csz = $cit."%2C+".$stat;
$query = $prefixurl."?zws-id=".$zwsid."&address=".$addr."&citystatezip=".$csz."&rentzestimate=true";
$sxml = simplexml_load_file(trim($query));
echo json_encode($sxml);
if($sxml)
echo "Success" else echo "Failure"

?>