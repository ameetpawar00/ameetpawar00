function checkValue(max,enter,field)
{
var max = parseInt(max);
var enter = parseInt(enter);
	if(max < enter)
	{
	alert("Point can't Be Greater Then Maximium Point");
	document.getElementById(field).value = '0';
	}
} 

function chkvalue(np,rnp)
{
	var newp = document.getElementById(np).value;
	var reenterp = document.getElementById(rnp).value;
	if(newp == reenterp)
	{
		closeMoodle();
	}
	else
	{
		alert("Entert the correct Password");
		document.getElementById(np).value = '';
		document.getElementById(rnp).value = '';
	}
}

function chkcurpswd(real,enter,msgs)
{

 var realp = real;
 var oldp = document.getElementById(enter).value;

 if(realp != oldp)
 {
 	document.getElementById(msgs).innerHTML = '  The password you gave is incorrect.';
 }
 else
 {
 	document.getElementById(msgs).innerHTML = '';
 }
}

function chkpswd(np,rnp,right,wrong)
{
	var newp = document.getElementById(np).value;
	var reenterp = document.getElementById(rnp).value;
	if(reenterp == "")
	{
		
		document.getElementById(wrong).style.display = 'none';
		document.getElementById(right).style.display = 'none';
	}
	else if(newp != reenterp)
	{
		document.getElementById(wrong).style.display = 'block';
		document.getElementById(right).style.display = 'none';
		
	}
	else
	{
		document.getElementById(right).style.display = 'block';
		document.getElementById(wrong).style.display = 'none';
	
	}
}

function permission(x)
{
alert("You do not have a permission to access "+x);
}

function getsalary(empid)
{
//alert(empid);
if (empid=="")
  {
  document.getElementById("incea0").innerHTML="";
  return;
  } 
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
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	//alert(xmlhttp.responseText);
    	var explodeS = xmlhttp.responseText.split("****");
    	
    document.getElementById("incea0").value=explodeS[0];
    document.getElementById("incen").innerHTML = explodeS[1];
    }
  }
xmlhttp.open("GET","incentive/salary/getsalary.php?id="+empid,true);
xmlhttp.send();
}

