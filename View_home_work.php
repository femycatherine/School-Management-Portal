<?php
include 'db_conf.php';
include 'includes/header.php';
include 'includes/left_menu.php';
$home_work_id = $_REQUEST['id'];

if($_REQUEST['form_admission_submit']=='1'){
	$class_id = $_REQUEST[class_id];
	$grade = $_REQUEST[grade];
	$student_name = $_REQUEST[student_name];
	//header("Location: $page?msg=admission_success");
}
$home_work_id = $_REQUEST['id'];
?>
<div id="page-wrapper">
	<form action="" method="post" name="form_admission">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-book"></i>&nbsp;&nbsp;Assignment details</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
				<h4><i>Activity for <?php echo $_SESSION['portal_parent_student_name_selected'];?> </i></h4>
					<div class="table-responsive">

						<?php 	
						$sql1 = "SELECT * FROM `home_work` where id='$home_work_id' order by id desc";

						$result1 = mysqli_query($conn, $sql1);
						if($row1 = $result1->fetch_assoc()) {    
						$due_date = $row1['respond_time'];
						$due_date = date("F j, Y, g:i a", strtotime($due_date));
						
						$date=strtotime($row1['respond_time']);//Converted to a PHP date (a second count)
						
						//Calculate difference
						$diff=$date-time();//time returns current time in seconds
						$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
						$hours=round(($diff-$days*60*60*24)/(60*60));
						//Report
						if($days>=0) { 
							$remaining_time =  "$days days $hours hours";
						}else{
							$remaining_time = "Over";
						}
						
						?>
						<h3>
							<?php echo $row1['home_work_heading'];?>
						</h3>
						<?php  if($row1['upload_link']!='') { ?>
						<a href="http://localhost/portal/portal/<?php echo $row1['upload_link'];?>">Download Assignment file </a>
						<?php } ?>
						<br /><br />
						<?php 	echo $row1['topics_text']; echo "<br/>";  	
						} ?>
					</div>
				</div>
			</div>
			<br/>
			<?php  
			if($_SESSION['portal_template']=='dashboard_guardian.php' ) {    
			$student_id = $_SESSION['portal_parent_studentid_selected'];
			$sql1 = "SELECT * FROM `assignments` where `homework_id` = '$home_work_id' 
			and `student_id` = '$student_id'";
			
			$result1 = mysqli_query($conn, $sql1);
			if($row1 = $result1->fetch_assoc()) {
				$submission_status = "Submitted";
				$grading_status = $row1['grade'];
				$last_modified =  date("F j, Y, g:i a", strtotime($row1['last_update_time']));
				$topics =  $row1['content'];
				$upload_link = $row1['upload_link'];
			}else {
				$submission_status = "Draft(not submitted)";
				$grading_status = "Not graded";
				$last_modified = "Not modified";
				$topics = "...";
				$upload_link = '';
			}
			?>
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-book"></i>&nbsp;&nbsp; Submission Status</li>
					</ol>
				</div>
			</div>
			<div class="row">
			
	
				<div class="col-lg-12">
					<div class="table-responsive">
	                            <table class="table table-bordered table-hover">
	                                <tbody>
	                                    <tr>
	                                        <th width="150px">Submission Status</th>
	                                        <td><?php echo $submission_status;?></td>
	                                    </tr>
	                                    <tr>
	                                        <th>Grading Status</th>
	                                        <td><?php echo $grading_status;?></td>
	                                    </tr>
	                                    <tr>
	                                        <th>Due date</th>
	                                        <td><?php echo $due_date;?></td>
	                                    </tr>
	                                     <tr>
	                                        <th>Time remaining</th>
	                                        <td><?php echo $remaining_time;?></td>
	                                    </tr>                                 
	                                     <tr>
	                                        <th>Last Modified</th>
	                                        <td><?php echo $last_modified;?></td>
	                                    </tr>
	                                    <tr>
	                                        <th>Uploaded file</th>
	                                        <td><?php echo $upload_link;?></td>
	                                    </tr>      
	                                     <tr>
	                                        <th>Online text</th>
	                                        <td> <?php echo $topics;?></td>
	                                    </tr>
	                                    </tbody>
	                            </table>
	                            <?php if($remaining_time!='Over') { ?>
	                            <a class="btn-<?php echo $configure_theme;?> btn" href="homework_submit.php?id=<?php echo $home_work_id;?>">
	                            Add or Edit submission</a>
	                            <?php } ?>
	                        </div>
				</div>
			</div>
		  <?php } ?>
		</div>
		<!-- /.container-fluid -->
	</form>
</div>
<?php include 'includes/footer.php';?>
