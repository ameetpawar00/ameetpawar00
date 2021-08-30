<?php
	include("../include/conFig.php");
	
	
	$getDatawe = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE 1" ,$con) or die(mysql_error());
	while($rowsalary=mysql_fetch_assoc($getDatawe))
	{
		$id=$rowsalary["id"];
		$name=$rowsalary["profileName"];
		$allSalary[$id]=$name;
	}
	
	$getDataesdd = mysql_query("SELECT `id`, `name` FROM `designation` WHERE 1" ,$con) or die(mysql_error());
	while($rowDesignationt=mysql_fetch_assoc($getDataesdd))
	{
		$id=$rowDesignationt["id"];
		$name=$rowDesignationt["name"];
		$allDesignationt[$id]=$name;
	}
	//print_r($allSalary);
	
	$rytyt=rtrim(display_children($hrmloggedid,0),",");
	function display_children($hrmloggedid,$level) {
		$result = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
		$abcdd="";
		while ($row = mysql_fetch_array($result)) {
			$id=$row["id"];
			//	$name=$row["name"];
			$designation=$row["designation"];
			//$abcdd.="$name--$id,";
			$abcdd.="$id,";
			$abcdd.=display_children($id,$level+1);
		}
		return $abcdd;
	}
	$SQLVALS=" AND employee.empstatus = 2";
	
	if($rytyt!="")
	{
		$SQLVALS="  AND employee.empstatus = 2 AND `emp_doc`.`eid` IN($rytyt)";
	}
	
	
	//echo "SELECT `emp_doc`.`id`,`employee`.`name`,`emp_doc`.`eid`, `emp_doc`.`mtype`, `emp_doc`.`desc`, `emp_doc`.`stype`, `emp_doc`.`createdate`, `emp_doc`.`modifieddate`,`emp_doc`.`status`, `emp_doc`.`extra`, `emp_doc`.`modifiedby`, `emp_doc`.`todate`, `emp_doc`.`duration`, `emp_doc`.`slab`, `emp_doc`.`entry`, `emp_doc`.`department`, `emp_doc`.`designation` FROM `emp_doc`,`employee` WHERE `emp_doc`.`delete`='0' AND `employee`.`delete`='0' AND  $SQLVALS ORDER BY `employee`.`name` ASC";
	$todasYdateYear=date("Y");
	$todasYdateMonth=date("n");

	if(isset($_REQUEST["year"]))
    {
        $todasYdateYear=$_REQUEST["year"];
        $todasYdateMonth=$_REQUEST["month"];
    }

	//$query = "SELECT `emp_doc`.`id`,`employee`.`name`,`employee`.`salaryId`,`employee`.`designation` as `empdesignation`,`emp_doc`.`eid`, `emp_doc`.`mtype`, `emp_doc`.`desc`, `emp_doc`.`stype`, `emp_doc`.`createdate`, `emp_doc`.`modifieddate`,`emp_doc`.`status`, `emp_doc`.`extra`, `emp_doc`.`modifiedby`, `emp_doc`.`todate`, `emp_doc`.`duration`, `emp_doc`.`slab`, `emp_doc`.`entry`, `emp_doc`.`department`, `emp_doc`.`designation` FROM `emp_doc`,`employee` WHERE `emp_doc`.`delete`='0' AND YEAR(`emp_doc`.`todate`)='$todasYdateYear' AND MONTH(`emp_doc`.`todate`)='$todasYdateMonth' AND `employee`.`delete`='0' AND `employee`.`id`=`emp_doc`.`eid` $SQLVALS ORDER BY `employee`.`name` ASC";
	
	
	$query = "SELECT    `emp_doc`.`id`,`employee`.`name`,`employee`.`salaryIdNew`,`employee`.`designation` as `empdesignation`,`emp_doc`.`eid`, `emp_doc`.`mtype`, `emp_doc`.`desc`, `emp_doc`.`stype`, `emp_doc`.`createdate`, `emp_doc`.`modifieddate`,`emp_doc`.`status`, `emp_doc`.`extra`, `emp_doc`.`modifiedby`, `emp_doc`.`todate`, `emp_doc`.`duration`, `emp_doc`.`slab`, `emp_doc`.`entry`, `emp_doc`.`department`, `emp_doc`.`designation`
FROM      employee
JOIN      (
              SELECT    MAX(id) max_id, eid
              FROM      emp_doc
              WHERE mtype=3 AND stype IN(3,4,5,6,7,8)
              GROUP BY  eid
          ) c_max ON (c_max.eid = employee.id)
JOIN      emp_doc ON (emp_doc.id = c_max.max_id) WHERE `emp_doc`.`delete`='0' AND YEAR(`emp_doc`.`todate`)='$todasYdateYear' AND MONTH(`emp_doc`.`todate`)='$todasYdateMonth' AND `employee`.`delete`='0' AND `employee`.`id`=`emp_doc`.`eid` $SQLVALS ORDER BY `employee`.`name` ASC";
	
	
	
	
	
	
	
	
	
	
	
	$getData = mysql_query($query,$con) or die(mysql_error());
	
	
	function validateDate($date, $format = 'Y-n-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
		return $d && $d->format($format) === $date;
	}
