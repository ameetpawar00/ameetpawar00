function allotto(page)
{
if(document.getElementById('chkCheckBox').value != '')
{
var dx=0;
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
for(i=0;i<maxI[1];i++)
{
	if(document.getElementById('chBx'+i))
	{
		if(document.getElementById('chBx'+i).checked == true)
		{
			dx += ","+document.getElementById('chBx'+i).value;
		}
	}
} 
if(page == "")
{
getModule('unalloted/viewAllot?ids='+dx,'viewmoodleContent','manipulatemoodleContent','');
}
else
{
getModule(page+'&ids='+dx,'viewmoodleContent','manipulatemoodleContent','');
}
} 
else
 {
 alert('Please Select Data First ');
 }
}
