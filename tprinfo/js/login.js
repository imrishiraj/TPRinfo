function login()
{
	//document.getElementById("error_display").innerHTML = '<img src="http://localhost/dashboard/tprinfo/img/ring.gif">';
	document.getElementById("error_display").innerHTML = '<img src="http://localhost/tprinfo/tprinfo/img/ring.gif">';
	var id = document.getElementById("id").value;      //fetching value in E-Mail Field
	var pass = document.getElementById("password").value;    //fetching value in Password Field
	if(id.length==0||pass.length==0)                      //if stuid or password is empty
	{
		if(id.length==0 && pass.length==0)                //if both stuid and password is empty
		{
			document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a><strong>Registration Number & Password</strong> can not be empty  </div></div>';
		}
		else if(id.length==0)                             //if stuid is empty but password has some value
		{
			document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a><strong>Registration Number</strong> can not be empty</div></div>';
		}
		else                                                 //if user is empty but stuid has some value
		{
			document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a><strong>Password</strong> can not be empty</div></div>';
		}
	}
	else if (id.length<10 || id.substring(0,2) != 20 || !isNaN(id.substring(4,6)))    //checking if stuid is in correct format or not
	{
		document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Please Provide a valid Registration Number</div></div>';
	}
	else                                                     //if front-end validation of both fields is OK. Move to backend validation i.e. check if stuid and password are correct or not.
	{
		processCheckDB();
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

function processCheckDB()
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)     						  //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		
		var id = (encodeURIComponent(document.getElementById("id").value)).toUpperCase();    // Reading from User
		var pass = encodeURIComponent(document.getElementById("password").value);
		//var url = "http://localhost/dashboard/tprinfo/php/login/login.php?id="+id+"&password="+pass;  //Sending Data to php script for validation
		var url = "http://" + document.domain + "/tprinfo/tprinfo/php/login/login.php?id="+id+"&password="+pass;  //Sending Data to php script for validation
		xmlHttp.open("GET",url, true);                                            //Preparing to send request
		xmlHttp.onreadystatechange = handleServerResponseLoginstu;                   //Handling response that will come from php script
		xmlHttp.send(null);                                                       //sending values to php script
	}
	else
	{
		setTimeout('processCheckDB()', 1000);                                     //If reasyState is NOT 0 or 4 then repeat then wait and check again after 1 second.
	}
}


function handleServerResponseLoginstu()
{
	if(xmlHttp.readyState==4 || xmlHttp.readyState==0)                              //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		if(xmlHttp.status==200)                                                   //status 200 means everything went OK
		{
			if(xmlHttp.responseText.indexOf("stuidnotexist")==0)
			{
				document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>The Registration Number you have entered does not match any account. <b>Please Contact Administrator</b></div></div>';
			}
			else if(xmlHttp.responseText.indexOf("wrongpassword")==0)
			{
				document.getElementById("error_display").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Sorry..!!! Password you entered is wrong. <b>Please Contact Administrator</b></div></div>';
			}
			else if(xmlHttp.responseText.indexOf("authenticated")==0)
			{
				//window.location = "http://localhost/dashboard/tprinfo/php/welcome.php"
				window.location = "http://localhost/tprinfo/tprinfo/php/welcome.php";
			}
			else
			{
				document.getElementById("error_display").innerHTML = xmlHttp.responseText;
			}
		}
		else
		{
			alert(xmlHttp.status);
		}
	}
}