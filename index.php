<!DOCTYPE HTML>
<html lang="en">
	<head>
	</head>
	<body>
		<h1><center>Welcome to rentalyzer.com</center></h1>
		<br>
		<center><a href="search.php">GetSearchResults</a></center>
		<br>
		<center><h3 class="panel-title">Submit Address or Zillow ID</h3></center>
		<form id="defaultForm" action="/search.php" method="post" role="form">
			<center><label>Street</label>
			<input type="text" placeholder="Street" name="reqstreet" value=""><br><br>
			<label>City</label>
			<input type="text" placeholder="City" name="reqcity" value=""><br><br>
			<label>State</label>
			<input type="text" placeholder="State" name="reqstate" value=""><br><br>
			<label>Zillow ID</label>
			<input type="text" placeholder="Zillow ID" name="reqZillowID" value=""><br><br>
			<input type="submit" value="Submit"></center>
		</form>
	</body>
</html>
