function ToggleMenu(id)
{
if(id == '')
{
	for(j=0;j<=4;j++)
	{
		if(document.getElementById('db'+j))
		{
			$('#db'+j).slideUp('fast');
		}
	}

}
else
{
	for(j=0;j<=4;j++)
	{
		if(document.getElementById('db'+j) && j!= id)
		{
			$('#db'+j).slideUp('fast');
			//document.getElementById('sm'+j).style.display = 'none';
		}
	}
	if(id != '')
	{
		$('#db'+id).slideDown('fast');
	}
}
}



function checkDate(value)
{
if(document.getElementById('opt10'))
{
var currentTime = new Date();
var selectedtime =  new Date(value);
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		var forNow = year + "-" + month + "-" + day;

if(forNow != value)
{

	if(currentTime > selectedtime)
	{
		//ShowError('<br/> Callbackdate Cant Be Lesser Than Today\'s Date.');	//document.getElementById(id).value = forNow;
	}
}
}
}


function ToggleBox(id,property,value)
{
document.getElementById(id).style.display = property;
	if(value != '')
	{
		if(id != 'loading' && id != 'sucessResult')
		{
		document.getElementById(id).innerHTML = value;
		}
		else if(id == 'sucessResult')
		{
		$("#sucessResult").fadeIn('slow');
		document.getElementById(id).innerHTML = value;
		}
		else
		{
		document.getElementById(id).className= 'loadingStyle';
		}
	}
}


function ShowError(text)
   				 {
    						ToggleBox('WarningBox','block','');
							document.getElementById('WarningText').innerHTML = text;
				 }
				 
	function Showsuccess(text)
				{	
					if(navigator.appName == 'Microsoft Internet Explorer')
    						{
    						document.getElementById('loading').style.display = 'block';
    						document.getElementById('loading').innerHTML = text;
    						}
    						else
    						{
							$('#'+mainId).fadeIn('fast', function() {
    					document.getElementById(subId).innerHTML = text;
  						});
  						}
  						
  						setTimeout('Hidesuccess()',6000);
				}
					
					function Hidesuccess()
					{	
												var mainId = 'loading';
						if(navigator.appName == 'Microsoft Internet Explorer')
    						{
    						document.getElementById(mainId).style.display = 'none';
    						}
    						else
    						{
    						$('#'+mainId).fadeOut('fast');
    						}
						}
	
	
	function insertRowTable(htmltext)
	{

		if(document.getElementById('viewtable'))
		{
		 var table = document.getElementById('viewtable');
           var rowCount = table.rows.length;
           var rc = rowCount;
          	rc = parseInt(rc);
          	rc = rc-1;
            var row = table.insertRow('1');
 				row.id = 'fetchRow'+rc;
 				var res = htmltext.split('FORB22REAKING55THE**DATA');
 				res[0] = res[0].replace('PUTGENERATEDIHEREINNS',rc);
 				res[0] = res[0].replace('PUTGENERATEDIHERE',rc);

 				row.innerHTML = res[0];		
 				/*
 				if(res.length>1)
 				{
 				res[1] = res[1].replace(/^\s+|\s+$/g,"");
 				var moduleUrl = res[1]+rc;
 				row.setAttribute("onclick", "getModule('"+moduleUrl+"','manipulateContent','viewContent')"); 
 				}
 				*/
 				var getFetch = document.getElementById('fetchData').value;
 				getFetch = getFetch.split('--');
 				rc = rc+1;
 				var newgetFetch =   getFetch[0]+"--"+rc;
 				document.getElementById('fetchData').value = newgetFetch;
 				
 				
 		}		
			

	}
	
	
	function editRowTable(htmltext,id)
	{
	if(document.getElementById('fetchRow'+id))
		{

	document.getElementById('fetchRow'+id).innerHTML = htmltext;
			
	}
	}
	
	
function disableAllButtons()
{
var fgh = document.getElementsByName('Button1');
for(k=0;k<fgh.length;k++)
{
fgh[k].disabled=true;
fgh[k].style.color = '#666';

}
document.getElementById('ebtbn').innerHTML = '<img src="images/caution.png" style="vertical-align:middle" onclick="enableAllButtons();"/>&nbsp;|&nbsp;';
}	

