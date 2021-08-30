function changeDrp(value,response,table,column)
{
var val = document.getElementById(value).value;

url = "changedrp.php?value="+val+"&table="+table+"&column="+column;

var chkpass;
if (window.XMLHttpRequest)
  {
  chkpass=new XMLHttpRequest();
  }
else
  {
  chkpass=new ActiveXObject("Microsoft.XMLHTTP");
  }
 chkpass.onreadystatechange=function()
  {
  
  if( chkpass.readyState < 4)
  {
  //document.getElementById('load').style.display = 'block';
  }
  if (chkpass.readyState==4)
    {
	    if( chkpass.status==200)
	    {
		 //alert(chkpass.responseText);
		 //document.getElementById('load').style.display = 'none';
	     document.getElementById(response).innerHTML = chkpass.responseText;
	   	}
	    else
	    {
	    alert("Page not found");
	    //document.getElementById("view").innerHTML = "";
	    }
	    
	}
  }
 

 chkpass.open("GET",url,true);
 chkpass.send();
}
