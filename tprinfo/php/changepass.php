<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('Location: http://localhost/');
	//header('Location: http://www.scanitjsr.org/tprinfo');
	exit();
}
include("connection.php");
$curpass=$_GET['curpass'];
$pass=$_GET['pass'];
$id=$_SESSION['id'];
$useragent =$_SERVER['HTTP_USER_AGENT'];
$ip = getRealIpAddr();
date_default_timezone_set("Asia/Kolkata");
$passchangedate = date("l jS \of F Y h:i:s A");
$stmt = $pdo->prepare("SELECT * from stu_tbl WHERE username = :id");
$stmt->execute(array(':id' => $id));
$result=$stmt->fetch(PDO::FETCH_ASSOC);
if(!password_verify($curpass, $result['password']))
{
	echo "wrongpassword";
	exit();
}
else
{
	$newpass = password_hash($pass, PASSWORD_BCRYPT);
	$stmt2 = $pdo->prepare("UPDATE stu_tbl SET password = :pass WHERE username = :id");
	if($stmt2->execute(array(':pass' => $newpass, ':id' => $id)))
	{
	
		$to = $result['email'];
		$subject = "tprinfo - Account Password Changed";
		
		$message = '<h2>Dear '.$result['name'].'</h2><h3>(Reg. No. - '.$_SESSION['id'].')</h3><h4>You tprinfo account password was changed on '.$passchangedate.' </h4><br><b>Password Changed from -- </b>'.$useragent.'<br><br><b>IP Address -- </b>'.$ip.'<br><br>NOTE : <br><em><li>If you did not changed the password then immediately contact the administrator.</li><li>Please do not delete this mail and produce a printed copy of it when asked by your TAP member.</li></em><br><br><br>Regards<br><br><b>Vishal Khare</b><br>Member, Training and Placement Cell<br>National Institute of Technology Jamshedpur<br>Jharkhand, INDIA - 831014<br><br>Ph : +91-7319706481<br>E-Mail : vishalkhare39@gmail.com';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: Rishiraj Mehta <rishiraj.nitjsr@gmail.com>' . "\r\n";
		//$headers[] = 'MIME-Version: 1.0';
		//$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		
			
			if(mail($to, $subject, $message, $headers)) 
			{
				echo "success";
				exit();	
			}
			else
			{
				echo "mailfailed";
				exit();
			}
	}
	else
	{
		echo "failed";
		exit();
	}
	
	
	
	
	
	
	
	
	
	
	
	
		/*$mail->addAddress($result['email'], $result['name']);
		$mail->isHTML(true);
		$mail->Subject='tprinfo - Account Password Changed';
		$mail->Body ='<h2>Dear '.$result['name'].'</h2><h3>(Reg. No. - '.$_SESSION['id'].')</h3><h4>You tprinfo account password was changed on '.$passchangedate.' </h4><br><b>Password Changed from -- </b>'.$useragent.'<br><br><b>IP Address -- </b>'.$ip.'<br><br>NOTE : <br><em><li>If you did not changed the password then immediately contact the administrator.</li><li>Please do not delete this mail and produce a printed copy of it when asked by your TAP member.</li></em><br><br><br>Regards<br><br><b>Vishal Khare</b><br>Member, Training and Placement Cell<br>National Institute of Technology Jamshedpur<br>Jharkhand, INDIA - 831014<br><br>Ph : +91-7319706481<br>E-Mail : vishalkhare39@gmail.com';
		$mail->send();
		echo "success";
		exit();
	}
	else
	{
		echo "failed";
		exit();
	}*/
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