<?php
include_once("../config");
$zwsid = $zid;

#$search = $_GET['address'];
#$citystate = $_GET['citystate'];
$search = "3227 Lockridge Ave";
$citystate = "Kansas City, MO";
$address = urlencode($search);
$citystatezip = urlencode($citystate);

$url = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=$zwsid&address=$address&citystatezip=$citystatezip";

$result = file_get_contents($url);
$data = simplexml_load_string($result);

echo "<h1><center>Results For</center></h1>";
echo "<center>$search<br>";
echo "$citystate</center>";
echo "<br>";
echo "zpid: ";
echo $data->response->results->result[0]->zpid;
echo "<br><br>";
echo "<h4>Links</h4>";
echo "homedetails: ";
$homeDetailLink = $data->response->results->result[0]->links->homedetails;
echo "<a href=$homeDetailLink target='_blank'>$homeDetailLink</a>";
echo "<br>";
echo "graphs & data: ";
$graphsanddata = $data->response->results->result[0]->links->graphsanddata;
echo "<a href=$graphsanddata target='_blank'>$graphsanddata</a>";
echo "<br>";
echo "comparables: ";
$comparables = $data->response->results->result[0]->links->comparables;
echo "<a href=$comparables target='_blank'>$comparables</a>";
echo "<br>";

echo "<h4>Zestimate</h4>";
echo "amount: ";
$zestimateAmount = $data->response->results->result[0]->zestimate->amount;
echo $zestimateAmount;
echo "<br>";
echo "percentile: ";
$zestimatePercentile = $data->response->results->result[0]->zestimate->percentile;
echo $zestimatePercentile;
echo "<br>";


//$code = $data->message->code;
//echo 'message code: ',$code;
//echo '<br>';

?>
