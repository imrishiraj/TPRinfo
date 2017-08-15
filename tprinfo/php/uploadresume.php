<?php
session_start();
if (!isset($_SESSION['id']))
{
	header('Location: http://localhost');
	//header('Location:http://www.scanitjsr.org/tprinfo');
	exit();
}
if(isset($_FILES['resume']))
{
	$name = $_FILES['resume']['name'];
	$extension  = pathinfo($name, PATHINFO_EXTENSION);
	if($extension != "pdf")
	{
		echo "notpdf";
		exit();
	}
	$newfilename=$_SESSION['id'].'.'.$extension;
    if (move_uploaded_file($_FILES['resume']['tmp_name'], "resumes/$newfilename")) 
    {
      echo "success";
    }
    else
    {
    	echo "failed";
    }
}
else
{
	echo "emptyinput";
}

?>