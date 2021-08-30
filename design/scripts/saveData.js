function SaveData(url,prefix,number,special,returnurl,returnid,addrow)
{
var err = 0;
var x=null;
var valto = null;
var org = url;
var chkQ = url.indexOf('?');
if(chkQ == -1)
{
url = url+".php";
}
else
{
url = url.replace("?",".php?");
}
	for(i=0;i<number;i++)
	{
	x = null;
	
		if(document.getElementById(prefix+i))
			{
				if(document.getElementById(prefix+i).type == 'checkbox')
					{
						if(document.getElementById(prefix+i).name == 'req' || document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob')
						{
							if(document.getElementById(prefix+i).checked == false)
							{
							ShowError('<br/>Please Fill All The Fields Marked With *')
							err = 1;
							exit;
							}
							else
							{
							x = document.getElementById(prefix+i).value;						
							}
						}
						else
						{
							if(document.getElementById(prefix+i).checked == true)
							{
							x = document.getElementById(prefix+i).value;						
							}
						}
	
					}
				else
					{
						if(document.getElementById(prefix+i).name == 'req' || document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob' || document.getElementById(prefix+i).name == 'isnum' || document.getElementById(prefix+i).name == 'ismob')
						{
							if((document.getElementById(prefix+i).name == 'req' || document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob') && (document.getElementById(prefix+i).value == '' || document.getElementById(prefix+i).value == ' '))
							{
							ShowError('<br/>Please Fill All The Fields Marked With *')
							document.getElementById(prefix+i).className = 'required';
							err = 1;
							exit;
							}
						
							else if((document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob' || document.getElementById(prefix+i).name == 'isnum' || document.getElementById(prefix+i).name == 'ismob') && (isNaN(document.getElementById(prefix+i).value)))
							{
							ShowError('<br/>Please Enter Only Numbers in Numeric Fields *')
							err = 1;
							exit;
							}
							else if((document.getElementById(prefix+i).name == 'reqismob') && (document.getElementById(prefix+i).value.length != 10))
							{
							ShowError('<br/>Please Enter 10 Digits in Mobile Number One')
							err = 1;
							exit;
							}
							else if((document.getElementById(prefix+i).name == 'ismob') && (document.getElementById(prefix+i).value.length != 10 && document.getElementById(prefix+i).value.length != 0))
							{
							ShowError('<br/>Please Enter 10 Digits in Mobile Number Two')
							err = 1;
							exit;
							}
							
							if((document.getElementById(prefix+i).title == 'isdec') && (document.getElementById(prefix+i).value.indexOf('.') == -1))
							{
							ShowError('<br/>Please Enter Decimal Values in Amount Field')
							err = 1;
							exit;

							}
							
							else
							{
							x = document.getElementById(prefix+i).value;
							}
						}
						else
							{
							x = document.getElementById(prefix+i).value;

							}
	

						
					}
				
				if(valto == null)
					{
						valto = x;
						 valto = valto .replace(/\n/g,"<br/>");
					}
				else
					{
						valto = valto + "*$*$*" + x;
						 valto = valto .replace(/\n/g,"<br/>");			
						 
						 }
			}
	}
	
	
										
			
					
					
							valto = encodeURIComponent(valto);

						var params = "valto="+valto+"&special="+special+"&returnurl="+returnurl;
						//params = encodeURIComponent(params);
						//alert(params);
						
						for(k=0;k<4;k++)
						{
						if(document.getElementById('ccav'+k))
							{
								var chkInnerNull = document.getElementById('ccav'+k).innerHTML.indexOf("!");
								var chkInnerCheck = document.getElementById('ccav'+k).innerHTML.indexOf("..");
								if(chkInnerNull != -1)
								{
									var err = 1;
									ShowError("<br/><br/>The "+document.getElementById('ccav'+k).title+ " you selected is not available, please try another.");
									exit;
								}
								if(chkInnerCheck != -1)
								{
									var err = 1;
									ShowError("<br/><br/>The "+document.getElementById('ccav'+k).title+ " you selected is still being checked, please try after it is approved.");
									exit;
								}

							}
						}
						
						
						
		
					
					
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
						xmlhttp.onreadystatechange = function() {
							 if (xmlhttp.readyState<4)
							    {
							      ToggleBox('loading','block','');
							      disableAllButtons();
							    
							    }

						   if (xmlhttp.readyState == 4)
						    {
						     if(xmlhttp.status == 200) 
						     {
						     ToggleBox('loading','none','');
						  //alert(xmlhttp.responseText);
						  var showAfter = xmlhttp.responseText;
						  showAfter = showAfter.split('BREAKSTRINGFORSAVEDATA');
						  //alert(showAfter[1]);
							document.getElementById(returnid).innerHTML=showAfter[1]; 
						  
						     	var doNt = xmlhttp.responseText.indexOf('DONOTSHOW');
						     	var errorMob = xmlhttp.responseText.indexOf('THEREOCCUREDSOMEERRORFORHANGOVER');
						    
						     	if(doNt == -1)
						     	{
						  	
						     	if(returnid != '')
						     	{  
									if(returnid == 'viewmoodleContent')
									{
						      		ToggleBox('bigMoodle','block','');
						      		ToggleBox('moodle','block','');
						      		document.getElementById(returnid).innerHTML=xmlhttp.responseText; 
									}
									else
									{
						      		//document.getElementById(returnid).innerHTML=xmlhttp.responseText; 
									}
						      				
						     	}
						     	if(addrow == 1)
						     	{
						     		insertRowTable(showAfter[1]);
						     	}
						     	if(addrow == 2)
						     	{
						     		 editRowTable(showAfter[1],special);
							    } 	 
						     	
						     	
						     	if(returnurl == 1)
						     	{
						     		ToggleBox('manipulateContent','none',''); ToggleBox('viewContent','block','');
						     	}

						     	}
						     	
						     	else if(errorMob != -1)
						     	{
						     
						     		ShowError('<br/>There Occured Some Error In Previous Save, Please Try Again!!');
						     	}
						     	for(i=0;i<number;i++)
									{
																		
										if(document.getElementById(prefix+i))
											{
												if(document.getElementById(prefix+i).title != 'isNotNull')
												{
												if(document.getElementById(prefix+i).type == 'checkbox')
													{
													document.getElementById(prefix+i).checked = false;
													}
												else
													{
													document.getElementById(prefix+i).value = '';
													}
												}
											}
									}
							setTimeout('ToggleBox("loading","none","")',2000);
							 var chkTask = url.indexOf('employee/savedepen');
                             if(chkTask != -1)
                               {
                               org = org.replace("savedepen","dependent");
                               getModule(org,'manipulatemoodleContent','','Dependent');
                               }
                               
                             var chkTask1 = url.indexOf('employee/saveexp');
                             if(chkTask1 != -1)
                               {
                               org = org.replace("saveexp","experience");
                               getModule(org,'manipulatemoodleContent','','Work Experience');
                               }
   
                             var chkTask2 = url.indexOf('employee/saveedu');
                             if(chkTask2 != -1)
                               {
                               org = org.replace("saveedu","education");
                               getModule(org,'manipulatemoodleContent','','Education');
                               }
  
                             var chkTask2 = url.indexOf('salary/save');
                             if(chkTask2 != -1)
                               {
                               org = org.replace("savea.php_9DEC","add");
                               getModule(org,'manipulatemoodleContent','','Salary');
                               }
								if(special != "")
								{
								var newSpcl = special.split("--**--");
									if(newSpcl.length > 0)
									{
									getModule('management/salary/view?month='+newSpcl[1],'viewContent','manipulateContent','Manage Salary');
									}
								}
                                if(returnurl != "")
                                {
                                 //alert(special);
                                 getModule(returnurl,'viewContent','manipulateContent','HRM');
                                }
						     	
							enableAllButtons();
							//ToggleBox('sucessResult','block','<span class="blueSimpletext">Data Successfully Updated&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
												     	
					
								//setTimeout('ToggleBox("sucessResult","none","")',6000);
						     }
						     else {
						     	
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