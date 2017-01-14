<?php
$ip = $_SERVER ["REMOTE_ADDR"];
if ($ip == "::1") {
	$mysql_servername = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_dbname = "";
}else {
	$mysql_servername = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_dbname = "";
}
// Create connection
$conn = new mysqli($mysql_servername, $mysql_username, $mysql_password, $mysql_dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>