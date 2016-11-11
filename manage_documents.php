<?php 
include 'sess_conf.php';
include 'db_conf.php';

if(in_array("Documents", $_SESSION['portal_functions'])) {
	$action = $_REQUEST['action'];

	if($action=='To_add') {
		$document_name = $_REQUEST['document_name'];
		$name = $_REQUEST['file_location'];
		$username = $_SESSION['portal_username'];
		
		$sql = "INSERT INTO `documents` 
		(`id`, `document_name`, `file_location`, `who_uploaded`, `create_time`) 
		VALUES (NULL, '$document_name', '', '$username', now())";
		$result = mysqli_query($conn, $sql);
		$id =  mysqli_insert_id($conn);
		
		
		$target_dir = "uploads/doc/$id/";
		mkdir("uploads/doc/".$id."/", 0700);
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		
		$url = "uploads/doc/".$id."/";
		$sql = "UPDATE `documents`
		set file_location='$target_file' where id= '$id'";
		$result = mysqli_query($conn, $sql);

		header('Location: documents.php');
	}elseif($action=='Delete') {
		$document_id = $_REQUEST['document_id'];
		$sql = "DELETE FROM `documents` WHERE `id` = '$document_id'";
		$result = mysqli_query($conn, $sql);

		header('Location: documents.php');
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
					<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;<?php echo $action;?>
						Documents</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">

				<form role="form" action="" method="post"
					enctype="multipart/form-data">
					<?php 
					if($action=='Add'){
						$action = 'To_add';
					}
					?>

					<input type="hidden" name="action" value="<?php echo $action;?>" />

					<div class="form-group">
						<label>Document Name</label> <input class="form-control"
							value="" placeholder="" name="document_name">
					</div>

					<div class="form-group">
						<label>Upload</label> <input name="fileToUpload" id="fileToUpload"
							class="form-control" type="file">
					</div>

					<button type="submit" class="btn btn-default">Submit Button</button>
					<button type="reset" class="btn btn-default">Reset Button</button>

				</form>
				<br /> <br /> <br /> <br />
			</div>
		</div>


	</div>
</div>
<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>