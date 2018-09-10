<?php
include_once("../config");
$zillow_id = $zid; //the zillow web service ID that you got from your email

#$search = $_GET['address'];
#$citystate = $_GET['citystate'];
$search = "3227 Lockridge Ave";
$citystate = "Kansas City, MO";
$address = urlencode($search);
$citystatezip = urlencode($citystate);

$url = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=$zillow_id&address=$address&citystatezip=$citystatezip";

$result = file_get_contents($url);
$data = simplexml_load_string($result);

echo "<h1><center>Results For</center></h1>";
echo "<center>$search<br>";
echo "$citystate</center>";
echo "<br>";
echo "zpid: ";
echo $data->response->results->result[0]->zpid;
echo "<br>";
echo "link-homedetails: ";
$homeDetailLink = $data->response->results->result[0]->links->homedetails;
echo "<a href=$homeDetailLink target='_blank'>$homeDetailLink</a>";
echo "<br>";
echo "graphsanddata: ";
$graphs = $data->response->results->resut[0]->links->graphsanddata;
echo $graphs;
echo "<br>";

//$code = $data->message->code;
//echo 'message code: ',$code;
//echo '<br>';

?>
