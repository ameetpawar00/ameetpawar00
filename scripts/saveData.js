function SaveData(url,prefix,number,special,returnurl,returnid,addrow)
{
	
	//alert(returnid);
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
							else
							{
							x = "";
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
							var cls = document.getElementById(prefix+i).className;
							var toAdd = cls.split(' ');
							//alert(toAdd[2]);
							if(toAdd[1] == 'drop-down')
							{
							document.getElementById(prefix+i).className = 'required '+toAdd[2];
							}
							else
							{
							document.getElementById(prefix+i).className = 'required '+toAdd[1];
							}
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
	
						if(document.getElementById("single"))
						{

						
							if((document.getElementById("single").checked == true) || (document.getElementById("married").checked == true))
							{

							}else{
								ShowError('Please Fill Marital Status');
								err = 1;
								exit;
							}
						}
						
					}
				
				if(valto == null)
					{
						valto = x;
						 valto = valto.replace(/\n/g,"<br/>");
					}
				else
					{
						valto = valto + "*$*$*" + x;
						 valto = valto.replace(/\n/g,"<br/>");			
						 
						 }
						 
						 
						 
						 
						 
						 
				
			}
		
	}
	
		/* added for pf and ltb with module 07-12-2016 by:-amit*/
		if(returnid==5)
				{
					
					//x=$('input[name=pfw'+i+']:checked').val();
					var ay=$('#total_amount_cal').html();
					var ax=$('#total_ins_cal').html();
					var axa=$('#total_amount_insv').html();
					 ax=parseFloat(ax);
					 axa=axa;
					 ay=parseFloat(ay);
					//x = x.replace("<br/>","");
					console.log(i);
							valto = valto + "*$*$*" + ax + "*$*$*" + ay + "*$*$*" + axa;
							valto = valto.replace(/\n/g,"<br/>");	
				}
	
		/* added for pf and ltb with module 07-12-2016 by:-amit*/

										
			
					
					
							valto = encodeURIComponent(valto);
							//alert(valto);

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
						     
						      var chkTask = url.indexOf('masters/salary-variables');
                             if(chkTask != -1)
                               {       
                               	getModule('masters/salary-variables/view','viewContent','manipulateContent','Manual Salary Setup');
                               }
						      var chkTask = url.indexOf('leaverecord/update');
                             if(chkTask != -1)
                               {       
                               	getModule('leaverecord/view','viewContent','manipulateContent','Leave Calendar');
                               }
						      var chkTasklcs = url.indexOf('leavecalendar/save');
						      var chkTasklcu = url.indexOf('leavecalendar/update');
                             if(chkTasklcs != -1 || chkTasklcu != -1 )
                               {       
                               	getModule('leavecalendar/view','viewContent','manipulateContent','Holiday Calendar');
                               }
						      var chkTaskaccesscontrol = url.indexOf('accesscontrol/save');
                             if(chkTaskaccesscontrol != -1)
                               {       
                               	getModule('masters/accesscontrol/index','viewContent','manipulateContent','Access Control');
                               }
						     
						     
						     
						  //alert(xmlhttp.responseText);
						  var showAfter = xmlhttp.responseText;
						  //showAfter = showAfter.split('BREAKSTRINGFORSAVEDATA');
						  //alert(showAfter[1]);
						  if(returnid != '' && addrow!=3 && addrow!=4)
						  {
						    var chkResp =  showAfter.indexOf('BREAKSTRINGFORSAVEDATA');
						    var chkRespa =  showAfter.indexOf('BRzEAKSTRINGFORSAVEDATALEAVE');
						  if(chkResp != -1)
						    {
						    showAfter = showAfter.split('BREAKSTRINGFORSAVEDATA');
						    document.getElementById(returnid).innerHTML= showAfter[0]; 
						    }else if(chkRespa != -1)
						    {
						    showAfter = showAfter.split('BRzEAKSTRINGFORSAVEDATALEAVE');
						    getModule('leaverequest/view','viewContent','manipulateContent','Leave Requests');
						   alert(showAfter[0]);
						    }
						    else
						    {
						     document.getElementById(returnid).innerHTML= showAfter; 
						    }
						    
						  }
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
						     	if(addrow == 3)		/* added for pf and ltb with module 07-12-2016 by:-amit*/
						     	{
						     		getModule('profile/moodelview-pf-new','manipulatemoodleContent','viewmoodleContent','');
							    } 
							    	 
							    	 
						     	if(addrow == 4)		/* added for ltb with module 12-12-2016 by:-amit*/
						     	{
						     		getModule('profile/moodelview-ltb-new','manipulatemoodleContent','viewmoodleContent','');
						     		//getModule('profile/moodelview-ltb','manipulatemoodleContent','viewmoodleContent','');
						     		//alert();
							    } 	 
							    	 
						     	if(addrow == 8)		/* added for ltb with module 12-12-2016 by:-amit*/
						     	{
						     		getModule('employee/documentation/view?eid='+showAfter,'manipulatemoodleContent','viewmoodleContent','Documentation')
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
							 var chkTask = url.indexOf('employee/save');
                             if(chkTask != -1)
                               {
                            
                               getModule(showAfter,'manipulateContent','viewContent','Leave Calendar');
                               }
							 var chkTask = url.indexOf('employee/dependent/savedepen');
                             if(chkTask != -1)
                               {
                               org = org.replace("savedepen","dependent");
                               getModule(org,'manipulatemoodleContent','','Dependent');
                               }
                               
                             var chkTask1 = url.indexOf('employee/workexperience/saveexp');
                             if(chkTask1 != -1)
                               {
                               org = org.replace("saveexp","experience");
                               getModule(org,'manipulatemoodleContent','','Work Experience');
                               }
   
                             var chkTask2 = url.indexOf('employee/education/saveedu');
                             if(chkTask2 != -1)
                               {
                               org = org.replace("saveedu","education");
                               getModule(org,'manipulatemoodleContent','','Education');
                               }
  
                            /* */
                            var chkTaskw2 = url.indexOf('management/salary/');
                             
                               
								if(special != "" && chkTaskw2 != -1)
								{
								var newSpcl = special.split("--**--");
									if(newSpcl.length > 0)
									{
										ToggleBox('viewContent','block','');
										$("#viewContent").html('<div class="loadingStyle" id="loading" style="display: block; background: rgb(255, 255, 255, 0.9) none repeat scroll 0% 0%; width: 100%; height: 100%; position: fixed; z-index: 2147483647;left: 0;top: 0;right: 0;bottom: 0;"><div class="loading"><img src="images/loading/10.gif" style="vertical-align:middle" alt="" height="120"></div></div>');ToggleBox('loading','block','');
										$("#manipulateContent").html('<div class="loadingStyle" id="loading" style="display: block; background: rgb(255, 255, 255, 0.9) none repeat scroll 0% 0%; width: 100%; height: 100%; position: fixed; z-index: 2147483647;left: 0;top: 0;right: 0;bottom: 0;"><div class="loading"><img src="images/loading/10.gif" style="vertical-align:middle" alt="" height="120"></div></div>');ToggleBox('loading','block','');
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