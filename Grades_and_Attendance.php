<?php 
include 'db_conf.php';
include 'includes/header.php';
include 'includes/left_menu.php';
 
 

if(in_array("Grades_and_Attendance", $_SESSION['portal_functions'])) { ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- <font color='green'>P</font>age Heading -->
		<div class="row">

			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-list"></i>&nbsp;&nbsp; <?php 	
					$class_id = $_SESSION['portal_teacher_classid_selected'];
					if($class_id!=''){

						$sql = "SELECT * from classes where id='$class_id'";
						$result = mysqli_query($conn, $sql);
						if($row = $result->fetch_assoc()) {
							$description = $row['description'];
							echo $description;
						}
					}else {
						echo "No assigned class for you";
					}
					?> &nbsp;</li>
				</ol>
			</div>
		</div>
		<?php if($class_id!='') { ?>
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

						</select>
					</form>
				</div>
			</div>
		</div>
		<?php 
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


					$first_year = '2016';
					$second_year = '2017';



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
						krsort($array_date);
						return $array_date;
					}


					$sql = "SELECT students.id as id,students.student_name as student_name  from students,class_student where class_student.student_id=students.id and  class_student.class_id='$class_id'";
					$result = mysqli_query($conn, $sql);
					while($row = $result->fetch_assoc()) {
						$student_name = $row['student_name'];
						$student_id = $row['id'];
						$counter = 0;
						foreach($months as $month) {
							$month_number = $month['month_number'];
							if($month_number=="09"||$month_number==10||$month_number==11||$month_number==12){
								$year=$first_year;
							}else{$year=$second_year;
							}
							$sunday_count = 0;
							foreach (getSundays($year, $month_number) as $sunday) {
								$sunday_count = $sunday_count+1;
								$date =  $sunday;
								$day = date('d',strtotime($sunday));
									
								$sql1 = "SELECT * from student_attendance where class_id='$class_id' and student_id='$student_id' and date='$date'";
								$result1 = mysqli_query($conn, $sql1);
								if($row1 = $result1->fetch_assoc()) {
									$student_status[$student_name][$month_number][$day] = $row1['status'];
								}else {
									$student_status[$student_name][$month_number][$day] = '-';
								}
							}
							$months[$counter]['counter'] = $sunday_count;
							$counter = $counter+1;
						}
					}

					?>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<?php 	if(isset($student_status)){  ?>
					<table class="table table-bordered table-hover"
						style="font-size: 11px; border: 2px solid #337AB7">
						<thead>
							<tr>
								<th>Sl</th>
								<th style="border-right: 2px solid #337AB7">Student</th>
								<?php $c=0;foreach($months as $month) { 
									$month_number = $month['month_number'];
									if($month_number=="09"||$month_number==10||$month_number==11||$month_number==12){
										$year=$first_year;
									}else{$year=$second_year;

									}
									?>
								<th colspan="<?php echo $month['counter'];?>"
									style="border-right: 2px solid #337AB7"><?php echo $month['month'];?>
								</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<?php 
								foreach($months as $month) {
									$month_number = $month['month_number'];
									if($month_number=="09"||$month_number==10||$month_number==11||$month_number==12){
										$year=$first_year;
									}else{$year=$second_year;
									}
									$border_check = 0;
									foreach (getSundays($year, $month_number) as $sunday) {
										$day =  date('d',strtotime($sunday));
										$d =  $sunday;

										if($border_check==0) {
											$border_check=1; $style="border-left:2px solid #337AB7;";
										}else { $style="";
										}
										echo "<td style='$style font-size:11px;padding:4px'><a href='Mark_Attendance.php?pass_date=$d'>$day</a></td>";
									}
								}
								?>
							</tr>
							<?php 
							$student_number = 1;
						foreach($student_status as $student_name=>$student_months_status) {?>
							<tr>
								<td><?php echo $student_number;?></td>
								<td style="border-right: 2px solid #337AB7"><?php echo $student_name;?>
								</td>
								<?php foreach($student_months_status as $month_number=>$day_status) {
									$border_check = 0;
									  foreach($day_status as $day=>$status) {  ?>
								<td
								<?php  if($border_check==0) { $border_check=1; echo "style='font-size:11px;border-left:2px solid #337AB7;'"; }?>>
									<font
									<?php  if($status=='A'){ echo  "color='red'"; } else { echo "color='green'"; } ?>><?php echo $status;?>
								</font>
								</td>
								<?php } 
								}
								?>
							</tr>
							<?php 
							$student_number ++;
						} ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>
</div>
 
<!-- /#page-wrapper -->
<?php }elseif(in_array("Grades_and_Attendance_parent_view", $_SESSION['portal_functions'])) { ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- <font color='green'>P</font>age Heading -->
		<?php 
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
				array("month"=>"May", "month_number"=>'05')
		);


		$first_year = '2016';
		$second_year = '2017';

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
			krsort($array_date);
			return $array_date;
		}
		$student_name = $_SESSION['portal_parent_student_name_selected'];
		$student_id = $_SESSION['portal_parent_studentid_selected'];
		$sql5 = "SELECT class_id,grade from class_student,classes where classes.id=class_student.class_id and student_id='$student_id'";
		$result5 = mysqli_query($conn, $sql5);
		while($row5 = $result5->fetch_assoc()) {
			$class_id = $row5['class_id'];
			$grade_display = $row5['grade'];
			$counter = 0;
			foreach($months as $month) {
				$month_number = $month['month_number'];
				if($month_number=="09"||$month_number==10||$month_number==11||$month_number==12){
					$year=$first_year;
				}else{$year=$second_year;
				}
				$sunday_count = 0;
				foreach (getSundays($year, $month_number) as $sunday) {
					$sunday_count = $sunday_count+1;

					$date =  $sunday;
					$day = date('d',strtotime($sunday));
					$sql1 = "SELECT * from student_attendance where class_id='$class_id'
					and student_id='$student_id' and date='$date'";
					$result1 = mysqli_query($conn, $sql1);
					if($row1 = $result1->fetch_assoc()) {
						$student_status[$student_name][$month_number][$day] = $row1['status'];
					}else {
						$student_status[$student_name][$month_number][$day] = '-';
					}
				}
				$months[$counter]['counter'] = $sunday_count;
				$counter = $counter+1;
			}


			?>
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-list"></i>&nbsp;&nbsp;Report
						&nbsp;</li>
				</ol>
			</div>
			<div class="col-lg-12">
				<div class="page-header">
					<h3>
						Attendence Report for
						<?php echo $student_name;?>
						, Grade:
						<?php echo $grade_display;?>
					</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<?php 	if(isset($student_status)){  ?>
					<table class="table table-bordered table-hover"
						style="border: 2px solid #337AB7">
						<thead>
							<tr>
								<th>Sl</th>
								<th style="border-right: 2px solid #337AB7">Student</th>
								<?php $c=0;foreach($months as $month) { 
									$month_number = $month['month_number'];
									if($month_number=="09"||$month_number==10||$month_number==11||$month_number==12){
										$year=$first_year;
									}else{$year=$second_year;

									}
									?>
								<th colspan="<?php echo $month['counter'];?>"
									style="border-right: 2px solid #337AB7"><?php echo $month['month'];?>
								</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<?php 
								foreach($months as $month) {
									$month_number = $month['month_number'];
									if($month_number=="09"||$month_number==10||$month_number==11||$month_number==12){
										$year=$first_year;
									}else{$year=$second_year;
									}
									$border_check = 0;
									foreach (getSundays($year, $month_number) as $sunday) {
										$day = date('d',strtotime($sunday));
										if($border_check==0) {
											$border_check=1; $style="border-left:2px solid #337AB7;";
										}else { $style="";
										}
										echo "<td style='$style font-size:11px;padding:4px'>$day</td>";
									}
								}
								?>
							</tr>
							<?php 
							$student_number = 1;
						foreach($student_status as $student_name=>$student_months_status) {?>
							<tr>
								<td><?php echo $student_number;?></td>
								<td style="border-right: 2px solid #337AB7"><?php echo $student_name;?>
								</td>
								<?php foreach($student_months_status as $month_number=>$day_status) {
									$border_check = 0;
									  foreach($day_status as $day=>$status) {  ?>
								<td
								<?php  if($border_check==0) { $border_check=1; echo "style='border-left:2px solid #337AB7;'"; }?>>
									<font
									<?php  if($status=='A'){ echo  "color='red'"; } else { echo "color='green'"; } ?>><?php echo $status;?>
								</font>
								</td>
								<?php } 
								}
								?>
							</tr>
							<?php 
							$student_number ++;
						} ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>

		</div>
		<br/><br/>
		<div class="row">
			<div class="col-lg-12">
				<b>Attendance Codes Legend</b>
				<hr/>
				<p>Attendance Codes:  
				P=Present | A=Absent | 5=Absent Half Day | 
				3=Excused Absent Religion | 7=Home Instruction | 
				8=Truant Full Day | 9=Truant Half Day | T=Tardy | 
				U=Tardy Unexcused | E=Present/Early Dismissal | F=Present/Field Trip | 
				N=Present/In School Suspension Full Day | R=Present/In School Suspension Half Day 
				| S=Absent Full Day/Suspension | V=Absent Half Day/Suspension | M=Absent/Family Trip 
				| H=Absent Half Day/Family Trip | W=TOCTWD |Citizenship Codes:  O=Outstanding | 
				S=Satisfactory | U=Unsatisfactory | N=Needs Improvement |
				</p>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>

<?php include 'includes/footer.php';?>