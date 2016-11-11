<?php

if (isset($_POST['dbserver'])) {
	$dbname = $_POST['dbname'];
	$dbserver = $_POST['dbserver'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	
	$data = '<?php
$ip = $_SERVER ["REMOTE_ADDR"];
if ($ip == "::1") {
	$mysql_servername = "'.$dbserver.'";
	$mysql_username = "'.$dbuser.'";
	$mysql_password = "'.$dbpass.'";
	$mysql_dbname = "'.$dbname.'";
}else {
	$mysql_servername = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_dbname = "stjudes_portal";
}
// Create connection
$conn = new mysqli($mysql_servername, $mysql_username, $mysql_password, $mysql_dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>';
	$file = "config.php";

	$handle = fopen($file, 'w');
	if (fwrite($handle, $data) === FALSE) { echo "Can not write to (".$file.")"; }
	echo "Succesfully Wrote to (".$file.")";
	fclose($handle);
}
else {
	echo "<form name=\"Config Creation\" method=\"post\">";
	echo "Database Host: <input type=\"text\" name=\"dbserver\" value=\"localhost\"><br>";
	echo "Database User: <input type=\"text\" name=\"dbuser\" value=\"root\"><br>";
	echo "Database Pass: <input type=\"password\" name=\"dbpass\" value=\"password\"><br>";
	echo "Database Name: <input type=\"text\" name=\"dbname\" value=\"forums\"><br>";
	echo "<input type=\"submit\" value=\"Create Config\"><input type=\"reset\" value=\"Reset\">";
	echo "</form>";
}
?>