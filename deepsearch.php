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

$zestimate = money_format('%n',floatval($s->response->results->result->zestimate->amount));

echo "<br>";
echo "query: ";
echo $query;
echo "<br>";
echo "zestimate: ";
echo $zestimate;

?>