function enableAllButtons()
{
var fgh = document.getElementsByName('Button1');
				for(k=0;k<fgh.length;k++)
				{
				fgh[k].disabled=false;
				if(fgh[k].className == 'button' || fgh[k].className == 'buttonnegetive' || fgh[k].className == 'buttonLeft' || fgh[k].className == 'buttonRight'  || fgh[k].className == 'buttonStraight')
				{
				fgh[k].style.color = '#222';
				}
				else
				{
				fgh[k].style.color = '#fff';
				}

				}
document.getElementById('ebtbn').innerHTML = '';
}	


function chkAll(sub,main)
{
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
	if(document.getElementById(main).checked == true)
	{
		for(i=0;i<maxI[1];i++)
		{
				if(document.getElementById('chBx'+i))
				{
					document.getElementById('chBx'+i).checked = true;
				}
		}
	}
	else
	{
		for(i=0;i<maxI[1];i++)
		{
				if(document.getElementById('chBx'+i))
				{
					document.getElementById('chBx'+i).checked = false;
				}
		}

	
	}
}


function dynamicTask(oldDate,newDate,id,todayDate,subject,status)
{

		if(document.getElementById('opt7').checked == true)
		{
		var notif = 1;
		}

		if(document.getElementById('optm7') && document.getElementById('bigMoodle').style.display != 'none')
		{
			if(document.getElementById('optm7').checked == true)
			{
			var notif = 1;
			}
		}


if(status == 0 && notif == 1)
{
if((newDate == todayDate) && (oldDate != todayDate))
	{

	var toAddli = '<li id="tsk'+id+'" onclick="getModule(\'task/edit?id='+id+'\',\'manipulateContent\',\'viewContent\',\'Loading Task..\');" style="cursor:pointer;color:black;border-bottom:1px #ccc solid;padding-top:10px;width:150px;padding-bottom:5px;">'+subject+'</li>';
	document.getElementById('todayTask').innerHTML+= toAddli;
	}
	else if((newDate != todayDate) && (oldDate == todayDate))
	{

		document.getElementById('todayTask').removeChild(document.getElementById('tsk'+id));
	
	}
	else if(newDate == todayDate)
	{

	var toAddli = '<li id="tsk'+id+'" onclick="getModule(\'task/edit?id='+id+'\',\'manipulateContent\',\'viewContent\',\'Loading Task..\');" style="cursor:pointer;color:#222;border-bottom:1px #ccc solid;padding-top:10px;width:150px;padding-bottom:5px;">'+subject+'</li>';
	document.getElementById('todayTask').innerHTML+= toAddli;	
	}
}
	if(notif != 1)
	{
		if(oldDate == todayDate)
		{
		document.getElementById('todayTask').removeChild(document.getElementById('tsk'+id));
		}
	}
	if(status != 0)
	{
		if(oldDate == todayDate)
		{
		document.getElementById('todayTask').removeChild(document.getElementById('tsk'+id));
		}
	}
	

}


function putNotesRight()
{
var h =0;
var k = 0;
var total = document.getElementById('totalRight').value;
	for(i=1;i<=total;i++)
	{
			fheight = 0;
			for(t=0;t<i;t++)
			{
				h = document.getElementById('noteR'+t).clientHeight;
				imgHeight = parseInt(h);	
				imgHeight = imgHeight;
				fheight +=imgHeight; 
	
			}
				fheight = fheight+60; 
				fheight = fheight +((i-1) * 20);
				document.getElementById('imgHere').innerHTML += '<img src="images/theDot.png" alt="" style="position:absolute;top:'+fheight+'px;left:35%"/>' 
	}
}

function putNotesLeft()
{
var h =0;
var k = 0;
var total = document.getElementById('totalLeft').value;
	for(i=1;i<=total;i++)
	{
			fheight = 0;
			for(t=0;t<i;t++)
			{
				h = document.getElementById('noteL'+t).clientHeight;
				imgHeight = parseInt(h);	
				imgHeight = imgHeight;
				fheight +=imgHeight; 
	
			}
				fheight = fheight+60; 
				fheight = fheight +((i-1) * 20);
				document.getElementById('imgHere').innerHTML += '<img src="images/theDot.png" alt="" style="position:absolute;top:'+fheight+'px;left:35%"/>' 
	}
}


function removeWhenAlloted(total)
{
var sum = 0;
var temp = 0;
var alt = 0;
var i;
var k;
	for(i=1;i<=total;i++)
	{
		if(document.getElementById('alt'+i))
		{
			alt = document.getElementById('alt'+i).value;
			if(alt == '')
			{
				alt = 0;
			}
			temp = parseInt(alt);
			sum+=temp
			i++;
		}
	}
		for(k=0;k<sum;k++)
		{
					
					$('#allotRow'+k).fadeOut('slow');
					//document.getElementById('allotRow'+k).style.display = 'none';
		}
						setTimeout("$('#customResult').slideUp('slow')",2000);
//		document.getElementById('customResult').innerHTML = '';
}

