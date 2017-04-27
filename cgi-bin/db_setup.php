<?php
$servername = "localhost";
$username = "gluo3";
$password = "wLq2AFFS";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Database Connected Successfully! \r\n";

?>
