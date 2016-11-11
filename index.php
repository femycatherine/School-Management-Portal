<?php 
include 'includes/header.php';
include 'includes/left_menu.php';
$msg = '';
if($_REQUEST[msg]=='admission_success'){
	$msg = "Please provide a donation of $50 (or more) per child to Maya Vargheese or Mathew Abraham(Sibi).<br/> (Your donation
				will help cover part of expenses such as travel, stationery &
					supplies, guest speakers etc. incurred during school year.)";
}
?>


<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
				
				</ol>
			</div>
		</div>
	<?php if($msg!=''){ ?>
	<div class="row">
		<div class="alert alert-success col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2">
			<?php echo $msg;?>
		</div>
	</div>	
		
	<?php }	?>
		<div class="row">


			<?php  if(in_array("Faith_Formation_Registration", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2">
				<a href="admission.php">
					<div>
						<img src="doc/adm.jpg" height="100px" />
					</div>
					<div class="icons_class">Faith Formation Registration</div>
				</a>
			</div>
			<?php }?>
			<?php  if(in_array("View_CCD_Attendence", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2">
				<a href="Grades_and_Attendance.php">
					<div>
						<img src="doc/attendance.jpg" height="100px" />
					</div>
					<div class="icons_class">CCD Attendence</div>
				</a>
			</div>
			<?php }?>
			<?php  if(in_array("View_Grades", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2">
				<a href="grades.php">
					<div>
						<img src="doc/marks.jpg" height="100px" />
					</div>
					<div class="icons_class">Grades</div>
				</a>
			</div>
			<?php }?>
			<?php  if(in_array("View_Students", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2">
				<a href="students.php">
					<div>
						<img src="doc/students.jpg" height="100px" />
					</div>
					<div class="icons_class">Students</div>
				</a>
			</div>
			<?php }?>
			<?php  if(in_array("View_Teachers", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2">
				<div>
					<img src="doc/teachers.jpg" height="100px" />
				</div>
				<div class="icons_class">Teachers</div>
			</div>
			<?php }?>
			<?php  if(in_array("Manage_Members", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="users.php">
				<div>
					<img src="doc/users.jpg" height="100px" />
				</div>
				<div class="icons_class">Manage Members</div> </a>
			</div>
		</div>
		<div class="row">
		<?php }?>
			<?php  if(in_array("View_CCD_Classes", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="classes.php">
				<div>
					<img src="doc/ccd.jpg" height="100px" />
				</div>
				<div class="icons_class">CCD Classes</div></a>
			</div>
			<?php }?>
			<?php  if(in_array("Documents", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="documents.php">
				<div>
					<img src="doc/documents.jpg" height="100px" />
				</div>
				<div class="icons_class">Documents</div></a>
			</div>
			<?php }?>
			<?php  if(in_array("Manage_Operations", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="functions.php">
				<div>
					<img src="doc/functions.jpg" height="100px" />
				</div>
				<div class="icons_class">Manage Operations</div> </a>
			</div>
			<?php }?>
			<?php  if(in_array("Manage_Roles", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="roles.php">
				<div>
					<img src="doc/roles.jpg" height="100px" />
				</div>
				<div class="icons_class">Manage Roles</div> </a>
			</div>
			<?php }?>
			<?php  if(in_array("Manage_Liturgy", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="liturgy.php">
				<div>
					<img src="doc/liturgy.jpg" height="100px" />
				</div>
				<div class="icons_class">Manage Liturgy</div> </a>
			</div>
			<?php }?>
			<?php  if(in_array("View_Settings", $_SESSION['portal_functions'])) {?>
			<div class="col-lg-2"><a href="settings.php">
				<div>
					<img src="doc/settings.jpg" height="100px" />
				</div>
				<div class="icons_class">Settings</div> </a>
			</div>
			<?php }?>
		</div>
	</div>
	<!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->
<?php include 'includes/footer.php';?>