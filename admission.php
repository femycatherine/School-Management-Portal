<?php 
include 'sess_conf.php';
include 'db_conf.php'; 
if($_REQUEST['form_admission_submit']=='1'){
			$class_id = $_REQUEST[class_id];
			$grade = $_REQUEST[grade];
			$student_name = $_REQUEST[student_name];
			$email = $_REQUEST[email];
			$malayalam_class = $_REQUEST[malayalam_class];
			$_SESSION['temp_address'] = $address = $_REQUEST[address];
			$_SESSION['temp_phone_home'] = $phone_home = $_REQUEST[phone_home];
			$_SESSION['temp_phone_cell'] = $phone_cell = $_REQUEST[phone_cell];
			$_SESSION['temp_contact_name1'] = $contact_name1 = $_REQUEST[contact_name1];
			$_SESSION['temp_contact_name2'] = $contact_name2 = $_REQUEST[contact_name2];
			$_SESSION['temp_contact_phone1'] = $contact_phone1 = $_REQUEST[contact_phone1];
			$_SESSION['temp_contact_phone2'] = $contact_phone2 = $_REQUEST[contact_phone2];
			$_SESSION['temp_contact_relation1'] = $contact_relation1 = $_REQUEST[contact_relation1];
			$_SESSION['temp_contact_relation2'] = $contact_relation2 = $_REQUEST[contact_relation2];
			$date_of_birth = date('Y-m-d',strtotime($_REQUEST[date_of_birth]));
			$date_of_baptism = date('Y-m-d',strtotime($_REQUEST[date_of_baptism])); 
			$date = date('Y-m-d');
			 
			$gender = $_REQUEST[gender];
			$parish_where_baptized = $_REQUEST[parish_where_baptized];
			$_SESSION['temp_name_of_previous_school'] = $name_of_previous_school = $_REQUEST[name_of_previous_school];
			$baptism_certificate_file = $_REQUEST[baptism_certificate_file];
			$baptism_previously_uploaded = $_REQUEST[baptism_previously_uploaded];
			$_SESSION['temp_father_family_name'] = $father_family_name = $_REQUEST[father_family_name];
			$_SESSION['temp_father_name'] = $father_name = $_REQUEST[father_name];
			$_SESSION['temp_father_religion_rite'] = $father_religion_rite = $_REQUEST[father_religion_rite];
			$_SESSION['temp_father_place_of_birth'] = $father_place_of_birth = $_REQUEST[father_place_of_birth];
			$_SESSION['temp_father_parish_diocess'] = $father_parish_diocess = $_REQUEST[father_parish_diocess];
			$_SESSION['temp_mother_family_name'] = $mother_family_name = $_REQUEST[mother_family_name];
			$_SESSION['temp_mother_name'] = $mother_name = $_REQUEST[mother_name];
			$_SESSION['temp_mother_religion_rite'] = $mother_religion_rite = $_REQUEST[mother_religion_rite];  
			$_SESSION['temp_mother_place_of_birth'] = $mother_place_of_birth = $_REQUEST[mother_place_of_birth];
			$_SESSION['temp_mother_parish_diocess'] = $mother_parish_diocess = $_REQUEST[mother_parish_diocess];
			$sign = $_REQUEST[sign];
			$safe_enviroment_authorization = $_REQUEST['safe_enviroment_authorization'];
			$alter_service_member = $_REQUEST['alter_service_member'];
			$sign_name = $_REQUEST['sign_name'];
			$person_who_is_added = $_SESSION['portal_username_id'];
			$sql = "INSERT INTO `students` 
			(`id`, `grade`, `class_id`, `student_name`, `address`, `phone_home`, `phone_cell`, 
			`email`, `contact_name1`, `contact_phone1`, `contact_relation1`, `contact_name2`, 
			`contact_phone2`, `contact_relation2`, `new_student`, `date_of_birth`, `gender`, 
			`date_of_baptism`, `parish_where_baptized`, `name_of_previous_school`, `father_family_name`, 
			`father_name`, `father_religion_rite`, `father_place_of_birth`, `father_parish_diocess`, 
			`mother_family_name`, `mother_name`, `mother_religion_rite`, `mother_place_of_birth`, 
			`mother_parish_diocess`, `date`, `sign`, `person_who_is_added`,`sign_name`,`safe_enviroment_authorization`,	`baptism_previously_uploaded`) VALUES 
			(NULL, '$class_id', '$class_id', '$student_name', '$address', '$phone_home', '$phone_cell', 
			'$email', '$contact_name1', '$contact_phone1', '$contact_relation1', '$contact_name2', 
			'$contact_phone2', '$contact_relation2', '', '$date_of_birth', '$gender', 
			'$date_of_baptism', '$parish_where_baptized', '$name_of_previous_school', '$father_family_name', 
			'$father_name', '$father_religion_rite', '$father_place_of_birth', '$father_parish_diocess', 
			'$mother_family_name', '$mother_name', '$mother_religion_rite', '$mother_place_of_birth', 
			'$mother_parish_diocess', '$date', '$sign', '$person_who_is_added','$sign_name','$safe_enviroment_authorization','$baptism_previously_uploaded');";
			$result = mysqli_query($conn, $sql);
			$student_id =  mysqli_insert_id($conn);
			 
			if($malayalam_class=="1") {
				$sql = "INSERT INTO `stjudes_portal`.`malayalam_class_students` (`id`, `student_id`) VALUES (NULL, '$student_id')";
				$result = mysqli_query($conn, $sql);
			}
			
			if($alter_service_member=="1") {
				$sql = "INSERT INTO `stjudes_portal`.`liturgy_members` (`id`, `liturgy_member_id`, `category`) VALUES (NULL, '$student_id', 'students')";
				$result = mysqli_query($conn, $sql);
			}
			
			$target_dir = "uploads/baptism_certificate/2016_2017/$student_id/";
			mkdir("uploads/baptism_certificate/2016_2017/".$student_id."/", 0777);
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
			$url = "uploads/baptism_certificate/2016_2017/".$student_id."/";
			$sql = "UPDATE `students`
			set baptism_doc_location='$target_file' where id= '$student_id'";
			$result = mysqli_query($conn, $sql);
			
			
			$sql = "INSERT INTO `class_student` (`id`, `class_id`, `student_id`, `create_time`) 
			VALUES (NULL, '$class_id', '$student_id', now())";
			$result = mysqli_query($conn, $sql);
			$page = $_SESSION['portal_template'];
			header("Location: $page?msg=admission_success");
} 
include 'includes/header.php';?>
<?php include 'includes/left_menu.php';
?>
<script>

