<?php
session_start();
include('db_conf.php');

$status = '0';
$username = $_REQUEST['username'];
$passwd = $_REQUEST['passwd'];


$sql = "SELECT * FROM users where username = '$username' and pass= '$passwd' and active=1 limit 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$status = '1';
	$_SESSION['portal_username'] = $username; 
	$row = $result->fetch_assoc();
	$id = $row['id'];
	$name = $row['name'];
	$email = $row['email'];
	$_SESSION['portal_username_id'] = $id;
	$_SESSION['portal_name'] = $name;
	$_SESSION['portal_email'] = $email; 
	$_SESSION['portal_class_type'] = 'Faith Formation'; 
	$sql1 = "SELECT roles.role_name as role_name,roles.template,roles.id as id  FROM `user_role`,`roles` where user_role.role_id=roles.id and
	user_role.user_id='$id' order by roles.id asc ";
	$result1 = mysqli_query($conn, $sql1);
	while($row1 = $result1->fetch_assoc()) {
		$array_roles_id[] = $row1['id'];
		$array_roles[] = $row1['role_name'];
		$array_roles_templates[] = $row1['template'];
	}
	$role_id_selected = $array_roles_id[0];
	$_SESSION['portal_roleid_selected'] = $role_id_selected;
	$_SESSION['portal_role_selected'] = $array_roles[0];
	$_SESSION['portal_roles'] = $array_roles;
	$_SESSION['portal_template'] = $page = $array_roles_templates[0].".php";
	
	$sql2 = "SELECT function_variable FROM `role_function`,`functions` 
	WHERE role_function.role_id='$role_id_selected' and role_function.function_id = functions.id";
	$result2 = mysqli_query($conn, $sql2);
	while($row2 = $result2->fetch_assoc()) {
		$array_funtions[] = $row2['function_variable'];
	}
	$_SESSION['portal_functions'] = $array_funtions;
	
	
	
	$sql3 = "SELECT classes.id,classes.grade FROM classes,class_teacher where class_teacher.class_id = classes.id
	and class_teacher.user_id='$id'";
	$result3 = mysqli_query($conn, $sql3);
	$count = 0;
	while($row3 = $result3->fetch_assoc()) {
		$array_classes_info[$count]['class_id'] = $row3['id'];
		$array_classes_info[$count]['grade'] = $row3['grade'];
		$count++;
		
	}
	if(count($array_classes_info)) {
		$_SESSION['portal_teacher_classid_selected'] = $array_classes_info[0]['class_id'];
		$_SESSION['portal_teacher_grade_selected'] = $array_classes_info[0]['grade'];
		$_SESSION['portal_teacher_classes'] = $array_classes_info;
	}else {
		$_SESSION['portal_teacher_classid_selected'] = '';
		$_SESSION['portal_teacher_grade_selected'] = '';
	}
	
	$sql4 = "SELECT students.id as id, students.student_name as name FROM students,student_user where 
	student_user.student_id=students.id and student_user.user_id = '$id'";
	$result4 = mysqli_query($conn, $sql4);
	$count = 0;
	while($row4 = $result4->fetch_assoc()) {
		$array_kids_info[$count]['student_id'] = $row4['id'];
		$array_kids_info[$count]['name'] = $row4['name'];
		$count++;
	
	}
	if(count($array_kids_info)) {
		$_SESSION['portal_parent_studentid_selected'] = $array_kids_info[0]['student_id'];
		$_SESSION['portal_parent_student_name_selected'] = $array_kids_info[0]['name'];
		$_SESSION['portal_parent_students'] = $array_kids_info;
	}else {
		$_SESSION['portal_parent_studentid_selected'] = '';
		$_SESSION['portal_parent_student_name_selected'] = '';
	}
	
	header("Location: $page");
}





?>