function addbillrow(value)
{
		var currentTime = new Date();
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		if(day <=9)
			{
				day = "0"+day;
			}
		var year = currentTime.getFullYear();
		var forNow = year + "-" + month + "-" + day;

	if(document.getElementById('typeCheck'))
	{
		var type = 'f';
	}
	
if(type == 'f')
{
	if(value != '')
	{
		var s = value.split("*");
		var table=document.getElementById('xyz');
		var c=table.rows.length;
		c = parseInt(c)-1;
		var html='<tr onmouseover="ToggleBox(\'del'+c+'\',\'block\',\'\');" class="d1" onmouseout="ToggleBox(\'del'+c+'\',\'none\',\'\')" id="pro'+c+'"><td><strong>'+s[0]+'</strong></td><td id="amt'+c+'" style="display:none">'+s[1]+'<input name="Text1" type="text"  value="'+s[2]+'" style="display:none" id="pid'+c+'"></td><td style="display:none" ><input name="Text1"  style="width:40px;" class="input" type="text" value="1" id="qt'+c+'" onkeyup="calc(\''+c+'\');numbersonly(\'qt'+c+'\')"></td><td><input id="from'+c+'" name="demo3" class="inputCalender" value="'+forNow+'"  onclick="openCalendar(this);" style="width:200px;" readonly="readonly" type="text"  /></td><td><input id="to'+c+'" name="demo3" class="inputCalender" style="width:200px;" value="'+forNow+'"  onclick="openCalendar(this);" readonly="readonly"  type="text"  /></td><td id="st'+c+'" style="display:none">'+s[1]+'</td><td><img src="images/delete.png" alt="" style="height:12px;display:none" id="del'+c+'" onclick="deleteRow(\''+c+'\')" /></td></tr>';
		document.getElementById('xyz').insertAdjacentHTML("beforeend",html);
		calculateAll();
	}
}
else
{
	if(value != '')
	{
		var s = value.split("*");
		var table=document.getElementById('xyz');
		var c=table.rows.length;
		c = parseInt(c)-1;
		var html='<tr onmouseover="ToggleBox(\'del'+c+'\',\'block\',\'\');" class="d1" onmouseout="ToggleBox(\'del'+c+'\',\'none\',\'\')" id="pro'+c+'"><td align="left" style="width:150px;"><strong>'+s[0]+'</strong></td><td align="left" style="width:215px;"><input id="from'+c+'" name="demo3" class="inputCalender" value="'+forNow+'"  onclick="openCalendar(this);" readonly="readonly" type="text"  /></td><td align="left" style="width:215px;"><input id="to'+c+'" name="demo3" class="inputCalender" value="'+forNow+'"  onclick="openCalendar(this);" readonly="readonly" type="text"  /></td><td id="amt'+c+'" align="left" style="width:60px;">'+s[1]+'<input name="Text1" type="text"  value="'+s[2]+'" style="display:none" id="pid'+c+'"></td><td align="left" style="width:60px;" ><input name="Text1"  style="width:40px;" class="input" type="text" value="1" id="qt'+c+'" onkeyup="calc(\''+c+'\');numbersonly(\'qt'+c+'\')"></td><td id="st'+c+'" align="left" style="width:60px;">'+s[1]+'</td><td align="left" style="width:40px;"><img src="images/delete.png" alt="" style="height:9px;display:none" id="del'+c+'" onclick="deleteRow(\''+c+'\')" /></td></tr>';
		document.getElementById('xyz').insertAdjacentHTML("beforeend",html);
		calculateAll();
	}


}
}

function calc(id)
{
var amount =parseInt(document.getElementById('amt'+id).innerHTML);
var qauntity =document.getElementById('qt'+id).value;
if(qauntity == '')
{
qauntity = 0;
document.getElementById('qt'+id).value = 0;
}
else
{
qauntity = parseInt(qauntity);
}

var total=qauntity*amount;
document.getElementById('st'+id).innerHTML=total;
calculateAll();
}

