<?php 
include 'sess_conf.php';
include 'db_conf.php';
$home_work_id = $_REQUEST['id'];
$student_id = $_SESSION['portal_parent_studentid_selected'];
if($_SESSION['portal_template']=='dashboard_guardian.php' ) {
	$action = $_REQUEST['action'];

	if($action=='To_add') {
		$homework_id = $_REQUEST['homework_id'];
		$topics = $_REQUEST['topics'];
		$upload_image = $_REQUEST['upload_image'];
		$student_id = $_SESSION['portal_parent_studentid_selected'];
		$assignment_id = $_REQUEST['assignment_id'];

		if($assignment_id=='') {
			$sql = "INSERT INTO `assignments` (`id`, `homework_id`, `student_id`, `content`,
			`upload_link`, `last_update_time`) VALUES 
			(NULL, '$homework_id', '$student_id', '$topics', '', now())";
	
			$result = mysqli_query($conn, $sql);
			$id = mysqli_insert_id($conn);
		}else {
			$sql = "Update `assignments` set `content` = '$topics',  
			`last_update_time` = now() where id= '$assignment_id'  ";
			
			$result = mysqli_query($conn, $sql);
			$id = $assignment_id;
			
		}
		$target_dir = "uploads/$id/";
		mkdir("uploads/".$id."/", 0700);
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

		if($_FILES["fileToUpload"]["tmp_name"]) {
			$sql = "UPDATE `assignments`
			set `upload_link`= '$target_file' where id='$id'";
	
			$result = mysqli_query($conn, $sql);
		}
		
		header('Location: View_home_work.php?id='.$homework_id);
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
					<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;HomeWork
						Submission</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">

					<?php 	
					$sql1 = "SELECT * FROM `home_work` where id='$home_work_id' order by id desc";

					$result1 = mysqli_query($conn, $sql1);
						if($row1 = $result1->fetch_assoc()) {    ?>
					<h3>
						<?php echo $row1['home_work_heading'];?>
					</h3>
					<?php  if($row1['upload_link']!='') { ?>
					<a href="http://localhost/portal/portal/<?php echo $row1['upload_link'];?>"> Download file </a>
					<?php } ?>
					<br />
					<?php 	echo $row1['topics_text']; echo "<br/>";  	
						} ?>
				</div>
			</div>
		</div>
		<hr></hr>
		<div class="row">
			<div class="col-lg-8">
				<form role="form" action="" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="action" value="To_add" />
					<input type="hidden" name="homework_id" value="<?php echo $home_work_id;?>" />
					
					<div class="form-group">
<?php 					
						$sql1 = "SELECT * FROM `assignments` where homework_id='$home_work_id' and student_id = '$student_id' order by id desc";

						$result1 = mysqli_query($conn, $sql1);
						if($row1 = $result1->fetch_assoc()) {   
							$content = $row1['content'];
							$upload_link = $row1['upload_link'];
							$assignment_id = $row1['id'];
						}
?>						<input type="hidden" name="assignment_id" value="<?php echo $assignment_id;?>" />
						<label>Write Answer here</label>
						<textarea class="form-control" name="topics"><?php echo $content;?></textarea>
					</div>
					<div class="form-group">
						<label>Upload files &nbsp; <?php echo $upload_link;?></label> <input name="fileToUpload" id="fileToUpload"
							class="form-control" type="file">
					</div>


					<button type="submit" class="btn btn-<?php echo $configure_theme;?>">Submit Button</button>
					<button type="reset" class="btn btn-<?php echo $configure_theme;?>">Reset Button</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>