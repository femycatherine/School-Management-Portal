<?php
include 'includes/header.php';
include 'includes/left_menu.php';
$msg = '';
?>


<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-dashboard"></i> Overview</li>

				</ol>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-6">
				<div>
					<b>Student list</b>
				</div>
				<div>
					<table class="table" style="height: 100px">
						<thead class="thead-inverse">
							<tr>
								<th>#</th>
								<th>Student Name</th>
								<th>Parents</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = "SELECT * FROM students order by class_id ";
$result = mysqli_query ( $conn, $sql );
$count = 1;
while ( $row = $result->fetch_assoc () ) {
	$class_id = $row ['class_id'];
	$student_id = $row ['id'];
	?>

							<tr>
								<th scope="row"><?php echo $count;?></th>
								<td><?php echo $row['student_name']?></td>
								<td><?php
	$row2 = array ();
	$sql2 = "SELECT users.name as name FROM student_user,users where 
								student_user.student_id='$student_id' and users.id=student_user.user_id";
	$result2 = mysqli_query ( $conn, $sql2 );
	
	while ( $row2 = $result2->fetch_assoc () ) {
		echo $row2 ['name'];
	}
	?> </td>
								<td><?php
	$row2 = array ();
	$sql2 = "SELECT users.email as email FROM student_user,users where 
								student_user.student_id='$student_id' and users.id=student_user.user_id";
	$result2 = mysqli_query ( $conn, $sql2 );
	
	while ( $row2 = $result2->fetch_assoc () ) {
		echo $row2 ['email'];
	}
	?></td>
							</tr>
<?php
	$count = $count + 1;
}
?>
						</tbody>
					</table>

				</div>
			</div>
			<div class="col-lg-6">
				<div>
					<b>Number of students</b>
				</div>
				<div>
					<table class="table">
						<thead class="thead-inverse">
							<tr>
								<th>#</th>
								<th>ClassName</th>
								<th>Co</th>
								<th>Teacher</th>
								<th>T_Email</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = "SELECT class_id, count(*) as value FROM students group by class_id";
$result = mysqli_query ( $conn, $sql );
$count = 1;
while ( $row = $result->fetch_assoc () ) {
	$class_id = $row ['class_id'];
	?>
						
							<tr>
								<th scope="row"><?php echo $count;?></th>
								<td><?php
	$sql2 = "SELECT grade FROM classes where id='$class_id'";
	$result2 = mysqli_query ( $conn, $sql2 );
	if ($row2 = $result2->fetch_assoc ()) {
		echo $row2 ['grade'];
	}
	?></td>
								<td><?php echo $row['value'];?></td>
								<td><?php
	$sql2 = "SELECT name,email FROM class_teacher,users where class_teacher.user_id=users.id and
								class_teacher.class_id='$class_id' and users.name not in ('Femy Ani','Mathew Abraham','Maya Vargheese')";
	$result2 = mysqli_query ( $conn, $sql2 );
	if ($row2 = $result2->fetch_assoc ()) {
		echo $row2 ['name'];
	}
	?></td>
								<td><?php
	$sql2 = "SELECT email FROM class_teacher,users where class_teacher.user_id=users.id and
								class_teacher.class_id='$class_id' and users.name not in ('Femy Ani','Mathew Abraham','Maya Vargheese')";
	$result2 = mysqli_query ( $conn, $sql2 );
	if ($row2 = $result2->fetch_assoc ()) {
		echo $row2 ['email'];
	}
	?></td>
							</tr>
<?php
	
	$count = $count + 1;
}
?>							
						</tbody>
					</table>

				</div>
				<div>
					<b>Teachers list</b>
				</div>
				<div>
					<table class="table">
						<thead class="thead-inverse">
							<tr>
								<th>#</th>
								<th>Teachers</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = "SELECT * FROM users, user_role where user_role.role_id=3 and user_role.user_id=users.id and 
		users.name not in ('Femy Ani','Mathew Abraham','Maya Vargheese')";
$result = mysqli_query ( $conn, $sql );
$count = 1;
while ( $row = $result->fetch_assoc () ) {
	
	?>
						
							<tr>
								<th scope="row"><?php echo $count;?></th>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['email'];?></td>
							</tr>
<?php
	
	$count = $count + 1;
}
?>							
						</tbody>
					</table>

				</div>
				<div></div>
			</div>
		</div>
		<!-- /.container-fluid -->

	</div>

	<!-- /#page-wrapper -->
<?php include 'includes/footer.php';?>