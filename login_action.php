<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

include('db_conf.php');

$email = $_REQUEST['email'];
$username = $_REQUEST['username'];
$name = $_REQUEST['full_name'];
$pass = $_REQUEST['pass'];
$role = $_REQUEST['role'];

$code = md5($username . microtime());

$sql = "INSERT INTO `users` 
(`email`, `name`, `username`, `pass`,  `create_time` , `activate_code` , `active`) VALUES 
('$email', '$name', '$username', '$pass',  NOW() , '$code', '0');";
$result = mysqli_query($conn, $sql);
$user_id =  mysqli_insert_id($conn);

$sql = "INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES (NULL, '$user_id', '2')";
$result = mysqli_query($conn, $sql);

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('stjudesj@web4.bijoys.net', 'St Jude Church');
//Set an alternative reply-to address
$mail->addReplyTo('stjudesj@web4.bijoys.net', 'St Jude Church');
//Set who the message is to be sent to
$mail->addAddress("$email", "$name");
$mail->addCustomHeader("BCC: femy.123@gmail.com"); 
//Set the subject line
$mail->Subject = 'CCD Portal Activation code!';
//Read an HTML message body from an external file, convert referenced images to embedded,
  

$heading = "CCD Portal Activation Link!";

$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>CCD Activation mail</title>
</head> 
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;font-color:black;">
 Thank you for joining CCD Portal :) <br/>
To activate your CCD account <a href="http://syromalabarsouthjersey.com/portal/login.php?activate='.$code.'">Click Here</a><br/>

If above link does not work, copy and paste the following link into your browser:<br/>
http://syromalabarsouthjersey.com/portal/login.php?activate='.$code.'
    
</div>
</body>
</html>';
//xzx

//convert HTML into a basic plain-text alternative body
$mail->msgHTML($body);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//send the message, check for errors
if (!$mail->send()) {
	//echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	//echo "Message sent!";
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
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">

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
</head>

<body style="margin-top: 0px;">
	<div class="row" style="background-color: #337ab7">
		<div class="logo">
			<a href="http://syromalabarsouthjersey.com" style="outline: none;"><img
				src="http://syromalabarsouthjersey.com/wordpress/wp-content/uploads/2013/06/logo1.png"
				alt="St. Jude Syro Malabar South Jersey" border="0"
				class="img-responsive"> </a>
		</div>
	</div>
	<div class="row" style="margin-top:10px;">
		<div class="alert alert-warning col-md-7 col-md-offset-2 col-sm-8 col-sm-offset-2">
						<strong>Alert! </strong> Please check your email <b>inbox or spam</b> folder for CCD activation link !

			
		</div></center>
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
