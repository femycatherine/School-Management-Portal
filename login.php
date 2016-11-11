<?php
error_reporting(E_ALL & ~E_NOTICE);
$ip = $_SERVER ['REMOTE_ADDR'];
session_start();
if ($ip != '127.0.0.1') {
	$db_servername = "localhost";
	$db_username = "stjudes_admin";
	$db_password = "Kappa25rs75p";
	$db_dbname = "stjudes_portal";
}else {
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_dbname = "stjudes_portal";
}

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['SCRIPT_FILENAME'].'-----'.$_SERVER['HTTP_USER_AGENT'];
$sql = "INSERT INTO `stjudes_portal`.`login_log` (`ip`, `url`, `action_time`) VALUES
('$ip', '$url', NOW());";


$activate = $_REQUEST['activate'];
$msg = ''; 
if($activate!=''){ 
	$sql_check = "select * from users where activate_code='$activate'";
	$result = mysqli_query($conn, $sql_check);
	
	if($row = $result->fetch_assoc()) {
		 $sql = "Update `users` set `active` = 1
		 where activate_code= '$activate'  ";
		if ($conn->query($sql) === TRUE) {
			$msg = 'Activated. You can login now';
		} 
	}	
}
$conn->close();
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
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
.icons_class {
	padding-left: 17px;
	padding-top: 6px;
	font-size: 15px;
	font-weight: bold;
	color: #000;
}
</style>
<script type="text/javascript">


function user_data_check() {
	 var val_msg='';
	 var inputPassword = $('#inputPassword').val();
	 var inputPasswordConfirm = $('#inputPasswordConfirm').val();

	 var username_length = inputPassword.length;
	 var n = inputPassword.localeCompare(inputPasswordConfirm);
	 var Username = $('#Username').val();

	 if(username_length<6) {
		 val_msg = val_msg +' Password must have minimum of 6 characters !';
	 }
	 if(n!=0){
			val_msg = val_msg +'Password Mismatch !';
			$('#error_msg').text(val_msg);
	    	$('#error_msg').css('display','block');
	    	 return false;
	 }else {
		     return username_db_check(Username);
     }
}

function username_db_check(Username){
	var val=0;
    $.ajax({
        type: "POST",
        url: "common_ajax.php",
        async:false,
        data: "action=username_db_check&username=" + Username,
        success : function(text){
            if (text == "1"){
            	 var val_msg = ' Username already exist !\n';
            	 $('#error_msg').text(val_msg);
    	    	 $('#error_msg').css('display','block');
            	 val = 1;
            }
        }
    });
    if(val==1){
    	return false;
    }else {
    	return true;
    }
}

function login_check() {
	var valu=1;
	 var login_username = $('#login_username').val();
	 var login_password = $('#login_password').val();
    $.ajax({
        type: "POST",
        url: "common_ajax.php",
        async:false,
        data: "action=login_check&login_username=" + login_username + "&login_password=" + login_password,
        success : function(text){
            if (text == "0"){
            	 var val_msg = 'The username and password you entered dont match.!\n';
            	 $('#error_msg_login').text(val_msg);
    	    	 $('#error_msg_login').css('display','block');
    	    	 valu = 0;
            }
        }
    });
    if(valu==0){
    	return false;
    }else {
    	return true;
    }
	
}
</script>
</head>

