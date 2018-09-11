<?php
include_once("../config");

$prefixurl = "http://www.zillow.com/webservice/GetDeepSearchResults.htm";
$address = ("3323 Cleveland Ave");
$city = ("Kansas City");
$state = ("MO");
$addr = urlencode($address);
$cit = urlencode($city);
$stat = urlencode($state);
$csz = $cit."%2C+".$stat;
$query = $prefixurl."?zws-id=".$zwsid."&address=".$addr."&citystatezip=".$csz."&rentzestimate=true";
$result = simplexml_load_file(trim($query));
$zpid = $result->response->results->result[0]->zpid;
//echo json_encode($result);

echo "<h1><center>Results For</center></h1>";
echo "<center>$address<br>";
echo "$city, $state";
echo "<br>";
echo "zpid: ";
echo $zpid;
echo "</center><br><br>";

$zestimate = money_format('%n',floatval($result->response->results->result->zestimate->amount));

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
$code = $detailsresult->message->code;
if ($code == 0){
	echo json_encode($detailsresult);
	echo "<br>";
	echo "detailsquery: ";
	echo "<a href=$detailsquery target='_blank'>$detailsquery</a>";
}
else
	echo "No Updates ($code)";


?>