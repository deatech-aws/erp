<?php
$servername   = "localhost";
$database = "dbvwyqowhbpef1";
$username = "ugavgscekiiyl";
$password = "yzi5vge5cqzu";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully";
?>