<?php
include 'sess_conf.php';
include 'db_conf.php';

$user_id = $_SESSION['portal_username_id'];
$action = $_REQUEST['action'];
$body = $_REQUEST['body'];

if($action=='save') {

	$sql = "INSERT INTO `help` (`id`, `body`, `created_by`, `create_time`) VALUES (NULL, '$body', '$user_id', now());";
	$result = mysqli_query($conn, $sql);
	$msg = "Thank you for your message. We will reply you as soon as possible";
}

include 'includes/header.php';
include 'includes/left_menu.php';
?>
<div id="page-wrapper">
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
		<?php if($msg=='') { ?>
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;Report
						your questions and suggestions</li>
				</ol>
			</div>
			<div class="col-lg-12">
				<p>if you face some technical issues, please include following
					information in your message.
				
				
				<ul>
					<li>Which url you faced this issue?</li>
					<li>Screenshot if possible</li>
					<li>Your contact information.</li>
					</p>
			
			</div>

			<div class="col-lg-6">
				<br /> <br />
				<form id="signupform" data-toggle="validator"
					class="form-horizontal" role="form" method="post">

					<div class="form-group">
						<label for="inputEmail" class="col-md-3 control-label">Message:
						</label>
						<div class="col-md-9">
							<textarea name="body" class="form-control" rows="10"></textarea>
						</div>

					</div>

					<div class="form-group">
						<!-- Button -->
						<div class="col-md-offset-3 col-md-9">
							<button type="submit"  name="action" value="save"  class="btn btn-<?php echo $configure_theme;?>">Save</button>
							<button type="reset" class="btn btn-<?php echo $configure_theme;?>">Reset</button>
						</div>
					</div>
				</form>

			</div>
			<?php }else { ?>
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;Report
							your questions and suggestions</li>
					</ol><br/>
					<font color="green"><?php echo $msg;?></font><br/><br/>
				</div>
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-lg-8">
			<b>Please note:</b> <br/>
			 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem 
			 nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
			</div>
		</div>

	</div>
</div>
<!-- /#page-wrapper -->
<?php include 'includes/footer.php';?>