function checkLeave(value,empId,fromdate,todate,lrid,ltype,ival,ltypeval,rtype){
	var value=value;
var ival=ival;
if(rtype==3 || rtype==4 || rtype==5)
{
	var days=$('#days'+ival).html(); 
	var leaveType_old=$('#selectit_old'+ival).html(); 
	
/*	//alert(leaveType_old);
	else if(rtype==5){
	var url = "management/leaverequest/getLeave.php?leaveType="+value+"&empId="+empId+"&fromdate="+fromdate+"&todate="+todate+"&lrid="+lrid+"&ltype="+ltype+"&ltypeval="+ltypeval+"&rtype="+rtype;
	
}*/
var url = "management/leaverequest/getLeave.php?leaveType="+value+"&empId="+empId+"&fromdate="+fromdate+"&todate="+todate+"&lrid="+lrid+"&ltype="+ltype+"&ltypeval="+ltypeval+"&rtype="+rtype+"&days="+days+"&leaveType_old="+leaveType_old;
}else if(rtype==6){
	var url = "management/leaverequest/getLeave.php?leaveType="+value+"&empId="+empId+"&fromdate="+fromdate+"&todate="+todate+"&lrid="+lrid+"&ltype="+ltype+"&ltypeval="+ltypeval+"&rtype="+rtype;
	
}else{
	var url = "management/leaverequest/getLeave.php?leaveType="+value+"&empId="+empId+"&fromdate="+fromdate+"&todate="+todate+"&lrid="+lrid+"&ltype="+ltype+"&ltypeval="+ltypeval+"&rtype="+rtype;
	
}

console.log=url;
if (window.XMLHttpRequest)
  {
  chkLeave =new XMLHttpRequest();
  }
else
  {
  chkLeave =new ActiveXObject("Microsoft.XMLHTTP");
  }
 chkLeave.onreadystatechange=function()
  {
  
  if( chkLeave.readyState < 4)
  {
  }
  if (chkLeave.readyState==4)
    {

	    if(chkLeave.status==200)
	    {
				var resultaa=chkLeave.responseText;
				resultaa=resultaa.trim();
				//alert(resultaa);
				var chkQ = resultaa.indexOf('**');
				//alert(chkQ);
				if(chkQ>=0)
				{
					//alert(resultaa);
					var rem = resultaa.split("**");
					resultaa=parseInt(rem[0]);
					var rem_leave=rem[1];
				}			
			//alert(chkLeave.responseText);
				if(resultaa == 1){
					alert("Employee Doesn't Have Sufficient Leave Balance for this leave type , Remaining : "+leaveType+" "+rem_leave+"");
					//alert("Employee Doesn't Have Sufficient Leave Balance ,Kindly Select "+value+" + LWP");
				}
				else if(resultaa == 2){
					alert("Employee Doesn't Have Sufficient Leave Balance for this leave type , Remaining : "+leaveType+" "+rem_leave+" ,Kindly Select LWP");
					//alert("Employee Doesn't Have Sufficient Leave Balance,Kindly Select LWP");
				}
				else if(resultaa == 3){
					alert("Starting day of leave can not be an holiday");
				}
				else if(resultaa == 4){
					alert("Please approve leave of current Date first..!!");
				}
				else if(resultaa == 555){
					alert("Leave Rejected Sucessfully");
					getModule('management/leaverequest/view','viewContent','manipulateContent','Manage Leave Request')
				}
				else if(resultaa == 666){
					alert("Leave Rejected (Updated) Successfully");
					getModule('management/leaverequest/view','viewContent','manipulateContent','Manage Leave Request')
				}	
				else if(resultaa == 0){
					var res = chkLeave.responseText.split("***");
					//alert(chkLeave.responseText);
					alert("Leave Approved");
					document.getElementById('selectit'+ival).disabled = true;
					document.getElementById('selectit'+ival).style.bordercolor= "green";
					document.getElementById('selectit'+ival).disabled = true;
					document.getElementById('leaveStat'+ival).innerHTML = "<span style='color:green'>Leave Approved</span>";
					getModule('management/leaverequest/view','viewContent','manipulateContent','Manage Leave Request')
					//document.getElementById('leavedays_'+ival).innerHTML = res[1];
				}
				else if(resultaa == 95840){
					
					alert("Request Submitted");
					//document.getElementById('fetchrow'+ival).style.display = "none";
					getModule('leaverequest/view','viewContent','manipulateContent','Leave Requests');
				}
				else if(resultaa == 95890){
					
					alert("Request Deleted");
					getModule('leaverequest/view','viewContent','manipulateContent','Leave Requests');
					
				}
				else if(resultaa == 786){
					
					alert("Leave Deduction Updated");
					getModule('management/leaverequest/view','viewContent','manipulateContent','Leave Requests');
					
				}
				else if(resultaa == 789){
					
					alert("Do not Have Sufficient Balance in leave bank");
					getModule('leaverequest/view','viewContent','manipulateContent','Leave Requests');
					
				}
				else{
					
					alert("There Is Some Problam With last Changes Please Reload and Try Again");
					console.log(chkLeave.responseText);
					getModule('management/leaverequest/view','viewContent','manipulateContent','Manage Leave Request');
					
				}
				
	   	}
	    else
	    {
	    	alert("Page not found");
	    }
	}
  }
  chkLeave.open("GET",url,true);
  chkLeave.send();
}


