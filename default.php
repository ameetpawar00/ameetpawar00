<?php
error_reporting(0);
include("include/conFig.php");
$getLogo = mysql_query("SELECT `logo`,`name` FROM  `companydetail` where `delete` = '0' order by `id` desc ",$con)or die(mysql_error());
$rowLogo = mysql_fetch_array($getLogo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script>

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//setInterval(function(){getCount()}, 10000);
function getCount()
{
	$.get("usernoti.php", function(result){
	var c=0;
		if($('#usernoti').css('display')=='block')
			{
				c=1;
			}
	document.getElementById('mynoti').innerHTML=result;
	if(c==1)
	{
		$('#usernoti').css('display','block');
	}else{
		$('#usernoti').css('display','none');
	}
	});
	$.get("getNotification.php", function(result){
	var inc,toinc=0;
	for(inc=1;inc<=5;inc++)
	{
		if(document.getElementById('noti'+inc))
		{
			var htt=$("#noti"+inc).html();
		}else{
				var htt=0;
			}
		var toincc=parseInt(htt);
		//console.log(toincc);
		toinc+=toincc;
	}
		var result=parseInt(result);

	document.getElementById('notify').innerHTML=result+toinc;
	var ddf=result+toinc;
	var cval=getCookie("cvaal");
	//cval=parseInt(cval);
	if(cval!=ddf && cval!=0)
	{
		setCookie("cvaal", ddf, 30);
		var cdsf=ddf-cval;
		if(cdsf>0)
		{
			cdsf="+"+cdsf;
		}
		$("#notifya").html(cdsf)
	}



	//alert(cdsf);
	});
	$.get("check_task.php", function(result){
	document.getElementById('taska').innerHTML=result;
	});
}
//setInterval(function(){getCount()}, 120000);
setInterval(function(){getCount()}, 120000);



function UpdateData(id)
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
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('update').innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","update.php?id="+id,true);
xmlhttp.send();
}
</script>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>.::Human Resource Management System::.</title>
<?php include('css.php')?>
</head>
<body onload="getCount();$('#head1').trigger('click');">
<?php
require_once "allhidden.php";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2">
<?php
	include ("header.php");
?>
<!--<div style="height:15px;background:#212121;padding:10px;width:100%;position:fixed">
<img src="images/hrm-logo.png" style="height:20px;" alt="" id="complogo"/>
<div style="float:right;margin-right:10px;color:#fff">

</div>
</div>-->
<a href="#" onclick="side_menu_slide()" class="dropdown-toggle side_mm" style="">
   <i id="icon_side_to" class="fa fa-angle-double-left side_mm" style="font-size: 3.5em;display:none;position: absolute;background: #364150;padding: 10px 10px 15px 0px;color: #fff;"></i>
</a>
</td>

</tr>
<tr onclick="$('.ddm_ha').hide();">
<td style="width:15%;background:#364150;height:1000px;" valign="top" id="smenu_toogle">
<?php
require_once "menu.php";
?>
</td>
<td style="width:85%" valign="top">
<div id="manipulateContent" style="padding:10px;margin-top:18px !important">
<?php //include("dash/index.php")?>
</div>
<div id="viewContent" style="padding:10px;margin-top:18px !important">
<br/><br/>
</div>
</td>
</tr>
</table>
<div id="tempSortdata" style="display:none"></div>
</body>
<?php
require_once "resources.php";
?>
<script>
	//	var ax=document.getElementById('ass$i').value; document.getElementById('total_amount_cal').innerHTML=ax;$('#pf_with_key').show();$('#total_ins_cal').html($i);
	function  ltb_check(years_completed,ins)
	{var firstins=0,thirdino=0,secondinss=0;
		var i,j,secondinst,totalltb=0,secondins=0,thirdins=0;
		for(i=1;i<=ins;i++)
		{
			
			for(j=1;j<=18;j++)
			{
				totalltb+=2000;
				
			}
		
		
			if(i==1)
				{
					firstins=totalltb/2;
					document.getElementById('ass'+i).value=firstins;
					
					document.getElementById('total_amount_cal').innerHTML=firstins;
					
					$("#pf_with_key").show();
				}
			if(i==2)
				{
					secondins=(totalltb-firstins)/2;
					secondinss=(totalltb-firstins)/2;
					var valfch=document.getElementById('valckp'+(i-1)).value;
					if(valfch==0)
					{
						secondins=secondins+firstins;
					}
					document.getElementById('ass'+i).value=secondins;
					document.getElementById('total_amount_cal').innerHTML=secondins;
					$("#pf_with_key").show();
					
					
				}
			if(i==3)
				{
					secondinst=(totalltb-firstins)/2;
					thirdins=(totalltb-secondinst);
					thirdino=(totalltb-secondinst);
					var valfch=document.getElementById('valckp'+(i-1)).value;
					if(valfch==0)
					{
						thirdins=thirdins+secondins;
					}
					document.getElementById('ass'+i).value=thirdins;
					document.getElementById('total_amount_cal').innerHTML=thirdins;
					$("#pf_with_key").show();
					
				}
				document.getElementById('total_amount_insv').innerHTML=thirdino+" + "+secondinss+" + "+firstins;
			document.getElementById('total_ins_cal').innerHTML=i;
		/*if(ins==2 || ins==3)
						{
							firstins=firstins/2;
						}
					if(ins==3)
						{
							firstins=firstins/2;
						}*/
		/*if(ins==2)
		{
			secondins=totalltb-firstins;
			secondins=secondins/2;
		}
		if(ins==3)
		{
			thirdins=totalltb-secondins;
			//secondins=secondins/2;
		}*/
		}
		//total_amount_cal	
		
		//document.getElementById('ass$i').value; =ax;$('#pf_with_key').show();$('#total_ins_cal').html($i);
			//alert(firstins+"--"+secondins+"--"+thirdins);
	}
	
	function findTotal(value)
	{
    	var arr = document.getElementsByClassName(value);
    	var tot=0;
   		 for(var i=0;i<arr.length;i++)
			{
       			if(parseFloat(arr[i].value))
	            tot += parseFloat(arr[i].value);
   			}
		$('.'+value+'tot').val(tot);
	}
	
	function date_reducechecker(val1,val2,val3,val4)
	{
		var aa=$(val1).val();
		var bb=$(val2).val();
		var date1 = new Date(aa);
		var date2 = new Date(bb);
		var timeDiff = date2.getTime() - date1.getTime();
		var diffDays = timeDiff / (1000 * 3600 * 24);
		if(diffDays<0){
			/*
			if(diffDays<-11){
				$(val1).val("");
				$(val2).val("");
				$(val3).val("");
				alert("Only 10 days earlier dates allowed");
			}*/
			if(diffDays <= -10){
//				$(val1).val("0000-00-00");
				$(val2).val(0);
				$(val3).val(0);
				$(val4).val(0);
				alert("Only 10 days earlier dates allowed");
			}
		}
		//alert(diffDays);
	}
	
	  $(window).load(function(){
		  setTimeout(function(){ var wht=$( window ).height();
	//alert(wht);
	$('#leftbar_tabs').height(wht-250); }, 1000);
	
	  });
	</script>
</html>