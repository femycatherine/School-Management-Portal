            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php if(strpos($_SERVER['SCRIPT_FILENAME'], $_SESSION['portal_template'])) { echo 'class="active"'; } ?>>
                        <a href="<?php echo $_SESSION['portal_template'];?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <?php  if(in_array("Summary", $_SESSION['portal_functions'])) {?>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'summary.php')) { echo 'class="active"'; } ?>>
                        <a href="summary.php"><i class="fa fa-fw fa-signal"></i> Summary</a>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION['portal_template']=='index.php'){ ?>
                   
                    <?php }elseif($_SESSION['portal_template']=='dashboard_guardian.php') { ?> 
                   	<li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'admission.php')) { echo 'class="active"'; } ?>>
                        <a href="admission.php"><i class="fa fa-fw fa-user"></i> CCD Registration</a>
                    </li>
                    <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Grades_and_Attendance.php')) { echo 'class="active"'; } ?>>
                        <a href="Grades_and_Attendance.php"><i class="fa fa-fw fa-signal"></i> Grades and Attendance</a>
                    </li>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Home_Work_information.php')) { echo 'class="active"'; } ?>>
                        <a href="Home_Work_information.php"><i class="fa fa-fw fa-pencil"></i> Home Work information</a>
                    </li>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Grades_and_Attendance.php')) { echo 'class="active"'; } ?>>
                        <a href="Grades_and_Attendance.php"><i class="fa fa-fw fa-list-alt"></i> Attendance History</a>
                    </li>
                    <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'documents.php')) { echo 'class="active"'; } ?>>
                        <a href="documents.php"><i class="fa fa-fw fa-book"></i> Documents</a>
                    </li>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Account_Preferences.php')) { echo 'class="active"'; } ?>>
                        <a href="Account_Preferences.php"><i class="fa fa-fw fa-cog"></i> Account Preferences</a>
                    </li>
                    <?php }elseif($_SESSION['portal_template']=='dashboard_mentor.php') { ?>
                    
                      <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Mark_Attendance.php')) { echo 'class="active"'; } ?>>
                        <a href="Mark_Attendance.php"><i class="fa fa-fw fa-list"></i> Mark Attendance</a>
                    </li>
                      <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Grades_and_Attendance.php')) { echo 'class="active"'; } ?>>
                        <a href="Grades_and_Attendance.php"><i class="fa fa-fw fa-signal"></i> Grades and Attendance</a>
                    </li>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Home_Work_information.php')||strpos($_SERVER['SCRIPT_FILENAME'], 'add_home_work.php')) { echo 'class="active"'; } ?>>
                        <a href="Home_Work_information.php"><i class="fa fa-fw fa-pencil"></i> Home Work information</a>
                    </li>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Grades_and_Attendance.php')) { echo 'class="active"'; } ?>>
                        <a href="Grades_and_Attendance.php"><i class="fa fa-fw fa-list-alt"></i> Attendance History</a>
                    </li>
                    <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'grades.php')) { echo 'class="active"'; } ?>>
                        <a href="grades.php"><i class="fa fa-fw fa-book"></i> Grades</a>
                    </li>
                    <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'documents.php')) { echo 'class="active"'; } ?>>
                        <a href="documents.php"><i class="fa fa-fw fa-book"></i> Documents</a>
                    </li>
                     <li  <?php if(strpos($_SERVER['SCRIPT_FILENAME'], 'Account_Preferences.php')) { echo 'class="active"'; } ?>>
                        <a href="Account_Preferences.php"><i class="fa fa-fw fa-cog"></i> Account Preferences</a>
                    </li>
                    
                    <?php }else{ ?>
					<?php } ?>
                    <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i>
									Log Out</a>
				    </li>
                </ul>
            </div>
        </nav>
            