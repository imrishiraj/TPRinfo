<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('Location: http://localhost');
	//header('Location: http://www.scanitjsr.org/tprinfo');
	exit();
}
include("connection.php");
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$stmt1 = $pdo->prepare("SELECT * from stu_tbl WHERE username = :id");
$stmt1->execute(array(':id' => $id));
$result1=$stmt1->fetch(PDO::FETCH_ASSOC);
?>
<html>
<title> &#9996; tprinfo</title>
<head>
	<link rel="icon" href="../img/favicon.png" type="image/x-icon">
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">	
	<link href="../css/introjs.min.css" rel="stylesheet">	
	<script src="../js/intro.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/changepass.js"></script>
	<script src="../js/stuinfo.js"></script>
	<script src="../js/uploadresume.js"></script>
	<script src="../js/applycomp.js"></script>
	<link href="../css/style.css" rel="stylesheet">
	
	<script> //customizing scrollbar
		$('#questiondiv').enscroll({
	    showOnHover: false,
	    verticalTrackClass: 'track3',
	    verticalHandleClass: 'handle3'
	});                  
	</script>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pavanam" rel="stylesheet">
</head>
<body class="customscrollbar" onload="introJs().setOption('showProgress', true).start();">
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
  	<a data-step="1" data-intro="Welcome to tprinfo. This is a short tour of tprinfo." data-position='bottom' style="color:white; font-size:30px; font-family:Oswald, sans-serif;">tprinfo &#9996;</a>
		<div class="btn-group pull-right" style=" margin-top:7px;">
		      <button data-step="5" data-intro="These are pull-down links." data-position='bottom' type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false"><?php echo $name;?>&nbsp;&nbsp;&#9776;</button>
		        <ul class="dropdown-menu">
		            <li><a id="abouttprinfolink">&#10068;&nbsp;&nbsp;About <b>tprinfo &#9996;</b></a></li>
		            <li><a id="resumeinfolink">&#9737;&nbsp;&nbsp;What is a Résumé and CV?</b></a></li>
		            <li><a id="releasenoteslink">&#9745;&nbsp;&nbsp;Release Notes</b></a></li>
		            <?php
		            if(file_exists("resumes/".$id.".pdf"))
		            {
		            	echo "<li><a id='viewresumelink'>&#8475;&nbsp;&nbsp;View Your Résumé</b></a></li>";
		            }
		            ?>
		            <li><a id="changepassword" >&#9998;&nbsp;&nbsp;Change Password</a></li>
		            <li><a href="http://www.scanitjsr.org/tprinfo">&#9919;&nbsp;&nbsp;Logout</a></li>	
		        </ul>
		</div>
	<a onclick="window.location.reload();" class="btn btn-default pull-right" style="margin-right:10px; margin-top:7px;">Home</a>
  </div>
