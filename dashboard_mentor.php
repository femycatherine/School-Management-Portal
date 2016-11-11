<?php 
include 'includes/header.php';
include 'includes/left_menu.php';?>


<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1>Welcome to Teacher portal</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success">
					<strong>Welcome to teacher portal!<br />
					</strong> Please check CCD homework uploaded by students from left side
					menu. <br />You have an option to add homeworks!
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-4">
				<br />
				<div class="list-group">
					<a href="#" class="list-group-item disabled"><b>You are the mentor
							of following classes</b> </a>
					<?php 
				foreach($_SESSION['portal_teacher_classes'] as $key=>$value) { ?>
					<a href="#" class="list-group-item"><?php echo $value['grade'];?> </a>
					<?php }
					?>
				</div>
				<br />
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Inbox</h3>
					</div>
					<div class="panel-body">No new messages!</div>
				</div>
			</div>
						<div class="col-lg-8">
				<h3>Getting Started</h3>
				<p><b>A Teacher account allows you to view the information for one or
					more classes with a single sign in. You can also manage your
					personal account preferences.</b></p>
				<p>Go to the CCD Teacher Portal at:
					<b>http://syromalabarsouthjersey.com/portal/login.php</b> Click the Create Account
					button and fill out the information as noted below:</p>
				<p><b>Name</b> - Your first and last name</p>
				<p><b>Email</b> - Student notifications and correspondence related to your
					Teacher account will be sent to this email</p>
				<p><b>Desired Username</b> - Your username is your unique PowerSchool
					identity</p>
				<p><b>Password</b> - Your password must be at least 6 characters long</p>
			</div>
		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->
	<?php include 'includes/footer.php';?>