<?php 
include 'db_conf.php';
include 'includes/header.php';
include 'includes/left_menu.php';
$date_to_be_added = $_REQUEST['pass_date'];
//echo $date_to_be_added = date('Y-m-d', strtotime('last Sunday', strtotime('2016-03-12'))); exit;
if(!isset($date_to_be_added)) { 
	$date_to_be_added = date('Y-m-d', strtotime('last Sunday', strtotime(date('Y-m-d'))));
	
}

$months = array
(
		array("month"=>"September", "month_number"=>'09'),
		array("month"=>"October", "month_number"=>'10'),
		array("month"=>"November", "month_number"=>'11'),
		array("month"=>"December", "month_number"=>'12'),
		array("month"=>"January", "month_number"=>'01'),
		array("month"=>"February", "month_number"=>'02'),
		array("month"=>"March", "month_number"=>'03'),
		array("month"=>"April", "month_number"=>'04'),
		array("month"=>"May", "month_number"=>'05'),
		array("month"=>"June", "month_number"=>'06')
);


$first_year = '2015';
$second_year = '2016';

function getSundays($y, $m)
{
	$start_strtotime = strtotime("$y-$m-01"); 
	$end_strtotime = strtotime(date("$y-$m-t"));
	while($start_strtotime<=$end_strtotime) {
		$end_strtotime = strtotime("last sunday", $end_strtotime);
		$last_date = date('Y-m-d',$end_strtotime); 
		if($start_strtotime<=$end_strtotime)
			$array_date[] = $last_date;
	}

	return $array_date;
}
$sunday_count = 0;
foreach($months as $month) {
	$month_number = $month['month_number'];
	if($month_number=='09'||$month_number==10||$month_number==11||$month_number==12){
		$year=$first_year;
	}else{$year=$second_year;
	}

	
	foreach (getSundays($year, $month_number) as $sunday) {
		$date_array[$sunday_count] =  $sunday; 
		$sunday_count++;
		
	}
}

if(in_array("Mark_Attendance", $_SESSION['portal_functions'])) { ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<form name='formid' action="mark_attendance_action.php" method="post">

			<!-- <font color='green'>P</font>age Heading -->
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-list"></i>&nbsp;&nbsp;Mark
							Attendance&nbsp;</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
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
							$sql = "SELECT * from classes, class_teacher where classes.id = class_teacher.class_id and class_teacher.user_id='$user_id'";
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
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
					<label>Date</label> 
					<select name="date_of_status"  class="form-control">
					<?php if($date_to_be_added!=''){ ?>
						<option value="<?php echo $date_to_be_added;?>"><?php echo $date_to_be_added;?></option>
					<?php } ?>
					<?php foreach($date_array as $k=>$d) { ?>
					<option value="<?php echo $d;?>"><?php echo $d;?></option>
					<?php } ?>
					</select>
					<span class="help-block">YYYY-MM-DD</span>
					</div>
				</div>
			</div> 

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<form name="form_id">
							<label>Students</label>
							<?php 
							$sql = "SELECT students.id as id,students.student_name as student_name  from students,class_student where class_student.student_id=students.id and  class_student.class_id=$class_id";
							$result = mysqli_query($conn, $sql);
							$count = 0;
							while($row = $result->fetch_assoc()) {
								$count = $count +1;
								$student_id = $row['id'];
								$sql8 = "SELECT status FROM `student_attendance` where `student_id` = '$student_id' and `class_id` = '$class_id' and date ='$date_to_be_added'";
								$result8 = mysqli_query($conn, $sql8);
								$checked = 'checked';
								if($row8 = $result8->fetch_assoc()) {
									if($row8['status']=='A'){
										$checked = '';
									}
								}
								?>
							<div class="checkbox">
								<?php echo $count;?>
								)&nbsp; <label><input type="checkbox"
									name="status_<?php echo $row['id'];?>" value="1" <?php echo $checked;?>> <?php echo $row['student_name'];?>
								</label>
							</div>

							<?php }	?>
							<button type="submit" class="btn btn-<?php echo $configure_theme;?> btn-default">Save</button>
							<button type="reset" class="btn btn-<?php echo $configure_theme;?> btn-default">Reset</button>

						</form>
					</div>
				</div>
			</div>
		</form>
	</div>
</div> 


<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>