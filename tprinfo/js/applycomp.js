function applycomp(compid)
{
	//document.getElementById(compid).innerHTML = '<img src="http://localhost/dashboard/tprinfo/img/apply.gif">';
	document.getElementById(compid).innerHTML = '<img src="http://localhost/tprinfo/tprinfo/img/apply.gif">';
	processCheckDB2(compid);
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

function processCheckDB2(compid)
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)     						  //If object state is either 0 OR 4 i.e. object not engaged otherwise.
	{	
		//var url = "http://localhost/dashboard/tprinfo/php/applycomp.php?compid="+compid;  //Sending Data to php script for validation
		var url = "http://www.localhost/tprinfo/tprinfo/php/applycomp.php?compid="+compid;  //Sending Data to php script for validation
		xmlHttp.open("GET",url, true);                                            //Preparing to send request
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState==4||xmlHttp.readyState==0)                              //If object state is either 0 OR 4 i.e. object not engaged otherwise.
			{
				if(xmlHttp.status==200)                                                   //status 200 means everything went OK
				{
					if(xmlHttp.responseText.indexOf("success")==0)
					{
						document.getElementById(compid).innerHTML = '<a style="color: Green;" >Applied &#10004;</a>';
					}
					else if(xmlHttp.responseText.indexOf("failed")==0)
					{
						document.getElementById(compid).innerHTML = '<a style="color: Green;" >Can\'t Apply</a>';
					}
					else
					{
						alert(xmlHttp.responseText);
					}
				}
				else
				{
					alert("xmlHttp.status!=200");
				}
			}
		}   
		xmlHttp.send(null);                                                       //sending values to php script
	}
	else
	{
		setTimeout('processCheckDB2(compid)', 1000);                                     //If reasyState is NOT 0 or 4 then repeat then wait and check again after 1 second.
	}
}