</nav>
<link rel="stylesheet" href="../css/index_style.css">
<div class="container">
<div class="row">
	<div class="customscrollbar" id="stuinfodiv" data-step="2" data-intro="This section shows all your details we have with us. Keep it updated at all times." data-position='right'>
		<h1 style="text-align: center; font-family: 'Pavanam', sans-serif;"">&#9998; Student Info</h1>
		<form  style="margin-top: 10px;">
		<div class="group">
		    <div class="alert alert-info" role="alert">
			  <center><a class="alert-link" style="font-size: 16px;"><?php if(isset($_SESSION['id'])) echo $result1['username'];?></a></center>
			</div>
		  </div>
		  <div class="group">
		    <input type="text" id="name" value="<?php if(isset($_SESSION['id'])) echo $result1['name'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>Full Name</label>
		  </div>
		  <div class="group">
		    <input type="email" id="email" value="<?php if(isset($_SESSION['id'])) echo $result1['email'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>E-Mail</label>
		  </div>
		  <div class="group">
		    <input type="text" id="phone" value="<?php if(isset($_SESSION['id'])) echo $result1['phone'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>10 digit Mobile Number</label>
		  </div>
		  <div class="group">
		    <input type="date" id="dob" value="<?php if(isset($_SESSION['id'])) echo $result1['dob'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>Date of Birth</label>
		  </div>
		  <div class="group">
		    <input type="text" id="room" value="<?php if(isset($_SESSION['id'])) echo $result1['room'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>Room Number</label>
		  </div>
		  <div class="group">
		    <input type="text" id="10per" value="<?php if(isset($_SESSION['id'])) echo $result1['10per'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>10th Percentage or CGPA</label>
		  </div>
		  <div class="group">
		    <input type="text" id="10year" value="<?php if(isset($_SESSION['id'])) echo $result1['10year'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>10th Passing Year</label>
		  </div>
		  <div class="group">
		    <input type="text" id="10board" value="<?php if(isset($_SESSION['id'])) echo $result1['10board'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>10th Board</label>
		  </div>
		  <div class="group">
		    <input type="text" id="12per" value="<?php if(isset($_SESSION['id'])) echo $result1['12per'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>12th Percentage</label>
		  </div>
		  <div class="group">
		    <input type="text" id="12year" value="<?php if(isset($_SESSION['id'])) echo $result1['12year'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>12th Passing Year</label>
		  </div>
		  <div class="group">
		    <input type="text" id="12board" value="<?php if(isset($_SESSION['id'])) echo $result1['12board'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>12th Board</label>
		  </div>
		  <div class="group">
		    <input type="text" id="gradper" value="<?php if(isset($_SESSION['id'])) echo $result1['gradper'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>Graduation Percentage or CGPA</label>
		  </div>
		  <div class="group">
		    <input type="text" id="gradyear" value="<?php if(isset($_SESSION['id'])) echo $result1['gradyear'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>Graduation Passing Year</label>
		  </div>
		  <div class="group">
		    <input type="text" id="graduni" value="<?php if(isset($_SESSION['id'])) echo $result1['graduni'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>Graduation University</label>
		  </div>
		  <div class="group">
		    <input type="text" id="mcacgpa" value="<?php if(isset($_SESSION['id'])) echo $result1['mcacgpa'];?>"><span class="highlight" ></span><span class="bar"></span>
		    <label>MCA CGPA</label>
		  </div>
		  <div id="error_display" style="width: 100%; margin-left: auto; margin-right: auto; display: block;"></div>
		  <button type="button" class="button buttonBlue" onclick="stuinfo();">Save
		    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
		  </button>
		</form>
	</div>







<?php
if($result1['year']==2)
{	
	$stmt4 = $pdo->prepare("SELECT * from company_tbl WHERE year2 = :year ORDER BY id DESC");
	$stmt4->execute(array(':year' => 1));
}
else
{
	$stmt4 = $pdo->prepare("SELECT * from company_tbl WHERE year3 = :year ORDER BY id DESC");
	$stmt4->execute(array(':year' => 1));
}
$appliedfor = array();
date_default_timezone_set("Asia/Kolkata");
$stmt5 = $pdo->prepare("SELECT * from apply_tbl WHERE stuid = :stuid");
$stmt5->execute(array(':stuid' => $id));
while($result5=$stmt5->fetch(PDO::FETCH_ASSOC))
	array_push($appliedfor, $result5['companyid']);

