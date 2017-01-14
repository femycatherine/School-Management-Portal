<?php
error_reporting(E_ALL & ~E_NOTICE);

$_POST = filterParameters ( $_POST );
$_GET = filterParameters ( $_GET );
 
 
 
			$ip = $_SERVER ["REMOTE_ADDR"];
			if ($ip != "::1") {
				$mysql_servername =  "localhost";
				$mysql_username = "";
				$mysql_password = "";
				$mysql_dbname = "";
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
$sql = "SELECT * FROM `configuration`";
$result = mysqli_query($conn, $sql);
if($row = $result->fetch_assoc()) {
	$configure_site_name = $row["site_name"];
	$configure_site_logo_url = $row["site_logo_url"];
	$configure_email = $row["email"];
	$configure_theme = $row["theme"];
	$configure_message = $row["message"];
}		 

function filterParameters($array) {
	
	// Check if the parameter is an array
	if (is_array ( $array )) {
		// Loop through the initial dimension
		foreach ( $array as $key => $value ) {
			// Check if any nodes are arrays themselves
			if (is_array ( $array [$key] ))
				// If they are, let the function call itself over that particular node
				$array [$key] = $this->filterParameters ( $array [$key] );
				
				// Check if the nodes are strings
			if (is_string ( $array [$key] ))
				// If they are, perform the real escape function over the selected node
				$array [$key] = mysql_real_escape_string ( $array [$key] );
		}
	}
	// Check if the parameter is a string
	if (is_string ( $array ))
		// If it is, perform a mysql_real_escape_string on the parameter
		$array = mysql_real_escape_string ( $array );
		
		// Return the filtered result
	return $array;
} 
			?>
