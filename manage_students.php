<?php 
include 'sess_conf.php';
include 'db_conf.php';

if(in_array("View_Students", $_SESSION['portal_functions'])) {
	$classes = array();
	$parents = array();
	$action = $_REQUEST['action'];
	
	if($action=='To_edit') {
		$student_id = $_REQUEST['student_id'];
		if(isset($_REQUEST['classes']))
		$classes = $_REQUEST['classes'];
	
		if(isset($_REQUEST['parents']))
		$parents = $_REQUEST['parents'];
		
		$sql = "DELETE FROM `class_student` WHERE `class_student`.`student_id` = '$student_id'";
		$result = mysqli_query($conn, $sql);
		
		if($classes!=''){
			foreach($classes as $c_id) {
				$sql = "INSERT INTO `class_student`
				(`id`, `class_id`, `student_id`) VALUES (NULL, '$c_id', '$student_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		$sql = "DELETE FROM `student_user` WHERE `student_user`.`student_id` = '$student_id'";
		$result = mysqli_query($conn, $sql);
		
		if($parents!=''){
			foreach($parents as $u_id) {
				$sql = "INSERT INTO `student_user`
				(`id`, `student_id`, `user_id`) VALUES (NULL, '$student_id', '$u_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		
		header('Location: students.php');
	}elseif($action=='Edit') {
		$student_id = $_REQUEST['student_id'];
		$sql1 = "SELECT * FROM class_student where class_student.student_id='$student_id'";
		$result1 = mysqli_query($conn, $sql1);
		$classes= array();
		$parents = array();
		
		while($row1 = $result1->fetch_assoc()) {
			$classes[] = $row1['class_id']; 
		}
		$sql2 = "SELECT * FROM student_user where student_user.student_id='$student_id'";
		$result2 = mysqli_query($conn, $sql2);
		while($row2 = $result2->fetch_assoc()) {
			$parents[] = $row2['user_id'];
		}
		
		$action = 'To_edit';
	}elseif($action=='Delete') {
		$student_id = $_REQUEST['student_id'];
		$sql = "DELETE FROM `students` WHERE `id` = '$student_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `class_student` WHERE `class_student`.`student_id` = '$student_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `student_user` WHERE `student_user`.`student_id` = '$student_id'";
		$result = mysqli_query($conn, $sql);
		
		header('Location: students.php');
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
	                            <li class="active">
	                                <i class="fa fa-star"></i>&nbsp;&nbsp;<?php echo $action;?> Student
	                            </li>
	                        </ol>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-lg-6">
	
	                        <form role="form" action="" method="post" >
								<?php 
								if($action=='Edit'){	$action = 'To_edit';
								}
								?>
								
								<input type="hidden" name="action" value="<?php echo $action;?>"/>
								<input type="hidden" name="student_id" value="<?php echo $student_id;?>"/>
								
	                         
	               				<div class="form-group">
	                                <label>Classes to be added</label>
	                                <select name="classes[]" multiple="" class="form-control">
	<?php 
		$sql_check = "SELECT * from malayalam_class_students where student_id = '$student_id'";
		$result_check = mysqli_query($conn, $sql_check);
		if($row_check = $result_check->fetch_assoc()) {
			$sql = "SELECT id, grade from classes";
		}else {
	    	$sql = "SELECT id, grade from classes where type='Faith Formation'";
		}
	    $result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option  <?php  if(in_array($row['id'],$classes)){ echo "selected"; }?> value="<?php echo $row['id'];?>"><?php echo $row['grade'];?></option>
	<?php } ?>
	                                   
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label>Guardians to be added</label>
	                                <select name="parents[]" multiple="" class="form-control">
	<?php 
	    $sql = "SELECT id,name from users";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option  <?php  if(in_array($row['id'],$parents)){ echo "selected"; }?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
	<?php } ?>
	                                   
	                                </select>
	                            </div>
	                            <button type="submit" class="btn btn-default">Submit Button</button>
	                            <button type="reset" class="btn btn-default">Reset Button</button>
	
	                        </form>
							<br/><br/><br/><br/>
	                    </div>
	                </div>
		
		
		</div>
	</div>
	<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>