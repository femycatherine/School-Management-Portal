<?php 
include 'sess_conf.php';
include 'db_conf.php'; 

$student_id = $_REQUEST['student_id'];
$sql = "SELECT * FROM students where id='$student_id'";
$result = mysqli_query($conn, $sql);
if($row = $result->fetch_assoc()) {

			$class_id = $row[class_id];
			$grade = $row[grade];
			$student_name = $row[student_name];
			$email = $row[email];
			$address = $row[address];
			$phone_home = $row[phone_home];
			$phone_cell = $row[phone_cell];
			$contact_name1 = $row[contact_name1];
			$contact_name2 = $row[contact_name2];
			$contact_phone1 = $row[contact_phone1];
			$contact_phone2 = $row[contact_phone2];
			$contact_relation1 = $row[contact_relation1];
			$contact_relation2 = $row[contact_relation2];
			$date_of_birth = date('Y-m-d',strtotime($row[date_of_birth]));
			$date_of_baptism = date('Y-m-d',strtotime($row[date_of_baptism])); 
			$date = date('Y-m-d');
			 
			$gender = $row[gender];
			$parish_where_baptized = $row[parish_where_baptized];
			$name_of_previous_school = $row[name_of_previous_school];
			$baptism_certificate_file = $row[baptism_certificate_file];
			$father_family_name = $row[father_family_name];
			$father_name = $row[father_name];
			$father_religion_rite = $row[father_religion_rite];
			$father_place_of_birth = $row[father_place_of_birth];
			$father_parish_diocess = $row[father_parish_diocess];
			$mother_family_name = $row[mother_family_name];
			$mother_name = $row[mother_name];
			$mother_religion_rite = $row[mother_religion_rite];  
			$mother_place_of_birth = $row[mother_place_of_birth];
			$mother_parish_diocess = $row[mother_parish_diocess];
			$sign = $row[sign];
			$safe_enviroment_authorization = $row['safe_enviroment_authorization'];
			$alter_service_member = $row['alter_service_member'];
			$sign_name = $row['sign_name'];
			$person_who_is_added = $row['person_who_is_added'];
} 
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';
?>

<div id="page-wrapper">

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;
						View Registration Form</li>
				</ol>
			</div>
		</div>
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<legend>
					<center>
						<h3>SCHOOL OF FAITH FORMATION</h3>
						<h5>
							<i> St. Jude Syro Malabar Parish S. Jersey<br> 
								250 S. Route 73, Winslow, NJ, 08095	
							</i>
						</h5>
					</center>
				</legend>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>CCD Class ID#:</label> <select  name="class_id" class="form-control">
<?php 
		$sql1 = "SELECT * FROM classes where id ='$class_id' ";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$classid = $row1['id']; 
			$ccd_grade = $row1['grade'];
			echo "<option value='$classid'>$ccd_grade</option>";
		}
?>		
				</select> 
			</div>
			<div class="col-md-6">
				<label>2016 - 17 School Grade: </label> <select name="grade" class="form-control">
<?php 
		$sql1 = "SELECT * FROM classes where id ='$grade'";
		$result1 = mysqli_query($conn, $sql1);
		if($row1 = $result1->fetch_assoc()) {
			$classid = $row1['id']; 
			$school_grade = $row1['grade'];
			echo "<option value='$classid'>$school_grade</option>";
		}
