<script type="text/javascript" src="scripts/jquery-1.7.2.min.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/autoCheck.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/base64.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/calScript.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/changedrp.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/changeStatus.js?"></script>
<script type="text/javascript" src="scripts/changeStatusnew.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/delete.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/deletesingle.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/fetchMore.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/getModule.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/hashModule.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/misc.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/saveData.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/approve.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/trifid.js?<?=$revar;?>"></script>
<script type="text/javascript" src="scripts/jquery.dataTables.min.js?<?=$revar;?>"></script>
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
getOnrefresh();
//getModule('masters/department/index','manipulateContent','viewContent','Human Resources Mangment Sysytem')
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


</script>
<script src="scripts/calendar.js?<?=$revar;?>"></script>
<script src="scripts/autosugges.js?<?=$revar;?>"></script>
<script src="scripts/editdynamic.js?<?=$revar;?>"></script>
<script>
    function settables() {
        var idaaaa="myTable_new";
        var orderInd=1;
        var searchCheck=true;
        var paginationCheck=true;
        if($('.dataTable').hasClass("kpiCheck"))
        {
            orderInd=0;
            idaaaa="myTable_newa";
            searchCheck=false;
            paginationCheck=false;

        }else{
            orderInd=1;
            idaaaa="myTable_new";
            searchCheck=true;
        }

        // Setup - add a text input to each footer cell
        $('#myTable_new tfoot th').each( function () {
            var title = $(this).text();
            var hkni=$(this).html();
            if(hkni!="")
            {

                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            }
        } );

        // DataTable
        var table = $('#'+idaaaa).DataTable({
            "order": [[ orderInd, "asc" ]],
            "paging": paginationCheck,
            "searching": searchCheck
        });

        if(searchCheck)
        {
            // Apply the search
            table.columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on('keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                });
            });
        }
    }
</script>