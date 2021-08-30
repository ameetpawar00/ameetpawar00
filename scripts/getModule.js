function getModule(url,responseid,hideid,value)
{
//alert(url);
 ToggleBox('loading','block','');
document.getElementById('forHash').value = '0';

var url1 = encode64(url);
var responseid1 = encode64(responseid);
var hideid1 = encode64(hideid);
var value1 = encode64(value);
var urlStage = url1+"$$**$$"+responseid1+"$$**$$"+hideid1+"$$**$$"+value1;

//var urlStage = url+"$$**$$"+responseid+"$$**$$"+hideid+"$$**$$"+value;
document.location.hash = urlStage;

var chkQ = url.indexOf('?')
if(chkQ == -1)
{
url = url+'.php';
}
else
{
url = url.replace("?",".php?");
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
  if(xmlhttp.readyState < 4)
  {
  	ToggleBox('loading','block','');
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  	
    //alert(xmlhttp.responseText);
			if(responseid== 'viewmoodleContent' || responseid== 'manipulatemoodleContent')
				{
				ToggleBox('bigMoodle','block','');
				ToggleBox('moodle','block','');
				
				}
						      		
	if(value != '')
	{
		document.title = value;
	}
	var Old = document.getElementById('t2').value;
	var title1 = document.getElementById('title1').value
	var newT = title1.replace(Old,value);
	document.getElementById('title1').value = newT;
	document.getElementById('t2').value = value;
	
	//var chKforNote = url.indexOf('noteline/index');
var chKforlc = url.indexOf('leavecalendar/view');
	if(chKforlc != -1)
   {
   
   
   }
   	
   	var chKforNote = url.indexOf('management/salary/story/view');
	if(chKforNote != -1)
   {
 //  putNotesRight();
//    putNotesLeft();
  // setTimeout("putNotesRight()",2000);
  // setTimeout("putNotesLeft()",2000);
  setTimeout("sroty_line()",1000);
  
  $('#moodle').css("background","#d2d2d2");
   }else{
	   $('#moodle').css("background","#fff");
   }
	
	if(responseid != '')
	{
			ToggleBox(responseid,'block',''); 
    document.getElementById(responseid).innerHTML=xmlhttp.responseText;
    forRange();
    
    
		var chkQll = url.indexOf('cl_leav_p')
		if(chkQll == -1)
		{	
			setTimeout("cl_l()",2000);
		}
		var chkQll = url.indexOf('cl_leav_c')
		if(chkQll == -1)
		{
			//setTimeout("cl_l()",1000);
			//setTimeout("cl_l()",1500);
			
		}
	
    }
    if(hideid != '')
    {
		ToggleBox(hideid,'none','');  
    }
	ToggleBox('loading','none','');  
	bindDiv();
	//$('#myTable_new').DataTable();
	settables();
  }
  }
   ToggleBox('loading','block','');
xmlhttp.open("GET",url,true);
xmlhttp.send();
 ToggleBox('loading','block','');
}
function cl_l()
    {
		$('#myTable_new').find('th:contains("Action")').trigger("click");
	}
		function axs()
		{
			var ij;
   			//$("#leav_cal_inp").trigger("click");
   			var calidx0cMhtml=$("#calenderidx0currentMonth").html();
   			var calidx0cYhtml=$("#calenderidx0currentYear").html();
   			var jardatahtml=$("#jardata").html();
   			var arrjar = JSON.parse(jardatahtml);
				//console.log(arrjar.length);
			$('.calc-table td').removeAttr("onclick");	
			$('.inputCal').hide();	
			$('.closeCalc').hide();	
				$('.ing').removeClass("ing");
   			for(ij=0;ij<=arrjar.length;ij++)
   			{
				var cdd=arrjar[ij][0];
				//var cdd="01-Dec-2016";
				var cce=arrjar[ij][1];
				cce='<span style="display:block">'+cce+'</span>';
				$('.calc-table td[title='+cdd+']').addClass("ing");
				$('.calc-table td[title='+cdd+']').append(cce);
				
				
			}
		}