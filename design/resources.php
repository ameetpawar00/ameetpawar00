<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/autoCheck.js"></script>
<script type="text/javascript" src="scripts/base64.js"></script>
<script type="text/javascript" src="scripts/calScript.js"></script>
<script type="text/javascript" src="scripts/changedrp.js"></script>
<script type="text/javascript" src="scripts/changeStatus.js"></script>
<script type="text/javascript" src="scripts/delete.js"></script>
<script type="text/javascript" src="scripts/deletesingle.js"></script>
<script type="text/javascript" src="scripts/fetchMore.js"></script>
<script type="text/javascript" src="scripts/getModule.js"></script>
<script type="text/javascript" src="scripts/hashModule.js"></script>
<script type="text/javascript" src="scripts/misc.js"></script>
<script type="text/javascript" src="scripts/saveData.js"></script>
<script type="text/javascript" src="scripts/approve.js"></script>
<script>
function getOnrefresh()
{
var hash = document.location.hash;
//	var hash = document.getElementById('forHashVal').value;
	if(hash != '')
	{

		hash = hash.split('$$**$$');

	 hash[0]= decode64(hash[0]);
		hash[0] = hash[0].replace("#","");
		hash[1]= decode64(hash[1]);
		hash[2]= decode64(hash[2]);
		hash[3]= decode64(hash[3]);

			if(hash[1] == 'directResult')
			{
			hash[1] = 'viewContent';
			}
			if(hash[1] != 'manipulatemoodleContent' && hash[1] != 'viewmoodleContent')
			{
				ToggleBox('bigMoodle','none','');
			}
	hashModule(hash[0],hash[1],hash[2],hash[3]);
	}
}
//getOnrefresh();
getModule('masters/department/view','manipulateContent','viewContent','Human Resources Mangment Sysytem')
</script>
<script>


function locationHashChanged() {
	var forHash = document.getElementById('forHash').value;
	if(forHash == '0')
	{
	document.getElementById('forHash').value = '1';
	}
	else
	{
	getOnrefresh();
	}
}

window.onhashchange = locationHashChanged;

titleInterval = setInterval("document.getElementById('t1').innerHTML = '0'",15000000);

</script>
<div class="loading" id="loading">
<img src="img/loading.gif" style="vertical-align:middle;padding-top:200px" alt=""/>
</div>
<script src="scripts/calScript.js"></script>
<script src="scripts/editdynamic.js"></script>
