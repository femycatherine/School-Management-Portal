<?php
include 'sess_conf.php';
include 'db_conf.php';

$user_id = $_SESSION['portal_username_id'];
$action = $_REQUEST['action'];
$name = $_REQUEST['name'];
$Email = $_REQUEST['Email'];
$Username = $_REQUEST['Username'];
$Password = $_REQUEST['Password'];

if($action=='save') {
	
	$sql = "UPDATE `users`
	SET `name` = '$name',	`email` = '$Email', `username` = '$Username' , `pass`  = '$Password' 
	WHERE `users`.`id` = '$user_id'";
	$_SESSION['portal_name'] = $name;
	$_SESSION['portal_email'] = $Email;
	$_SESSION['portal_username'] = $Username;
	$result = mysqli_query($conn, $sql); 
}

include 'includes/header.php';
include 'includes/left_menu.php';
?>
<div id="page-wrapper">
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;Account
						Preference</li>
				</ol>
			</div>
			<div class="col-lg-12">
				<p>
					If you want to change the name, e-mail address, username or
					password associated with your
					<?php echo $_SESSION['portal_role_selected'];?>
					account, you may do so below. Please click the corresponding Edit
					button to make changes to your username, or password.
				</p>
			</div>
			
			<div class="col-lg-6"><br/>	<br/>
				<form id="account_preference_form" data-toggle="validator"
					class="form-horizontal" role="form" method="post">

					<div class="form-group">
						<label for="inputName" class="col-md-3 control-label">Name:
						</label>
						<div class="col-md-9">
							<input name="name" type="text" class="col-md-3 form-control"
								id="name" placeholder="Name" value="<?php echo $_SESSION['portal_name'];?>">
							
						</div>

					</div>
					
					<div class="form-group">
						<label for="email" class="col-md-3 control-label">Email:<span
							style="color: red;">*</span>
						</label>
						<div class="col-md-9">
							<input type="email" class="col-md-3  form-control"
								name="Email" placeholder="Email" id="inputEmail" required value="<?php echo $_SESSION['portal_email'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-md-3 control-label">Username:<span
							style="color: red;">*</span>
						</label>
						<div class="col-md-9">
							<input value="<?php echo $_SESSION['portal_username'];?>" type="text" class="col-md-3  form-control"
								name="Username" placeholder="Username" id="Username" required>
						</div>
					</div>
					<div class="form-group">
						<label for="firstname" class="col-md-3 control-label">New Password:<span
							style="color: red;">*</span>
						</label>
						<div class="col-md-9">
							<input type="password" class="col-md-3  form-control"
								name="Password" placeholder="Password" id="Password" required>
						</div>
					</div>
					<div class="form-group">
								<!-- Button -->
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" name="action" value="save" class="btn btn-<?php echo $configure_theme;?>">Save</button>
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