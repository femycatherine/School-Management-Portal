<?php 
include 'sess_conf.php';
include 'db_conf.php'; 
include 'includes/header.php';
include 'includes/left_menu.php';


if(in_array("Documents", $_SESSION['portal_functions'])) {
?>

<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Important Forms and Document list</li>  <?php if($_SESSION['portal_template']=='index.php'){ ?>
						<li><a href="manage_documents.php?action=Add"><button type="button" class="btn btn-<?php echo $configure_theme;?>">Add New Documents</button></a>
					</li><?php } ?>
				</ol>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead style="background-color: #c5c5c5">
							<tr>
								<th>id</th>
								<th>Document Name</th>
								<th>Uploaded by</th>
								<th></th>
							  <?php if($_SESSION['portal_template']=='index.php'){ ?>	<th></th> <?php } ?>
							</tr>
						</thead>
						<tbody>
	<?php 
	    $sql = "SELECT * from documents";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
	?>
							<tr>
								<td><?php echo $row['id'];?></td>
								<td><?php echo $row['document_name'];?></td>
								<td><?php echo $row['who_uploaded'];?> &nbsp; on (<?php echo $row['create_time'];?>)</td>
								<td><a href="http://localhost/portal/portal/<?php echo $row['file_location'];?>"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a></td>
								  <?php if($_SESSION['portal_template']=='index.php'){ ?> <td><a class="delete_confirm" style="padding:0px" href="manage_documents.php?action=Delete&amp;document_id=<?php echo $row['id'];?>">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</a></td> <?php } ?>
							</tr>
	<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
			<b>Please note:</b> <br/>
			 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem 
			 nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
			</div>
		</div>
	</div>
</div>
<?php  } ?>
<!-- /#page-wrapper -->
<?php include 'includes/footer.php';?>