function calculateAll()
{
var table=document.getElementById('xyz');
var c=table.rows.length;
c = parseInt(c)-1;
var totalPrice = 0;
	for(k=0;k<c;k++)
	{
		if(document.getElementById('pro'+k).style.display != 'none')
		{
		totalPrice += parseInt(document.getElementById('st'+k).innerHTML);
		}
	}
document.getElementById('totalPrice').value=totalPrice;
var disCount = parseInt(document.getElementById('disCount').value);
var adjustMent= parseInt(document.getElementById('adjustMent').value);
if(isNaN(disCount))
{
disCount =0;
}
if(isNaN(adjustMent))
{
adjustMent =0;
}
document.getElementById('grandTotal').value=totalPrice - parseInt(disCount) + parseInt(adjustMent);
}

function deleteRow(id)
{
document.getElementById('pro'+id).style.display='none';
calculateAll();

}

function numbersonly(dec) {

var getNum = document.getElementById(dec).value;
if(isNaN(getNum))
{
ShowError('<br/>Please Enter Only Numbers in Numeric Fields *')
document.getElementById(dec).value = '';
document.getElementById(dec).focus();
}

}


function setTitle(myName)
{
var t1= document.getElementById('t1').value;
var t2 = document.getElementById('t2').value; 
t1 = parseInt(t1);
t1 = t1+1;
document.getElementById('t1').value = t1;
title1 = "("+t1+") "+t2;
title2 = myName+" says..";
document.getElementById('title1').value = title1;;
document.getElementById('title2').value += title2+",";
document.title = title2;
clearInterval(titleInterval);
titleInterval = setInterval("switchTitle()",2000);
}


function switchTitle(title1,title2)
{
var title1 = document.getElementById('title1').value;
var title2 = document.getElementById('title2').value;

var toshow= title2.split(",");
var len = toshow.length;
var ran = Math.random();
ran = ran*100000;
while(ran > len)
{
ran = ran/33;
}

var turn =  Math.floor(ran);
document.getElementById('rand').value = turn;

if(toshow[turn] == '')
{
turn = turn-1;
}

var titleToshow = toshow[turn];



var curr = document.getElementById('currT').value;
	if(curr == '0')
	{
		document.title = title1;
		document.getElementById('currT').value = '1';
	}
	else
	{
		document.title = titleToshow;
		document.getElementById('currT').value = '0';
	}
}

function resetTitle()
{
	document.title = ".::Wall & Broadcasting::.";
	clearInterval(titleInterval);
	document.getElementById('currT').value = '0';
	document.getElementById('t1').value = '0';
	document.getElementById('title1').value = '';
	document.getElementById('title2').value = '';
	document.getElementById('rand').value = '0';
}


function showCustomRows(todo,table)
{

var tab = document.getElementById(table);
var rc = tab.rows.length;
rc = rc-1;
for(i=0;i<rc;i++)
{

if(document.getElementById('fetchRow'+i))
{
	if(todo != 'All')
	{
		thisRow = document.getElementById('fetchRow'+i);
		if(thisRow.title == todo)
		{
		thisRow.style.display = 'table-row';
		}
		else
		{
		thisRow.style.display = 'none';
		}
	}
	else
	{
		thisRow = document.getElementById('fetchRow'+i);
		thisRow.style.display = 'table-row';
	}
}
}
}

function pushLead(todo,id)
{
	if(todo == 'hot')
	{
		document.getElementById('hotBut').className = 'pushed'; 
		document.getElementById('coldBut').className = 'pulled'; 
		document.getElementById('hotBut').innerHTML = "Marked As Hot";
		document.getElementById('coldBut').innerHTML = "Cool It!!";
		$('#hotNot').slideDown('fast');
		document.getElementById('coldNot').style.display = 'none';
		getModule("leads/markHot?id="+id+"&todo="+todo,'','','Hot Lead');
	}
	else
	{
		document.getElementById('hotBut').className = 'pulled'; 
		document.getElementById('coldBut').className = 'pushed'; 
		document.getElementById('coldBut').innerHTML = "Marked As Cold";
		document.getElementById('hotBut').innerHTML = "Hot It!!";
		$('#coldNot').slideDown('fast');
		document.getElementById('hotNot').style.display = 'none';
		getModule("leads/markHot?id="+id+"&todo="+todo,'','','Cold Lead');
	}
}

function countAllot(i)
{
var sum = document.getElementById('userSum').value;
var total = parseInt(document.getElementById('totalVal').value);


var x = 0;
	for(p=1;p<=sum;p++)
	{
		if(document.getElementById('alt'+p) && document.getElementById('alt'+p).value != '')
		{
			x += parseInt(document.getElementById('alt'+p).value);
			
		}
	p++;	
	}
	document.getElementById('leadTotal').innerHTML = total - x;
	if(x > total)
	{

		ShowError('<br/>Only '+total+ ' leads can be alloted. Your sum has exceeded that. Previous allotment will be decreased to zero');
		document.getElementById('alt'+i).value = 0;
		document.getElementById('alt'+i).focus();
	}
}