function admission_check() {
 
	if(document.getElementById("baptism_previously_uploaded").checked) {
		return true;
	} else {
 	   if(document.getElementById( 'fileToUpload' ).value.length===0) {
 		   alert('Please provide baptism certificate or click on previously provided ');
 	       return false; 
 	    }else {
 		   
 		   return true;
 	    }
	} 
}
</script>
<div id="page-wrapper">
<form name="form_admission" role="form" action="" method="post"
					enctype="multipart/form-data" onsubmit="return admission_check();">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;
						Registration Form</li>
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
		<script type="text/javascript">
		function change_class_description(){
			var class_id = document.getElementById( 'class_id' ).value;
			document.getElementById('grade').value = class_id; 
		}

		</script>
		<div class="row">
			<div class="col-md-6">
				<label>2016 - 17 School Grade:</label> 
				<select onChange="change_class_description();" id="class_id" name="class_id" class="form-control">
<?php 
		$sql1 = "SELECT * FROM classes where type='Faith Formation'";
		$result1 = mysqli_query($conn, $sql1);
		while($row1 = $result1->fetch_assoc()) {
			$class_id = $row1['id']; 
			$grade = $row1['grade']; 
			 
			echo "<option value='$class_id'>$grade</option>";
		}
?>		
				</select> 
			</div>
			<div class="col-md-6">
				<label>CCD Class ID: </label> 
				<select disabled name="grade" id="grade" class="form-control">
<?php 
		$sql1 = "SELECT * FROM classes where type='Faith Formation'";
		$result1 = mysqli_query($conn, $sql1);
		while($row1 = $result1->fetch_assoc()) {
			$class_id = $row1['id']; 
			$grade = $row1['grade'];
			$description = $row1['description'];
			echo "<option value='$class_id'>$description</option>";
		}