?>


	<div id="announcementsdiv" class="customscrollbar"  data-step="4" data-intro="This is the announcement section. Use this to know about upcoming companies and apply for them" data-position='left'>
		<h1 style="text-align: center; font-family: 'Pavanam', sans-serif;"">&#9732; Announcements</h1>
		<form style="width: 100%; margin-top: 10px; padding: 1em 1em 1em 1em;">
		<table class="table table-hover table-bordered" id="company_tbl">
		<tr><th>Id</th><th>Company</th><th>Posted on</th><th>Compensation</th><th>Deadline</th><th>Apply?</th></tr>
		<?php
		while($result4=$stmt4->fetch(PDO::FETCH_ASSOC))
		{
			$btn = '<input type="button" class="btn btn-primary btn-xs" value="Apply">';
			if(in_array($result4['id'], $appliedfor))
			{
				$btn = '<a style="color: Green;" >Applied &#10004;</a>';
			}
			else if(!in_array($result4['id'], $appliedfor) && $result4['deadline']>= date("Y-m-d"))
			{
				$btn = '<input type="button" class="btn btn-primary btn-xs" onclick="applycomp('.$result4['id'].')"value="Apply">';
			}
			else if(!in_array($result4['id'], $appliedfor) && $result4['deadline']< date("Y-m-d"))
			{
				$btn = '<a style="color: Red;" >Deadline Crossed</a>';
			}

			echo '<tr><td>'.$result4['id'].'</td><td><a href="#" data-toggle="popover" data-html="true" data-placement="bottom" title="<b>'.$result4['name'].'</b>" data-content="'.$result4['details'].'">'.$result4['name'].'</a></td><td>'.$result4['date'].'</td><td>'.$result4['stipend'].'</td><td>'.$result4['deadline'].'</td><td id="'.$result4['id'].'">'.$btn.'</td></tr>';
		}
		?>
		</table>
		</form>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();  
});
</script>

	</div>














	<div class= "customscrollbar" id="resumediv" data-step="3" data-intro="This section allows you to upload your Résumé to us. Keep your Résumé updated at all times." data-position='top'>
	<table style="width:100%;height:100%">
	<tr><td valign="top">
	<div class="alert alert-info" role="alert" style="margin-left: 10px; margin-top: 10px; margin-right: 10px;">
			  <div style="font-weight: bold;">Upload your Résumé &#8594;</div>
			  <em><li>Upload Only PDF Document</li></em>
			  <em><li>Maximum Size limit - 2 MB</li></em>
			  <em><li>Uploading a new Résumé will overwrite previously saved one</li></em>
			</div>
	</td>
	<td valign="top" style="padding-right: 10px;">
		<form style="margin-right:10px;margin: auto; margin-top: 10px; padding: 1em 1em 1em 1em; font-size: 12px;" class="file" method="post" enctype="multipart/form-data">
		    <input id="resume" name="resume" type="file" required/><br>
		    <div id="error_display3"></div>
		    <button type="button" style="height: 40px; width:100%; background-color: #1E88E5; color: #fff; font-size: 20px;" onclick="resumefunc();">Upload</button>
		</form>
	</td></tr>
	</table>
		
	</div>
	</div>
</div>
<div class="modal bs-modal-md" id="changepass">
  <div class="modal-dialog modal-md"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
      	<br>
      	<div id="changepassform">
      		<div class="group">
		    <input type="password" id="currentpass" style="background: white;"><span class="highlight" ></span><span class="bar"></span>
		    <label>Current Password</label>
		  </div>
		  <div class="group">
		    <input type="password" id="newpassword" style="background: white;"><span class="highlight" ></span><span class="bar"></span>
		    <label>New Password</label>
		  </div>
		  <div class="group">
		    <input type="password" id="newpassword1" style="background: white;"><span class="highlight" ></span><span class="bar"></span>
		    <label>Re-Type New password</label>
		  </div>
		  <div id="error_display1"></div>
      	</div>
      </div>
      <div class="modal-footer">
        <center>
        
        <button type="button" class="btn btn-success" onclick="changepass();">Submit</button>
        <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
    	</center>
      </div>
    </div>
  </div>
</div>



<!--div for modal after test is successfully added.-->
<div class="modal bs-modal-lg" id="resumeinfo">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
        </button>
        <h2 class="modal-title" id="myModalLabel">Curriculum vitae and Résumé</h2>
      </div>
      <div class="modal-body" style=" font-size:18px; font-family: 'Pavanam', sans-serif;">
			    <b>Curriculum vitae or CV</b> for short, is a latin expression which loosely translates to ‘the course of life’. By definition, a CV contains your biography or detailed account of academics, experience and projects undertaken, accomplishments, awards and affiliations, publications, teaching experience, honors and grants. A CV is written in a chronological order and the content does not change as per the job requirement.<br><br>

				<b>Résumé</b>, a french word, means to sum up. Résumé is a brief job specific document that summarises the job experience, skillset, accomplishments, education, volunteer and extra curricular activities directly relevant to the particular position. The order in which it written is of little or no importance but the content must be tailored to suit the position applied for.The length of a resume is usually one or two pages whereas the length of the CV may vary as per the content.<br><br>

				CV is mainly used in UK, New Zealand, European Union. Résumé is used in US and Canada. In India, South Africa and Australia, the terms resume and CV are used interchangeably.Depending on which part of the world you stay, you may choose the type of document. In India, unless specified, a combination of CV and resume is used. The document must contain your work experience so far(only relevant experience if you are aiming for change of career), education, training and volunteer activities, accomplishments, and extra-curricular activities, affiliations and publications.
      </div>
      
       <div class="modal-footer">
        <center>
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    	</center>
      </div>
    	</center>
      </div>
    </div>
  </div>