function mySubmenu(id,todo)
{

	if(document.getElementById('in'+id).style.display != 'block')
	{
		document.getElementById('ft'+id).className = todo;
		document.getElementById('in'+id).style.display= 'block';
		resetSubmenu(id);
	}
	else
	{
		resetSubmenu('x');
	}

}

function resetSubmenu(id)
{


	for(i=0;i<4;i++)
	{
		if(document.getElementById('ft'+i) && id != i)
		{

			if(i==0)
			{
				document.getElementById('ft'+i).className = 'buttonLeft';
			}
			else if(i==3)
			{
				document.getElementById('ft'+i).className = 'buttonRight';
			}
			else
			{
				document.getElementById('ft'+i).className = 'buttonStraight';
			}
			document.getElementById('in'+i).style.display= 'none';
		}
	}
}

function changePage(url,todo)
{
	if(document.getElementById('tlview'))
	{
		var sql = document.getElementById('tlview').value;
		url = url+'&sql='+sql;
	}
		url = url+'&todo='+todo;
	getModule(url,'manipulateContent','','Custom View');
}

function whatshapp()
{
	if(document.getElementById('whatshapp').className == 'whtclose')
	{
		document.getElementById('whatshapp').className = 'whtopen';
		ToggleBox('bigMoodle','block','');
		ToggleBox('moodle','none','');
	}
	else
	{
		document.getElementById('whatshapp').className = 'whtclose'
		ToggleBox('bigMoodle','none','');
		ToggleBox('moodle','block','');
	}
}

function getPrefix(value)
{
	if(value == 'other')
	{
		document.getElementById('oprefix').style.display = 'inline-block';
	}
	else
	{
		document.getElementById('oprefix').style.display = 'none';
		document.getElementById('oprefixVal').value= '';
	}
}

function chkModule(sub,main,total,fr,dis)
{
fr = parseInt(fr);
total = parseInt(total);

	if(document.getElementById(main).checked == true)
	{
	for(i=fr;i<=total;i++)
		{

				if(document.getElementById(sub+i))
				{
				
					document.getElementById(sub+i).checked = true;
					document.getElementById(sub+i).disabled = false;
				}
		}
	}
	else
	{
	for(i=fr;i<=total;i++)
		{

		if(document.getElementById(sub+i))
				{
					document.getElementById(sub+i).checked = false;
					if(dis != '')
					{
					document.getElementById(sub+i).disabled = true;
					}
				}
		}

	
	}
}
/*On Enter Key*/
function checkKey(e,task)
{
 if (e.keyCode == 13)
  {
   if(task == 'search')
     {
      var term = document.getElementById('mainSearch').value;

      	if(term  != "" && term.length>=4)
     		{
           		getModule('search/index?term='+term,'viewContent','manipulateContent','Search Results')       
           		
           	}
      }  	
   }
}




function forRange()
{

	   var el, newPoint, newPlace, offset;
	   $("input[type='range']").change(function() {
	     el = $(this);
	     width = el.width();
	     newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
	     offset = -1.3;
	     if (newPoint < 0) { newPlace = 0;  }
	     else if (newPoint > 1) { newPlace = width; }
	     else { newPlace = width * newPoint + offset; offset -= newPoint;}
	     el
	       .next("output")
	       .css({
	         left: newPlace,
	         marginLeft: offset + "%"
	       })
	       .text(el.val());
	   })
	   .trigger('change');
	 
}


function checkUnalloted()
{
var totalUnalloted =parseInt(document.getElementById('countTotal').value);
var loopTotal =parseInt(document.getElementById('totalUser').value);
var i = 1;	
var x = 0;
	for(i=1; i<=loopTotal ;i++)
	{
	var  allotLeads=document.getElementById('unLeads'+i).value;
	 if(allotLeads == "")
		{
		allotLeads = 0;
		}
		else
		{
			x = parseInt(x);
			allotLeads = parseInt(allotLeads);
			x = x + allotLeads;
			if(x > totalUnalloted )
			{
			alert('Insufficient Unalloted Leads kindly check Unalloted leads You have Only '+document.getElementById('showTotal').value+' Leads');
			
			}
			else
			{
			x = x;
			var  remainUnallot= totalUnalloted-x;
			document.getElementById('showTotal').value = remainUnallot;
			}
		
		}
	}
	
}
function chkNumbers(evt)
	{
	
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8 && charCode!=118 && charCode!=99)
		{
			return false;
			
		}
		else
		{
			return true;
		}

	}
	function chkDecimal(evt,response)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8 && charCode!=118 && charCode!=99 && charCode!=46)
		{
			
			document.getElementById(response).innerHTML = "Numeric Field Only";
			return false;
		}
		else
		{
		document.getElementById(response).innerHTML= "";
			return true;
			
		}

	}
