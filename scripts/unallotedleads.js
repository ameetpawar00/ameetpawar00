function uploadUnalloted(url,prefix,number,user,leads)
{
var loopCount = document.getElementById(number).value;
var err = 0;
var x= 0;
var users = "";
var noofleads = "";
var totalUser = "";
var totalLeads = "";
var i = 1;
var valto = null;
var org = url;
var chkQ = url.indexOf('?');
//alert(leads);
if(chkQ == -1)
{
url = url+".php";
}
else
{
url = url.replace("?",".php?");
}

	for(i=1;i<loopCount;i++)
	{
	users = document.getElementById(user+i).value;
	noofleads = document.getElementById(leads+i).value;
	x=x+parseInt(noofleads);
	totalUser =  totalUser +"*$*$*"+users;
	totalLeads  = totalLeads +"*$*$*"+noofleads ;
	}
	//alert(totalLeads);
					//		valto = encodeURIComponent(valto);
						var params = "user="+totalUser +"&leads="+totalLeads+"&total="+x ;
						//params = encodeURIComponent(params);
						//alert(params);
					if(err == 0)
					{
						var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange = function()
						 {
							 if (xmlhttp.readyState<4)
							    {
							      ToggleBox('loading','block','Saving Values..');
							    
							    }

						   if (xmlhttp.readyState == 4)
						    {
						     if(xmlhttp.status == 200)
						      {
						    
						      //alert(xmlhttp.responseText);
								//ToggleBox('loading','block','Data Successfully Updated');  
							      ToggleBox('loading','none','');
							      document.getElementById('viewmoodleContent').innerHTML='';
							      document.getElementById('manipulatemoodleContent').innerHTML='';
							      ToggleBox('bigMoodle','none','')
							      getModule('unalloted/index','viewContent','manipulateContent','Unalloted Data');
								

						      }
						     else
						      {
						     	
						     	ShowError('<br/>There Occured Some Error In Previous Save, Please Try Again!!');
						     	ToggleBox('loading','none',''); 

						     	}
						     }
						     }
						  
						xmlhttp.open("POST",url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.setRequestHeader("Content-length", params.length);
						xmlhttp.setRequestHeader("Connection", "close");
						xmlhttp.send(params);
					}
}