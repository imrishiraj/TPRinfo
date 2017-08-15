<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('Location: http://localhost');
	//header('Location: http://www.scanitjsr.org/tapkey');
	exit();
}
include("connection.php");
$name = $_GET['name'];
$email= $_GET['email'];
$phone= $_GET['phone'];
$dob= $_GET['dob'];
$room = $_GET['room'];
$per10= $_GET['per10'];
$year10= $_GET['year10'];
$board10= $_GET['board10'];
$per12 = $_GET['per12'];
$year12= $_GET['year12'];
$board12= $_GET['board12'];
$gradper= $_GET['gradper'];
$gradyear= $_GET['gradyear'];
$graduni= $_GET['graduni'];
$mcacgpa  = $_GET['mcacgpa'];
date_default_timezone_set("Asia/Kolkata");
$lastupdated = date("l jS \of F Y h:i:s A");
$id=$_SESSION['id'];
$useragent =$_SERVER['HTTP_USER_AGENT'];
$ip = getRealIpAddr();
$stmt3 = $pdo->prepare("UPDATE stu_tbl SET name = :name, email = :email, phone = :phone, dob = :dob, room = :room, 10per = :per10, 10year = :year10, 10board = :board10, 12per = :per12, 12year = :year12, 12board = :board12, gradper = :gradper, gradyear = :gradyear, graduni = :graduni, mcacgpa = :mcacgpa, lastupdated = :lastupdated WHERE username = :id");

