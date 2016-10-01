<?php

$servername = "localhost";
$username = "partizan";
$password = "peterko16000";
$dbname = "homeiot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
