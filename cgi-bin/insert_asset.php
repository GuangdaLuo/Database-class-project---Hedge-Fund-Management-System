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
$asset_name = $_POST['asset_name'];
$price = $_POST['price'];
$type = $_POST['type'];
// echo "type: " . $type;
$sql = "INSERT INTO Asset VALUES(0,'$asset_name','$price','$type');";

if($conn->query($sql)){
	echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Inserting asset succeed! You can click GO BACK button on your browser to go back to manager page</div>";
} else if (!$conn->query($sql)) {
	// printf("Errormessage: %s\n", $conn->error);
	echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>" . $conn->error . "</div>";
}

?>
<div id="backhome">
    <form action="../index.html">
        <input type="submit" value="Back to Home Page">
    </form>
</div>

<!-- <div id="backhome">
    <form action="./login.php">
        <input type="submit" value="Back to Manager Page">
    </form>
</div> -->

<?php
$conn->close();

?>
</body>
</html>
