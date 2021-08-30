<?php
include("../include/conFig.php");
if((in_array('v_salary',$thisper)) OR (in_array('v_MSalary',$thisper)))
{
	$salId = base64CustomDe($_GET['id']);
	$tableName="salaryslip_new";
	if(isset($_GET['old']))
    {
        $tableName="salaryslip";

    }

$getSalary = mysql_query("SELECT `$tableName`.*,`employee`.`name` FROM  `$tableName`,`employee` where `$tableName`.`id` = '$salId' AND `employee`.`id`=`$tableName`.`employee`",$con) or die(mysql_error());
$rowSal = mysql_fetch_array($getSalary);
$month=$rowSal['month'];
$year=$rowSal['year'];
$ename=$rowSal['name'];
$slip=$rowSal['slip'];
		$employee=$rowSal['employee'];

		if(($hrmloggedid == '86' OR $hrmloggedid == '93' OR  (in_array('v_MSalary',$thisper))) OR $hrmloggedid==$employee)
		{
            if(isset($_GET['exceldown']))
            {
                $slip=str_replace('<img src="../../images/logo.png" alt="" style="margin: 0px;" width="150">','',$slip);
                $name = "Excel_Salary_Download_For_".$ename."_".$salId."_month_".$month."_year_".$year.".xls";
                header("Content-Disposition: attachment; filename=\"$name\"");
                header("Content-Type: application/vnd.ms-excel");
            }
?>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 10;  /* this affects the margin in the printer settings */
	
	}
input{display:none}
</style>
<div style="background:#fff;height:100%;color:#000 !important;" id="mySalslip">
<?php
					if($hrmloggedid == '86' OR $hrmloggedid == '93')
{
?>
<div>

<input type="submit" value="Download Salary Slip" name="submit" style="background: #7BB700;border: 0px;text-align: center;padding: 3px 10px;color: #fff;font-size: 13px;cursor: pointer;" onclick="myFunction()">


</div>
<?php
}
?>
<?php echo $slip;
if(!in_array('p_salary',$thisper)){ 
?>
<span id="watermark" style="position: fixed;top: 50%;left: 25%;font-size: 5em;font-weight: 800;opacity: 0.2;"> FOR INTERNAL USES ONLY
</span>
<?php } ?>
</div>
<?php if(in_array('p_salary',$thisper)){ ?>
<script>
function myFunction() {
    window.print();
}
myFunction();
</script>
<?php 
}
		
		}else{
			echo $tyr=<<<AAA
<span id="watermark" style="position: fixed;top: 50%;left: 25%;font-size: 5em;font-weight: 800;opacity: 0.2;"> Not Authorised !!
</span>
AAA;

		}
}else{
		echo $tyr=<<<AAA
<span id="watermark" style="position: fixed;top: 50%;left: 25%;font-size: 5em;font-weight: 800;opacity: 0.2;"> Not Authorised !!
</span>
AAA;
} 
 ?>