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
$link = $data->response->results->result->links->homedetails;
$street = $result->response->results->result->address->street;
$city = $result->response->results->result->address->city;
$state = $result->response->results->result->address->state;
$zipcode = $result->response->results->result->address->zipcode;
$zestimate = money_format('%n',floatval($result->response->results->result->zestimate->amount));
$valuationLow = money_format('%n',floatval($result->response->results->result->zestimate->valuationRange->low));
$valuationHigh = money_format('%n',floatval($result->response->results->result->zestimate->valuationRange->high));
$zestimateDate = $result->response->results->result->zestimate->{'last-updated'};
$thirtyDayChange = money_format('%n',floatval($result->response->results->result->zestimate->valueChange));
$rentZestimate = money_format('%n',floatval($result->response->results->result->rentzestimate->amount));
$rentValuationLow = money_format('%n',floatval($result->response->results->result->rentzestimate->valuationRange->low));
$rentValuationHigh = money_format('%n',floatval($result->response->results->result->rentzestimate->valuationRange->high));
$rentZestimateDate = $result->response->results->result->rentzestimate->{'last-updated'};

// Updates API Call
$prefixurldetails = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm";
$detailsquery = $prefixurldetails."?zws-id=".$zwsid."&zpid=".$zpid;
$detailsresult = simplexml_load_file(trim($detailsquery));
$code = $detailsresult->message->code;
if ($code == 0){
	$updates = "<a href=$detailsquery target='_blank'>$detailsquery</a>";
}
else
	$updates = "No Updates (error code $code)";

// Header Output
echo "<h1><center>Search Results For</center></h1>";
echo "<center><a href=$link target='_blank'>$street<br>";
echo "$city, $state $zipcode</a></center><br>";
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
			echo "<tr><td>Zestimate Date</td> \n";
			echo "<td>$zestimateDate</td></tr> \n";
			echo "<tr><td>30 Day Change</td> \n";
			echo "<td>\$$thirtyDayChange</td></tr> \n";
			echo "<tr><td>Rent Zestimate</td> \n";
			echo "<td>\$$rentZestimate (\$$rentValuationLow - \$$rentValuationHigh)</td></tr> \n";
			echo "<tr><td>Rent Zestimate Date</td> \n";
			echo "<td>$rentZestimateDate</td></tr> \n";
			echo "<tr><td>Updates</td> \n";
			echo "<td>$updates</td></tr> \n";


		?>
	</tbody>
</table>