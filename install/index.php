<?php
session_start ();
ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
$action = $_REQUEST ['action'];
if ($action == 'Remove installation folder') { 
	$site_name = $_REQUEST ['site_name'];
	$email = $_REQUEST ['toemail'];
	$theme = $_REQUEST ['theme'];
	$message = $_REQUEST ['message'];
	
	$dbname = $_REQUEST ['mysql_dbname'];
	$dbserver = $_REQUEST ['mysql_servername'];
	$dbuser = $_REQUEST ['mysql_username'];
	$dbpass = $_REQUEST ['mysql_password'];
	$ip = $_SERVER ['REMOTE_ADDR'];
	if ($ip != "::1") {
		$data = '<?php
			$ip = $_SERVER ["REMOTE_ADDR"];
			if ($ip != "::1") {
				$mysql_servername = "' . $dbserver . '";
				$mysql_username = "' . $dbuser . '";
				$mysql_password = "' . $dbpass . '";
				$mysql_dbname = "' . $dbname . '";
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
			?>';
	} else {
		$data = '<?php
			$ip = $_SERVER ["REMOTE_ADDR"];
			if ($ip != "::1") {
				$mysql_servername =  "localhost";
				$mysql_username = "stjudes_admin";
				$mysql_password = "Kappa25rs75p";
				$mysql_dbname = "stjudes_portal";
			}else {
				$mysql_servername = "' . $dbserver . '";
				$mysql_username = "' . $dbuser . '";
				$mysql_password = "' . $dbpass . '";
				$mysql_dbname = "' . $dbname . '";
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
			?>';
	}
	$file = "../db_confi.php";
	
	$handle = fopen ( $file, 'w' );
	if (fwrite ( $handle, $data ) === FALSE) {
		echo "Can not write to (" . $file . ")";
	}
	
	fclose ( $handle );
	
	$conn = new mysqli($dbserver, $dbuser, $dbpass);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "CREATE DATABASE ".$dbname;
	$result = mysqli_query($conn, $sql);
	
	$conn1 = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
	// Check connection
	if ($conn1->connect_error) {
		die("Connection failed: " . $conn1->connect_error);
	}
	
	include 'sql.php';
	$result = mysqli_multi_query($conn1, $sql);
	

	
	$sql = "INSERT INTO `configuration` (`id`, `site_name`, `site_logo_url`, `email`, `theme`, `message`) 
	VALUES ('0', '$site_name', '', '$email', '$theme', '$message')";
	
	$result = mysqli_query($conn1, $sql);
	
	if($_FILES["fileToUpload"]["name"]){
		$target_dir = "doc/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	
	
		$sql = "UPDATE `configuration`
		set `site_logo_url`= '$target_file' where id='0'";
	
		$result = mysqli_query($conn1, $sql);
	}
	
	
	header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>CCD Portal: St Jude Syro Malabar Catholic Mission</title>

<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="install.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="../css/sb-admin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="../css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
function add_configuration(){
    $( "#tab1primary" ).removeClass( "fade in active" );
    $( "#id_1" ).removeClass( "active" );
    $( "#tab3primary" ).removeClass( "fade in active" );
    $( "#id_3" ).removeClass( "active" );
    $( "#tab2primary" ).addClass( "fade in active" );
    $( "#id_2" ).addClass( "active" );
}

function add_databases() {
	$( "#tab1primary" ).removeClass( "fade in active" );
    $( "#id_1" ).removeClass( "active" );
    $( "#tab2primary" ).removeClass( "fade in active" );
    $( "#id_2" ).removeClass( "active" );
    $( "#tab3primary" ).addClass( "fade in active" );
    $( "#id_3" ).addClass( "active" );

}
</script>
</head>

<body>
	<div id="wrapper">

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="index.html">Open Source CCD Portal</a>
			</div>
		</nav>

		<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-8">
						<h1 class="page-header">Make your own CCD web application</h1>

						<div class="panel with-nav-tabs panel-primary">
							<div class="panel-heading">
								<ul class="nav nav-tabs">
									<li id="id_1" class="active"><a>Configuration</a></li>
									<li id="id_2"><a>Database Setup</a></li>
									<li id="id_3"><a>Overview</a></li>

								</ul>
							</div>
							<form data-toggle="validator" class="form-horizontal" role="form"
								method="post" enctype="multipart/form-data">
								<div class="panel-body">
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab1primary">


											<div class="form-group">
												<label for="SiteName" class="col-md-3 control-label">Site
													Name: </label>
												<div class="col-md-9">
													<input name="site_name" type="text"
														class="col-md-3 form-control" id="name" placeholder="Name"
														value="">

												</div>

											</div>
											<div class="form-group">
												<label for="inputName" class="col-md-3 control-label">Site
													Logo: </label>
												<div class="col-md-9">
													<input name="fileToUpload" id="fileToUpload"
														class="form-control" type="file">
												</div>

											</div>
											<div class="form-group">
												<label for="email" class="col-md-3 control-label">Email: </label>
												<div class="col-md-9">
													<input type="email" class="col-md-3  form-control"
														name=toemail placeholder="Email" id="inputEmail" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="Button" class="col-md-3 control-label">Button
													Color: </label>
												<div class="col-md-9">
													<select class="col-md-3  form-control" name="theme"
														id="Button">
														<option value="primary">primary</option>
														<option value="secondary">secondary</option>
														<option value="success">success</option>
														<option value="info">info</option>
														<option value="warning">warning</option>
														<option value="danger">danger</option>
														<option value="link">link</option>
													</select>

												</div>
											</div>
											<div class="form-group">
												<label for="Message" class="col-md-3 control-label">Global
													Message: </label>
												<div class="col-md-9">
													<textarea rows="" cols="" class="col-md-3  form-control"
														name="message"></textarea>
												</div>
											</div>
											<div class="form-group">
												<!-- Button -->
												<div class="col-md-offset-3 col-md-9">
													<div onclick="add_configuration();" id="config_button"
														class="btn btn-primary">Save</div>

												</div>
											</div>

										</div>
										<div class="tab-pane fade" id="tab2primary">
											<div class="form-group">
												<label for="server" class="col-md-3 control-label">Mysql
													Server: </label>
												<div class="col-md-9">
													<input type="text" class="col-md-3  form-control"
														name="mysql_servername" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="User" class="col-md-3 control-label">Mysql User:
												</label>
												<div class="col-md-9">
													<input type="text" class="col-md-3  form-control"
														name="mysql_username" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="User" class="col-md-3 control-label">Mysql
													Password: </label>
												<div class="col-md-9">
													<input type="password" class="col-md-3  form-control"
														name="mysql_password" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="User" class="col-md-3 control-label">Mysql
													Database: </label>
												<div class="col-md-9">
													<input type="text" class="col-md-3  form-control"
														name="mysql_dbname" value="">
												</div>
											</div>
											<div class="form-group">
												<!-- Button -->
												<div class="col-md-offset-3 col-md-9">
													<div onclick="add_databases();" class="btn btn-primary">Save</div>

												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="tab3primary">
											<div class="well">
												<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Configuration
												setup done..<br /> <span class="glyphicon glyphicon-ok"
													aria-hidden="true"></span>&nbsp;Database and tables
												created.. <br />
												<br />Please note your login information , username:<b>admin</b>,
												password:<b>admin</b><br />
												<br />
												<button type="submit" name="action"
													value="Remove installation folder" class="btn btn-primary">View
													Portal</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>


			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->

	</div>


	<!-- jQuery -->
	<script src="../js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../js/bootstrap.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="../js/plugins/morris/raphael.min.js"></script>
	<script src="../js/plugins/morris/morris.min.js"></script>
	<script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>