?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Student Name:<span style="color: red;">*</span>
				</label> <input name="student_name" class="form-control"
					placeholder="" required>
			</div>
			<div class="col-md-6">
				<label>Email: <span style="color: red;">*</span>
				 </label> <input name="email" readonly value="<?php echo $_SESSION['portal_email'];?>" class="form-control" required>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Address: <span style="color: red;">*</span></label> 
				<textarea rows="4" class="form-control" name="address" required><?php echo $_SESSION['temp_address']?></textarea>
			</div>
			<div class="col-md-6">
				<label>Phone(Home): </label> <input value="<?php echo $_SESSION['temp_phone_home']?>" name="phone_home" class="form-control">
				 <label>Phone(Cell):
				</label> <input value="<?php echo $_SESSION['temp_phone_cell']?>" name="phone_cell" class="form-control">
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
				<label>Name: </label> <input value="<?php echo $_SESSION['temp_contact_name1']?>" name="contact_name1" class="form-control"> <label>Name: </label>
				<input value="<?php echo $_SESSION['temp_contact_name2']?>" name="contact_name2" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Phone: </label> <input value="<?php echo $_SESSION['temp_contact_phone1']?>" name="contact_phone1"  class="form-control"> <label>Phone: </label>
				<input value="<?php echo $_SESSION['temp_contact_phone2']?>" name="contact_phone2"  class="form-control">
			</div>
			<div class="col-md-4">
				<label>Relationship: </label> <input value="<?php echo $_SESSION['temp_contact_relation1']?>" name="contact_relation1"  class="form-control"> <label>Relationship:
				</label> <input value="<?php echo $_SESSION['temp_contact_relation2']?>" name="contact_relation2"   class="form-control">
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
				<label>Date of Birth:</label> <input name="date_of_birth" id="date_of_birth" type="date" class="form-control"> <label>Date
					of Baptism:</label> <input name="date_of_baptism"  type="date" class="form-control">
			</div>
			<div class="col-md-6">
				<label>Gender: </label> <select name="gender" class="form-control">
				<option value="male">Male</option><option value="female">Female</option></select>
				 <label>Parish where Baptized: </label>  <input name="parish_where_baptized"  class="form-control">
			</div>
			<div class="col-md-12">
				<label>Name of Previous School attended (if applicable): </label> <input value="<?php echo $_SESSION['temp_name_of_previous_school']?>" name="name_of_previous_school" 
					class="form-control">
			</div>
			<div class="col-md-12">
				
				<label>Upload baptism certificate: </label> 
				<input name="fileToUpload" id="fileToUpload"
							class="form-control" type="file" value="1"> &nbsp;
				<label>Baptism certificate provided previously: </label> <input type="checkbox" id="baptism_previously_uploaded" value="1" name="baptism_previously_uploaded" />
				<br />
			</div>
		</div>
		<br />
		<div class="row" style="border: 1px solid black; margin: 0px;">
			<div class="col-md-6">
				<h5>
					<u><b>Information of Father</b> </u>
				</h5>
				<label>Family Name:</label> <input value="<?php echo $_SESSION['temp_father_family_name']?>" name="father_family_name"  class="form-control"> <label>Name:</label>
				<input value="<?php echo $_SESSION['temp_father_name']?>" name="father_name"  class="form-control"> <label>Religion/Rite:</label> <input value="<?php echo $_SESSION['temp_father_religion_rite']?>" name="father_religion_rite" 
					class="form-control"> <label>Place of Birth:</label> <input value="<?php echo $_SESSION['temp_father_place_of_birth']?>" name="father_place_of_birth" 
					class="form-control"> <label>Parish/Diocese in India:</label> <input value="<?php echo $_SESSION['temp_father_parish_diocess']?>" name="father_parish_diocess" 
					class="form-control">
			</div>
			<div class="col-md-6">
				<h5>
					<u><b>Information of Mother</b> </u>
				</h5>
				<label>Family Name:</label> <input value="<?php echo $_SESSION['temp_mother_family_name']?>" name="mother_family_name"  class="form-control"> <label>Name:</label>
				<input value="<?php echo $_SESSION['temp_mother_name']?>" name="mother_name"  class="form-control"> <label>Religion/Rite:</label> <input value="<?php echo $_SESSION['temp_mother_religion_rite']?>" name="mother_religion_rite" 
					class="form-control"> <label>Place of Birth:</label> <input value="<?php echo $_SESSION['temp_mother_place_of_birth']?>" name="mother_place_of_birth" 
					class="form-control"> <label>Parish/Diocese in India:</label> <input value="<?php echo $_SESSION['temp_mother_parish_diocess']?>" name="mother_parish_diocess" 
					class="form-control"><br />
			</div>
		</div>
		<br/>
		<div class="row" style="border: 1px solid black; margin: 0px;">
			<div class="col-md-12">
				<label>Enroll Malayalam Class: </label> &nbsp; <input type="checkbox" name="malayalam_class" id="malayalam_class" value="1" />
				<br />
			</div>
		</div>		
		<br/>
		<div class="row" style="border: 1px solid black; margin: 0px;">
			<div class="col-md-12">
				<label>Alter Service Member: </label> &nbsp; <input type="checkbox" name="alter_service_member" id="alter_service_member" value="1" />
				<br />
			</div>
		</div>
		<br/> 
		<div class="row"  style="border: 1px solid black; margin: 0px;">
			<div class="col-md-12">
				<input type="radio" name="safe_enviroment_authorization"  value="1" checked /><label>
				&nbsp; &nbsp; I hereby authorize my child named on this form to
				 receive touch and safety training. </label> 
				<br />
				<input type="radio" name="safe_enviroment_authorization" value="0" /><label>
				&nbsp; &nbsp; As a parent I will be responsible to provide touch and safety training (Training materials will be provided by the Safe Environment Office).</label> 
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
				<h6>(3) Please include a donation of $50 (or more) payable to SJSMCC per child  to Maya Vargheese or Mathew Abraham(Sibi). (This
					will help cover part of expenses such as travel, stationery &
					supplies, guest speakers etc. incurred during school year.)
			
			</div>
		</div> 
		
		<div class="row">
			<div class="col-md-1">
				<div class="checkbox">
					<label> <input name="sign" value="1"  type="checkbox" required> Sign <span style="color: red;">*</span> </label>
				
					
				</div>
			</div>
			<div class="col-md-6">
				<label>Name:<span style="color: red;">*</span></label>&nbsp;<input name="sign_name"  class="form-control" required />
			
			</div>
				
		</div>
		<div class="row">
			<button type="submit"  name="form_admission_submit" value="1" class="btn btn-<?php echo $configure_theme;?>">Submit</button>
		
		</div>
		<br /> <br />
	</div>
	<!-- /.container-fluid -->
</form>
</div>
<?php include 'includes/footer.php';?>
