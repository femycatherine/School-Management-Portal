<?php 
include 'db_conf.php';
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';?>
<?php  if(in_array("Manage_Roles", $_SESSION['portal_functions'])) { ?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Roles List&nbsp;
					</li>
					<li><a href="manage_roles.php?action=Add"><button type="button" class="btn btn-<?php echo $configure_theme;?>">Add New Role</button></a>
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
								<th>Role Name</th>
								<th>Role Description</th>
								<th>Design/Template</th>
								<th>Functions</th>
								<th>Create Time</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = "SELECT * FROM roles";
							$result = mysqli_query($conn, $sql);

							 while($row = $result->fetch_assoc()) { 
							 	$id = $row['id'];
							 	?>
							<tr>
								<td><?php echo $id;?></td>
								<td><?php echo $row['role_name'];?></td>
								<td><?php echo $row['role_description'];?></td>
								
								<td><?php echo $row['template'];?></td>
								<td><?php 
								$sql2 = "SELECT * FROM `role_function`, functions WHERE 
								`role_function`.function_id = functions.id and role_function.role_id='$id'";
								$result2 = mysqli_query($conn, $sql2);
								while($row2 = $result2->fetch_assoc()) {
									echo $row2['function_name'].",<br/>";
								}
								
								?></td>
								<td><?php echo $row['create_time'];?></td>
								<td><a class="edit_confirm" style="padding:0px" href="manage_roles.php?action=Edit&role_id=<?php echo $id;?>">
								 		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									</a>&nbsp;&nbsp;
									<a class="delete_confirm" style="padding:0px" href="manage_roles.php?action=Delete&role_id=<?php echo $id;?>"> 
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