function CheckedAll(area,action)
{
	return $("#"+area+" input[type='checkbox']").attr("checked",action);
}

function addToteam(id,val,createid,response,removeid)
{
id = id.split("**");
var tochk =  "-"+id[0]+"-,";
var j = document.getElementById(val).value.indexOf(tochk);
if(j == -1)
{
	document.getElementById(createid).innerHTML += '<div class="teamMate" id="'+createid+id[0]+'">'+id[1]+'&nbsp;&nbsp;&nbsp;<span onclick="removeTeam(\''+id[0]+'\',\''+val+'\',\''+createid+'\',\''+response+'\')">x</span></div>';
	document.getElementById(val).value += "-"+id[0]+"-,";
	document.getElementById(removeid).innerHTML ='';
}
else
{
	document.getElementById(removeid).innerHTML = '<span style="color:maroon">Already Selected!</span>'
}
}

function removeTeam(id,val,createid,response)
{
//alert(createid+id);
document.getElementById(response).removeChild(document.getElementById(createid+id));
var x = document.getElementById(val).value;
var toRep = "-"+id+"-,";
x = x.replace(toRep,"");
document.getElementById(val).value = x;
}

function CheckedAll(area,action)
{
       return $("#"+area+" input[type='checkbox']").attr("checked",action);
}

function texttotext(prefix,response,maxdata)
{
var newvalue = ""; 
var totali = document.getElementById(maxdata).value;
for(i=1;i<totali;i++)
{
var val= document.getElementById(prefix+i).value;
if(val != "")
       {
       newvalue = newvalue+"*TEXTTOTEXT*"+val;
       }
}
document.getElementById(response).value = newvalue        
}
function inlineEditData(show,hide)
{
	document.getElementById(hide).style.display = 'none';
	var allIds = [].slice.apply(document.getElementsByClassName("inputDisabled"));
	for (var i = 0; i < allIds.length; i++) 
	{
			
			if(allIds[i].tagName == "SELECT")
			{
			var id = allIds[i].getAttribute( 'id' );
			document.getElementById(id).disabled = "";
			}
			
			/*if(allIds[i].type == "checkbox")
			{
			var chk = allIds[i].getAttribute( 'id' );
			document.getElementById(id).checked = "";
			}*/

			
	  allIds[i].className = allIds[i].className = 'input';
	}
	document.getElementById(show).style.display = 'block';
}
function closeEditData(show,hide)
{
document.getElementById(hide).style.display = 'none';
var allIds = [].slice.apply(document.getElementsByClassName("input"));
	for (var i = 0; i < allIds.length; i++) 
	{
			
			if(allIds[i].tagName == "SELECT")
			{
			var id = allIds[i].getAttribute( 'id' );
			document.getElementById(id).disabled = "disabled";
			}
		
	  allIds[i].className = allIds[i].className = 'inputDisabled';
	}
document.getElementById(show).style.display = 'block';

}

function changeIncentive(value,response,type)
{
	var val = document.getElementById(value).value;
	var content = "";
	if(type = 'incentive')
	{
		if(val == "1")
		{
		content = "Flat Amount";
		}
		else if(val == "2")
		{
		content = "In Percent";
		}
		else
		{
		content = "Value";
		}
	}
	document.getElementById(response).innerHTML = content;
}
function incentiveexist(page,response,designation,from,toval)
{
var frm = document.getElementById(from).value;
var to = document.getElementById(toval).value;
var desig = document.getElementById(designation).value;

$.ajax({type:"POST",url:page,data:{designation:desig,from:frm,to:to},success:function(result){
if(result == "1")
{
$("#"+response).html("<div class='sucessResp'>Sorry This Period All Ready Exist</div>");
document.getElementById(from).value = '';
document.getElementById(toval).value = '';
}
else
{
$("#"+response).html("");
}
    }});
   
}

	