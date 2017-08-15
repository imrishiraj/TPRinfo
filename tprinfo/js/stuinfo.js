function stuinfo()
{
	//document.getElementById("error_display").innerHTML = '<img src="http://scanitjsr.org/tprinfo/tprinfo/img/ring.gif">';
	document.getElementById("error_display").innerHTML = '<img src="http://localhost/tprinfo/tprinfo/img/ring.gif">';
	var name = document.getElementById("name").value;    //fetching value in name Field
	var email = document.getElementById("email").value;
	var phone = document.getElementById("phone").value;
	var dob = document.getElementById("dob").value;
	var room = document.getElementById("room").value;
	var per10 = document.getElementById("10per").value;
	var year10 = document.getElementById("10year").value;
	var board10 = document.getElementById("10board").value;
	var per12 = document.getElementById("12per").value;
	var year12 = document.getElementById("12year").value;
	var board12 = document.getElementById("12board").value;
	var gradper = document.getElementById("gradper").value;
	var gradyear = document.getElementById("gradyear").value;
	var graduni = document.getElementById("graduni").value;
	var mcacgpa = document.getElementById("mcacgpa").value;
	var dobsplitted = dob.split("-");
	if(name.length==0)                      //if stuid or password is empty
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a><strong>Name </strong>can not be empty</div></div>';	
	}
	else if(email.length==0)
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Oops..!!! You forgot to type your E-Mail ID</div></div>';
	}
	else if (email.indexOf("@")<1 || email.lastIndexOf(".")<email.indexOf("@")+2 || email.lastIndexOf(".")+2>=email.length)
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Please Provide a valid Registered <b>E-Mail</b></div></div>';
	}
	else if (phone.length != 10 || !phone.isNumber())    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a><strong>Phone number</strong>should be 10 digit long string.</div></div>';
	}
	else if (dob.length!=10 || dobsplitted[0] > 2000)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a><strong>Date of Birth</strong> seems to be an impossible value</div></div>';
	}
	else if (room.length < 3 || room.length > 6)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Invalid <strong>Room number</strong></div></div>';
	}
	else if (year10.length != 4)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Invalid <strong>10th Passing Year</strong></div></div>';
	}
	else if (year12.length != 4)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Invalid <strong>12th Passing Year</strong></div></div>';
	}
	else if (gradyear.length != 4)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Invalid <strong>Graduation Passing Year</strong></div></div>';
	}
	else if (mcacgpa.length < 3 || mcacgpa.length > 5)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Invalid <strong>MCA CGPA</strong></div></div>';
	}
	else                                                     //if front-end validation of both fields is OK. Move to backend validation i.e. check if stuid and password are correct or not.
	{
		processCheckDB();
	}
}
String.prototype.isNumber = function(){return /^\d+$/.test(this);}  // to check if phone number is all numeric or not
var xmlHttp = createXmlHttpRequestObject();                  //Calling the function to vaidate input credentials
function createXmlHttpRequestObject()                        
{
	var xmlHttp;

	if(window.ActiveXObject)                                 //If user is using internet Explorer
	{
		try
		{
			xmlHttp = new ActiveXObject("Microsoft.xmlHttp");
		}
		catch(e)
		{
			xmlHttp=false;
		}
	}
	else                                                   //If user is NOT using internet Explorer but any other browser
	{
		try
		{
			xmlHttp = new XMLHttpRequest();
		}
		catch(e)
		{
			xmlHttp=false;
		}
	}

	if(!xmlHttp)                                           //If Object can not be initialized.
		{
			alert("Can not create object");
		}
	else
	{
		return xmlHttp;
	}
}

function processCheckDB()
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)     						  //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		
		var name = document.getElementById("name").value;    //fetching value in name Field
		var email = document.getElementById("email").value;
		var phone = document.getElementById("phone").value;
		var dob = document.getElementById("dob").value;
		var room = document.getElementById("room").value;
		var per10 = document.getElementById("10per").value;
		var year10 = document.getElementById("10year").value;
		var board10 = document.getElementById("10board").value;
		var per12 = document.getElementById("12per").value;
		var year12 = document.getElementById("12year").value;
		var board12 = document.getElementById("12board").value;
		var gradper = document.getElementById("gradper").value;
		var gradyear = document.getElementById("gradyear").value;
		var graduni = document.getElementById("graduni").value;
		var mcacgpa = document.getElementById("mcacgpa").value;
		//var url = "http://localhost/dashboard/tprinfo/php/stuinfo.php?name="+name+"&email="+email+"&phone="+phone+"&dob="+dob+"&room="+room+"&per10="+per10+"&year10="+year10+"&board10="+board10+"&per12="+per12+"&year12="+year12+"&board12="+board12+"&gradper="+gradper+"&gradyear="+gradyear+"&graduni="+graduni+"&mcacgpa="+mcacgpa;                  //Sending Data to php script for validation
		var url = "http://localhost/tprinfo/tprinfo/php/stuinfo.php?name="+name+"&email="+email+"&phone="+phone+"&dob="+dob+"&room="+room+"&per10="+per10+"&year10="+year10+"&board10="+board10+"&per12="+per12+"&year12="+year12+"&board12="+board12+"&gradper="+gradper+"&gradyear="+gradyear+"&graduni="+graduni+"&mcacgpa="+mcacgpa;                  //Sending Data to php script for validation
		xmlHttp.open("GET",url, true);                                            //Preparing to send request
		xmlHttp.onreadystatechange = handleServerResponsestuinfo;                   //Handling response that will come from php script
		xmlHttp.send(null);                                                       //sending values to php script
	}
	else
	{
		setTimeout('processCheckDB()', 1000);                                     //If reasyState is NOT 0 or 4 then repeat then wait and check again after 1 second.
	}
}


function handleServerResponsestuinfo()
{
	if(xmlHttp.readyState==4||xmlHttp.readyState==0)                              //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		if(xmlHttp.status==200)                                                   //status 200 means everything went OK
		{
			if(xmlHttp.responseText.indexOf("error")==0)
			{
				document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Can not update data currently.<b>Please Contact Administrator</b></div></div>';
			}
			else if(xmlHttp.responseText.indexOf("success")==0)
			{
				document.getElementById("error_display").innerHTML = '<div><div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Your details have been saved successfully.  &#9996;</b></div></div>';
			}
			else if(xmlHttp.responseText.indexOf("mailnotsent")==0)
			{
				document.getElementById("error_display").innerHTML = '<div><div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Your details have been saved successfully.  &#9996, Although a confirmation mail can not be sent at the moment.;</b></div></div>';
			}
			else
			{
				document.getElementById("error_display").innerHTML = xmlHttp.responseText;
			}
		}
		else
		{
			alert("xmlHttp.status!=200");
		}
	}
}