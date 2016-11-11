	<?php }elseif($_SESSION['portal_template']=='dashboard_guardian.php') { ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<thead style="background-color: #c5c5c5">
								<tr>
									<th>Sl</th>
									<th>Topics</th>
									<th>Created</th>
									<th>Report</th>
									<th>Assigned</th>
								</tr>
							</thead>
							<tbody>
<?php 	
		$student_name = $_SESSION['portal_parent_student_name_selected'];
		$student_id = $_SESSION['portal_parent_studentid_selected'];
		$sql1 = "SELECT class_id,grade from class_student,classes where 
		classes.id=class_student.class_id and student_id='$student_id'";
		$result1 = mysqli_query($conn, $sql1);	
		if($row1 = $result1->fetch_assoc()) {
			$class_id = $row1['class_id'];
		}
		$sql1 = "SELECT * FROM `home_work` where class_id='$class_id' order by id desc";
		
		$result1 = mysqli_query($conn, $sql1);
		while($row1 = $result1->fetch_assoc()) {  ?>
								<tr>
									<td  width="20px"><a href="View_home_work.php?id=<?php echo $row1['id'];?>"><?php echo $row1['id'];?></a></td>
									<td width="100px">
									<a href="View_home_work.php?id=<?php echo $row1['id'];?>">
									<img width="420px" src="http://localhost/portal/portal/<?php echo $row1['upload_link'];?>">
									<br/><?php echo $row1['topics_text'];?></a></td>
									<td width="100px"><?php echo $row1['create_time'];?></td>
									<td width="150px"><?php echo $row1['respond_time'];?></td>
									<td width="150px"><?php 
									$teacher_id = $row1['teacher'];
									$sql2 = "SELECT name FROM users where id='$teacher_id'";
									$result2 = mysqli_query($conn, $sql2);
									if($row2 = $result2->fetch_assoc()) {
										echo $row2['name'];
									}
									?></td>
								</tr>
<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>