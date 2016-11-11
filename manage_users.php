<?php 
include 'sess_conf.php';
include 'db_conf.php';

if(in_array("Manage_Users", $_SESSION['portal_functions'])) {
	$email = $user_id = $name = $username = '';
	$roles_m_u = array();
	$action = $_REQUEST['action'];
	
	if($action=='To_add') { 
		$email = $_REQUEST['email'];
		$name = $_REQUEST['name'];
		$username = $_REQUEST['username'];
		if(isset($_REQUEST['roles'])) {
			$roles_m_u = $_REQUEST['roles'];
		}
		$sql = "INSERT INTO `users` 
		  (`id`, `email`, `name`, `username`, `create_time`) VALUES (NULL, '$email', '$name', '$username', now())";
		$result = mysqli_query($conn, $sql);
		$id =  mysqli_insert_id($conn);
		if($roles_m_u!=''){
			foreach($roles_m_u as $r_id) {
				$sql = "INSERT INTO `user_role` (`id`, `user_id`, `role_id`) 
				VALUES (NULL, '$id', '$r_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		header('Location: users.php');
	}elseif($action=='To_edit') {
		$user_id = $_REQUEST['user_id'];
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$username = $_REQUEST['username'];
		if(isset($_REQUEST['roles']))
		$roles_m_u = $_REQUEST['roles'];
	
		$sql = "UPDATE `users`
		SET `name` = '$name',	`email` = '$email', `username` = '$username'
		WHERE `users`.`id` = '$user_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `user_role` WHERE `user_role`.`user_id` = '$user_id'";
		$result = mysqli_query($conn, $sql);
		if($roles_m_u!=''){
			foreach($roles_m_u as $r_id) {
				$sql = "INSERT INTO `user_role`
				(`id`, `user_id`, `role_id`) VALUES (NULL, '$user_id', '$r_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		header('Location: users.php');
	}elseif($action=='Edit') {
		$user_id = $_REQUEST['user_id'];
		$sql1 = "SELECT * FROM users where users.id='$user_id'";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$name = $row1['name'];
			$email = $row1['email'];
			$username = $row1['username'];
		} 
		$sql1 = "SELECT * FROM user_role where user_role.user_id='$user_id'";
		$result1 = mysqli_query($conn, $sql1);
		$roles_m_u= array();
		while($row1 = $result1->fetch_assoc()) {
			$roles_m_u[] = $row1['role_id']; 
		}
		$action = 'To_edit';
	}elseif($action=='Delete') {
		$user_id = $_REQUEST['user_id'];
		$sql = "DELETE FROM `users` WHERE `id` = '$user_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `user_role` WHERE `user_role`.`user_id` = '$user_id'";
		$result = mysqli_query($conn, $sql);
		header('Location: users.php');
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
	                            <li class="active">
	                                <i class="fa fa-star"></i>&nbsp;&nbsp;<?php echo $action;?> user
	                            </li>
	                        </ol>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-lg-6">
	
	                        <form role="form" action="" method="post" >
								<?php 
								if($action=='Add'){ $action = 'To_add';  $roles_m_u = array(); }
								if($action=='Edit'){	$action = 'To_edit';
								}
								?>
								
								<input type="hidden" name="action" value="<?php echo $action;?>"/>
								<input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
								
	                            <div class="form-group">
	                                <label>User Name</label>
	                                <input class="form-control" value="<?php echo $name; ?>" placeholder="" name="name">
	                            </div>
	                          
	                            <div class="form-group">
	                                <label>Email</label>
	                                <textarea class="form-control" rows="3"  name="email" ><?php echo $email; ?></textarea>
	                            </div>
	                            <div class="form-group">
	                                <label>Username</label>
	                                <input class="form-control" value="<?php echo $username; ?>" placeholder="" name="username">
	                            </div>
	               				<div class="form-group">
	                                <label>Roles to be added</label>
	                                <select name="roles[]" multiple="" class="form-control">
	<?php
	    $sql = "SELECT id, role_name from roles";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option  <?php  if(in_array($row['id'],$roles_m_u)){ echo "selected"; }?> value="<?php echo $row['id'];?>"><?php echo $row['role_name'];?></option>
	<?php } ?>
	                                   
	                                </select>
	                            </div>
	                            <button type="submit" class="btn btn-default">Submit Button</button>
	                            <button type="reset" class="btn btn-default">Reset Button</button>
	
	                        </form>
							<br/><br/><br/><br/>
	                    </div>
	                </div>
		
		
		</div>
	</div>
	<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>