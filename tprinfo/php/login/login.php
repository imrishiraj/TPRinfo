<?php
if(!isset($_GET['id']))
{
	header('Location: http://localhost');
	//header('Location: http://www.scanitjsr.org/tprinfo');
	exit();
}
include("../connection.php");
$id = $_GET['id'];
$pass=$_GET['password'];
$stmt = $pdo->prepare("SELECT * from stu_tbl WHERE username = :id");
$stmt->execute(array(':id' => $id));
$result=$stmt->fetch(PDO::FETCH_ASSOC);
if($result==0)
{
	echo "stuidnotexist";
	exit();
}
else
{
	if(!password_verify($pass, $result['password']))
	{
		echo "wrongpassword";
		exit();
	}
	else
	{
		session_start();
		$_SESSION['name']=$result['name'];
		$_SESSION['id']=$id;
		echo "authenticated";
		exit();
	}
}
?>