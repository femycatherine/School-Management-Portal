<?php 
require 'PHPMailer-master/PHPMailerAutoload.php';
include 'sess_conf.php';
include 'db_conf.php';



if(in_array("Home_Work_information", $_SESSION['portal_functions'])) {
	$action = $_REQUEST['action'];

	if($action=='To_add') {
		$home_work_heading = $_REQUEST['home_work_heading'];
		$topics = $_REQUEST['topics'];
		$upload_image = $_REQUEST['upload_image'];
		$respond = $_REQUEST['respond'];
		$class_id = $_SESSION['portal_teacher_classid_selected'];
		$grade = $_SESSION['portal_teacher_grade_selected'];
		$user_id = $_SESSION['portal_username_id'];
	
		$teacher_id = $user_id;
		$sql2 = "SELECT name FROM users where id='$teacher_id'";
		$result2 = mysqli_query($conn, $sql2);
		if($row2 = $result2->fetch_assoc()) {
			$created_by =  $row2['name'];
		}
		
		
		if($respond!='') {
			$due_date = "(Due Date:$respond)";
		}
		if(isset($_REQUEST['send_parents'])){
			$send_parents = $_REQUEST['send_parents'];
			$sql1 = "SELECT students.email,students.id,students.student_name FROM `class_student`,students where class_student.class_id='$class_id' and 
			class_student.student_id = students.id";
			$result1 = mysqli_query($conn, $sql1);
			
			////////////////////////////////////////
			//Create a new PHPMailer instance
			$mail = new PHPMailer;
			//Set who the message is to be sent from
			$mail->setFrom('stjudesj@web4.bijoys.net', 'St Jude Church');
			//Set an alternative reply-to address
			$mail->addReplyTo('stjudesj@web4.bijoys.net', 'St Jude Church');
			//Set who the message is to be sent to
			$mail->addCustomHeader("BCC: femy.123@gmail.com");
			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>  
		<head> 
		  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		  <title>Homework</title>
		</head>
		<body> 
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold;font-color:black;">
		 '.$home_work_heading.'</div> '.$due_date.' <br/><br/><br/><div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight:normal;font-color:black;">
		'.$topics.'<br/><br/>Created by: <b>'.$created_by.'
		</div>
		</body> 
		</html>'; 
			$mail->msgHTML($body);
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			/////////////////////////////////////////
			   
			while($row1 = $result1->fetch_assoc()) {
				$email = $row1['email'];
				$student_name = $row1['student_name'];
				$mail->Subject = "CCD Home Work for $student_name";
  
				$mail->addAddress("$email", "$email");
				//send the message, check for errors
				if (!$mail->send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
					//echo "Message sent!";
				}
				
			}
		} 

		$sql = "INSERT INTO `home_work`
		(`id`, `home_work_heading`, `class_id`, `topics_text`, `upload_link`, `create_time`, `respond_time`, `teacher`)
		VALUES (NULL, '$home_work_heading'  , '$class_id', '$topics', '', now(), '$respond', '$user_id')";
		
		$result = mysqli_query($conn, $sql);
		$id = mysqli_insert_id($conn);
		
		$target_dir = "uploads/$id/";
		mkdir("uploads/".$id."/", 0700);
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		
		
		$sql = "UPDATE `home_work`
		set `upload_link`= '$target_file' where id='$id'";
		
		$result = mysqli_query($conn, $sql);
		header('Location: Home_Work_information.php');
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
					<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;Add Home
						Work</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<form name='formid' >
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
							classes.id = class_teacher.class_id and class_teacher.user_id='$user_id' and classes.type='$type'";
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
		</div>
		<div class="row">
			<div class="col-lg-8">
				<form role="form" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="action" value="To_add" />
					<div class="form-group">
						<label>Heading</label>
						<input type="text" class="form-control" name="home_work_heading">
					</div>
					<div class="form-group">
						<label>Topics</label>
						<textarea class="form-control" name="topics"></textarea>
					</div>
					<div class="form-group">
						<label>Upload</label> <input name="fileToUpload" id="fileToUpload"
							class="form-control" type="file">
					</div>   
					<div class="form-group">
						<label>Report Date</label> <input placeholder="YYYY-MM-DD"
							class="form-control" type="date" name="respond">
					</div>
					<div class="form-group">
						<label>Send homework info to parents:&nbsp;<input  type="checkbox" name="send_parents" value="1"></label>
					</div>

					<button type="submit" class="btn btn-default">Submit Button</button>
					<button type="reset" class="btn btn-default">Reset Button</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>