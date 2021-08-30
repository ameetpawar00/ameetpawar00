function getModule(url,responseid,hideid,value)
{
document.getElementById('forHash').value = '0';
var url1 = encode64(url);
var responseid1 = encode64(responseid);
var hideid1 = encode64(hideid);
var value1 = encode64(value);
var urlStage = url1+"$$**$$"+responseid1+"$$**$$"+hideid1+"$$**$$"+value1;
document.location.hash = urlStage;




var chkQ = url.indexOf('?')
if(chkQ == -1)
{
url = url+'.php';
}
else
{
url = url.replace("?",".php?");
}




if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState < 4)
  {
  ToggleBox('loading','block','');
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  	
    //alert(xmlhttp.responseText);
   					      		if(responseid== 'viewmoodleContent' || responseid== 'manipulatemoodleContent')
						      		{
						      		ToggleBox('bigMoodle','block','');
						      		ToggleBox('moodle','block','');
						      		}
						      		
	if(value != '')
	{
	document.title = value;
	}
	var Old = document.getElementById('t2').value;

	var title1 = document.getElementById('title1').value
	var newT = title1.replace(Old,value);
	document.getElementById('title1').value = newT;
	document.getElementById('t2').value = value;
	
	var chKforNote = url.indexOf('management/salary/story/view');
	alert(chKforNote);
   if(chKforNote != -1)
   {
 //  putNotesRight();
//    putNotesLeft();
   setTimeout("putNotesRight()",2000);
   setTimeout("putNotesLeft()",2000);
   }
	
	if(responseid != '')
	{
    document.getElementById(responseid).innerHTML=xmlhttp.responseText;
    forRange();
	
			//ToggleBox(responseid,'block',''); 
    }
    if(hideid != '')
    {
		ToggleBox(hideid,'none','');  
    }
	ToggleBox('loading','none','');  
  }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}