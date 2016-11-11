<?php
include 'sess_conf.php';
include('db_conf.php');
$ip = $_SERVER ['REMOTE_ADDR'];
$ip = $_SERVER ['REMOTE_ADDR'];
$url = $_SERVER ['SCRIPT_FILENAME'] . '-----' . $_SERVER ['HTTP_USER_AGENT'];
$sql = "INSERT INTO `login_log` (`ip`, `url`, `action_time`) VALUES
('$ip', '$url', NOW());";
if ($ip != '73.178.164.230') {
	$result = mysqli_query($conn, $sql);
	//mail ( 'femy.123@gmail.com', "$ip", "$url" );
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
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
	color: #777;
}
</style>
<script type="text/javascript">

function change_teacher_classid(class_id, url){
	var val=0;
    $.ajax({
        type: "POST",
        url: "change_class_or_kids.php",
        async:false,
        data: "action=change_teacher_classid&class_id=" + class_id + "&url=" + url,
        success : function(text){
        	window.location=url;
        }
    });
}	

function change_class_type(type, url) {
	var val=0;
    $.ajax({
        type: "POST",
        url: "change_class_or_kids.php",
        async:false,
        data: "action=change_class_type&type=" + type + "&url=" + url,
        success : function(text){
        	window.location=url;
        }
    });
}

function change_parent_student_id(student_id, url){
	var val=0;
    $.ajax({
        type: "POST",
        url: "change_class_or_kids.php",
        async:false,
        data: "action=change_parent_student_id&student_id=" + student_id + "&url=" + url,
        success : function(text){
        	window.location=url;
        }
    });
}	

function change_homework(homework_id, url) {
	$.post( "common_ajax.php", { action: "change_homework", homework_id: homework_id }, function( data ) {
		$( "#homework_html" ).html(data);
	});
}

function view_assignment(assignment_id, student_name) {
	$.post( "common_ajax.php", { action: "view_assignment", assignment_id: assignment_id , student_name: student_name}, function( data ) {
		$( "#homework_assignment" ).html(data);
	});
}
function edit_assignment_grade(grade, assignment_id, homework_id , student_name) {
	$.post( "common_ajax.php", { action: "edit_grade", grade: grade , assignment_id: assignment_id,homework_id:homework_id }, function( data ) {
		$.post( "common_ajax.php", { action: "change_homework", homework_id: homework_id }, function( data1 ) {
			$( "#homework_html" ).html(data1);
		});
		$.post( "common_ajax.php", { action: "view_assignment", assignment_id: assignment_id , student_name: student_name}, function( data2 ) {
			$( "#homework_assignment" ).html(data2);
		});
		
	});
}

$(document).on("click", ".delete_confirm", function(e) {
	  e.preventDefault();
	    var $link = $(this);
	    bootbox.confirm("Are you really want to delete ?", function (confirmation) {
	        confirmation && document.location.assign($link.attr('href'));
	    });     
});
$(document).on("click", ".edit_confirm", function(e) {
	  e.preventDefault();
	    var $link = $(this);
	    bootbox.confirm("Are you really want to Edit ?", function (confirmation) {
	        confirmation && document.location.assign($link.attr('href'));
	    });     
});
</script>
</head>
<body>

		<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>

				<a href="http://syromalabarsouthjersey.com/portal/<?php echo $_SESSION['portal_template'];?>"> <img
					src="<?php echo $configure_site_logo_url;?>"
					alt="<?php echo $configure_site_name;?>" border="0"
					class="hidden-xs" style="max-height: 50px">
				</a>
				<!-- Top Menu Items -->
				<ul class="nav navbar-right top-nav ">
				<?php 
				$url  = $_SERVER['REQUEST_URI'];
				?>
<?php if($_SESSION['portal_template']=='dashboard_guardian.php') { ?>	
	<?php if($_SESSION['portal_parent_student_name_selected']) { ?>
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['portal_parent_student_name_selected'];?></a>
							<ul class="dropdown-menu">
							<?php $array_kids_info = $_SESSION['portal_parent_students']; foreach($array_kids_info as $kids) {?>						
								<li><a  onClick="change_parent_student_id('<?php echo $kids['student_id']?>','<?php echo $url;?>');"><i class="fa fa-fw fa-user"></i><?php echo $kids['name']?></a></li>
							<?php } ?>						
							</ul>
						</li>
	<?php } ?>				
<?php } if($_SESSION['portal_template']=='dashboard_mentor.php') { ?>	
	<?php if($_SESSION['portal_teacher_grade_selected']) { ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['portal_teacher_grade_selected'];?></a>
						<ul class="dropdown-menu">
						<?php $array_classes_info = $_SESSION['portal_teacher_classes'];  foreach($array_classes_info as $grade) {?>	
	   						<li><a  onClick="change_teacher_classid('<?php echo $grade['class_id']?>','<?php echo $url;?>');"><i class="fa fa-fw fa-user"></i><?php echo $grade['grade'];?></a></li>
	   					<?php } ?>				
						</ul>
					</li>
	<?php } ?>	
<?php } ?>			
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;
						<?php echo $_SESSION['portal_class_type'];?></a> 
						<ul class="dropdown-menu">
						<?php  
						$sql1 = "SELECT distinct(type) as type FROM `classes`";
						$result1 = mysqli_query($conn, $sql1);
						while($row1 = $result1->fetch_assoc()) {  ?>
							<li><a onClick="change_class_type('<?php echo $row1['type']?>','<?php echo $url;?>');">
	   						<i class="fa fa-fw fa-user"></i><?php echo $row1['type'];?></a></li>
						<?php } ?> 
						</ul>
					</li>		
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"><i class="fa fa-star"></i>&nbsp;<?php echo $_SESSION['portal_role_selected'];?><b
							class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-fw fa-gear"></i>click below to role change</a></li>
						    <li class="divider"></li>
						    <?php $check = 0; foreach($_SESSION['portal_roles'] as $roles) { 
						    if($roles!=$_SESSION['portal_role_selected']) { $check=$check+1; ?>
								<li><a href="change_role.php?role=<?php echo $roles; ?>"><i class="fa fa-fw fa-user"></i> <?php echo $roles;?></a></li>
							<?php } }
							if($check==0){ ?>
								<li><a href="#"><i class="fa fa-fw "></i>No other roles</a></li>
							<?php } ?>
						</ul>
					</li>
					<li class="dropdown"><a href="#" class="dropdown-toggle hidden-xs"
						data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['portal_name'];?><b
							class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li><a href="Account_Preferences.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
							<?php if( ($_SESSION['portal_template']=='index.php')&& ($_SESSION['portal_role_selected']=='Admin') ) { ?>	
							<li><a href="main_configuration_setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
							<?php } ?>
							<li><a href="help.php"><i class="fa fa-fw fa-question"></i>Help</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i>
									Log Out</a>
							</li>
						</ul>
					</li>
				</ul>

			</div>

			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->