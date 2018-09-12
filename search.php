<?php
include_once("../config");

$prefixurl = "http://www.zillow.com/webservice/GetSearchResults.htm";
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

echo "<h1><center>Search Results For</center></h1>";
echo "<center>$address<br>";
echo "$city, $state";
echo "<br>";
echo "zpid: ";
echo $zpid;
echo "</center><br>";

$zestimate = money_format('%n',floatval($result->response->results->result->zestimate->amount));

$prefixurldetails = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm";
$detailsquery = $prefixurldetails."?zws-id=".$zwsid."&zpid=".$zpid;
$detailsresult = simplexml_load_file(trim($detailsquery));
$code = $detailsresult->message->code;
if ($code == 0){
	$updates = "<a href=$detailsquery target='_blank'>$detailsquery</a>";
}
else
	$updates = "No Updates ($code)";
?>

<br>
<br>
<table border=1>
	<thead>
		<tr>
			<th>Label</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//Display Table Data
			echo "<tr><td>Query</td> \n";
			echo "<td><a href=$query target='_blank'>$query</a></td></tr> \n";
			echo "<tr><td>Zestimate</td> \n";
			echo "<td>$zestimate</td></tr> \n";
			echo "<tr><td>Updates</td> \n";
			echo "<td>$updates</td></tr> \n";


		?>
	</tbody>
</table>