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
$email = $_POST['email'];
$user_type = $_POST['user_type'];
$sql = "SELECT * FROM Users where user_name = '$username';";

$result = $conn->query($sql);
$res = $result->fetch_assoc();
// var_dump($result);
if($result->num_rows > 0){
   echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>User name already exists! Please change user name to another one !</div>";
	// echo "User name already exists! Please change user name to another one !";
	// return to homepage
	?>
	<div id="backhome">
        <form action="../index.html">
            <input type="submit" value="Back to Home Page">
        </form>
	</div>
	<?php
} else { // user name not exists, check email existence below:
	$sql2 = "SELECT * FROM Users where email = '$email';";
	$result2 = $conn->query($sql2);
	$res2 = $result2->fetch_assoc();
	// var_dump($result2);
	if($result2->num_rows > 0){ // email is exists, cannot create new user
		echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Email already exists! Please change email to another one !</div>";
		?>
		<div id="backhome">
	        <form action="../index.html">
	            <input type="submit" value="Back to Home Page">
	        </form>
		</div>
		<?php
	} else { // create new user
		$sql3 = "INSERT INTO Users VALUES(0,'$username','$user_type','$email','$password');";
		if($conn->query($sql3)){
			echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>Register succeed, welcome to our system !</div>";
		} else if (!$conn->query($sql3)) {
	    	// printf("Errormessage: %s\n", $conn->error);
	    	echo "<div style ='font:40px Arial,tahoma,sans-serif;color:#123f87'>" . $conn->error . "</div>";
		}
		?>
		<div id="backhome">
	        <form action="../index.html">
	            <input type="submit" value="Back to Home Page to Login">
	        </form>
		</div>
		<?php
		$conn->close();
	}
}
?>
</body>
</html>
