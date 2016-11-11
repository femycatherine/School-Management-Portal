<?php
include 'sess_conf.php';
include 'db_conf.php';

$action = $_REQUEST['action'];

if($action=='save') {
	$site_name = $_REQUEST['site_name'];
	$site_logo_url = $_REQUEST['site_logo_url'];
	$email = $_REQUEST['email'];
	$theme = $_REQUEST['theme'];
	$message = $_REQUEST['message'];
	
	$sql = "Update `configuration` set
	`site_name` = '$site_name',  `email` = '$email', `theme` = '$theme',
	`message` = '$message' where id = '0'";
	
	$result = mysqli_query($conn, $sql);
	
	if($_FILES["fileToUpload"]["name"]){
		$target_dir = "doc/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		
		
		$sql = "UPDATE `configuration`
		set `site_logo_url`= '$target_file' where id='0'";
		
		$result = mysqli_query($conn, $sql);
	}
	

	$dbname = $_REQUEST['mysql_dbname'];
	$dbserver = $_REQUEST['mysql_servername'];
	$dbuser = $_REQUEST['mysql_username'];
	$dbpass = $_REQUEST['mysql_password'];
	$ip = $_SERVER ['REMOTE_ADDR'];
	if ($ip != "::1") {
		$data = '<?php
			$ip = $_SERVER ["REMOTE_ADDR"];
			if ($ip != "::1") {
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
	}else {
		$data = '<?php
			$ip = $_SERVER ["REMOTE_ADDR"];
			if ($ip != "::1") {
				$mysql_servername =  "localhost";
				$mysql_username = "stjudes_admin";
				$mysql_password = "Kappa25rs75p";
				$mysql_dbname = "stjudes_portal";
			}else {
				$mysql_servername = "'.$dbserver.'";
				$mysql_username = "'.$dbuser.'";
				$mysql_password = "'.$dbpass.'";
				$mysql_dbname = "'.$dbname.'";
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
	$file = "db_conf.php";
	
	$handle = fopen($file, 'w');
	if (fwrite($handle, $data) === FALSE) { echo "Can not write to (".$file.")"; }
	
	fclose($handle);
}

include 'includes/header.php';
include 'includes/left_menu.php';
$sql = "SELECT * FROM `configuration`";

$result = mysqli_query($conn, $sql);
if($row = $result->fetch_assoc()) {
	$site_name = $row['site_name'];
	$site_logo_url = $row['site_logo_url'];
	$email = $row['email'];
	$theme = $row['theme'];
	$message = $row['message'];
	
}


?>
<div id="page-wrapper">
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;Main
						Configuration Page</li>
				</ol>
			</div>
			<div class="col-lg-6"><br />
				<p>Server frontend information .</p>
				
				<form data-toggle="validator"
					class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="SiteName" class="col-md-3 control-label">Site Name: </label>
						<div class="col-md-9">
							<input name="site_name" type="text" class="col-md-3 form-control"
								id="name" placeholder="Name"
								value="<?php echo $site_name;?>">

						</div>

					</div>
					<div class="form-group">
						<label for="inputName" class="col-md-3 control-label">Site Logo: </label>
						<div class="col-md-9">
							<input name="fileToUpload" id="fileToUpload" class="form-control" type="file">
							<img height="30px" src="<?php echo $site_logo_url;?>" 
							style="margin:2px;background-color:#337ab7" />
						</div>

					</div>
					<div class="form-group">
						<label for="email" class="col-md-3 control-label">Email: </label>
						<div class="col-md-9">
							<input type="email" class="col-md-3  form-control" name=email
								placeholder="Email" id="inputEmail" value="<?php echo $email;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="Button" class="col-md-3 control-label">Button Color: </label>
						<div class="col-md-9">
						<select class="col-md-3  form-control"
								name="theme" id="Button">
								<option value="<?php echo $theme;?>"><?php echo $theme;?></option>
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
						<label for="Message" class="col-md-3 control-label">Global Message: </label>
						<div class="col-md-9">
							<textarea rows="" cols="" class="col-md-3  form-control" name="message"><?php echo $message;?></textarea>
						</div>
					</div><br/><br/>
					<p>Database Information.</p>
					
					<div class="form-group">
						<label for="server" class="col-md-3 control-label">Mysql Server: </label>
						<div class="col-md-9">
							<input type="text" class="col-md-3  form-control" name="mysql_servername"
								 value="<?php echo $mysql_servername;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="User" class="col-md-3 control-label">Mysql User: </label>
						<div class="col-md-9">
							<input type="text" class="col-md-3  form-control" name="mysql_username"
								 value="<?php echo $mysql_username;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="User" class="col-md-3 control-label">Mysql Password: </label>
						<div class="col-md-9">
							<input type="password" class="col-md-3  form-control" name="mysql_password"
								 value="<?php echo $mysql_password;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="User" class="col-md-3 control-label">Mysql Database: </label>
						<div class="col-md-9">
							<input type="text" class="col-md-3  form-control" name="mysql_dbname"
								 value="<?php echo $mysql_dbname;?>">
						</div>
					</div>
					<p>Are you really want to save above information?.</p>
					<div class="form-group">
						<!-- Button -->
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" name="action" value="save"
								class="btn btn-<?php echo $configure_theme;?>">Save</button>
							<button type="reset" class="btn btn-<?php echo $configure_theme;?>">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /#page-wrapper -->
<?php include 'includes/footer.php';?>