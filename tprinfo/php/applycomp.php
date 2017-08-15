<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('Location:http://localhost/');
	//header('Location:http://www.scanitjsr.org/tprinfo');
	exit();
}
else
{
	include("connection.php");
	$compid = $_GET['compid'];
	date_default_timezone_set("Asia/Kolkata");
	$applydate = date("l jS \of F Y h:i:s A");
	$useragent =$_SERVER['HTTP_USER_AGENT'];
	$ip = getRealIpAddr();
	$stmt5 = $pdo->prepare("INSERT INTO `apply_tbl`(`stuid`, `companyid`, `appliedon`) VALUES (:id, :compid, :applydate)");
	if($stmt5->execute(array(':id' => $_SESSION['id'], ':compid' => $compid, ':applydate' => $applydate)))
	{

		$stmt6 = $pdo->prepare("SELECT * from stu_tbl WHERE username = :id");
		$stmt6->execute(array(':id' => $_SESSION['id']));
		$result6=$stmt6->fetch(PDO::FETCH_ASSOC);
		$stmt7 = $pdo->prepare("SELECT * from company_tbl WHERE id = :compid");
		$stmt7->execute(array(':compid' => $compid));
		$result7=$stmt7->fetch(PDO::FETCH_ASSOC);
		$to = $result6['email'];
		$subject = "tprinfo - Application for - ".$result7['name']."";
		
		$message = '<h2>Dear '.$result6['name'].'</h2><h3>(Reg. No. - '.$_SESSION['id'].')</h3><h4>You used tprinfo to apply for '.$result7['name'].' on '.$applydate.'.<br> Thank You for your Application and wish you all the very best.<br><br>In case you get placed please do call TAP cell members to your placement party :)</h4><br><b>Applied from -- </b>'.$useragent.'<br><br><b>IP Address -- </b>'.$ip.'<br><br>NOTE : <br><em><li>If you did not made this application then immediately contact the administrator.</li><li>Please do not delete this mail and produce a printed copy of it when asked by your TAP cell member.</li></em><br><br><br>Regards<br><br><b>Vishal Khare</b><br>Member, Training and Placement Cell<br>National Institute of Technology Jamshedpur<br>Jharkhand, INDIA - 831014<br><br>Ph : +91-7319706481<br>E-Mail : vishalkhare39@gmail.com';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: Rishiraj Mehta <rishiraj.nitjsr@gmail.com>' . "\r\n";
		//$headers[] = 'MIME-Version: 1.0';
		//$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		mail($to, $subject, $message, $headers);
		echo "successs";
		exit();
	}
	else
	{
		echo "failed";
		exit();
	}
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