function editDynamic(page,id,rowid,action)
{
//alert(table);
var url=page;
var err = 0;
if(err == 0)
{ 
var params = "id="+id+"&action="+action+"&rowid="+rowid;
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
				                  	//ToggleBox('loading','none','');  

						      //document.getElementById('loading').style.display = 'block';
						      	}
							if(xmlhttp.readyState == 4)
				               {
					                if(xmlhttp.status == 200)
					               	{
										//alert(xmlhttp.responseText);
										//ToggleBox('loading','block','');  
										document.getElementById(rowid).innerHTML = xmlhttp.responseText;

					           			//document.getElementById('loading').style.display = 'none';
					           			//alert(xmlhttp.responseText);
						              
						              
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