?>
<br/>
<div style="height:500px;overflow-x:hidden;overflow-y:scroll" id="">
	<?php
		$i = 1;
		
		
		$nhty="";
		$cnrit=0;
		while ($row = mysql_fetch_array($getData))
		{
			
			$eid = $row["eid"];
			$employeeName = $row["name"];
			$mtype = $row["mtype"];
			$stype = $row["stype"];
			$empsalary = $row["salaryIdNew"];
			$empdesignation = $row["empdesignation"];
			$id=$row["id"];
			$desc=$row["desc"];
			$createdate=$row["createdate"];
			$modifieddate=$row["modifieddate"];
			$status=$row["status"];
			$extra=$row["extra"];
			$modifiedby=$row["modifiedby"];
			
			if($mtype==3 AND ($stype==3 OR $stype==4 OR $stype==5 OR $stype==6 OR $stype==7 OR $stype==8 OR $stype==9))
			{
				$todate=$row["todate"];
				$duration=$row["duration"];
				$slab=$row["slab"];
				$entry=$row["entry"];
				$department=$row["department"];
				$designation=$row["designation"];
				$Months="Months";
				if($duration==1){
					$Months="Month";
				}
				$diff=0;
				$rc_Id="";
				if($todate)
				{
					if(validateDate($todate, $format = 'Y-n-d'))
					{
						$todasYdate=date("Y-n-d");
						$date1=date_create($todasYdate);
						$date2=date_create($todate);
						$diff=date_diff($date1,$date2);
						$dirtek= $diff->format("%R%a days");
						if($dirtek<=0)
						{
							$rc_Id="style='background-color:#e7505a;color:#fff;font-weight: bold;'";
							$rc_Id="style='font-weight: bold;'";
						}elseif($dirtek<10)
						{
							$rc_Id="style='background-color:#c49f47;color:#fff;font-weight: bold;'";
							$rc_Id="style='font-weight: bold;'";
						}else{
							$rc_Id="style='font-weight: bold;'";
						}
					}
				}
				$nhty.= <<<AAA
<tr $rc_Id>
<td style="color:#000;text-align: center" class="sorting_1">
<span  >
$employeeName				</span>
<small>
</td>
<td style="text-align: center">


Designation : $allDesignationt[$empdesignation]
 <br>
 <br>
Slab : $allSalary[$empsalary]

</td>
<td style="text-align: center">
<b>$extra - $todate  (Renew Date) || $dirtek</b>
</td>
</tr>
AAA;
				$cnrit++;
			}
		}
	?>
	<div id="myTitle">
		<div class="title">Pending Increment Details</div>
		<div class="strip">
			<span>Dashboard</span>
			<span>Pending Increment</span>
			<span>View</span>

		<div class="strip" style="float: right;padding: 0;margin: 0;    margin-top: -5px;">
            <select name="month" id="monthSel" class="input">
                <?php
                 //   echo "<br>$todasYdateMonth";
                    $dgfMon=array("1"=>"Jan","2"=>"Feb","3"=>"Mar","4"=>"Apr","5"=>"May","6"=>"Jun","7"=>"Jul","8"=>"Aug","9"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec");
                    foreach($dgfMon as $dgfMonKey=>$dgfMonVal)
                    {
                        $selYr='';
                        if($todasYdateMonth==$dgfMonKey)
                        {
                            $selYr="selected='selected'";
                        }
                        echo "<option value='".$dgfMonKey."' $selYr>$dgfMonVal</option>";
                    }
                ?>
            </select>



            <select name="year" id="yearSel" class="input" >
                <?php
                for($dgf=2018;$dgf<=DATE("Y");$dgf++)
                {
                    $selYear='';
                    if($todasYdateYear==$dgf)
                    {
                        $selYear="selected='selected'";
                    }
                    echo "<option value='".$dgf."' $selYear>$dgf</option>";
                }
                ?>
            </select>
            <input type="button" class="button green" onclick="var month =$('#monthSel').val(); var year =$('#yearSel').val(); getModule('dash/incrementData?year='+year+'&month='+month,'viewContent','manipulateContent','Pending Increments');" value="Fetch">
		</div>
		</div>
	</div>
	<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
		<tr>
			
			<td style="width:30%"></td>
			<td style="width:70%" align="right">
				
				&nbsp;<button class="button gray" onclick="getModule('dash/index','manipulateContent','viewContent','Setup');">
					<i class="back"></i>Back</button>
			</td>
		</tr>
	</table>
	<div style="height:550px;overflow:auto" id="mainDivId">
		
		
		
		<table width="100%" cellpadding="5" cellspacing="0"  border="1" class="fetch" id="">
			<caption style="font-size: 18px;padding-bottom: 5px;font-weight: bold;">Increment Details (<?=$todasYdateMonth.",".$todasYdateYear?>)</caption>
			<tr style="background-color: #2b3643">
				<th>
					Employee
				</th>
				<th>
					Designation & Slab
				</th>
				<th>
					Remaining Days
				</th>
			</tr>
			<?php
				echo $nhty;
			?>
		</table>
	
	</div>
</div>