function checkLeavestatus(leavetype,empId,ctype,i)
{
	var leavetype=leavetype;
	var i=i;
	if(ctype==1)
		{
		if($('#levr0').val()==0)
			{
				alert('Please Select Leave Time'); 
				$('#selectit'+empId).val('');
			}else{
					var leavetime=$('#levr0').val(); 
					var fromdate=$('#levr1').val(); 
					var todate=$('#levr2').val(); 
					var leaveType=$('#levr4').val(); 
					//checkLeavestatus(this.value, '86', 'vv1', 'vv2', 'vv0') 
					 $.get("leaverequest/checkLeave.php",{leaveType:leaveType,empId:empId,fromdate:fromdate,todate:todate,leavetime:leavetime}, function(result){
						var chkQ = result.indexOf('**');
						//alert(chkQ);
						if(chkQ>=0)
						{
							//alert(result);
						var rem = result.split("**");
						result=parseInt(rem[0]);
						var rem_leave=rem[1];
						}
							if(result == 1)
								{
									//alert("Employee Doesn't Have Sufficient Leave Balance ,Kindly Select "+leaveType+" + LWP");
									alert("Employee Doesn't Have Sufficient Leave Balance for this leave type , Remaining : "+leaveType+" "+rem_leave+"");
									document.getElementById('levr4').value=0;
														//alert();
								}
								else if(result == 2){
									alert("Employee Doesn't Have Sufficient Leave Balance for this leave type , Remaining : "+leaveType+" "+rem_leave+"");
									document.getElementById('levr4').value=0;
								}
								else if(result == 3){
									alert("Starting day of leave can not be an holiday");
									document.getElementById('levr4').value=0;
								}
								else if(result == 5){
									//alert("leaveType");
								}
								else{
									var res = result.split("***");
									//alert(result);
									document.getElementById('levr5').value=res[1];
								}
						

					});
				}
		}else{
					var leavetime=$('#leavetime_sel_'+i).val(); 
					var fromdate=$('#levr1asas'+i).val(); 
					var todate=$('#levr2asdfa'+i).val(); 
					var leaveType=$('#selectit'+i).val(); 
					
					var days=$('#days'+i).html(); 
					var leaveType_old=$('#selectit_old'+i).html(); 
					var type=1; 
					//checkLeavestatus(this.value, '86', 'vv1', 'vv2', 'vv0') 
					 $.get("leaverequest/checkLeave.php",{leaveType_old:leaveType_old,leaveType:leaveType,empId:empId,fromdate:fromdate,todate:todate,leavetime:leavetime,type:type,days:days}, function(result){
						//alert(result);
						
						var chkQ = result.indexOf('**');
						//alert(chkQ);
						if(chkQ>=0)
						{
							//alert(result);
						var rem = result.split("**");
						result=parseInt(rem[0]);
						var rem_leave=rem[1];
						}
						
							if(result == 1)
								{
									//alert("Employee Doesn't Have Sufficient Leave Balance ,Kindly Select "+leaveType+" + LWP");
									alert("Employee Doesn't Have Sufficient Leave Balance for this leave type , Remaining : "+leaveType+" "+rem_leave+"");
									document.getElementById('selectit'+i).value=0;
														//alert();
								}
								else if(result == 2){
									//alert("Employee Doesn't Have Sufficient Leave Balance,Kindly Select LWP");
									alert("Employee Doesn't Have Sufficient Leave Balance for this leave type , Remaining : "+leaveType+" "+rem_leave+"");
									
									document.getElementById('selectit'+i).value=0;
								}
								else if(result == 3){
									alert("Starting day of leave can not be an holiday");
									document.getElementById('selectit'+i).value=0;
								}
								else if(result == 5){
									//alert("leaveType");
								}
								else{
									var res = result.split("***");
									//alert(result);
									//document.getElementById('levr5').value=res[1];
								}
						

					});
		}			
}

//var a=$('.sel_lT option:contains("$row[10]")')[0];a.setAttribute("selected", "selected");





function approved_status_change(i,type)
{
	if(type==1)
		{
			$("#approved_buttons_"+i).show();
			$("#approved_status_"+i).hide();
			$("#levr1asas"+i).attr("style","border-color:blue");
			$("#levr1asas"+i).removeAttr("disabled");
			$("#levr2asdfa"+i).attr("style","border-color:blue");
			$("#levr2asdfa"+i).removeAttr("disabled");
			$("#leavetime_sel_"+i).attr("style","border-color:blue");
			$("#leavetime_sel_"+i).removeAttr("disabled");
			$("#selectit"+i).attr("style","border-color:blue");
			$("#selectit"+i).removeAttr("disabled");
		}else if(type==2)
				{
					$("#approved_buttons_"+i).hide();
					$("#approved_status_"+i).show();
					$("#levr1asas"+i).attr("style","border-color:green");
					$("#levr1asas"+i).attr("disabled","");
					$("#levr2asdfa"+i).attr("style","border-color:green");
					$("#levr2asdfa"+i).attr("disabled","");
					$("#leavetime_sel_"+i).attr("style","border-color:green");
					$("#leavetime_sel_"+i).attr("disabled","");
					$("#selectit"+i).attr("style","border-color:green");
					$("#selectit"+i).attr("disabled","");
				}else if(type==3)
				{
					/*$("#approved_buttons_"+i).hide();
					$("#approved_status_"+i).show();
					$("#levr1asas"+i).attr("style","border-color:green");
					$("#levr1asas"+i).attr("disabled","");
					$("#levr2asdfa"+i).attr("style","border-color:green");
					$("#levr2asdfa"+i).attr("disabled","");
					$("#leavetime_sel_"+i).attr("style","border-color:green");
					$("#leavetime_sel_"+i).attr("disabled","");
					$("#selectit"+i).attr("style","border-color:green");
					$("#selectit"+i).attr("disabled","");*/
				}
					
				
	
	
}