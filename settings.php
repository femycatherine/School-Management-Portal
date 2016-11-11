<?php include 'includes/header.php';?>
<?php include 'includes/left_menu.php';?>

<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-5">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp; Students
						Marks List</li>
				</ol>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Add Marks</label> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="form-group">
					<label>CCD class</label> <select class="form-control">
						<option>SELECT</option>
						<option>Preschool</option>
						<option>Kindergarten</option>
						<option>First Grade</option>
						<option>Second Grade</option>
					</select>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead style="background-color: #c5c5c5">
							<tr>
								<th>Student Name</th>
								<th>Marks1</th>
								<th>Marks2</th>
								<th>Marks3</th>

							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Preethi</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>

							</tr>
							<tr>
								<td>Sonia Thomas</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>
							</tr>
							<tr>
								<td>Treesa Joseph</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>
							</tr>
							<tr>
								<td>Merly Joseph</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>
							</tr>
							<tr>
								<td>Tina</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>
							</tr>
							<tr>
								<td>Paul Thomas</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>
							</tr>
							<tr>
								<td>Betty Thomas</td>
								<td>65</td>
								<td>45</td>
								<td>65</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /#page-wrapper -->
<?php include 'includes/footer.php';?>