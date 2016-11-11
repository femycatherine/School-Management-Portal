<?php
session_start();
include('db_conf.php');

$status = '0';
$role = $_REQUEST['role'];
$username = $_SESSION['portal_username'];
$user_id= $_SESSION['portal_username_id'];
$role_id_session = $_SESSION['portal_roleid_selected'];
$sql = "SELECT * FROM `user_role`,roles where `user_id` = '$user_id' 
and roles.role_name='$role' and `user_role`.`role_id` = roles.id";
$result = mysqli_query($conn, $sql);
$array_funtions = array('');
if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();
	$role_id = $row['role_id'];
	$_SESSION['portal_role_selected'] = $role;
	$_SESSION['portal_roleid_selected'] = $role_id;
	$_SESSION['portal_template'] = $page = $row['template'].".php";
	
	$sql2 = "SELECT function_variable FROM `role_function`,`functions` 
	WHERE role_function.role_id='$role_id' and role_function.function_id = functions.id";
	$result2 = mysqli_query($conn, $sql2);
	while($row2 = $result2->fetch_assoc()) {
		$array_funtions[] = $row2['function_variable'];
	}
	$_SESSION['portal_functions'] = $array_funtions;
	header("Location: $page");
}

