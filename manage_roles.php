<?php 
include 'sess_conf.php';
include 'db_conf.php';

if(in_array("Manage_Roles", $_SESSION['portal_functions'])) { 
	$role_name = $role_id = $role_description = $template = '';
	$functions = array();
	$action = $_REQUEST['action'];
	
	if($action=='To_add') { 
		$role_name = $_REQUEST['role_name'];
		$role_description = $_REQUEST['role_description'];
		$template = $_REQUEST['template'];
		if(isset($_REQUEST['functions']))
		$functions = $_REQUEST['functions'];
		$sql = "INSERT INTO `roles` 
		(`id`, `role_name`, `role_description`, `template`, `create_time`) VALUES 
		(NULL, '$role_name', '$role_description', '$template', now())";
		$result = mysqli_query($conn, $sql);
		$id =  mysqli_insert_id($conn);
		if($functions!=''){
			foreach($functions as $f_id) {
				$sql = "INSERT INTO `role_function` 
				(`id`, `role_id`, `function_id`) VALUES (NULL, '$id', '$f_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		header('Location: roles.php');
	}elseif($action=='To_edit') {
		$role_id = $_REQUEST['role_id'];
		$role_name = $_REQUEST['role_name'];
		$role_description = $_REQUEST['role_description'];
		$template = $_REQUEST['template'];
		if(isset($_REQUEST['functions']))
		$functions = $_REQUEST['functions'];
	
		$sql = "UPDATE `roles`
		SET `role_name` = '$role_name',	`role_description` = '$role_description', `template` = '$template'
		WHERE `roles`.`id` = '$role_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `role_function` WHERE `role_function`.`role_id` = '$role_id'";
		$result = mysqli_query($conn, $sql);
		if($functions!=''){
			foreach($functions as $f_id) {
				$sql = "INSERT INTO `role_function`
				(`id`, `role_id`, `function_id`) VALUES (NULL, '$role_id', '$f_id')";
				$result = mysqli_query($conn, $sql);
			}
		}
		header('Location: roles.php');
	}elseif($action=='Edit') {
		$role_id = $_REQUEST['role_id'];
		$sql1 = "SELECT * FROM roles where roles.id='$role_id'";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$role_name = $row1['role_name'];
			$role_description = $row1['role_description'];
			$template = $row1['template'];
		}
		$sql1 = "SELECT * FROM role_function where role_function.role_id='$role_id'";
		$result1 = mysqli_query($conn, $sql1);
		$functions= array();
		while($row1 = $result1->fetch_assoc()) {
			$functions[] = $row1['function_id']; 
		}
		$action = 'To_edit';
	}elseif($action=='Delete') {
		$role_id = $_REQUEST['role_id'];
		$sql = "DELETE FROM `roles` WHERE `id` = '$role_id'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "DELETE FROM `role_function` WHERE `role_function`.`role_id` = '$role_id'";
		$result = mysqli_query($conn, $sql);
		header('Location: roles.php');
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
	                                <i class="fa fa-star"></i>&nbsp;&nbsp;<?php echo $action;?> role
	                            </li>
	                        </ol>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-lg-6">
	
	                        <form role="form" action="" method="post" >
								<?php 
								if($action=='Add'){ $action = 'To_add'; }
								if($action=='Edit'){	$action = 'To_edit';
								}
								?>
								
								<input type="hidden" name="action" value="<?php echo $action;?>"/>
								<input type="hidden" name="role_id" value="<?php echo $role_id;?>"/>
								
	                            <div class="form-group">
	                                <label>Role Name</label>
	                                <input class="form-control" value="<?php echo $role_name; ?>" placeholder="" name="role_name">
	                            </div>
	                          
	                            <div class="form-group">
	                                <label>Role Description</label>
	                                <textarea class="form-control" rows="3"  name="role_description" ><?php echo $role_description; ?></textarea>
	                            </div>
	                            <div class="form-group">
	                                <label>Template</label>
	                                <select class="form-control" name="template" >
	                                	<option>SELECT</option>
	<?php 
	    $sql = "SELECT distinct(template) as template from roles ";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option <?php  if($row['template']==$template){ echo "selected"; }?>>
	                                    	<?php echo $row['template'];?>
	                                    </option>
	<?php } ?>
	                                </select>
	                            </div>
	               				<div class="form-group">
	                                <label>Functions to be added</label>
	                                <select name="functions[]" multiple="" class="form-control">
	<?php 
	    $sql = "SELECT id, function_name from functions";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
	                                    <option  <?php  if(in_array($row['id'],$functions)){ echo "selected"; }?> value="<?php echo $row['id'];?>"><?php echo $row['function_name'];?></option>
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