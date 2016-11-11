<?php 
include 'db_conf.php';
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';?>

<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Functions List&nbsp;
					</li>
					<li>
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
								<th>Operation</th>
								<th>Description</th>
								<th>Create Time</th>
							
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = "SELECT * FROM functions";
							$result = mysqli_query($conn, $sql);

							 while($row = $result->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $row['id'];?></td>
								<td><?php echo $row['function_name'];?></td>
								<td><?php echo $row['function_variable'];?></td>
								<td><?php echo $row['create_time'];?></td>
								
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
<?php include 'includes/footer.php';?>