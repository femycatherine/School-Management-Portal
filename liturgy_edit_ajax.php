<?php
include 'sess_conf.php';
include 'db_conf.php';

$action =  $_REQUEST['action'];

if($action == "edit_activity") {
	$id = $_REQUEST['id'];
	$id = substr($id, 14);
	$id_array = explode('0000',$id);
	$category = $id_array[0];
	$liturgy_member_id = $id_array[1];
    $date = str_replace('_','-',$id_array[2]);
	$value = $_REQUEST['value'];
	if($category=='students') {
		$sql1 = "SELECT * FROM `liturgy` WHERE student_id = '$liturgy_member_id' and day = '$date' and category='students'";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$sql2 = "update `liturgy` set activity = '$value' where student_id = '$liturgy_member_id' and day = '$date'  and category='students' ";
			$result2 = mysqli_query($conn, $sql2);
		}else {
			$sql2 = "INSERT INTO `liturgy` (`id`, `student_id`, `user_id`, `day`, `activity`, `category`) 
			VALUES (NULL, '$liturgy_member_id', '', '$date', '$value', 'students')";;
			$result2 = mysqli_query($conn, $sql2);
		}
	}
	if($category=='elders') {
		$sql1 = "SELECT * FROM `liturgy` WHERE user_id = '$liturgy_member_id' and day = '$date' and category='elders'";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$sql2 = "update `liturgy` set activity = '$value' where user_id = '$liturgy_member_id' and day = '$date'  and category='elders' ";
			$result2 = mysqli_query($conn, $sql2);
		}else {
			echo $sql2 = "INSERT INTO `liturgy` (`id`, `user_id`, `day`, `activity`, `category`)
			VALUES (NULL, '$liturgy_member_id', '$date', '$value', 'elders')";;
			$result2 = mysqli_query($conn, $sql2);
		}
		}
}

?>