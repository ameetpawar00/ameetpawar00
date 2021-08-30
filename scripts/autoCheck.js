function autoCheck(table,field,value,responseid)
{

if(value != "")
{
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
  document.getElementById(responseid).innerHTML = 'Checking '+document.getElementById(responseid).title+" ..";
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  document.getElementById(responseid).innerHTML = xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","autoCheck.php?table="+table+"&field="+field+"&value="+value,true);
xmlhttp.send();
}
}