<body style="margin-top: 0px;">
	<div class="row" style="background-color: #337ab7">
		<div class="logo">
			<a href="http://syromalabarsouthjersey.com/portal" style="outline: none;"><img
				src="doc/logo1.png"
				alt="St. Jude Syro Malabar South Jersey" border="0"
				class="img-responsive"> </a>
		</div>
	</div>
	<?php if($msg!=''){ ?>
	<div class="row">
		<div class="alert alert-success col-md-7 col-md-offset-2 col-sm-8 col-sm-offset-2">
			<strong>Activated! </strong>You can login now!
		</div>
	</div>	
		
	<?php }	?>
	<div class="row">
		<div class="container" style="margin-top: 10px;">
			<div id="loginbox"
				class="mainbox col-md-7 col-md-offset-2 col-sm-8 col-sm-offset-2">
				<div class="panel panel-primary">
					
					<div class="panel-heading">
						<div class="panel-title">Login</div>
						<div
							style="float: right; font-size: 80%; position: relative; top: -10px">
							<a href="#">Forgot password?</a>
						</div>
					</div>

					<div style="padding-top: 30px" class="panel-body">

						<div style="display: none" id="login-alert"
							class="alert alert-danger col-sm-12"></div>

						<form id="loginform" class="form-horizontal" role="form"
							data-toggle="validator" method="post" action="login_page.php"
							onsubmit="return login_check();">

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i
									class="glyphicon glyphicon-user"></i> </span> <input
									id="login_username" type="text" class="form-control"
									name="username" value="" placeholder="username"
									required>
							</div>

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i
									class="glyphicon glyphicon-lock"></i> </span> <input
									id="login_password" type="password" class="form-control"
									name="passwd" placeholder="passwd" required>
							</div>



							<div class="input-group">
								<div class="checkbox">
									<label> <input id="login-remember" type="checkbox"
										name="remember" value="1"> Remember me
									</label>
								</div>
							</div>
							<div class="alert alert-danger" style="display: none;"
								id="error_msg_login">
								<strong>Error!</strong> Indicates a dangerous or potentially
								negative action.
							</div>

							<div style="margin-top: 10px" class="form-group">
								<!-- Button -->

								<div class="col-sm-12 controls">
									<button type="submit" class="btn btn-primary">Login</button>
								</div>
							</div>


							<div class="form-group">
								<div class="col-md-12 control">
									<div
										style="border-top: 1px solid #888; padding-top: 15px; font-size: 85%">
										Don't have an account! <a href="#"
											onClick="$('#loginbox').hide(); $('#signupbox').show()"> Sign
											Up Here</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="signupbox" style="display: none;"
				class="mainbox col-md-7 col-md-offset-2 col-sm-8 col-sm-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">Signup</div>
						<div
							style="float: right; font-size: 85%; position: relative; top: -10px">
							<a id="signinlink" href="#"
								onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a>
						</div>
					</div>
					<div class="panel-body">
						<form id="signupform" data-toggle="validator"
							class="form-horizontal" role="form" method="post"
							onsubmit="return user_data_check();" action="login_action.php">



							<div class="form-group">
								<label for="firstname" class="col-md-3 control-label">Name<span
									style="color: red;">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" class="col-md-3  form-control"
										name="full_name" placeholder="Full Name" id="inputName"
										required>
								</div>
							</div>
							<div class="form-group">
								<label for="username" class="col-md-3 control-label">Username<span
									style="color: red;">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" class="col-md-3  form-control"
										name="username" placeholder="Username" id="Username" required>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password<span
									style="color: red;">*</span>
								</label>
								<div class="col-md-9">
									<input name="pass" type="password" data-minlength="6"
										class="col-md-3  form-control" id="inputPassword"
										placeholder="Password" required> <span class="help-block">Minimum
										of 6 characters</span>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Retype
									Password<span style="color: red;">*</span>
								</label>
								<div class="col-md-9">
									<input name="conf_pass" type="password" class="form-control"
										id="inputPasswordConfirm" data-match="#inputPassword"
										data-match-error="Whoops, these don't match"
										placeholder="Confirm" required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-md-3 control-label">Email<span
									style="color: red;">*</span>
								</label>
								<div class="col-md-9">
									<input name="email" type="email" class="col-md-3 form-control"
										id="inputEmail" placeholder="Email"
										data-error="Bruh, that email address is invalid" required>
									<div class="help-block with-errors"></div>
								</div>

							</div>
							<input type="hidden" readonly class="form-control" name="role"
				 						value="Parent" placeholder="Parent" required>
							 
							<div class="alert alert-danger" style="display: none;"
								id="error_msg">
								<strong>Error!</strong> Indicates a dangerous or potentially
								negative action.
							</div>

							<div class="form-group">
								<!-- Button -->
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn btn-primary">Submit</button>
									
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12 control">
									<div
										style="border-top: 1px solid #888; padding-top: 15px; font-size: 85%">
										Do you have an account! <a href="#"
											onClick="$('#signupbox').hide(); $('#loginbox').show();">
											Login Here </a>
									</div>
								</div>
							</div>


						</form>
					</div>
					<!-- /#page-wrapper -->
				</div>
			</div>
		</div>
	</div>


	<!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="js/plugins/morris/raphael.min.js"></script>
	<script src="js/plugins/morris/morris.min.js"></script>
	<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
