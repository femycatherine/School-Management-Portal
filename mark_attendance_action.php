<?php
include 'sess_conf.php';
include 'db_conf.php';

$class_id = $_SESSION['portal_teacher_classid_selected'];
$date_of_status = $_REQUEST['date_of_status'];
$sql = "SELECT students.id as id,students.student_name as student_name  from students,class_student where class_student.student_id=students.id and  class_student.class_id='$class_id'";
$result = mysqli_query($conn, $sql);
$count = 0;
while($row = $result->fetch_assoc()) {
	$status = $_REQUEST['status_'.$row['id']];
	$student_id = $row['id'];
	
	$sql7 = "DELETE FROM `student_attendance` WHERE 
	`student_attendance`.`student_id` = '$student_id' and `student_attendance`.`student_id` = '$student_id' and
	`student_attendance`.`class_id` = '$class_id' and `student_attendance`.`date` = '$date_of_status'";
	$result7 = mysqli_query($conn, $sql7);
	if(isset($status)) {

			$sql2 = "INSERT INTO `student_attendance` 
			(`id`, `student_id`, `class_id`, `date`, `status`) VALUES 
			(NULL, '$student_id', '$class_id', '$date_of_status', 'P')";
			$result2 = mysqli_query($conn, $sql2);
		
	}else {
			$sql3 = "INSERT INTO `student_attendance`
			(`id`, `student_id`, `class_id`, `date`, `status`) VALUES
			(NULL, '$student_id', '$class_id', '$date_of_status', 'A')";
			$result3 = mysqli_query($conn, $sql3);
		
	}
	
}
header('Location: Grades_and_Attendance.php');
?>