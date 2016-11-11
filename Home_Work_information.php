<?php
include 'db_conf.php';
include 'includes/header.php';
include 'includes/left_menu.php';

if($_REQUEST['form_admission_submit']=='1'){
	$class_id = $_REQUEST[class_id];
	$grade = $_REQUEST[grade];
	$student_name = $_REQUEST[student_name];
	//header("Location: $page?msg=admission_success");
}
?>
<div id="page-wrapper">
	<form action="" method="post" name="form_admission">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp; Home
							Work Assignment details</li>
					</ol>
				</div>
			</div>
			  <?php if($_SESSION['portal_template']=='dashboard_mentor.php') { ?> 
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
					
						<form name='formid'>
							<?php 
							$class_id = $_SESSION['portal_teacher_classid_selected'];
							$grade = $_SESSION['portal_teacher_grade_selected'];
							$url  = $_SERVER['REQUEST_URI'];
							?>
							<label>Select Class</label> <select
								onChange="change_teacher_classid(this.value,'<?php echo $url;?>');"
								name="classid_to_be_changed" class="form-control">
								<option value="<?php echo $class_id;?>"><?php echo $grade;?></option>
								<?php 	
								$class_id = $_SESSION['portal_teacher_classid_selected'];
								$user_id = $_SESSION['portal_username_id'];
								$type = $_SESSION['portal_class_type'];
								$sql = "SELECT * from classes, class_teacher where
								classes.id = class_teacher.class_id and class_teacher.user_id='$user_id'  and classes.type='$type'";
								$result = mysqli_query($conn, $sql);
								while($row = $result->fetch_assoc()) {
									$grade = $row['grade'];
									$id = $row['class_id'];
									$description = $row['description'];
									if($id!=$class_id)
										echo "<option value='$id'>$grade&nbsp;&nbsp;&nbsp;($description)</option>";
								}
								?>

							</select>
						</form>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<br class="" /> <a href="add_home_work.php">
							<button type="button" class="btn btn-<?php echo $configure_theme;?>">Add Home Work
								Information</button>
						</a>
					</div>
				</div>
			</div>
			<?php }if($_SESSION['portal_template']=='dashboard_guardian.php') { 
				$student_name = $_SESSION['portal_parent_student_name_selected'];
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="page-header">
						<h3>
							Class Assignments & Scores: 
							<?php echo $student_name;?>
							
						</h3>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<thead style="background-color: #c5c5c5">
								<tr>
									<th>Sl</th>
									<th>Heading</th>
									<th>Topics</th>
									<th>Created On</th>
									<th>Due Date</th>
									<th>Teacher</th>
								</tr>
							</thead>
							<tbody>
<?php 	
		if($_SESSION['portal_template']=='dashboard_mentor.php') {
				$class_id = $_SESSION['portal_teacher_classid_selected'];	
		}elseif($_SESSION['portal_template']=='dashboard_guardian.php') {
			$student_name = $_SESSION['portal_parent_student_name_selected'];
			$student_id = $_SESSION['portal_parent_studentid_selected'];
			$sql1 = "SELECT class_id,grade from class_student,classes where
			classes.id=class_student.class_id and student_id='$student_id'";
			$result1 = mysqli_query($conn, $sql1);
			if($row1 = $result1->fetch_assoc()) {
				$class_id = $row1['class_id'];
			}
			
		}		
		$sql1 = "SELECT * FROM `home_work` where class_id='$class_id' order by id desc";
		$result1 = mysqli_query($conn, $sql1);
		while($row1 = $result1->fetch_assoc()) {  ?>
								<tr>
									<td  width="20px"><a href="View_home_work.php?id=<?php echo $row1['id'];?>"><?php echo $row1['id'];?></a></td>
									<td> <?php echo $row1['home_work_heading'];?></td>
									<td width="380px">
									<a href="View_home_work.php?id=<?php echo $row1['id'];?>">
									<?php echo $row1['topics_text'];?></a></td>
									<td width="100px"><?php echo $row1['create_time'];?></td>
									<td width="150px"><?php echo $row1['respond_time'];?></td>
									<td width="150px"><?php 
									$teacher_id = $row1['teacher'];
									$sql2 = "SELECT name FROM users where id='$teacher_id'";
									$result2 = mysqli_query($conn, $sql2);
									if($row2 = $result2->fetch_assoc()) {
										echo $row2['name'];
									}
									?></td>
								</tr>
<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>  
		<div class="row">
			<div class="col-lg-3">
				<b><font color="black">Codes Legend</font></b>
				<hr/>
				<ul class="list-group">
  <li class="list-group-item list-group-item-success">Collected/Submitted</li>
  <li class="list-group-item list-group-item-danger">Not Submitted</li>
  <li class="list-group-item list-group-item-info">Late</li>
  <li class="list-group-item list-group-item-warning">Missing</li>
  <li class="list-group-item list-group-item-success">Graded</li>
</ul>

			</div>
		</div>
		</div>
		<!-- /.container-fluid -->
	</form>
</div>
<?php include 'includes/footer.php';?>
