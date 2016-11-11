<?php 
include 'db_conf.php';
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';
 if(in_array("View_CCD_Classes", $_SESSION['portal_functions'])) { ?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Class
						List&nbsp;</li>
					<li><a href="manage_classes.php?action=Add">
							<button type="button" class="btn btn-<?php echo $configure_theme;?>">Add New Class Info</button>
					</a>
					</li>
				</ol>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead style="background-color: #A2C2DE">
							<tr>
								<th>Id</th>
								<th>Description</th>
								<th>Year</th>
								<th>Grade</th>
								<th>Responsible Teachers</th>
								<th></th>

							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = "SELECT * FROM classes";
							$result = mysqli_query($conn, $sql);

							while($row = $result->fetch_assoc()) {
								$id = $row['id'];
								?>
							<tr>
								<td><?php echo $id;?></td>
								<td><?php echo $row['description'];?></td>
								<td><?php echo $row['year'];?></td>

								<td><?php echo $row['grade'];?></td>
								<td><?php
								$sql2 = "SELECT users.name as name FROM
								`users`,`class_teacher` where class_teacher.user_id = users.id and
								class_teacher.class_id='$id'";
								$result2 = mysqli_query($conn, $sql2);
								while($row2 = $result2->fetch_assoc()) {
									echo $row2['name'].",<br/>";
								}
								
								?>
								</td>
								<td><a 
									href="students.php?display=<?php echo $id;?>">
										<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								</a>&nbsp;&nbsp; <a class="edit_confirm" style="padding:0px"
									href="manage_classes.php?action=Edit&class_id=<?php echo $id;?>">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								</a>&nbsp;&nbsp; <a class="delete_confirm" style="padding:0px"
									href="manage_classes.php?action=Delete&class_id=<?php echo $id;?>">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</a>
								</td>
							</tr>
							<?php }	?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>