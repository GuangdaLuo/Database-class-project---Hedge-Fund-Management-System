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
$sql = "SELECT * FROM Asset;";
$result = $conn->query($sql);
// var_dump($result);

if($result->num_rows > 0){
	?>
	<div id="header">
		<div id="top_area">
			<div id="logo_bar">Asset Table</div>
		</div>
	</div>
	<br>
	<br>
   <table class="table table-striped">
      <tr>
		<th>asset_id</th>
		<th>asset_name</th>
		<th>price</th>
		<th>type</th>
      </tr>
<?php

while($res = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $res['asset_id']?></td>
          <td><?php echo $res['asset_name']?></td>
          <td><?php echo $res['price']?></td>
          <td><?php echo $res['type']?></td>
      </tr>

<?php
}
} else {
echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Cannot find data in Asset table</div>";
}
?>

    </table>

<?php
$conn->close();
?>  

</body>
</html>
