function suggestList(id,dataprovider,output,inputid,cookiename)
{
	var suggestOrg = document.getElementById(dataprovider).innerHTML;
if(cookiename != "")
{
var cookieName = getCookie(cookiename);
cookieName = cookieName.split('ACNTCOOKIE');
cookieName = cookieName[1]+'**'+cookieName[0];
suggestOrg = suggestOrg.replace(cookieName,"");
}

	var value = document.getElementById(inputid).value;
	value = value.toLowerCase();
	if(value == '')
	{
	if(document.getElementById(id+'suggest'))
		{
			document.getElementById(id+'suggest').innerHTML ='';
		}
	}
	else
	{
	suggestOrg = suggestOrg.split(",");
	var html='';
	var temp;
	var flag;
		var fromSearch;

	var t=0;
		for(j=0;j<suggestOrg.length;j++)
		{ 
			temp = suggestOrg[j].split('**');
			fromSearch = temp[0].toLowerCase();
			if(suggestOrg[j] != '')
			{
			flag = fromSearch.indexOf(value);
			if(flag != -1)
			{
			
				html+= '<tr id="'+id+t+'" class="unselectedName"><td><input onclick="directSelect(\''+id+'\',\''+t+'\',\''+output+'\',\''+inputid+'\')" readonly="readonly" onkeyup="directKeycode(event,\''+id+'\',\''+t+'\',\''+dataprovider+'\',\''+output+'\',\''+inputid+'\');" value="'+temp[0]+'" type="text" id="inp'+id+t+'" class="hideInput"/>'+
				'<input style="display:none" value="'+temp[1]+'" type="text" id="out'+id+t+'"/>'+
				'</td></tr>';
				t++;
			}
		}
	}
	html = '<table id="'+id+'table" class="fetch-auto" cellpadding="0" cellspacing="0">'+html+'</table>';


	if(document.getElementById(id+'suggest'))
	{
		document.getElementById(id+'suggest').innerHTML = html;
	}
	else
	{
		html = '<div id="'+id+'suggest" class="suggest">'+html+'</div>';
		document.getElementById(id).insertAdjacentHTML('beforeEnd',html); 
	}

	document.getElementById(id+'suggest').style.display='block';	

	}
}

function directKeycode(e,id,start,dataprovider,output,inputid,cookiename)
{
	if(e.keyCode == 13)
	{
		document.getElementById(id+'suggest').style.display='none';	
		document.getElementById(inputid).focus();

	}
	else if(e.keyCode == 40)
	{
		callDown(id,start,output,inputid);
	}
	else if(e.keyCode == 38)
	{
		callUp(id,start,output,inputid);
	}
	else
	{
		suggestList(id,dataprovider,output,inputid,cookiename)
	}
}

function callDown(id,from,output,inputid)
{
var table = document.getElementById(id+'table');
var rowCount = table.rows.length;
rowCount = parseInt(rowCount);


	if(from == 'up')
	{
		document.getElementById(id+'0').className = 'selectedName';
		document.getElementById('inp'+id+'0').focus();
		document.getElementById(inputid).value = document.getElementById('inp'+id+'0').value;
		document.getElementById(output).value = document.getElementById('out'+id+'0').value;
	}
	else
	{
	if(from == (rowCount-1))
	{
	from = -1;
	}
	var j = parseInt(from)+1;
	for(k=0;k<rowCount;k++)
	{
		if(k != j)
		{
			document.getElementById(id+k).className = 'unselectedName';
		}
	}

		document.getElementById(id+j).className = 'selectedName';
		document.getElementById('inp'+id+j).focus();
		document.getElementById(inputid).value = document.getElementById('inp'+id+j).value;
		document.getElementById(output).value = document.getElementById('out'+id+j).value;	
	}
}

function callUp(id,from,output,inputid)
{
var table = document.getElementById(id+'table');
var rowCount = table.rows.length;
rowCount = parseInt(rowCount);


	if(from == 'up')
	{
		document.getElementById(id+'0').className = 'selectedName';
		document.getElementById('inp'+id+'0').focus();
		document.getElementById(inputid).value = document.getElementById('inp'+id+'0').value;
		document.getElementById(output).value = document.getElementById('out'+id+'0').value;
	}
	else
	{
	if(from == 0)
	{
	from = rowCount;
	}

	var j = parseInt(from)-1;
	for(k=0;k<rowCount;k++)
	{
		if(k != j)
		{
			document.getElementById(id+k).className = 'unselectedName';
		}
	}
		document.getElementById(id+j).className = 'selectedName';
		document.getElementById('inp'+id+j).focus();
		document.getElementById(inputid).value = document.getElementById('inp'+id+j).value;
		document.getElementById(output).value = document.getElementById('out'+id+j).value;	
	}
}

function directSelect(id,from,output,inputid)
{
var table = document.getElementById(id+'table');
var rowCount = table.rows.length;

var j = parseInt(from);
	for(k=0;k<rowCount;k++)
	{
		if(k != j)
		{
			document.getElementById(id+k).className = 'unselectedName';
		}
	}
		document.getElementById(id+j).className = 'selectedName';
		
		document.getElementById(inputid).value = document.getElementById('inp'+id+j).value;
		document.getElementById(output).value = document.getElementById('out'+id+j).value;	
		document.getElementById(id+'suggest').style.display = 'none';
		document.getElementById(inputid).focus();

}
