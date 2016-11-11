<?php 
include 'sess_conf.php';
include 'db_conf.php';

if(in_array("View_CCD_Classes", $_SESSION['portal_functions'])) {
	$description = $class_id = $year = $grade = ''; 
	$teachers = array();
	$action = $_REQUEST['action'];
	
	if($action=='To_add') { 
		$description = $_REQUEST['description'];
		$year = $_REQUEST['year'];
		if($_REQUEST['other_type']=='') { 
			$type = $_REQUEST['type'];
		}else { 
			$type = $_REQUEST['other_type'];
		}
		$grade = $_REQUEST['grade'];
		if(isset($_REQUEST['teachers']))
		$teachers = $_REQUEST['teachers'];
	
		$sql = "INSERT INTO `classes` 
		  (`id`, `description`, `year`, `grade`, `create_time` , `type`) VALUES (NULL, '$description', '$year', '$grade', now(),'$type')";
		$result = mysqli_query($conn, $sql);
		$id =  mysqli_insert_id($conn);
		if($teachers!=''){
			foreach($teachers as $t_id) {
				$sql = "INSERT INTO `class_teacher` (`id`, `class_id`, `user_id`) 
				VALUES (NULL, '$id', '$t_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		header('Location: classes.php');
	}elseif($action=='To_edit') {
		$class_id = $_REQUEST['class_id'];
		$year = $_REQUEST['year'];
		if($_REQUEST['other_type']=='') { 
			$type = $_REQUEST['type'];
		}else {
			$type = $_REQUEST['other_type'];
		}
		$description = $_REQUEST['description'];
		$grade = $_REQUEST['grade'];
		if(isset($_REQUEST['teachers']))
		$teachers = $_REQUEST['teachers'];
	
		$sql = "UPDATE `classes`
		SET `year` = '$year',	`description` = '$description', `grade` = '$grade' , `type` = '$type'
		WHERE `classes`.`id` = '$class_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `class_teacher` WHERE `class_teacher`.`class_id` = '$class_id'";
		$result = mysqli_query($conn, $sql);
		if($teachers!=''){
			foreach($teachers as $t_id) {
				$sql = "INSERT INTO `class_teacher`
				(`id`, `class_id`, `user_id`) VALUES (NULL, '$class_id', '$t_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		header('Location: classes.php');
	}elseif($action=='Edit') {
		$class_id = $_REQUEST['class_id'];
		$sql1 = "SELECT * FROM classes where id='$class_id'";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$year = $row1['year'];
			$description = $row1['description'];
			$grade = $row1['grade'];
			$type = $row1['type'];
		}
		
		$sql1 = "SELECT * FROM class_teacher where class_teacher.class_id='$class_id'";
		$result1 = mysqli_query($conn, $sql1);
		$teachers= array();
		while($row1 = $result1->fetch_assoc()) {
			$teachers[] = $row1['user_id']; 
		}
		$action = 'To_edit';
	}elseif($action=='Delete') {
		$class_id = $_REQUEST['class_id'];
		$sql = "DELETE FROM `classes` WHERE `id` = '$class_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `class_teacher` WHERE `class_teacher`.`class_id` = '$class_id'";
		$result = mysqli_query($conn, $sql);
		header('Location: classes.php');
	}elseif ($action=='Add'){
		
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
	                                <i class="fa fa-star"></i>&nbsp;&nbsp;<?php echo $action;?> Class
	                            </li>
	                        </ol>
	                    </div> 
	                </div> 
	                <div class="row">
	                    <div class="col-lg-6">
	
	                        <form role="form" action="" method="post" >
								<?php 
								if($action=='Add'){ $action = 'To_add'; $year = '2016-17';}
								if($action=='Edit'){	$action = 'To_edit';
								}
								?>  
								
								<input type="hidden" name="action" value="<?php echo $action;?>"/>
								<input type="hidden" name="class_id" value="<?php echo $class_id;?>"/>
								
	                            <div class="form-group">
	                                <label>Year</label>
	                                <input class="form-control" value="<?php echo $year; ?>" placeholder="" name="year">
	                            </div>
	                          
	                            <div class="form-group">
	                                <label>Description</label>
	                                <textarea class="form-control" rows="3"  name="description" ><?php echo $description; ?></textarea>
	                            </div>
	                            <div class="form-group">
	                                <label>Grade</label>
	                                <input class="form-control" value="<?php echo $grade; ?>" placeholder="" name="grade">
	                            </div>
	                            <div class="form-group">
	                                <label>Category</label>
	                                 <select name="type"  class="form-control">
	<?php 
	    $sql = "SELECT distinct(type) from classes";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option  <?php  if($row['type']==$type){ echo "selected"; }?> value='<?php echo $row["type"];?>'><?php echo $row['type'];?></option>
	<?php } ?>
	                                    
	                                </select>
	                                <br/>
	                                 <label>Other than above category</label>
	                                <input class="form-control" value="" 
	                                placeholder="" name="other_type">
	                                
	                            </div>	                            
	               				<div class="form-group">
	                                <label>Teachers to be added. (List of users with Role: "Teacher")</label>
	                                <select name="teachers[]" multiple="" class="form-control">
	<?php 
	    $sql = "SELECT users.id, users.name from users, user_role where users.id=user_role.user_id 
	    and user_role.role_id='3'";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option  <?php  if(in_array($row['id'],$teachers)){ echo "selected"; }?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
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
	<?php include 'includes/footer.php';?>
<?php } ?>
