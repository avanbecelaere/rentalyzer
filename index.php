<!DOCTYPE HTML>
<html lang="en">
	<head>
	</head>
	<body>
		<h1>Welcome to rentalyzer.com</h1>
		<br>
		<a href="search.php">GetSearchResults</a>
		<br>
		<h3 class="panel-title">Submit Address or Zillow ID</h3>
		<form id="defaultForm" method="post" class="form-horizontal" role="form">
			<label>Street</label>
			<input type="text" class="form-control" placeholder="Street" name="street" value=""><br><br>
			<label>City</label>
			<input type="text" class="form-control" placeholder="City" name="city" value=""><br><br>
			<label>State</label>
			<input type="text" class="form-control" placeholder="State" name="state" value=""><br><br>
			<label>Zillow ID</label>
			<input type="text" class="form-control" placeholder="Zillow ID" name="zillowID" value=""><br><br>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