</div>



<div class="modal bs-modal-lg" id="abouttprinfo">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
        </button>
        <h2 class="modal-title" id="myModalLabel">About <b>tprinfo &#9996;</b></h2>
      </div>
      <div class="modal-body" style=" font-size:18px; font-family: 'Pavanam', sans-serif;">
			    <b>tprinfo</b> is a web based solution to all job applications processing woes.<br> At NIT Jamshedpur and specifically at Department at Computer Applications, a placement opportunity holds a great value and any glitches in the process can create a lot of chaos.<br> Generally students apply by mailing their applications and Résumés to their representatives of Training and Placement Cell. This is an extremely inefficient process on practical grounds. Some applications are missed out and worse of all the TAP cell member has to do a lot of redundant work.<br><br>
			    <b>Enter tprinfo</b><br>
			    <b>tprinfo</b> allows students to record their personal as well as academic details any number of times they want. The use case where this is best suited is when there are some dynamic components to student's academic and personal details like CGPA(Changes after every semester), Room Number and even phone number in some cases. Apart from that tprinfo also allow students to upload their Résumés for the use of placement purposes by TAP cell members. Résumés are also a dynamic component as it is always advisable to fine tune your Résumés before applying to a company keeping in mind the requirement of the position.<br>
			    In all <b>tprinfo</b> make the lives of student as well as TAP cell members extremely easy.<br><br>

			    P.S. - Few more super awesome functionalities will be added soon...!!!
      </div>
      
       <div class="modal-footer">
        <center>
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    	</center>
       </div>
    	</center>
      </div>
    </div>
  </div>
</div>
	



<!--View Resume Modal-->


<div class="modal bs-modal-lg" id="viewresume">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
        </button>
        <h2 class="modal-title" id="myModalLabel"><?php if(isset($_SESSION['id'])) echo 'View Résumé - '.$id.'.pdf';?></h2>
      </div>
      <div class="modal-body customscrollbar" style=" font-size:18px; font-family: 'Pavanam', sans-serif;">
			    <embed type="application/pdf" src="<?php if(isset($_SESSION['id'])) echo 'resumes/'.$id.'.pdf';?>" width="100%" height="65%">
      </div>
      
       <div class="modal-footer">
        <center>
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    	</center>
      </div>
    	</center>
      </div>
    </div>
  </div>
</div>


<!--View Release notes Modal-->

<div class="modal" id="releasenotes">
  <div class="modal-dialog"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
        </button>
        <h2 class="modal-title" id="myModalLabel">Release Notes</h2>
      </div>
      <div class="modal-body" style=" font-size:18px; font-family: 'Pavanam', sans-serif;">
      			<h3>breaking.feature.fix (Versioning Scheme Used)</h3>
      			<ul>
			    	<li>breaking: Something has changed that means code must change</li>
			    	<li>feature: Something new is added, but old code will still work fine.</li>
			    	<li>fix: Nothing's new, but a bug has been fixed.</li>
			    </ul>
			    <b><h3>Version 1.0.0</h3>Published on - 12/04/2017 - 1200 hrs</b>
			    <br>
			    <b>What's new?</b>
			    <br>
			    <ul>
			    	<li>Initial Release.</li>
			    </ul>
			    <b><h3>Version 1.1.0</h3>Published on - 14/04/2017 - 0500 hrs</b>
			    <br>
			    <b>What's new?</b>
			    <br>
			    <ul>
			    	<li>Field to add Date of birth added in student info section.</li>
			    	<li>Functionality to view uploaded Résumé added in pull-down links.</li>
			    	<li>Functionality to view Release notes added in pull-down links.</li>
			    </ul>
			    <b><h3>Version 2.2.0</h3>Published on - 17/04/2017 - 0706 hrs</b>
			    <br>
			    <b>What's new?</b>
			    <br>
			    <ul>
			    	<li>Announcement section added.</li>
			    	<li>User can now acquire information about upcoming companies and apply for them from announcement section.</li>
			    </ul>
      </div>
      
       <div class="modal-footer">
        <center>
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    	</center>
      </div>
    	</center>
      </div>
    </div>
  </div>
