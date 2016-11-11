<?php

// // multiple recipients
 $to  = 'femy.123@hotmail.com' . ', '; // note the comma
 $to .= 'femy.123@gmail.com';

// // subject


// // message
// $message = '
// <html>
// <head>
// <title>Birthday Reminders for August</title>
// </head>
// <body>
// <p>Here are the birthdays upcoming in August!</p>
// <table>
// <tr>
// <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
// </tr>
// <tr>
// <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
// </tr>
// <tr>
// <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
// </tr>
// </table>
// </body>
// </html>
// ';

// // To send HTML mail, the Content-type header must be set
 $headers  = 'MIME-Version: 1.0' . "\r\n";
 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// // Additional headers
// $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
 $headers .= 'From: St Jude Syro Malabar catholic church <stjudesj@web4.bijoys.net>' . "\r\n";
// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// // Mail it


include 'sess_conf.php';
include 'db_conf.php';

$sql = "SELECT * FROM `liturgy_dates` WHERE `dates` >= CURDATE() ORDER BY `dates` LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$next_date = $row['dates'];

$sql = "SELECT * FROM reading WHERE `date` = '$next_date' ";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$heading = $row['heading'];
$body = $row['body'];
$subject = "Liturgy Remainder for $next_date ! ";
$reading_info = "<b><u>Reading information: ($next_date) </u> <h2>$heading</h2>$body";

$information = "<pre><font size='4px'><b>Liturgy responsibility for the day ($next_date)</b> <br/>";
$sql1 = "SELECT * FROM `liturgy` where day = '$next_date'";
$result1 = mysqli_query($conn, $sql1);
while($row1 = $result1->fetch_assoc()) {
	$category = $row1['category'];
	$liturgy_member_student_id = $row1['student_id'];
	$liturgy_member_user_id = $row1['user_id'];
	$activity = $row1['activity'];
	
	if($category=='students') {
		$sql2 = "SELECT * FROM `students` where id = '$liturgy_member_student_id'";
		$result2 = mysqli_query($conn, $sql2);
		$row2 = $result2->fetch_assoc();
		$name = $row2['student_name'];
		$email = $row2['email'];
		$information .= $name.' >>> '.$activity.", <br/>";
	}elseif($category=='elders') {
		$sql3 = "SELECT * FROM `users` where id = '$liturgy_member_user_id'";
		$result3 = mysqli_query($conn, $sql3);
		$row3 = $result3->fetch_assoc();
		$name = $row3['name'];
		$information .= $name.' >>> '.$activity.", <br/>";
		$email = $row3['email'];
		
	}
}
$information .= "<br/>".$reading_info;
print_r($information);
mail($to, $subject, $information, $headers);

?>
