<?php 
include 'includes/header.php';
include 'includes/left_menu.php';?>


<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1>Welcome to parent portal</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success">
					<strong>Welcome to parent portal!<br />
					</strong> Please check CCD homework information from left side
					menu. <br />You have an option to add homework assignment!
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<h3>Getting Started</h3>
				<p><b>A parent account allows you to view the information for one or
					more students with a single sign in. You can also manage your
					personal account preferences.</b></p>


				<p>If you do not have your child(s) Access ID and password you will
					need to visit your child(s) school(s) to obtain this information;
					then follow the instructions below to link all your children's
					accounts under one single parent sign-on. To create a parent
					account, enter the following information:</p>
				<p>Go to the CCD Parent Portal at:
					<b>http://syromalabarsouthjersey.com/portal/login.php</b> Click the Create Account
					button and fill out the information as noted below:</p>
				<p><b>Name</b> - Your first and last name</p>
				<p><b>Email</b> - Student notifications and correspondence related to your
					parent account will be sent to this email</p>
				<p><b>Desired Username</b> - Your username is your unique PowerSchool
					identity</p>
				<p><b>Password</b> - Your password must be at least 6 characters long</p>
			</div>
			<div class="col-lg-4">
				<br />
				<div class="list-group">
					<a href="#" class="list-group-item disabled"><b>You are the gurdian
							of following students</b> </a>
					<?php 
				foreach($_SESSION['portal_parent_students'] as $key=>$value) { ?>
					<a href="#" class="list-group-item"><?php echo $value['name'];?> </a>
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
		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->
	<?php include 'includes/footer.php';?>