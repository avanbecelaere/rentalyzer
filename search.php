<?php
include_once("../config");

$prefixurl = "http://www.zillow.com/webservice/GetSearchResults.htm";
$addr = urlencode("3227 Lockridge Ave");
$cit = urlencode("Kansas City");
$stat = urlencode("MO");
$csz = $cit."%2C+".$stat;
$query = $prefixurl."?zws-id=".$zwsid."&address=".$addr."&citystatezip=".$csz."&rentzestimate=true";
$result = simplexml_load_file(trim($query));
echo json_encode($result);

$zestimate = money_format('%n',floatval($result->response->results->result->zestimate->amount));
$zpid = $data->response->results->result[0]->zpid;
echo "<br>";
echo "zpid: ";
echo $zpid;

echo "<br>";
echo "query: ";
echo "<a href=$query target='_blank'>$query</a>";
echo "<br>";
echo "zestimate: ";
echo $zestimate;
echo "<br>";

$prefixurldetails = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm";
$detailsquery = $prefixurldetails."?zws-id=".$zwsid."&zpid=".$zpid;
$detailsresult = simplexml_load_file(trim($detailsquery));
echo json_encode($detailsresult);

?>