if($stmt3->execute(array(':name' => $name, ':email' => $email, ':phone' => $phone, ':dob' => $dob, ':room' => $room, ':per10' => $per10, ':year10' => $year10, ':board10' => $board10, ':per12' => $per12, ':year12' => $year12, ':board12' => $board12,  ':gradper' => $gradper, ':gradyear' => $gradyear, ':graduni' => $graduni, ':mcacgpa' => $mcacgpa, ':lastupdated' => $lastupdated, ':id' => $id)))
{
	if (isset($_GET['email']))
	{
		$to = $email;
		$subject = "Tapkey - Student Info Updated";
		
		$message = '<h2>Dear '.$name.'</h2><h3>(Reg. No. - '.$_SESSION['id'].')</h3>You updated following data at tapkey &#9996; <br><br><table><tr><th>1.</th><td>Full Name</td><td>: <b>'.$name.'</b></td></tr><tr><th>2.</th><td>E-Mail</td><td>: <b>'.$email.'</b></td></tr><tr><th>3.</th><td>Phone</td><td>: <b>'.$phone.'</b></td></tr><tr><th>4.</th><td>Date of Birth</td><td>: <b>'.$dob.'</b></td></tr><tr><th>5.</th><td>Room No.</td><td>: <b>'.$room.'</b></td></tr><tr><th>6.</th><td>10th Percentage/CGPA</td><td>: <b>'.$per10.'</b></td></tr><tr><th>7.</th><td>10th Passing Year</td><td>: <b>'.$year10.'</b></td></tr><tr><th>8.</th><td>10th Board</td><td>: <b>'.$board10.'</b></td></tr><tr><th>9.</th><td>12th Percentage</td><td>: <b>'.$per12.'</b></td></tr><tr><th>10.</th><td>12th Passing Year</td><td>: <b>'.$year12.'</b></td></tr><tr><th>11.</th><td>12th Board</td><td>: <b>'.$board12.'</b></td></tr><tr><th>12.</th><td>Graduation Percentage</td><td>: <b>'.$gradper.'</b></td></tr><tr><th>13.</th><td>Graduation Passing Year</td><td>: <b>'.$gradyear.'</b></td></tr><tr><th>14.</th><td>Graduation Univeristy</td><td>: <b>'.$graduni.'</b></td></tr><tr><th>15.</th><td>MCA CGPA</td><td>: <b>'.$mcacgpa.'</b></td></tr><tr><th>16.</th><td>Updated On</td><td>: <b>'.$lastupdated.'</b></td></tr><tr><th>17.</th><td>Updated from</td><td>: <b>'.$useragent.'</b></td></tr><tr><th>18.</th><td>IP Address</td><td>: <b>'.$ip.'</b></td></tr></table><br><br><br>NOTE : <br><em><li>If there is any discrepancy regarding the correctness of data then please visit <cod>http://www.scanitjsr.org/tapkey</code> and correct it immediately.</li><li>Please do not delete this mail and produce a printed copy of it when asked by your TAP member.</li></em><br><br><br>Regards<br><br><b>Vishal Khare</b><br>Member, Training and Placement Cell<br>National Institute of Technology Jamshedpur<br>Jharkhand, INDIA - 831014<br><br>Ph : +91-7319706481<br>E-Mail : vishalkhare39@gmail.com';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: Rishiraj Mehta <rishiraj.nitjsr@gmail.com>' . "\r\n";
		//$headers[] = 'MIME-Version: 1.0';
		//$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		
			
			if(mail($to, $subject, $message, $headers)) {
				echo "success";
				exit();	
			}
			else
			{
				echo "mailnotsent";
				exit();
			}




/*




		$mail->addAddress($email, $name);
		$mail->isHTML(true);
		$mail->Subject='tapkey - Student Info Updated';
		$mail->Body ='<h2>Dear '.$name.'</h2><h3>(Reg. No. - '.$_SESSION['id'].')</h3>You updated following data at tapkey &#9996; <br><br><table><tr><th>1.</th><td>Full Name</td><td>: <b>'.$name.'</b></td></tr><tr><th>2.</th><td>E-Mail</td><td>: <b>'.$email.'</b></td></tr><tr><th>3.</th><td>Phone</td><td>: <b>'.$phone.'</b></td></tr><tr><th>4.</th><td>Room No.</td><td>: <b>'.$room.'</b></td></tr><tr><th>5.</th><td>10th Percentage/CGPA</td><td>: <b>'.$per10.'</b></td></tr><tr><th>6.</th><td>10th Passing Year</td><td>: <b>'.$year10.'</b></td></tr><tr><th>7.</th><td>10th Board</td><td>: <b>'.$board10.'</b></td></tr><tr><th>8.</th><td>12th Percentage</td><td>: <b>'.$per12.'</b></td></tr><tr><th>9.</th><td>12th Passing Year</td><td>: <b>'.$year12.'</b></td></tr><tr><th>10.</th><td>12th Board</td><td>: <b>'.$board12.'</b></td></tr><tr><th>11.</th><td>Graduation Percentage</td><td>: <b>'.$gradper.'</b></td></tr><tr><th>12.</th><td>Graduation Passing Year</td><td>: <b>'.$gradyear.'</b></td></tr><tr><th>13.</th><td>Graduation Univeristy</td><td>: <b>'.$graduni.'</b></td></tr><tr><th>14.</th><td>MCA CGPA</td><td>: <b>'.$mcacgpa.'</b></td></tr><tr><th>15.</th><td>Updated On</td><td>: <b>'.$lastupdated.'</b></td></tr><tr><th>16.</th><td>Updated from</td><td>: <b>'.$useragent.'</b></td></tr><tr><th>17.</th><td>IP Address</td><td>: <b>'.$ip.'</b></td></tr></table><br><br><br>NOTE : <br><em><li>If there is any discrepancy regarding the correctness of data then please visit <cod>http://scanitjsr.org/tapkey</code> and correct it immediately.</li><li>Please do not delete this mail and produce a printed copy of it when asked by your TAP member.</li></em><br><br><br>Regards<br><br><b>Vishal Khare</b><br>Member, Training and Placement Cell<br>National Institute of Technology Jamshedpur<br>Jharkhand, INDIA - 831014<br><br>Ph : +91-7319706481<br>E-Mail : vishalkhare39@gmail.com';
		if ($mail->send())
		{
			
		}
		else
		{
			echo "mailnotsent";
			exit();
		}
	*/}
}
else
{
	echo "error";
	exit();
}
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>