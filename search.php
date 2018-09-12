<?php
include_once("../config");

// Request Data
$prefixurl = "http://www.zillow.com/webservice/GetSearchResults.htm";
$reqstreet = ("3323 Cleveland Ave");
$reqcity = ("Kansas City");
$reqstate = ("MO");
$reqstreeturl = urlencode($reqstreet);
$reqcityurl = urlencode($reqcity);
$reqstateurl = urlencode($reqstate);
$reqcsz = $reqcityurl."%2C+".$reqstateurl;
$query = $prefixurl."?zws-id=".$zwsid."&address=".$reqstreeturl."&citystatezip=".$reqcsz."&rentzestimate=true";
$result = simplexml_load_file(trim($query));
$zpid = $result->response->results->result->zpid;

// Response Data & Calculations
$street = $result->response->results->result->address->street;
$city = $result->response->results->result->address->city;
$state = $result->response->results->result->address->state;
$zipcode = $result->response->results->result->address->zipcode;
$zestimate = money_format('%n',floatval($result->response->results->result->zestimate->amount));
$valuationLow = money_format('%n',floatval($result->response->results->result->zestimate->valuationRange->low));
$valuationHigh = money_format('%n',floatval($result->response->results->result->zestimate->valuationRange->high));
$prefixurldetails = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm";
$detailsquery = $prefixurldetails."?zws-id=".$zwsid."&zpid=".$zpid;
$detailsresult = simplexml_load_file(trim($detailsquery));

$code = $detailsresult->message->code;
if ($code == 0){
	$updates = "<a href=$detailsquery target='_blank'>$detailsquery</a>";
}
else
	$updates = "No Updates ($code)";

// Header Output
echo "<h1><center>Search Results For</center></h1>";
echo "<center>$street<br>";
echo "$city, $state $zipcode</center><br>";
?>

<!-- Table Output -->
<table border=1>
	<thead>
		<tr>
			<th>Label</th>
			<th>Response</th>
		</tr>
	</thead>
	<tbody>
		<?php
			// Display Table Data
			echo "<tr><td>ZPID</td> \n";
			echo "<td>$zpid</td></tr> \n";
			echo "<tr><td>Query</td> \n";
			echo "<td><a href=$query target='_blank'>$query</a></td></tr> \n";
			echo "<tr><td>Zestimate</td> \n";
			echo "<td>\$$zestimate (\$$valuationLow - \$$valuationHigh)</td></tr> \n";
			echo "<tr><td>Updates</td> \n";
			echo "<td>$updates</td></tr> \n";


		?>
	</tbody>
</table>