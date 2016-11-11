<?php 
include 'db_conf.php';
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';

$display = $_REQUEST['display']


?>
<?php  if(in_array("View_Students", $_SESSION['portal_functions'])) { ?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Students
						List&nbsp;</li>
					<li><a href="admission.php">
							<button type="button" class="btn btn-<?php echo $configure_theme;?>">Add New Student</button>
					</a>
					</li>
					<li>
						<!-- Single button -->
						<div class="btn-group ">
							<button type="button"
								class="  btn btn-default dropdown-toggle"
								data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								Students based on Class <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
<?php 
	    $sql = "SELECT id, grade from classes";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
?>
								<li><a href="?display=<?php echo $row['id'];?>"><?php echo $row['grade'];?></a></li>
<?php } ?>
							</ul>
						</div>
					</li>
				</ol>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead style="background-color: #A2C2DE">
							<tr>
								<th>Id</th>
								<th>Email</th>
								<th>Name</th>
								<th>Class Participation</th>
								<th>Guardians/Parents</th>
								<th></th>

							</tr>
						</thead>
						<tbody>
							<?php 
							if($display!='') {
								$sql = "SELECT students.id,students.email,students.student_name,class_student.class_id  FROM students,class_student where
								students.id=class_student.student_id and  class_student.class_id= '$display'";
								
							}else{
								$sql = "SELECT * FROM students";
								
							}
							$result = mysqli_query($conn, $sql);

							while($row = $result->fetch_assoc()) {
								$id = $row['id'];
								$q = '';
								?>
							<tr>
								<td><?php echo $id;?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['student_name'];?></td>
								<td>
								<?php
								if($display!='') {
									$q = " and class_student.class_id = '$display'";
								} 
								$row1 = array();
								$sql1 = "SELECT classes.grade as grade FROM class_student,classes where 
								class_student.student_id='$id' and classes.id=class_student.class_id $q";
								$result1 = mysqli_query($conn, $sql1);
								
								while($row1 = $result1->fetch_assoc()) {
									echo $row1['grade'].",<br/>";
								}							
								?>
								</td>
								<td>
								<?php
								$row2 = array();
								$sql2 = "SELECT users.name as name FROM student_user,users where 
								student_user.student_id='$id' and users.id=student_user.user_id";
								$result2 = mysqli_query($conn, $sql2);
								
								while($row2 = $result2->fetch_assoc()) {
									echo $row2['name'].",<br/>";
								}							
								?> 
								</td>
								<td>
								<a style="padding:0px"
									href="view_students.php?action=View&student_id=<?php echo $id;?>">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</a>&nbsp;&nbsp;
								<a  style="padding:0px"
									href="manage_students.php?action=Edit&student_id=<?php echo $id;?>">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								</a>&nbsp;&nbsp; <a class="delete_confirm" style="padding:0px"
									href="manage_students.php?action=Delete&student_id=<?php echo $id;?>">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</a>
								</td>
							</tr>
							<?php }	?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>