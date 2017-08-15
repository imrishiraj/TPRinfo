function resumefunc()
{
	//document.getElementById("error_display3").innerHTML = '<img src="http://localhost/dashboard/tprinfo/img/ring.gif">';
	document.getElementById("error_display3").innerHTML = '<img src="http://localhost/tprinfo/tprinfo/img/ring.gif">';
	var x = document.getElementById("resume");
	if (typeof x.files[0] === 'undefined')
	{
		document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>File toh select kr le.</div></div>';	
	}
	/*var ext = x.files[0].name.split(".");
	if (ext[1] != "pdf" && ext[1] != "PDF")
	{
		document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Oopss...!!! Seems like the file you have choosen is not a PDF file.</div></div>';	
	}
	else*/ if (x.files[0].size > 2097152)
	{
		document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>File is too Big. Please choose a file below 2 MB</div></div>';	
	}
	else if(x.files[0].size === 0)
	{
		document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Seems Like your doesn\'t contain any data. Please check and upload a valid resume. </div></div>';		
	}
    //document.getElementById("error_display3").innerHTML = x.files[0].name + "size" + x.files[0].size;
	else
	{
		processCheckDBresume();
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

function processCheckDBresume()
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)     						  //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		
		var _file = document.getElementById("resume");
		var data = new FormData();
	    data.append('resume', _file.files[0]);
	    //var url = "http://localhost/dashboard/tprinfo/php/uploadresume.php";       //Sending Data to php script for validation
		var url = "http://localhost/tprinfo/tprinfo/php/uploadresume.php";       //Sending Data to php script for validation
		xmlHttp.open("POST",url);                                            //Preparing to send request
		xmlHttp.onreadystatechange = handleServerResponseResume;                   //Handling response that will come from php script
		xmlHttp.send(data);                                                       //sending values to php script
	}
	else
	{
		setTimeout('processCheckDBresume()', 1000);                                     //If reasyState is NOT 0 or 4 then repeat then wait and check again after 1 second.
	}
}


function handleServerResponseResume()
{
	if(xmlHttp.readyState==4||xmlHttp.readyState==0)                              //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{
		if(xmlHttp.status==200)                                                   //status 200 means everything went OK
		{
			if(xmlHttp.responseText.indexOf("notpdf")==0)
			{
				document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Oopss...!!! Seems like the file you have choosen is not a PDF file.</div></div>';
			}
			else if(xmlHttp.responseText.indexOf("success")==0)
			{
				document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Your Résumé has been uploaded. Cheers.. &#9996;</b></div></div>';
			}
			else if(xmlHttp.responseText.indexOf("failed")==0)
			{
				document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Can not upload your Résumé right now. Something went wrong. Please contact administrator.</div></div>';
			}
			else if(xmlHttp.responseText.indexOf("emptyinput")==0)
			{
				document.getElementById("error_display3").innerHTML = '<div><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>Please select a file and then hit Upload.</div></div>';
			}
			else
			{
				document.getElementById("error_display3").innerHTML = xmlHttp.responseText;
			}
		}
		else
		{
			alert("xmlHttp.status!=200");
		}
	}
}