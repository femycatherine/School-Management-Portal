<?php
error_reporting(E_ALL & ~E_NOTICE);


			$ip = $_SERVER ["REMOTE_ADDR"];
			if ($ip != '127.0.0.1') {
				$mysql_servername =  "localhost";
				$mysql_username = "";
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
$sql = "SELECT * FROM `configuration`";
$result = mysqli_query($conn, $sql);
if($row = $result->fetch_assoc()) {
	$configure_site_name = $row["site_name"];
	$configure_site_logo_url = $row["site_logo_url"];
	$configure_email = $row["email"];
	$configure_theme = $row["theme"];
	$configure_message = $row["message"];
}		 


			?>