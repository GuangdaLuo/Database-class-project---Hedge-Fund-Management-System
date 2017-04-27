<!DOCTYPE html>
<html>
<head>
	<title>Hedge Fund Management System</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="../js/widgEditor.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/login.css" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<style type="text/css" media="all">
		@import "../css/main.css";
		@import "../css/widgEditor.css";
		table {
		    font-family: arial, sans-serif;
		    width: 100%; /*most left to right*/
		}

		td, th {
		    border: 1px solid #dddddd;
		    text-align: left;
		    padding: 6px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}
	</style>
</head>

<body>

<?php
require_once('./db_setup.php');
$sql = "USE gluo3;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database gluo3";
} else {
   echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Using gluo3 database error: </div>";
   echo "Using gluo3 database error: " . $conn->error;
}

// Query:
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];
$sql = "SELECT * FROM Users where user_name = '$username';";

$result = $conn->query($sql);
$res = $result->fetch_assoc();

if($res['authority_level'] != $user_type){
	echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>You do not have access to this type of user!</div>";
	$conn->close();
} else{

if($result->num_rows == 1){
	if($res['password'] != $password){
		echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Wrong Password</div>";
		// echo "Wrong Password";
		// return to homepage
		?>
		<div id="backhome">
	        <form action="../index.html">
	            <input type="submit" value="Back to Home Page">
	        </form>
		</div>
		<?php
	} else if($user_type == "Client"){
?>
	<div id="header">
		<div id="top_area">
			<div id="logo_bar">Hedge Fund Management System for Client</div>
		</div>
	</div>
	<br>
	<br>
   <table class="table table-striped">
      <tr>
		<th>Client Name</th>
		<th>Manager ID</th>
		<th>Management Fees</th>
		<th>Performance Fees</th>
<!-- 		<th>Stock %</th>
		<th>Bond %</th> -->
		<th>Value Under Management</th>
		<th>Cash Amount</th>
      </tr>
<?php
$user_id = $res['user_id'];
$sql2 = "SELECT Portfolio.client_id, Portfolio.manager_id, Portfolio.management_fee, Portfolio.performance_fee, Portfolio.value, Portfolio.cash_amount
FROM Portfolio WHERE Portfolio.client_id = '$user_id';";
$result2 = $conn->query($sql2);
$res2 = $result2->fetch_assoc()
?>
      <tr>
          <td><?php echo $res2['client_id']?></td>
          <td><?php echo $res2['manager_id']?></td>
          <td><?php echo $res2['management_fee']?></td>
          <td><?php echo $res2['performance_fee']?></td>
          <td><?php echo $res2['value']?></td>
          <td><?php echo $res2['cash_amount']?></td>
      </tr>

<?php
	} else {
		// manager page
?>
<?php	
		// table 1 Accounts 
?>
	<div id="header">
		<div id="top_area">
			<div id="logo_bar">Hedge Fund Management System for Manager</div>
		</div>
	</div>

	<div id="backhome">
        <form action="../insert_asset.html">
            <input type="submit" value="Insert a new stock or bond">
        </form>
        <form action="../buy_sell_page.php">
            <input type="submit" value="Buy or Sell a Stock or Bond">
        </form>
	</div>
	<br>

   <table class="table table-striped">
   <div style ='font:30px Arial,tahoma,sans-serif;color:#123f87'> Accounts</div>
      <tr>
		<th>Client ID</th>
		<th>Client Name</th>
		<th>Account Value</th>
      </tr>
<?php
$user_id = $res['user_id'];

$sql_m1 = "SELECT Portfolio.client_id, Users.user_name, Portfolio.value FROM Portfolio, Users WHERE Portfolio.manager_id = '$user_id' AND Portfolio.client_id = Users.user_id;";

$result_m1 = $conn->query($sql_m1);
// var_dump($result_m1);
while($res_m1 = $result_m1->fetch_assoc()){
?>
      <tr>
          <td><?php echo $res_m1['client_id']?></td>
          <td><?php echo $res_m1['user_name']?></td>
          <td><?php echo $res_m1['value']?></td>
      </tr>

<?php
}

	// table 2 Transactions  
?>
 
   <table class="table table-striped">
   <div style ='font:30px Arial,tahoma,sans-serif;color:#123f87'> Transactions</div>
      <tr>
		<th>Transaction ID</th>
		<th>Type</th>
		<th>Amount</th>
		<th>Date</th>
		<th>Client ID</th>
      </tr>
<?php

$sql_m2 = "SELECT Transaction.id, Asset.type, (Transaction.units * Transaction.unit_price) AS Amount, Transaction.trans_time, Portfolio.client_id FROM Transaction, Portfolio, Asset WHERE Portfolio.manager_id = '$user_id' AND Transaction.portfolio_id = Portfolio.id AND Transaction.asset_id = Asset.asset_id;";


$result_m2 = $conn->query($sql_m2);
// var_dump($result_m2);
while($res_m2 = $result_m2->fetch_assoc()){
?>
      <tr>
          <td><?php echo $res_m2['id']?></td>
          <td><?php echo $res_m2['type']?></td>
          <td><?php echo $res_m2['Amount']?></td>
          <td><?php echo $res_m2['trans_time']?></td>
          <td><?php echo $res_m2['client_id']?></td>
      </tr>

<?php
}

	// table 3 Market Information  
?>
 
   <table class="table table-striped">
   <div style ='font:30px Arial,tahoma,sans-serif;color:#123f87'> Market Information</div>
      <tr>
		<th>SEC Type</th>
		<th>Entity</th>
		<th>Value</th>
      </tr>
<?php
$sql_m3 = "SELECT type, asset_name, price FROM Asset;";

$result_m3 = $conn->query($sql_m3);
// var_dump($result_m2);
while($sql_m3 = $result_m3->fetch_assoc()){
?>
      <tr>
          <td><?php echo $sql_m3['type']?></td>
          <td><?php echo $sql_m3['asset_name']?></td>
          <td><?php echo $sql_m3['price']?></td>
      </tr>

<?php
}

// manager page ends
	}
} else {
echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Cannot find the user name</div>";
// back to homepage
?>
<div id="backhome">
    <form action="../index.html">
        <input type="submit" value="Back to Home Page">
    </form>
</div>
<?php
}
?>

    </table>

<?php
$conn->close();


}


?>  
</body>
</html>
