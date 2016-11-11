<?php 
include 'db_conf.php';
include 'includes/header.php';
include 'includes/left_menu.php';



if(in_array("View_Grades", $_SESSION['portal_functions'])) { ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- <font color='green'>P</font>age Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-list"></i>&nbsp;&nbsp; <?php 	
					$class_id = $_SESSION['portal_teacher_classid_selected'];
					$sql = "SELECT * from classes where id='$class_id'";
					$result = mysqli_query($conn, $sql);
					if($row = $result->fetch_assoc()) {
						$description = $row['description'];
						echo $description;
					}
					?> &nbsp;</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<form name='formid'>
						<?php 
						$url  = $_SERVER['REQUEST_URI'];
						?>
						<label>Select Class</label> <select
							onChange="change_teacher_classid(this.value,'<?php echo $url;?>');"
							name="classid_to_be_changed" class="form-control">
							<option value="<?php echo $class_id;?>"><?php echo $row['grade']."&nbsp;&nbsp;&nbsp;($description)";?></option>
							<?php 	
							$class_id = $_SESSION['portal_teacher_classid_selected'];
							$user_id = $_SESSION['portal_username_id'];
							$type = $_SESSION['portal_class_type']; 
							$sql = "SELECT * from classes, class_teacher where
							classes.id = class_teacher.class_id and class_teacher.user_id='$user_id' and classes.type='$type'";
							$result = mysqli_query($conn, $sql);
							while($row = $result->fetch_assoc()) {
								$grade = $row['grade'];
								$id = $row['class_id']; 
								$description = $row['description'];
								echo "<option value='$id'>$grade&nbsp;&nbsp;&nbsp;($description)</option>";
							}
							?>

						</select> <br />
						<?php 	
						$class_id = $_SESSION['portal_teacher_classid_selected'];
						$sql = "SELECT * FROM `home_work` WHERE `class_id` = '$class_id'";
						$result = mysqli_query($conn, $sql);
						if($row = $result->fetch_assoc()) {
						?>
						<select name="homework_select" class="form-control" 
						onChange="change_homework(this.value,'<?php echo $url;?>');">
						<option>Select</option>
						<?php 
						}
						$result = mysqli_query($conn, $sql);
						while($row = $result->fetch_assoc()) {
							$home_work_heading = $row['home_work_heading'];
							$id = $row['id'];
							if($home_work_heading=='') {
								$home_work_heading = 'HomeWork id:'.$id;
							}
						
							echo "<option value='$id'>$home_work_heading</option>";
						}
						$result = mysqli_query($conn, $sql);
						if($row = $result->fetch_assoc()) {
						?>
						</select>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<div id="homework_html"></div>
			</div>
			<div class="col-lg-7">
				<div id="homework_assignment"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
			<b>Please note:</b> <br/>
			 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem 
			 nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
			</div>
		</div>
	</div>
</div>

<?php } ?>

<?php include 'includes/footer.php';?>
