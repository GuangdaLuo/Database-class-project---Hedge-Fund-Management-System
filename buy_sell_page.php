<!DOCTYPE html>
<html>
<head>
	<title>Buy or Sell a Stock Or Bond</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="./js/widgEditor.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
	<script src="js/register.js"></script>
	<script src="js/check_register.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<style type="text/css" media="all">
		@import "css/main.css";
		@import "css/widgEditor.css";
	</style>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/slide.css">
</head>
<body>

<div id="header">
	<div id="top_area">
		<div id="logo_bar">Buy or Sell a Stock Or Bond</div>
	</div>
</div>

<?php
require_once('./cgi-bin/db_setup.php');
$sql = "USE gluo3;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database gluo3";
} else {
   echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Using gluo3 database error: </div>";
   echo "Using gluo3 database error: " . $conn->error;
}
?>

<div>
	<div class="buy_sell">
		<div class="table-responsive"> 
		<form action="cgi-bin/buy_sell.php" method="post">
			<table class="table">
<!-- 				<tr>
					<td>
						<div id="buy_sell">Asset Name:</div>
					</td>
					<td>
						<input type="text" id="asset_name" name ="asset_name"/>
					</td>
				</tr> -->
				<tr>
					<td>
						<div id="buy_sell"><h3>Asset Name:</h3></div>
					</td>
					<td>
						<select name="asset_name">
						<?php 
						$sql = "SELECT asset_name FROM Asset;";
						$result = $conn->query($sql);
						while($res = $result->fetch_assoc()){
						?>
						  <option value="<?php echo $res['asset_name']?>"><?php echo $res['asset_name']?></option>
						<?php
						}
						$conn->close();
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<div id="buy_sell"><h3>Buy Amount (units):</h3></div>
					</td>
					<td>
						<input type="text" id="units" name="units"/>
					</td>
				</tr>
				<tr>
					<td>
						<div id="buy_sell"><h3>Portfolio ID:</h3></div>
					</td>
					<td>
						<input type="text" id="portfolio_id" name="portfolio_id"/>
					</td>
				</tr>
				<tr>
					<td>
						<label class="radio-inline"><input type="radio" name="buyORsell" value="BUY"><div id="buy_sell"><h4>BUY</h4></div></label>
						<label class="radio-inline"><input type="radio" name="buyORsell" value="SELL"><div id="buy_sell"><h4>SELL</h4></div></label>
					</td>
				</tr>
				<tr>
					<td>
					<input type="submit" id="buy_sell" name="buy_sell" value="submit">
					</td>
				</tr>
			</table>	
		</form>
		</div>
		</div>
		
	<div id="backhome">
        <form action="index.html">
            <input type="submit" value="Back to Home Page">
        </form>
	</div>
	<br>
	<div id="register_res"></div>


</div>
</body>
</html>	
