<?php
session_start();
include('db_conf.php');

$status = '0';
$action = $_REQUEST['action'];


$username = $_SESSION['portal_username'];
$user_id= $_SESSION['portal_username_id'];
$role_id_session = $_SESSION['portal_roleid_selected'];

if($action == 'change_teacher_classid') {
	$class_id = $_REQUEST['class_id'];
	$sql3 = "SELECT classes.id,classes.grade FROM classes,class_teacher where class_teacher.class_id = classes.id
	and class_teacher.user_id='$user_id' and class_teacher.class_id='$class_id' ";
	$result3 = mysqli_query($conn, $sql3);
	$count = 0;
	if($row3 = $result3->fetch_assoc()) {
		$_SESSION['portal_teacher_classid_selected'] = $row3['id'];
		$_SESSION['portal_teacher_grade_selected'] = $row3['grade'];
	}else{
		$_SESSION['portal_teacher_classid_selected'] = '';
		$_SESSION['portal_teacher_grade_selected'] = '';
	}
}elseif($action == 'change_parent_student_id'){
	$student_id = $_REQUEST['student_id'];
	$sql3 = "SELECT students.id as id, students.student_name as name FROM students,student_user where
	student_user.student_id=students.id and student_user.user_id = '$user_id' and student_user.student_id = '$student_id'";
	$result3 = mysqli_query($conn, $sql3);
	$count = 0;
	if($row3 = $result3->fetch_assoc()) {
		$_SESSION['portal_parent_studentid_selected'] = $row3['id'];
		$_SESSION['portal_parent_student_name_selected'] = $row3['name'];
	}else{
		$_SESSION['portal_parent_studentid_selected'] = '';
		$_SESSION['portal_parent_student_name_selected'] = '';
	}
}elseif($action == 'change_class_type'){
	$type = $_REQUEST['type'];
	$_SESSION['portal_class_type'] = $type; 

	
}

?>