</div>


	<div id="displaymasterblock">
		
		<!--<div class="alert alert-info fade in" id="addtestheader">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;Add New Test
		</div>
		<em>&nbsp;&nbsp;&nbsp;All fields are mandatory</em>
			<form>
				<div class="form-inline">
					<div id="formelements">
						<label>1. Name of Test :</label>
						<input type="text" id="nameoftest" style="height:30px;" placeholder="Maximum 20 Characters"></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>2. Scheduled on :</label>
						<div id="datetimepicker" class="input-append date">
						<input type="text" style="height:30px;" id="datetime" placeholder="Date & Time of Test"></input>
						<span class="add-on" style="height:30px;">
						<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
						</span>
					      </div>
					    <script type="text/javascript">   //datepicker
					      $("#datetimepicker").datetimepicker({
					          format: "dd/MM/yyyy hh:mm",
					          orientation: "auto",
					          todayHighlight: true,
					          pickSeconds: false,
					          pick12HourFormat: true
					      });
					    </script>
					</div>
				</div>
				<div class="alert alert-info fade in" id="addtestheader" style="height:25px;font-size:15px;padding:2px;">
					<span class="glyphicon glyphicon-user"></span>&nbsp;Select Target students for test
				</div>
				<div class="form-inline">
					<div id="formelements">
						
						  <div class = "input-group">
						  	<span class = "input-group-addon" style="width:40px;">3. Programme</span>
						    <select id="programme" name="programme" class="form-control" style="width:150px;" onchange="changeinprog();">
						      <option value="0" selected>Select One</option>
						      <option value="1">B.Tech</option>
						      <option value="2">M.Tech</option>
						      <option value="3">MCA</option>
						      <option value="4">M.Sc.</option>
						    </select>
						    <span class = "input-group-addon">4. Branch</span>
						    <select id="branch" name="branch" class="form-control" onchange="changeofbranch();">
						      <option value="0">Select Programme</option>
						    </select>
						</div>
						<div class = "input-group" style="margin-top:10px;">
						    <span class = "input-group-addon" style="width:40px;">5. Semester</span>
						    <select id="semester" name="semester" class="form-control" style="width:150px;" onchange="changeinsemester();">
						      <option value="0">Select Programme</option>
						    </select>
						    <span class = "input-group-addon">6. Course</span>
						    <select id="course" name="course" class="form-control" style="width:270px;" >
						      <option value="0">Problem solving and programming skills</option>
						    </select>
						</div>
					</div>
				</div>
				<center>
				<div id="errordiv" style="width:400px;"></div>
				<button type="button" class="btn btn-success" onclick="addtestsave();">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-default">Cancel</button>
				</center>
			</form>-->
	</div>
<!--div for Change Password-->

<footer>
 <p>Designed with all the &#9829; in the world by <a href="https://www.linkedin.com/in/iamrishiraj/" target="_blank">Rishiraj Mehta</a></p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/intro.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">                                              //launching modals
		$(function(){
		 $('#changepassword').click(function() {
		   $('#changepass').modal('show');
		 });
		});
		$(function(){
		 $('#abouttprinfolink').click(function() {
		   $('#abouttprinfo').modal('show');
		 });
		});
		$(function(){
		 $('#viewresumelink').click(function() {
		   $('#viewresume').modal('show');
		 });
		});
		$(function(){
		 $('#releasenoteslink').click(function() {
		   $('#releasenotes').modal('show');
		 });
		});
		$(function(){
		 $('#resumeinfolink').click(function() {
		   $('#resumeinfo').modal('show');
		 });
		});
	</script>
	<script src="../js/bootstrap.min.js"></script>
</body>

</html>