function changeStatus(coloum,table,id,field)
{
var r=confirm("Are You Sure You Want To Upadte This Entity!");
if (r==true)
{
	
				var d = document.getElementById(field+id);
				if(d.className == 'maroon')
				{
				value = "Yes";					           				
				}
				else
				{
				value = "No";
				}
																								


//alert(table);
//alert(id);
var url='changeStatus.php';
var err = 0;
if(err == 0)
{ 
//alert(value);
var params = "id="+id+"&table="+table+"&coloum="+coloum+"&value="+value;
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

						      //document.getElementById('loading').style.display = 'block';
						      	}
							if(xmlhttp.readyState == 4)
				               {
					                if(xmlhttp.status == 200)
					               	{
										//alert(xmlhttp.responseText);
										ToggleBox('loading','none','');  

					           			//document.getElementById('loading').style.display = 'none';
					           		
					           				var d = document.getElementById(field+id);
					           				if(d.className == 'maroon')
					           				{
					           					d.className = 'green';
					           					if(field == 'ase')
					           					{
					           					d.innerHTML = 'Returned';
					           					}
					           					else if(field == 'lev')
					           					{
					           					d.innerHTML = 'Approved';
					           					}
					           					else if(field == 'invAt')
					           					{
					           					d.innerHTML = 'Applicable';
					           					}
					           					else
					           					{
					           					d.innerHTML = 'Active';
					           					}
					           				}
					           				else
					           				{
					           					d.className = 'maroon';
					           					if(field == 'ase')
					           					{
					           					d.innerHTML = 'Not Returned';
					           					}
					           					else if(field == 'lev')
					           					{
					           					d.innerHTML = 'Not Yet';
					           					}
					           					else if(field == 'invAt')
					           					{
					           					d.innerHTML = 'Not Now';
					           					}
					           					else
					           					{
					           					d.innerHTML = 'Deactive';
					           					}
					           				}
					           			
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

}
