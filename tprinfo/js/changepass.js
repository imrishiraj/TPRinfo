function changepass()
{
	//document.getElementById("error_display1").innerHTML = '<img src="http://localhost/dashboard/tprinfo/img/ring.gif">';
	document.getElementById("error_display1").innerHTML = '<img src="http://localhost/tprinfo/tprinfo/img/ring.gif">';
	var curpass = document.getElementById("currentpass").value;      //fetching value in E-Mail Field
	var pass = document.getElementById("newpassword").value;    //fetching value in Password Field
	var pass1 = document.getElementById("newpassword1").value;
	if(curpass.length==0||pass.length==0||pass1.length==0)                      //if stuid or password is empty
	{
		document.getElementById("error_display1").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>All Fields are mandatory</div></div>';
	}
	else if (pass != pass1)    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display1").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Re-Typed Password does not match with New Password.</div></div>';
	}
	else                                                     //if front-end validation of both fields is OK. Move to backend validation i.e. check if stuid and password are correct or not.
	{
		processCheckDB1();
	}
}
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

function processCheckDB1()
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)     						  //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{	
		var curpass = document.getElementById("currentpass").value;      //fetching value in E-Mail Field
		var pass = document.getElementById("newpassword").value;    //fetching value in Password Field
		//var url = "http://localhost/dashboard/tprinfo/php/changepass.php?curpass="+curpass+"&pass="+pass;  //Sending Data to php script for validation
		var url = "http://www.localhost/tprinfo/tprinfo/php/changepass.php?curpass="+curpass+"&pass="+pass;  //Sending Data to php script for validation
		xmlHttp.open("GET",url, true);                                            //Preparing to send request
		xmlHttp.onreadystatechange = handleServerResponse;                   //Handling response that will come from php script
		xmlHttp.send(null);                                                       //sending values to php script
	}
	else
	{
		setTimeout('processCheckDB1()', 1000);                                     //If reasyState is NOT 0 or 4 then repeat then wait and check again after 1 second.
	}
}


function handleServerResponse()
{
	if(xmlHttp.readyState==4||xmlHttp.readyState==0)                              //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		if(xmlHttp.status==200)                                                   //status 200 means everything went OK
		{
			if(xmlHttp.responseText.indexOf("wrongpassword")==0)
			{
				document.getElementById("error_display1").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Incorrect Current Password. <b>Please Contact Administrator</b></div></div>';
			}
			else if(xmlHttp.responseText.indexOf("success")==0)
			{
				document.getElementById("error_display1").innerHTML = '<div><div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Password Changed successfully. &#9996;</div></div>';
				document.getElementById("changepassform").reset();
			}
			else if(xmlHttp.responseText.indexOf("failed")==0)
			{
				document.getElementById("error_display1").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Technical Glitch. Please contact Administrator</div></div>';
			}
			else if(xmlHttp.responseText.indexOf("mailfailed")==0)
			{
				document.getElementById("error_display1").innerHTML = '<div><div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Password Changed successfully. Although a confirmation mail can not be sent at the moment.!!!</div></div>';
			}
			else
			{
				document.getElementById("error_display1").innerHTML = xmlHttp.responseText;
			}
		}
		else
		{
			alert("xmlHttp.status!=200");
		}
	}
}