function deleteSingle(id,rowid,table)
{
var r=confirm("Are You Sure You Want To Delete!");
if (r==true)
{
//alert(table);
//alert(id);
var url='deleteSingle.php';

var err = 0;
if(err == 0)
{ 
//alert(table);
var params = "id="+id+"&table="+table;
//alert(params);
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
					
							if (xmlhttp.readyState < 4)
				                {
								ToggleBox('loading','block','');
					     	 	}
							if(xmlhttp.readyState == 4)
				               {
					                if(xmlhttp.status == 200)
					               	{
					           			ToggleBox('loading','none','');
					           			//alert(xmlhttp.responseText);
						               	document.getElementById(rowid).style.display = 'none';
									}								
							     	else 
							     	{
					
						     	alert('There Occured Some Error In Previous Delete, Please Try Again!!');
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

}