?>		
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Student Name:<span style="color: red;">*</span>
				</label> <input name="student_name" class="form-control" value="<?php echo $student_name;?>"
					placeholder="" required>
			</div>
			<div class="col-md-6">
				<label>Email: <span style="color: red;">*</span>
				 </label> <input name="email" value="<?php echo $email;?>" class="form-control" required>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Address: <span style="color: red;">*</span></label> 
				<textarea rows="4" class="form-control" name="address" required><?php echo $address?></textarea>
			</div>
			<div class="col-md-6">
				<label>Phone(Home): </label> <input value="<?php echo $phone_home?>" name="phone_home" class="form-control">
				 <label>Phone(Cell):
				</label> <input value="<?php echo $phone_cell?>" name="phone_cell" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>
					<b>Two emergency contacts (other than parents):</b>
				</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<label>Name: </label> <input value="<?php echo $contact_name1?>" name="contact_name1" class="form-control"> <label>Name: </label>
				<input value="<?php echo $contact_name2?>" name="contact_name2" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Phone: </label> <input value="<?php echo $contact_phone1?>" name="contact_phone1"  class="form-control"> <label>Phone: </label>
				<input value="<?php echo $contact_phone2?>" name="contact_phone2"  class="form-control">
			</div>
			<div class="col-md-4">
				<label>Relationship: </label> <input value="<?php echo $contact_relation1?>" name="contact_relation1"  class="form-control"> <label>Relationship:
				</label> <input value="<?php echo $contact_relation2?>" name="contact_relation2"   class="form-control">
			</div>
		</div>
		<br />
		<div class="row" style="border: 1px solid black; margin: 0px;">
			<div class="col-md-12">
				<h5>
					The information in this box are to be filled <b> only for new
						student registration.</b>
				</h5>
				<h5>
					<u><b>Information of Child</b> </u>
				</h5>
			</div>
			<div class="col-md-6">
				<label>Date of Birth:</label> <input value="<?php echo $date_of_birth;?>" name="date_of_birth" id="date_of_birth" type="date" class="form-control"> <label>Date
					of Baptism:</label> <input value="<?php echo $date_of_baptism;?>" name="date_of_baptism"  type="date" class="form-control">
			</div>
			<div class="col-md-6">
				<label>Gender: </label> <select name="gender" class="form-control">
				<option value="<?php echo $gender;?>"><?php echo $gender;?></option></select>
				 <label>Parish where Baptized: </label>  <input name="parish_where_baptized" value="<?php echo $parish_where_baptized;?>" class="form-control">
			</div>
			<div class="col-md-12">
				<label>Name of Previous School attended (if applicable): </label> <input value="<?php echo $name_of_previous_school?>" name="name_of_previous_school" 
					class="form-control">
			</div>
			<div class="col-md-12">
				 
				
				<?php if($baptism_certificate_file!='') {?>
				<label>Upload baptism certificate: </label> 
				<a href="http://syromalabarsouthjersey.com/portal/<?php echo $baptism_certificate_file;?>">View</a>
				<?php ?>
				<br />
			</div> 
		</div> 
		<br />
		<div class="row" style="border: 1px solid black; margin: 0px;">
			<div class="col-md-6">
				<h5>
					<u><b>Information of Father</b> </u>
				</h5>
				<label>Family Name:</label> <input value="<?php echo $father_family_name?>" name="father_family_name"  class="form-control"> <label>Name:</label>
				<input value="<?php echo $father_name?>" name="father_name"  class="form-control"> <label>Religion/Rite:</label> <input value="<?php echo $father_religion_rite?>" name="father_religion_rite" 
					class="form-control"> <label>Place of Birth:</label> <input value="<?php echo $father_place_of_birth?>" name="father_place_of_birth" 
					class="form-control"> <label>Parish/Diocese in India:</label> <input value="<?php echo $father_parish_diocess?>" name="father_parish_diocess" 
					class="form-control">
			</div>
			<div class="col-md-6">
				<h5>
					<u><b>Information of Mother</b> </u>
				</h5>
				<label>Family Name:</label> <input value="<?php echo $mother_family_name?>" name="mother_family_name"  class="form-control"> <label>Name:</label>
				<input value="<?php echo $mother_name?>" name="mother_name"  class="form-control"> <label>Religion/Rite:</label> <input value="<?php echo $mother_religion_rite?>" name="mother_religion_rite" 
					class="form-control"> <label>Place of Birth:</label> <input value="<?php echo $mother_place_of_birth?>" name="mother_place_of_birth" 
					class="form-control"> <label>Parish/Diocese in India:</label> <input value="<?php echo $mother_parish_diocess?>" name="mother_parish_diocess" 
					class="form-control"><br />
			</div>
		</div>
		<br/>
		<div class="row" style="border: 1px solid black; margin: 0px;">
			<div class="col-md-12"><label>Alter Service Member: </label> &nbsp; 
<?php 
$sql = "SELECT * FROM  `liturgy_members` where liturgy_member_id='$student_id'";
$result = mysqli_query($conn, $sql);
if($row = $result->fetch_assoc()) {		
?><input type="checkbox" name="alter_service_member" id="alter_service_member" checked />
<?php } else {?>
<input type="checkbox" name="alter_service_member" id="alter_service_member" />
<?php } ?>
				
				<br />
			</div>
		</div>
		<br/> 
		<div class="row"  style="border: 1px solid black; margin: 0px;">
			<div class="col-md-12">
<?php if ($safe_enviroment_authorization=="1") { ?>
				<input type="radio" name="safe_enviroment_authorization"  value="1" checked /><label>
				&nbsp; &nbsp; I hereby authorize my child named on this form to
				 receive safe environment training. </label> 
				<br />
<?php } else {?>
				<input type="radio" name="safe_enviroment_authorization" value="0" checked/><label>
				&nbsp; &nbsp; As a parent I will be responsible to provide safe environment training.</label> 
<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<br /> <label>Note:</label>
				<h6>
					(1) Please provide Baptism certificate at the time of <b>new
						registration</b> or if you were not able to provide previously.
				</h6>
				<h6>
					(2) Registration is due on or before <b>Sept. 4th</b> and classes
					will commence on <b>Sept. 11th.</b>
				</h6>
				<h6>(3) Please include a donation of $50 (or more) per child  to Maya Vargheese or Mathew Abraham(Sibi). (This
					will help cover part of expenses such as travel, stationery &
					supplies, guest speakers etc. incurred during school year.)
			
			</div>
		</div> 
		
		<div class="row">
			<div class="col-md-1">
				<div class="checkbox">
					<label> 
					
					<input name="sign" value="1"  type="checkbox" <?php if($sign=="1"){ echo "checked";}?> > Sign <span style="color: red;">*</span> </label>
				
					
				</div>
			</div>
			<div class="col-md-6">
				<label>Name:<span style="color: red;">*</span></label>&nbsp;<input name="sign_name" value="<?php echo $sign_name;?>" class="form-control" required />
			
			</div>
				
		</div>
		<div class="row">
			<button type="button"  name="form_admission_submit"  class="btn btn-<?php echo $configure_theme;?>">Close</button>
		
		</div>
		<br /> <br />
	</div>
	<!-- /.container-fluid -->

</div>
<?php include 'includes/footer.php';?>
