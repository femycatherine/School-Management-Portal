<?php 
include 'db_conf.php';
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';

$display = $_REQUEST['display']


?>
<?php  if(in_array("Manage_Roles", $_SESSION['portal_functions'])) { ?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Users
						List&nbsp;</li>
					<li><a href="manage_users.php?action=Add">
							<button type="button" class="btn btn-<?php echo $configure_theme;?>">Add New User</button>
					</a>
					</li>
					<li>
						<!-- Single button -->
						<div class="btn-group ">
							<button type="button"
								class="  btn btn-default dropdown-toggle"
								data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								Role based on  <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
<?php 
	    $sql = "SELECT id, role_name from roles";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
?>
								<li><a href="?display=<?php echo $row['id'];?>"><?php echo $row['role_name'];?></a></li>
<?php } ?>
							</ul>
						</div>
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
								<th>Email</th>
								<th>Name</th>
								<th>Username</th>
								<th>Roles</th>
								<th>Create Time</th>
								<th></th>

							</tr>
						</thead>
						<tbody>
							<?php 
							if($display!='') {
								$sql = "SELECT users.id,users.email,users.name,users.username FROM users,user_role where user_role.user_id = users.id 
							and user_role.role_id= '$display'";
							}else{
								$sql = "SELECT * FROM users";
							}
							$result = mysqli_query($conn, $sql);

							while($row = $result->fetch_assoc()) {
								$id = $row['id'];
								$q = '';
								?>
							<tr>
								<td><?php echo $id;?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['name'];?></td>

								<td><?php echo $row['username'];?></td>
								<td><?php if($display!='') {
									$q = " and user_role.role_id='$display'";
								}
								$sql2 = "SELECT roles.role_name as role_name FROM
								`user_role`,`roles` where user_role.role_id=roles.id and
								user_role.user_id='$id' $q";
								$result2 = mysqli_query($conn, $sql2);
								while($row2 = $result2->fetch_assoc()) {
									echo $row2['role_name'].",<br/>";
								}
								
								?> 
								</td>
								<td><?php echo $row['create_time'];?></td>
								<td><a style="padding:0px"
									href="manage_users.php?action=Edit&user_id=<?php echo $id;?>">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								</a>&nbsp;&nbsp; <a class="delete_confirm" style="padding:0px"
									href="manage_users.php?action=Delete&user_id=<?php echo $id;?>">
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