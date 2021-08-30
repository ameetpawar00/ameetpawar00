function firstInit(id)
{
var now = new Date();
now.setDate(now.getDate());
document.getElementById(id+'temp').value = now;
var x = document.getElementById(id+'temp').value;
x = x.split(" ");
var day = x[0];
var month = x[1];
var date = x[2];
var year = x[3];
document.getElementById(id+'currentMonth').value = month;
document.getElementById(id+'currentYear').value = year;
document.getElementById(id+'currentDate').value = date;
fillVoid(id);
}

var temp;
var toput;
var monthname=new Array(12);
monthname[0]="Jan";
monthname[1]="Feb";
monthname[2]="Mar";
monthname[3]="Apr";
monthname[4]="May";
monthname[5]="Jun";
monthname[6]="Jul";
monthname[7]="Aug";
monthname[8]="Sep";
monthname[9]="Oct";
monthname[10]="Nov";
monthname[11]="Dec";



function fillVoid(id)
{
var month = document.getElementById(id+'currentMonth').value;
var year = document.getElementById(id+'currentYear').value;
var date = document.getElementById(id+'currentDate').value;

var weekday=new Array(7);
weekday[0]="Sun";
weekday[1]="Mon";
weekday[2]="Tue";
weekday[3]="Wed";
weekday[4]="Thu";
weekday[5]="Fri";
weekday[6]="Sat";
var dateStr = month+" 01, "+year;
var date = new Date(dateStr);
firstday = date.getDay();
if(firstday == 0)
{
var diff = 6;
}
else
{
var diff = firstday-1;
}
week = weekday[date.getDay()];
var fulldate = week+' '+month+' 01 '+year+' 05:30:00 GMT+0530 (India Standard Time)';
var myDate = new Date(fulldate);
myDate.setDate(myDate.getDate() - diff);
firstDate = myDate;

//var toput = myDate.split(" ");

document.getElementById(id+'currentFirstDate').value = firstDate;
document.getElementById(id+'temp').value = firstDate;
toput = document.getElementById(id+'temp').value;
toput = toput.split(" ");
if(toput[1] == month)
{
document.getElementById(id+'d0').innerHTML = "<span style='color:#000;'>"+toput[2]+"</span>";
document.getElementById(id+'d0').title = toput[2]+"-"+toput[1]+"-"+toput[3];
}
else
{
document.getElementById(id+'d0').innerHTML = "<span style='color:#999;'>"+toput[2]+"</span>";
document.getElementById(id+'d0').title = toput[2]+"-"+toput[1]+"-"+toput[3];
}
var current = firstDate;
for(j=1;j<=41;j++)
{
temp = getNextDate(current);
document.getElementById(id+'temp').value = temp;
toput = document.getElementById(id+'temp').value;
toput = toput.split(" ");
if(toput[1] == month)
{
document.getElementById(id+'d'+j).innerHTML = "<span style='color:#000;'>"+toput[2]+"</span>";
document.getElementById(id+'d'+j).title = toput[2]+"-"+toput[1]+"-"+toput[3];
}
else
{
document.getElementById(id+'d'+j).innerHTML = "<span style='color:#999;'>"+toput[2]+"</span>";
document.getElementById(id+'d'+j).title = toput[2]+"-"+toput[1]+"-"+toput[3];
}
current = temp;
}

}


function getNextDate(current)
{
var myDate = new Date(current);
myDate.setDate(myDate.getDate() + 1);
return myDate; 
}


function previous(parameter,id)
{
	if(parameter == 'month')
	{
	var month = document.getElementById(id+'currentMonth').value;
	var year = document.getElementById(id+'currentYear').value;
	var monthdigit;
	for(i=0;i<=11;i++)
	{
	if(month == monthname[i])
	{
	monthdigit = i;
	}
	
	}
		if(monthdigit != 0)
		{
		monthdigit = monthdigit-1;
		}
		else
		{
		monthdigit = 11;
		year = parseInt(year);
		year = year-1;
		}
	}
	document.getElementById(id+'currentMonth').value = monthname[monthdigit];
	document.getElementById(id+'currentYear').value = year;
fillVoid(id);
}

function next(parameter,id)
{
	if(parameter == 'month')
	{
	var month = document.getElementById(id+'currentMonth').value;
	var year = document.getElementById(id+'currentYear').value;
	var monthdigit;
	for(i=0;i<=11;i++)
	{
	if(month == monthname[i])
	{
	monthdigit = i;
	}
	
	}
		if(monthdigit != 11)
		{
		monthdigit = monthdigit+1;
		}
		else
		{
		monthdigit = 0;
		year = parseInt(year);
		year = year+1;
		}
	}
	document.getElementById(id+'currentMonth').value = monthname[monthdigit];
	document.getElementById(id+'currentYear').value = year;
fillVoid(id);
}

function getMonth(newMonth,id)
{

document.getElementById(id+'currentMonth').value = newMonth;
fillVoid(id);
}

