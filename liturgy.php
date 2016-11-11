<?php 
include 'sess_conf.php';
include 'db_conf.php';

if(in_array("Manage_Liturgy", $_SESSION['portal_functions'])) {
	$student_id = $day = $activity = '';
	$action = $_REQUEST['action'];
	if($action==''){
		$action = 'Add';
	}
	if($action=='To_add') {
		$liturgy_member_id = $_REQUEST['liturgy_member_id'];
		$member = explode('0000',$liturgy_member_id);
		$liturgy_member_category = $member[0];
		$liturgy_member_id = $member[1];

		$day = $_REQUEST['day'];
		$activity = $_REQUEST['activity'];
		if($liturgy_member_id !='') {
			echo $sql = "INSERT INTO `liturgy_members`
			(`id`, `liturgy_member_id`, `category`) VALUES (NULL, '$liturgy_member_id', '$liturgy_member_category')";
			$result = mysqli_query($conn, $sql);
		}
		if($day !='') {
			$sql = "INSERT INTO `liturgy_dates` (`id`, `dates`) VALUES (NULL, '$day')";
			$result = mysqli_query($conn, $sql);
		}
		header('Location: liturgy.php');
	}elseif($action=='Delete') {

		$liturgy_member_id = $_REQUEST['liturgy_member_id'];
		$member = explode('0000',$liturgy_member_id);
		$liturgy_member_category = $member[0];
		$liturgy_member_id = $member[1];

		$dates = $_REQUEST['dates'];
		if($liturgy_member_id!='') {
			$sql = "DELETE FROM `liturgy_members`
			WHERE `liturgy_members`.`liturgy_member_id` = '$liturgy_member_id' and `liturgy_members`.`category` = '$liturgy_member_category'";
			$result = mysqli_query($conn, $sql);
		}

		if($dates!='') {
			$sql = "DELETE FROM `liturgy_dates`
			WHERE `liturgy_dates`.`dates` = '$dates'";
			$result = mysqli_query($conn, $sql);
		}
		header('Location: liturgy.php');
	}
	include 'includes/header.php';
	include 'includes/left_menu.php';
	?>
<script type="text/javascript">
	function open_select(id) {
		var result = $($('#full_ids_list').val().split(','));
		$.each( result, function( key, value ) {
			 $('#'+value).css('display','none');
		}); 
		$('#'+id).css('display','block');
	}
	
	function edit_activity(data){
		$.post( "liturgy_edit_ajax.php", { action: "edit_activity", id : data.id , value: data.value  }, function( data ) {
			location.reload();
		});
	}	
	</script>
<div id="page-wrapper">

	<form role="form" action="" method="post">
		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-star"></i>&nbsp;&nbsp;<?php echo $action;?>
							Liturgy</li>

					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped"
							style="font-size: 11px; border: 2px solid #337AB7">
							<thead>
								<tr style="font-size: 10px; line-height: 10px">
									<th class="col-md-2">Name</th>

									<?php
									$sql = "SELECT * from liturgy_dates";
									$result = mysqli_query($conn, $sql);
									while($row = $result->fetch_assoc()) {
										echo "<th>";
										echo date('m/d', strtotime($row['dates']));
										echo "</th>";
									}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
								$id_list_array = '';

								$sql = "SELECT * from students, liturgy_members where
								students.id=liturgy_members.liturgy_member_id and liturgy_members.category = 'students'";
								$result = mysqli_query($conn, $sql);
								while($row = $result->fetch_assoc()) {
									if($class=='active'){
										$class='';
									} else { $class='active';
									}
									echo "<tr class='$class'><td class='col-md-2'>";
									echo $row['student_name'];
									$sql1 = "SELECT * from liturgy_dates";
									$result1 = mysqli_query($conn, $sql1);
									while($row1 = $result1->fetch_assoc()) {
										$dates = $row1['dates'];
										$date_formated = date('Y_m_d', strtotime($dates));
											
										$id = $row['category']."0000".$row['liturgy_member_id']."0000".$date_formated;
										$id_list_array .= ",$id";
										echo "<td onclick=\"open_select('$id')\">";
										$student_id = $row['liturgy_member_id'];
										$sql3 = "SELECT * FROM `liturgy` where `student_id` = '$student_id' and `day` = '$dates' ";
										$result3 = mysqli_query($conn, $sql3);
										if($row3 = $result3->fetch_assoc()) {
											echo substr($row3['activity'], 0, 1);
										}

										echo "<div id='$id' style='display:none;'>
										<select style='width:33px;'  id='edit_activity_$id' name='edit_activity_$id' onchange='edit_activity(this)'>
										<option value='1'>Select</option>
										<option value='Decon'>D</option>
										<option value='Alterserver'>A</option><option value='Usher'>U</option>
										<option value='Reader'>R</option><option value=''>Remove</option></select>
										</div>";
										echo "</td>";
									}
									?>
								</tr>

								<?php } ?>
							
							
							<tbody>
						
						</table>
						<br/>
						<table class="table table-bordered table-hover table-striped"
							style="font-size: 11px; border: 2px solid #337AB7">
							<tbody>
							<?php 

							$sql = "SELECT * from users, liturgy_members where
							users.id=liturgy_members.liturgy_member_id and liturgy_members.category = 'elders'";
							$result = mysqli_query($conn, $sql);
							while($row = $result->fetch_assoc()) {
								if($class=='active'){
									$class='';
								} else { $class='active';
								}
								echo "<tr class='$class'><td class='col-md-2'>";
								echo $row['name'];
								$sql1 = "SELECT * from liturgy_dates";
								$result1 = mysqli_query($conn, $sql1);
								while($row1 = $result1->fetch_assoc()) {
									$dates = $row1['dates'];
									$date_formated = date('Y_m_d', strtotime($dates));

									$id = $row['category']."0000".$row['liturgy_member_id']."0000".$date_formated;
									$id_list_array .= ",$id";
									echo "<td onclick=\"open_select('$id')\">";
									$liturgy_member_id = $row['liturgy_member_id'];
									$sql3 = "SELECT * FROM `liturgy` where `user_id` = '$liturgy_member_id' and `day` = '$dates' ";
									$result3 = mysqli_query($conn, $sql3);
									if($row3 = $result3->fetch_assoc()) {
										echo substr($row3['activity'], 0, 1);
									}

									echo "<div id='$id' style='display:none;'>
									<select style='width:33px;'  id='edit_activity_$id' name='edit_activity_$id' onchange='edit_activity(this)'>
									<option value='1'>Select</option>
									<option value='Decon'>D</option>
									<option value='Alterserver'>A</option><option value='Usher'>U</option>
									<option value='Reader'>R</option><option value=''>Remove</option></select>
									</div>";
									echo "</td>";
								}
								?>
							</tr>
							<?php }
							?>

							</tbody>
						</table>
						<input id="full_ids_list" type="hidden"
							value="<?php echo $id_list_array;?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<?php 
				if($action=='Add'){
					$action = 'To_add';
				}
				?>
				<input type="hidden" name="action" value="<?php echo $action;?>" />
				<div class="form-group">
					<label>Liturgy Members</label><br />
					<?php
					$sql = "SELECT students.id as liturgy_member_id,student_name   from students, liturgy_members where
					students.id=liturgy_members.liturgy_member_id and liturgy_members.category = 'students'";
					$result = mysqli_query($conn, $sql);
					while($row = $result->fetch_assoc()) {
						?>
					<a  class="delete_confirm" style="padding:0px"
						href="liturgy.php?action=Delete&liturgy_member_id=students0000<?php echo $row['liturgy_member_id'];?>">
						<span class="glyphicon glyphicon-remove" data-toggle="confirmation" aria-hidden="true"></span>
					</a>
					<?php
					echo $row['student_name'];
					?>
					<br />
					<?php } ?>
					<br />
					<?php
					$sql = "SELECT users.id as liturgy_member_id,name   from users, liturgy_members where
					users.id=liturgy_members.liturgy_member_id and liturgy_members.category = 'elders'";
					$result = mysqli_query($conn, $sql);
					while($row = $result->fetch_assoc()) {
						?>
					<a class="delete_confirm" style="padding:0px"
						href="liturgy.php?action=Delete&liturgy_member_id=elders0000<?php echo $row['liturgy_member_id'];?>">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
					<?php
					echo $row['name'];
					?>
					<br />
					<?php } ?>
					<br />
					<select name="liturgy_member_id" class="form-control">
						<option value="">SELECT</option>
						<?php
						$sql = "SELECT * from students";
						$result = mysqli_query($conn, $sql);
						while($row = $result->fetch_assoc()) {
							?>
						<option value="students0000<?php echo $row['id'];?>"><?php echo $row['student_name'];?></option>
						<?php } ?>
						<?php
						$sql = "SELECT * from users";
						$result = mysqli_query($conn, $sql);
						while($row = $result->fetch_assoc()) {
							?>
						<option value="elders0000<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
						<?php } ?>
					</select>
				</div>
				<button type="submit" class="btn btn-default">Submit Button</button>
				<button type="reset" class="btn btn-default">Reset Button</button>
				<br /> <br /> <br /> <br />

			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<input type="hidden" name="action" value="<?php echo $action;?>" />
					<label>Dates</label><br />
					<?php
					$sql = "SELECT * from liturgy_dates";
					$result = mysqli_query($conn, $sql);
					while($row = $result->fetch_assoc()) {
						?>
					<a class="delete_confirm" style="padding:0px"
						href="liturgy.php?action=Delete&dates=<?php echo $row['dates'];?>">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
					<?php echo $row['dates']."<br/>";?>
					<?php } ?>
					<br />
					<input class="form-control" type="date" name="day">
				</div>
				<button type="submit" class="btn btn-default">Submit Button</button>
				<button type="reset" class="btn btn-default">Reset Button</button>
			</div>
		</div>

</div>
</form>
</div>
<!-- /#page-wrapper -->
<?php } ?>
<?php include 'includes/footer.php';?>