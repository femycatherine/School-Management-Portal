<?php
session_start();
include 'db_conf.php';

$action = $_REQUEST['action'];
if($action == 'username_db_check') {
	$username = $_REQUEST['username'];

	$sql = "SELECT * FROM users where username = '$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "1";
	} else {
		echo "0";
	}
}
if($action == 'login_check') {
	$login_username = $_REQUEST['login_username'];
	$login_password = $_REQUEST['login_password'];

	$sql = "SELECT * FROM users where username = '$login_username' and pass = '$login_password' and active = 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "1";
	} else {
		echo "0";
	}
}

if($action =='change_homework') {
	$homework_id = $_REQUEST['homework_id'];
	$sql1 = "SELECT * FROM `home_work` where id='$homework_id' order by id desc";

	$result1 = mysqli_query($conn, $sql1);
	if($row1 = $result1->fetch_assoc()) {  ?>
<h3>
	<?php echo $row1['home_work_heading'];?>
</h3>
<?php  if($row1['upload_link']!='') { ?>
<a href="http://localhost/portal/portal/<?php echo $row1['upload_link'];?>"> Download assignment here </a>
<?php } ?>
<br />
<?php 	echo $row1['topics_text']; echo "<br/>"; 
	}
	echo "<hr>";
	?>
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Students</th>
				<th>Grade</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$class_id = $_SESSION['portal_teacher_classid_selected'];

			$sql1 = "SELECT students.id,students.student_name  FROM `students`,class_student
			WHERE students.id = class_student.student_id and class_student.class_id='$class_id'";

			$result1 = mysqli_query($conn, $sql1);
			while($row1 = $result1->fetch_assoc()) {
				$student_id = $row1['id'];
				$sql2 = "select assignments.id,assignments.grade  from assignments, home_work where home_work.id = assignments.homework_id
				and class_id= '$class_id' and homework_id = '$homework_id' and student_id = '$student_id'";

				$result2 = mysqli_query($conn, $sql2);
				if($row2 = $result2->fetch_assoc()) {
					$assignment_id = $row2['id'];
					$grade = $row2['grade'];
					?>
			<tr>
				<td><a
					onClick="view_assignment('<?php echo $assignment_id;?>', '<?php echo $row1['student_name'];?>' );"><?php echo $row1['student_name'];?>
				</a></td>
				<td><?php echo $grade;?></td>
			</tr>
			<?php 
				}else {
					?>
			<tr>
				<td><?php echo $row1['student_name'];?></td>
				<td>Not submitted</td>
			</tr>
			<?php 
				}
			}
			?>
		</tbody>
	</table>
</div>

<?php 	
}
if($action =='view_assignment') {
	?>
<div class="table-responsive">

	<?php 
	$assignment_id = $_REQUEST['assignment_id'];
	$student_name = $_REQUEST['student_name'];
	$sql1 = "SELECT * FROM `assignments` where id='$assignment_id' order by id desc";

	$result1 = mysqli_query($conn, $sql1);
						if($row1 = $result1->fetch_assoc()) {  
							$homework_id = $row1['homework_id'];
							$select = "Select"; 

						?>
	<h3>
		<i> Submitted by <?php echo $student_name;?>
		</i>
	</h3>
	<?php echo $row1['content'];?>
	<?php  if($row1['upload_link']!='') { ?>
	<br/><br/><a href="http://localhost/portal/portal/<?php echo $row1['upload_link'];?>">Download Assignment Here</a><br/><br/>
	<?php }  if($row1['grade']!='') { $select = $row1['grade']; }?>
		<div class="form-group">
	<label>Score above assignment by select below !</label>
	<select onchange="edit_assignment_grade(this.value,'<?php echo $assignment_id;?>' , '<?php echo $homework_id;?>' ,'<?php echo $student_name;?>' )" class="form-control" name="select_grade" >
	<option value="<?php echo $row1['grade'];?>"><?php echo $select; ?></option>
	<option value="A+">A+</option>
	<option value="A">A</option>
	<option value="B+">B+</option>
	<option value="B">B</option>
	<option value="C+">C+</option>
	<option value="C">C</option>
	<option value="D">D</option>
	</select>
	</div>
	<?php } ?>
</div>

<?php 

}
if($action=="edit_grade"){
	$assignment_id = $_REQUEST['assignment_id'];
	$homework_id =  $_REQUEST['homework_id'];
	$grade = $_REQUEST['grade'];
	$sql1 = " Update `assignments` set grade = '$grade' where id= '$assignment_id'";
	$result1 = mysqli_query($conn, $sql1);
}








?>