function getYear(newYear,id)
{

document.getElementById(id+'currentYear').value = newYear;
fillVoid(id);
}



function openCalender(id,ipid)
{
	var d = new Date();
	var current_year = d.getFullYear(); 
	var current_month = d.getMonth(); 
	var cal_auto_cal="";
	var i;
	for(i=1967;i<=2050;i++)
	{
		var sel='';
		if(current_year==i)
		{
			sel='selected';
		}
		cal_auto_cal+='<option value="'+i+'" '+sel+'>'+i+'</option>';
	}

	var months=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
	var ia;
	var month_auto_cal='';
	for(ia=0;ia<=11;ia++)
	{
		var sel='';
		var month=months[ia];
		var current_months=months[current_month];
		if(current_months==month)
		{
			sel='selected';
		}
		month_auto_cal+='<option value="'+month+'" '+sel+'>'+month+'</option>';
	}

document.getElementById(id).style.display = 'block';
var html = '<div style="" class="calinner" id="'+id+'cd">';
html = html+'<input name="Text1" type="text" id="'+id+'currentDate" style="display:none"  />'+
'<input name="Text1" type="text" id="'+id+'currentFirstDate" style="display:none"  />'+
'<input name="Text1" type="text" id="'+id+'temp" style="display:none"  />'+
'<table width="200px;" cellpadding="5" cellspacing="0" class="calc-table">'+
'<tr>'+
'<th align="left"><img src="images/left-arrow-black.png" alt="" onclick="previous(\'month\',\''+id+'\');axs()"/></th><th colspan="5">'+
'<select name="Select1" class="inputCal" onchange="getMonth(this.value,\''+id+'\')" style="width:55px">'+month_auto_cal+'</select>'+
'<select name="Select1" class="inputCal" onchange="getYear(this.value,\''+id+'\')" style="width:55px">'+cal_auto_cal+'</select>'+
'</th><th align="right"><img src="images/right-arrow-black.png" alt="" onclick="next(\'month\',\''+id+'\');axs()" /></th>'+
'</tr>'+
'<tr>'+
'<th colspan="7"><input readonly="readonly" name="Text1" type="text" id="'+id+'currentMonth" style="" class="inputHid" /> <input readonly="readonly"  class="inputHid" name="Text1" type="text" id="'+id+'currentYear" style="display:"  /></th>'+
'</tr>'+

'<tr>'+
'<th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th><th>S</th>'+
'</tr>'+
'<tr><td id="'+id+'d0"></td><td id="'+id+'d1"></td><td id="'+id+'d2"></td><td id="'+id+'d3"></td><td id="'+id+'d4"></td><td id="'+id+'d5"></td><td id="'+id+'d6"></td></tr>'+
'<tr><td id="'+id+'d7"></td><td id="'+id+'d8"></td><td id="'+id+'d9"></td><td id="'+id+'d10"></td><td id="'+id+'d11"></td><td id="'+id+'d12"></td><td id="'+id+'d13"></td></tr>'+
'<tr><td id="'+id+'d14"></td><td id="'+id+'d15"></td><td id="'+id+'d16"></td><td id="'+id+'d17"></td><td id="'+id+'d18"></td><td id="'+id+'d19"></td><td id="'+id+'d20"></td></tr>'+
'<tr><td id="'+id+'d21"></td><td id="'+id+'d22"></td><td id="'+id+'d23"></td><td id="'+id+'d24"></td><td id="'+id+'d25"></td><td id="'+id+'d26"></td><td id="'+id+'d27"></td></tr>'+
'<tr><td id="'+id+'d28"></td><td id="'+id+'d29"></td><td id="'+id+'d30"></td><td id="'+id+'d31"></td><td id="'+id+'d32"></td><td id="'+id+'d33"></td><td id="'+id+'d34"></td></tr>'+
'<tr><td id="'+id+'d35"></td><td id="'+id+'d36"></td><td id="'+id+'d37"></td><td id="'+id+'d38"></td><td id="'+id+'d39"></td><td id="'+id+'d40"></td><td id="'+id+'d41"></td></tr>'+
'<tr><td colspan="7" class="closeCalc" align="right" onclick="document.getElementById(\''+id+'\').style.display = \'none\';">[x]</td></tr>'+
'</table>'+
'</div>';
document.getElementById(id).innerHTML = html;
firstInit(id);
for(k=0;k<=41;k++)
{
document.getElementById(id+'d'+k).setAttribute("onclick", "getInputvalue(\'"+ipid+"\',\'"+id+"\',\'"+k+"\')");
}
}

function getInputvalue(ipid,id,k)
{
var temp = document.getElementById(id+'d'+k).title;
temp = temp.split("-");
var y = temp[2];
var mtext = temp[1];
for(i=0;i<=11;i++)
	{
	if(mtext == monthname[i])
	{
	monthdigit = i;
	}
	}
m = monthdigit+1;
var d = temp[0];
document.getElementById(ipid).value = y+"-"+m+"-"+d;
document.getElementById(id).style.display = 'none';

}