function ToggleMenu(id,heading)
{
var menu = 0;
var headmenu = 0;
var maxval=  document.getElementById("maxMenu").value;
maxval =maxval.split('**');
menu = parseInt(maxval[0]);
if(id != "")
{
	for(j=1;j<menu;j++)
	{
			if( j != id)
			{
			$('#menu'+j).slideUp('fast');
			}
	}
	$('#menu'+id).slideToggle('fast');
}
else
{
for(j=1;j<menu;j++)
	{
	$('#menu'+j).slideUp('fast');
	}

}
headmenu= parseInt(maxval[1]);

	for(i=1;i<headmenu;i++)
	{
		//	document.getElementById('head'+i).className = '';	
			 $("#head"+i).removeClass('active-menu');
	}

//document.getElementById('head'+heading).className = 'active-menu';	
 $("#head"+heading).addClass('active-menu');
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
if(id == 'viewmoodleContent' || id == 'manipulatemoodleContent')
{
$("#moodle").animate({left:'15%'},300);
//$("#moodle").animate({top:"0px"},2000);
//$('#moodle').animate({top:'0px'}));
}
else
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

		if(document.getElementById('mytable'))
		{
		 var table = document.getElementById('mytable');
           var rowCount = table.rows.length;
           var rc = rowCount;
          	rc = parseInt(rc);
          	//alert(rc);
          	//rc = rc-1;
            var row = table.insertRow('1');
 				row.id = 'fetchrow'+rc;
 				row.className  = "d"+(rc%2);
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
//alert(document.getElementById('fetchrow'+id));
	if(document.getElementById('fetchrow'+id))
		{
//alert(htmltext);
	document.getElementById('fetchrow'+id).innerHTML = htmltext;
			
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
		for(i=1;i<maxI[1];i++)
		{
				if(document.getElementById('chBx'+i))
				{
					//document.getElementById('chBx'+i).checked = true;
					if(maxI[0]=="xxxx")
					{
						//console.log(maxI[0]);
						document.getElementById('chBx'+i).checked = true;
						
						var element = document.getElementById('fetchrow'+i);
						element.style.backgroundColor='#b2ffd999';
					}else{
						document.getElementById('chBx'+i).checked = true;
					}
				}
		}
	}
	else
	{
		for(i=0;i<maxI[1];i++)
		{
				if(document.getElementById('chBx'+i))
				{
					if(maxI[0]=="xxxx")
					{
						console.log(maxI[0]);
						document.getElementById('chBx'+i).checked = false;
						
						element = document.getElementById('fetchrow'+i);
						element.style.backgroundColor='#fff';
					}else{
						document.getElementById('chBx'+i).checked = false;
					}
					
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

function sroty_line()
{
	var h=$('#asassasa').height();
	$('#asstl').height(h);
	
	
	/*var lrin=$('.lrid');
	var a=lrin.length;
//	alert(a);
	var arr = new Array();
	for(i=0; i<=a; i++)
	{
		var arval=$('.lrid')[i].val();
		arr.push(arval);
	}
alert(arr);*//*
var arr = new Array();
$("input[name='lrid']").each(function() {
arval = $(this).val();
arr.push(arval);
});

function unique(array){
    return array.filter(function(el, index, arr) {
        return index === arr.indexOf(el);
    });
}
	var unary=unique(arr);
		unaryLen = unary.length;
		for (i = 0; i < unaryLen; i++) 
			{
				var c='#'+Math.floor(Math.random()*16777215).toString(16);
				$(".par"+unary[i]).css("background-color",c);
			}
*/
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

function numbersonly(dec)
{

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

function CheckedAll(area,chkId)
{
	var action = "";
	if(document.getElementById(chkId).checked == true)
	{
		action = true;

	}
	else
	{
	action = false;
	}
				

	return $("#"+area+" input[type='checkbox']").attr("checked",action);
	}

function addToteam(id,val,createid,response,removeid)
{
id = id.split("**");
var tochk =  "-"+id[0]+"-,";
var j = document.getElementById(val).value.indexOf(tochk);
if(j == -1)
{
	document.getElementById(createid).innerHTML += '<div class="teamMate" id="'+createid+id[0]+'">'+id[1]+'&nbsp;&nbsp;&nbsp;<span onclick="removeTeam(\''+id[0]+'\',\''+val+'\',\''+createid+'\',\''+createid+'\')">x</span></div>';
	document.getElementById(val).value += "-"+id[0]+"-,";
	document.getElementById(removeid).innerHTML ='';
}
else
{
	document.getElementById(removeid).innerHTML = '<span style="color:maroon">Already Selected!</span>'
}
}

function addSalaryVariables(thisToVal,checkId,prependId,errorId)
{
	var varId=parseInt($(thisToVal).val());
	var myId=$(thisToVal).attr('id');
	var varName=$("#"+myId+" option:selected").text();

	var tochk =  "-"+varId+"-,";
	var j = document.getElementById(checkId).value.indexOf(tochk);
	if(j == -1)
	{
        var checkNumberid=document.getElementById("checkNumber");

        var oldValue=checkNumberid.value;
        var newValue=parseInt(oldValue)+1;
        checkNumberid.value=newValue;

		var htmlContent=
						'<tr id="rowId'+varId+'">' +
							'<th>'+varName+'<span>*</span></th>' +
							'<td>' +
								'<input class="input medium" name="req" value="" class="" data-original-title="" type="text"  style="width:240px;" id="salP'+newValue+'"/>' +
								'<span onclick="removeSalaryVariables('+varId+',\''+checkId+'\')" class="smallCloseButton">X</span>' +
							'</td>' +
						'</tr>';

		$('#'+prependId).append(htmlContent);

		document.getElementById(checkId).value += "-"+varId+"-,";

		document.getElementById(errorId).innerHTML ='';


		/*if(varId==10|| varId==12)
        {

            var e = document.getElementById("salaryVariableHolder");
            var strUser = e.options[parseInt(e.selectedIndex)+1].text;

            var varIdExrta=varId+1;
            var varNameExtra=strUser;
            var checkNumberid=document.getElementById("checkNumber");

            var oldValue=checkNumberid.value;
            var newValue=parseInt(oldValue)+1;
            checkNumberid.value=newValue;

            var htmlContent=
                '<tr id="rowId'+varIdExrta+'">' +
                '<th>'+varNameExtra+'<span>*</span></th>' +
                '<td>' +
                '<input class="input medium" name="req" value="" class="" data-original-title="" type="text"  style="width:240px;" id="salP'+newValue+'"/>' +
                '<span onclick="removeSalaryVariables('+varIdExrta+',\''+checkId+'\')" class="smallCloseButton" style="display: none">X</span>' +
                '</td>' +
                '</tr>';

            $('#'+prependId).append(htmlContent);

            document.getElementById(checkId).value += "-"+varIdExrta+"-,";

            document.getElementById(errorId).innerHTML ='';

        }*/

	}
	else
	{
		document.getElementById(errorId).innerHTML = '<span style="color:maroon">Already Selected!</span>'
	}

	/*id = id.split("**");

	var tochk =  "-"+id[0]+"-,";
	var j = document.getElementById(val).value.indexOf(tochk);
	if(j == -1)
	{
		document.getElementById(createid).innerHTML += '<div class="teamMate" id="'+createid+id[0]+'">'+id[1]+'&nbsp;&nbsp;&nbsp;<span onclick="removeTeam(\''+id[0]+'\',\''+val+'\',\''+createid+'\',\''+createid+'\')">x</span></div>';
		document.getElementById(val).value += "-"+id[0]+"-,";
		document.getElementById(removeid).innerHTML ='';
	}
	else
	{
		document.getElementById(removeid).innerHTML = '<span style="color:maroon">Already Selected!</span>'
	}*/
}

function removeSalaryVariables(varId,checkId)
{
	varId=parseInt(varId);
	$('#rowId'+varId).remove();
	var x = document.getElementById(checkId).value;
	var toRep = "-"+varId+"-,";
	x = x.replace(toRep,"");
	document.getElementById(checkId).value = x;

    var checkNumberid=document.getElementById("checkNumber");

    var oldValue=checkNumberid.value;
    var newValue=parseInt(oldValue)-1;
    checkNumberid.value=newValue;


   /* if(varId==10 || varId==12)
    {
		var varIdExtra=varId+1;
		$('#rowId'+varIdExtra).remove();
		var x = document.getElementById(checkId).value;
		var toRep = "-"+varIdExtra+"-,";
		x = x.replace(toRep,"");
		document.getElementById(checkId).value = x;

		var checkNumberid=document.getElementById("checkNumber");

		var oldValue=checkNumberid.value;
		var newValue=parseInt(oldValue)-1;
		checkNumberid.value=newValue;
    }*/

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

function incentiveexist(page,response,designation,from,toval,kpi)
{
var frm = document.getElementById(from).value;
var to = document.getElementById(toval).value;
var desig = document.getElementById(designation).value;
if(kpi !="")
{
var kp = document.getElementById(kpi).value;
}
//alert(kp);
$.ajax({type:"POST",url:page,data:{designation:desig,from:frm,to:to,kpi:kp},success:function(result){
//alert(result);
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

$(document).keydown(function(e)
{
    if (e.keyCode == 27)
     {
     $('#moodle').animate({left:'115%'},300);
    	setTimeout('closeBigmoodle()',600);
    }
});

function closeBigmoodle()
{
	  document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';
$('#bigMoodle').fadeOut('fast');
document.getElementById('moodle').style.left='-1000px';
}

function magicScroll()
{
if($('#titleForced').val == 0)
{
$('#pullDown').fadeIn('fast');
$('#myTitle').slideUp('slow');
$('#mytableSubs').fadeIn('slow');
//document.getElementById('mainDivId').style.height = '470px';
$('#mainDivId').height('470px');
/*
$('#myTitle').slideUp('slow', function(){
$('#pullDown').fadeIn('fast');
});
*/
}
}

function magicScrollDown()
{
if($('#titleForced').val == 0)
{
$('#mytableSubs').fadeOut('fast');
$('#myTitle').slideDown('slow');
$('#pullDown').fadeOut('fast');
//document.getElementById('mainDivId').style.height = '400px';
$('#mainDivId').height('400px');
}
}

function sort(ev)
{
var currentId = ev;
var currImgId = currentId+'img';
if(document.getElementById(currImgId).title == 'Ascending')
{
document.getElementById(currImgId).innerHTML = '<img src="icons/up-arrow-dropdown.png" style="width:10px;" alt="" />';
document.getElementById(currImgId).title = 'Descending';
}
else
{
document.getElementById(currImgId).innerHTML = '<img src="icons/down-arrow-dropdown.png" style="width:10px;" alt="" />';
document.getElementById(currImgId).title = 'Ascending';
}

var currInputId = currentId+'input';
var inh = '';
var table = document.getElementById('mytable');
var rows = table.rows.length;
targetTableColCount = table.rows.item(0).cells.length;

for(j=0;j<targetTableColCount;j++)
{

if(ev == table.rows.item(0).cells.item(j).id)
{
targetColumn = j;
}
}

var thisrowcontent= new Array();
var thiscoltext= new Array();
for(i=1;i<table.rows.length;i++)
{
x = table.rows.item(i).cells.item(targetColumn).innerHTML;
x = x.toLowerCase();
thiscoltext[i] = x+'THISISABREAKER'+table.rows[i].innerHTML
}

if(document.getElementById(currInputId).value == 0)
{
document.getElementById(currInputId).value = '1';
thiscoltext = thiscoltext.sort();
}
else
{
document.getElementById(currInputId).value = '0';
thiscoltext = thiscoltext.reverse();
}
var colength = (thiscoltext.length-1)
var myinnerHTML = '';
var temp= ''
var classId = 0;
for(k=0;k<colength;k++)
{
temp = thiscoltext[k];
temp = temp.split('THISISABREAKER');
classId = k%2;
myinnerHTML += "<tr class='d"+classId+"' id='fetchrow"+(k+1)+"'>"+temp[1]+"</tr>";
}
myinnerHTML = table.rows[0].innerHTML + myinnerHTML;
document.getElementById('mytable').innerHTML = myinnerHTML;

	for(m=1;m<=table.rows.length;m++)
		{
		document.getElementById('fetchrow'+m).setAttribute('onmousemove','callScroll(\''+m+'\')');
		}
		


}

function  bindDiv()
{
if(document.getElementById('mytable'))
	{
		var table = document.getElementById('mytable');
		if(table.data != 'Sorting Enabled')
		{
		table.data = 'Sorting Enabled';
		var targetTableColCount = table.rows.item(0).cells.length;
		document.getElementById('tempSortdata').innerHTML = '';
			for(j=1;j<targetTableColCount;j++)
			{
				elm = table.rows.item(0).cells.item(j);
				elm.id = 'th'+j;
				elm.setAttribute("onclick", 'sort(\'th'+j+'\')');
				elm.innerHTML += '<div style="padding-left:8px;display:inline-block" id="th'+j+'img" title="Ascending"><img src="icons/down-arrow-dropdown.png" style="width:10px;" alt="" /></div>';
				document.getElementById('tempSortdata').innerHTML += '<input name="Text1" type="text" value="0" id="th'+j+'input"  />'
			}
		}
		
		var thData = table.rows.item(0).innerHTML;
		thData = thData.replace('id="mainChk"','id="mainChk1"');
		thData = thData.replace(",'mainChk'",",'mainChk1'");
		var newTable = '<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytableSubs" style="display:none"><tr>'+thData+'</tr></table>';
		//document.getElementById('mainDivId').insertAdjacentHTML('beforeBegin',newTable);
		$("#mainDivId").before(newTable);
		
		var headerTable = '<div style="background:transparent;display:none;width:100%;padding-top:10px;" id="pullDown" onclick="magicScrollDown();document.getElementById(\'titleForced\').value = \'1\';$(\'#pullDown\').fadeOut(\'fast\');"><center><img src="icons/down-arrow-black.png" alt=""/>\</center><input name="Text1" type="text" id="titleForced" style="display:none" value="0" /></div>';
		//document.getElementById('headerTable').insertAdjacentHTML('beforeBegin',headerTable);
		//document.getElementById('headerTable').insertAdjacentHTML('beforeBegin',headerTable);
		$("#headerTable").before(headerTable);
		for(k=1;k<=table.rows.length;k++)
		{
		//document.getElementById('fetchrow'+k).setAttribute('onmousemove','callScroll(\''+k+'\')');
		$("#fetchrow"+k).attr("onmousemove","callScroll(\'"+k+"\')");
		}
		
		
	}
}

function callScroll(id)
{

if(id < 12) 
{
magicScrollDown();
}
else if(id > 18)
{
magicScroll();
}

}

function closeMoodle()
{
 $('#moodle').animate({left:'115%'},300);
 setTimeout('closeBigmoodle()',600);

}

function salaryCalcu(basic,totalDays,leave,response,response2,totalamt,prefix,start,max)
{
var leaves = parseFloat(document.getElementById(leave).value) ;
leaves = parseFloat(leaves);
	if(leaves > 1.5)
	{
		var basicSal = parseFloat(document.getElementById(basic).value) ;
		var totalDay = parseFloat(document.getElementById(totalDays).value) ;
		var ttlAmt = parseFloat(document.getElementById(totalamt).value) ;
		if(document.getElementById(totalDays).value == "")
		{
		totalDay = parseFloat(document.getElementById('sals0').value);
		document.getElementById(totalDays).value = totalDay;
		}
		if(leaves == "" )
		{
		document.getElementById(leave).value= 0;
		}
		
		var oneDay = 0;
		var deduction = 0;
		var amount = 0;
		var totalAmount = 0
		var total = 0;
		total = parseFloat(total);
		oneDay = parseFloat(oneDay);
		oneDay = parseFloat(basicSal/totalDay).toFixed(2);
		deduction = parseFloat(deduction);
		deduction = parseFloat(oneDay*leaves).toFixed(2)
		totalAmount = parseFloat(totalAmount);

			for(i=start;i<max;i++)
			{
				amount = document.getElementById(prefix+i).value;
				if(amount == "")
				{
				document.getElementById(prefix+i).value = 0;
				amount = 0;
				}
				amount = parseFloat(amount);
				totalAmount = parseFloat(totalAmount+amount);
				totalAmount = parseFloat(totalAmount);
				
			}
		total = parseFloat(totalAmount-deduction);
		total = Math.round(total);
		document.getElementById(response).value  = deduction;
		document.getElementById(response2).value = total;
	}
}

function selectYear(value)
{
 var cookieName = "selectedYear";
 var cokkieVal = value;
 var today = new Date();
 var expire = new Date();
 expire.setTime(today.getTime() + 3600000*2);
 document.cookie = cookieName+"="+escape(cokkieVal)+ ";expires="+expire.toGMTString();
 getModule('management/salary/view?month='+document.getElementById('month_sel_sal').value,'viewContent','manipulateContent','Manage Salary')
}

function PrintDiv(area)
{
           var divToPrint = document.getElementById(area);
           var popupWin = window.open('', '_blank', 'width=900,height=700');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
}

function checkOut(id)
{
document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Checkout this time '; 
document.getElementById('DeleteButtons').innerHTML = '<input class="button green"  name="Button1" onclick="getModule(\'attendance/userattendance?id='+id+'\',\'myAttendancechk\',\'\',\'\');ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Ok" style="border:0px;" />&nbsp;&nbsp;<input class="button gray" style="border:0px;"  name="Button1" onclick="ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Cancel" /><br />'; 
ToggleBox('DeleteBox','block','');
}

function logout()
{
document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Logout Without Checkout'; 
document.getElementById('DeleteButtons').innerHTML = '<input class="button green"  name="Button1" onclick="window.location.href=\'logout.php\';ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Ok" style="border:0px;" />&nbsp;&nbsp;<input class="button gray" style="border:0px;"  name="Button1" onclick="ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Cancel" /><br />'; 
ToggleBox('DeleteBox','block','');
}

function changediv(per0,des,upl,cmp2)
{
var type = document.getElementById(per0).value;

if(type == 1)
{
document.getElementById(des).style.display = 'inline-block';
document.getElementById(cmp2).style.display = 'inline-block';
document.getElementById(upl).style.display = 'none';
}
else if(type == 2)
{
document.getElementById(des).style.display = 'none';

document.getElementById(upl).style.display = 'inline-block';
document.getElementById(cmp2).style.display = 'inline-block';

}
}

function compareDate(var1,var2,message)
{
var date1 = document.getElementById(var1).value;
var date2 = document.getElementById(var2).value;
if(date2 < date1)
	{
	ShowError('<br/>'+message);        
	document.getElementById(var1).value = "";
	document.getElementById(var2).value = "";
	document.getElementById(var1).focus();
	}


}

function valueTick(chktick,chk,min,max,resp)
{

		for(i=min;i<=max;i++)
		{
			
			if(document.getElementById(chk+""+i).checked == true && (chk+""+i == chktick) )
			{
			//alert(1);
			document.getElementById(resp).value = document.getElementById(chktick).value;
			}else
			{
			//alert(3);
			document.getElementById(chk+""+i).checked = false;
			}
			
		}

}


function calculatesalaryApp(absentdays,Aabsentdays,NAabsentdays,deduction,monthdays,leave)
{
	var Aabsentdays = parseFloat(document.getElementById(Aabsentdays).value);
	var NAabsentdays = parseFloat(document.getElementById(NAabsentdays).value);
    var basic=$('.getMyVal').val();
    var totalbasic=$('#sals19').val();

	var deductionamount = parseFloat(document.getElementById(deduction).value);
	var monthdays = parseFloat(document.getElementById(monthdays).value);
	var leave = parseFloat(document.getElementById(leave).value);


	var perdaysal = 0;
	var perdayNAsal = 0;
	var absentdeduction = 0;
	var absentNAdeduction = 0;
	var totaldeduction = 0;
	perdaysal = parseFloat(basic/monthdays);
	perdayNAsal = parseFloat(totalbasic/monthdays);
	Aabsentdays=Aabsentdays-leave;
	console.log("perdaysal-"+perdaysal+" perdayNAsal-"+perdayNAsal+" monthdays-"+monthdays+" basic-"+basic+" totalbasic-"+totalbasic);
	absentNAdeduction = parseFloat(perdayNAsal*parseFloat(NAabsentdays));
	absentdeduction = parseFloat(perdaysal*parseFloat(Aabsentdays));
		//alert(perdayNAsal);
	totaldeduction  = parseFloat(absentdeduction) + parseFloat(absentNAdeduction);
	totaldeduction = Math.round(totaldeduction);
	console.log();
	document.getElementById(deduction).value = totaldeduction;
	var sals25 = parseFloat(document.getElementById("sals9").value);
	var sals26 = parseFloat(document.getElementById("sals10").value);
	var sals27 = parseFloat(document.getElementById("sals11").value);
	var sals28 = parseFloat(document.getElementById("sals12").value);
	var sals29 = parseFloat(document.getElementById("sals13").value);
	var sals30 = parseFloat(document.getElementById("sals14").value);
	document.getElementById(absentdays).value=Aabsentdays+NAabsentdays+sals25+sals26+sals27+sals28+sals29+sals30;
	var sals1 = parseFloat(document.getElementById("sals1").value);
	var sals8a = parseFloat(document.getElementById(absentdays).value);
	document.getElementById("sals2").value=sals1-sals8a;
}

/*
function calculatesalaryApp(absentdays,Aabsentdays,NAabsentdays,basic,deduction,monthdays,con_allow,spec_allow,other_allow,leave)
{

	var absentdays = parseFloat(document.getElementById(absentdays).value);
	var Aabsentdays = parseFloat(document.getElementById(Aabsentdays).value);
	var NAabsentdays = parseFloat(document.getElementById(NAabsentdays).value);
	var con_allow = parseFloat(document.getElementById(con_allow).value);
	var spec_allow = parseFloat(document.getElementById(spec_allow).value);
	var other_allow = parseFloat(document.getElementById(other_allow).value);
	var basic = parseFloat(document.getElementById(basic).value);
	var totalbasic = parseFloat(basic+con_allow+spec_allow+other_allow);
	var deductionamount = parseFloat(document.getElementById(deduction).value);
	var monthdays = parseFloat(document.getElementById(monthdays).value);
	var leave = parseFloat(document.getElementById(leave).value);

	var perdaysal = 0;
	var perdayNAsal = 0;
	var absentdeduction = 0;
	var absentNAdeduction = 0;
	var totaldeduction = 0;
	perdaysal = parseFloat(basic/monthdays);
	perdayNAsal = parseFloat(totalbasic/monthdays);
	//absentdays = absentdays - leave;
	Aabsentdays=Aabsentdays-leave;
//console.log(totalbasic+" "+perdayNAsal+" "+monthdays);
	absentNAdeduction = parseFloat(perdayNAsal*parseFloat(NAabsentdays));
	absentdeduction = parseFloat(perdaysal*parseFloat(Aabsentdays));
		//alert(perdayNAsal);
	totaldeduction  = parseFloat(absentdeduction) + parseFloat(absentNAdeduction);
	totaldeduction = Math.round(totaldeduction);
	//console.log(absentNAdeduction+" "+absentdeduction+" "+totaldeduction);
	document.getElementById(deduction).value = totaldeduction;
	var sals8 = parseFloat(document.getElementById("sals8").value);
	var sals25 = parseFloat(document.getElementById("sals25").value);
	var sals26 = parseFloat(document.getElementById("sals26").value);
	var sals27 = parseFloat(document.getElementById("sals27").value);
	var sals28 = parseFloat(document.getElementById("sals28").value);
	var sals29 = parseFloat(document.getElementById("sals29").value);
	var sals30 = parseFloat(document.getElementById("sals30").value);
	document.getElementById("sals8").value=Aabsentdays+NAabsentdays+sals25+sals26+sals27+sals28+sals29+sals30;
	//document.getElementById("sals8").value=absentdays+NAabsentdays+sals25+sals26+sals27+sals28+sals29+sals30;
	var sals1 = parseFloat(document.getElementById("sals1").value);
	var sals8a = parseFloat(document.getElementById("sals8").value);
	document.getElementById("sals2").value=sals1-sals8a;
	
}*/

function side_menu_slide()
{
	$('#smenu_toogle').toggle("slow");
	$('#icon_side_to').toggle("fast");
	$('#icon_side_to').toggleClass("side_mm");
	$('#icon_side_to').toggleClass("fa-angle-double-left");
	$('#icon_side_to').toggleClass("fa-angle-double-right");

}

function myFunction()
{
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  if(document.getElementById("mytable"))
  {
  	 table = document.getElementById("mytable");
  }else{
  	 table = document.getElementById("myTable_new");
  }
 
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        tr[i+1].style.display = "";
      } else {
        tr[i].style.display = "none";
        tr[i+1].style.display = "none";
      }
    }
  }
}

function update_leave_bank(crlid,eid,ttype,val)
{
	if(val==1)
	{	
		var dx = 0;
		var dxl = 0;
		var maxI = document.getElementById('fetchData').value;
		maxI = maxI.split("--");
		for(i=0;i<maxI[1];i++)
		{
			if(document.getElementById('chBx'+i))
			{
				if(document.getElementById('chBx'+i).checked == true)
				{
					dx += ","+document.getElementById('chBx'+i).value;
					dxl += ","+document.getElementById('c_leave_val'+i).value;
				}
			}
		}
		$.post("management/leaverequest/bulk_forward_leaves_update.php",{dx:dx,dxl:dxl,type:val}, function(result){
			
			ToggleMenu('','8');
			getModule('management/leaverequest/bulk_forward_leaves','viewContent','manipulateContent','Bulk Forward Leaves');
		});	
	}else{
		if(ttype==3)
		{
			var cno = document.getElementById('checknumber_'+crlid).value;
			leaves_cashed=0;
		}else{
			var leaves_cashed = document.getElementById('leaves_cashed_'+crlid).value;
			cno=0;
			
		}
		
			$.post("management/leaverequest/bulk_forward_leaves_update.php",{crlid:crlid,eid:eid,ttype:ttype,type:val,cno:cno,leaves_cashed:leaves_cashed}, function(result){
				console.log(result);
				getModule('management/leaverequest/cash_leaves_req','viewContent','manipulateContent','Cash Leaves Requests');
			});	
		
		
	}
}

function update_withstat(crlid,eid,ttype,val)
{
	
	if(val==2)
	{	
			if(ttype==3)
				{
					var cno = document.getElementById('checknumber_'+crlid).value;
					var doj = document.getElementById('doj'+crlid).value;
					var ins = document.getElementById('ins'+crlid).value;
				}else{
					var cno=0;
					var doj=0;
					var ins=0;
					
				}
			$.post("management/salary/withdrwal_status_update.php",{crlid:crlid,eid:eid,ttype:ttype,type:val,cno:cno,doj:doj,ins:ins}, function(result){
				console.log(result);
				alert(result);
				getModule('management/salary/moodelview-cltb-r','viewContent','manipulateContent','Cash LTB Requests');
			});	
		
	}else{
		if(ttype==3)
		{
			var cno = document.getElementById('checknumber_'+crlid).value;
			
		}else{
			var cno=0;
			
			
		}
				
		
			$.post("management/salary/withdrwal_status_update.php",{crlid:crlid,eid:eid,ttype:ttype,type:val,cno:cno}, function(result){
				console.log(result);
				alert(result);
				getModule('management/salary/moodelview-cpf-r','viewContent','manipulateContent','Cash PF Requests');
			});	
		
		
	}
}