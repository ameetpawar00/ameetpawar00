function deleteData(table,name)
{
document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Delete Selected '+name; 
document.getElementById('DeleteButtons').innerHTML = '<input class="red awesome small"  name="Button1" onclick="deleteEntry(\''+name+'\',\''+table+'\')" type="button" value="Ok" style="border:0px;" /><input class="red awesome small" style="border:0px;"  name="Button1" onclick="ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Cancel" /><br />'; 
ToggleBox('DeleteBox','Block','');
}

function deleteEntry(name,table)
{
var dx = 0;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
for(i=0;i<maxI[1];i++)
{
	if(document.getElementById('chBx'+i))
	{
		if(document.getElementById('chBx'+i).checked == true)
		{
			dx += ","+document.getElementById('chBx'+i).value;
			ToggleBox('fetchrow'+i,'none','');
		}
	}
} 

xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState < 4)
  {
  ToggleBox('loading','block','Deleting '+name);
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  	//alert(xmlhttp.responseText);
  	ToggleBox('loading','none','');  
	ToggleMenu(''); 
	ToggleBox('DeleteBox','none','');	
  }
  }
xmlhttp.open("GET",'deleteEntry.php?dx='+dx+'&table='+table,true);
xmlhttp.send();

}