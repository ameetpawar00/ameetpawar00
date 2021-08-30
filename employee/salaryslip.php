<?php
	include("../include/conFig.php");
	
	$sqal = "SELECT `saldistyp` FROM `employee` WHERE `id` = '$hrmloggedid'";
	
	$getDatasa = mysql_query($sqal,$con) or die(mysql_error());
	
	$rowgetDatasa=mysql_fetch_array($getDatasa);
	$salviewdetails=$rowgetDatasa[0];
	$seldec="";
	if($salviewdetails==0)
	{
	
	}else if($salviewdetails==1 OR $salviewdetails==2)
	{
		$seldec="`employee` = '$hrmloggedid'";
	}else  if($salviewdetails==3)
	{
		$seldec="`employee` = 'xscddsa'";
	}else{
	
	}
	
	
	$sql = "SELECT `id`,`month`,`total_salary`,`employee`,`year` from `salaryslip_new` where `delete` = '0' and $seldec";
	$getData = mysql_query($sql,$con) or die(mysql_error());
	$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'employee/salaryslip';
	$title = 'salaryslip';
	if($salviewdetails==2)
	{
		$dlimit=" 1";
		
	}else{
		$dlimit=" $Page_Start , $Per_Page";
	}
	
	//$getData = mysql_query("SELECT `id`,`month`,`total`,`employee` from `salaryslip` where `delete` = '0' and `employee` = '$hrmloggedid' order by `month` ",$con) or die(mysql_error());
?>
	<div class="title">Salary For Employee <span style="display:inline-block"><?php echo $hrmloggeduser?></span></div>
	
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td style="width:30%"></td>
			<td style="width:70%" align="right">
				
				<!--<h2 class="title">Salary For Employee <span style="display:inline-block"><?php echo $hrmloggeduser?></span>-->
				<div class="" style="display:inline-block;display:none">Select Month <select class="input drop-down" name="Select1" id="month" onchange="getModule('management/salary/view?month='+document.getElementById('month').value,'viewContent','manipulateContent','Manage Salary')" >
						<option <?php if($mnth == '01' ) {echo 'selected=selected';}?>  value="1">January</option>
						<option <?php if($mnth == '02' ) {echo 'selected=selected';}?> value="2">February</option>
						<option <?php if($mnth == '03' ) {echo 'selected=selected';}?> value="3">March</option>
						<option <?php if($mnth == '04' ) {echo 'selected=selected';}?> value="4">April</option>
						<option <?php if($mnth == '05' ) {echo 'selected=selected';}?> value="5">May</option>
						<option <?php if($mnth == '06' ) {echo 'selected=selected';}?> value="6">June</option>
						<option <?php if($mnth == '07' ) {echo 'selected=selected';}?> value="7">July</option>
						<option <?php if($mnth == '08' ) {echo 'selected=selected';}?> value="8">August</option>
						<option <?php if($mnth == '09' ) {echo 'selected=selected';}?> value="9">September</option>
						<option <?php if($mnth == '10' ) {echo 'selected=selected';}?> value="10">October</option>
						<option <?php if($mnth == '11' ) {echo 'selected=selected';}?> value="11">November</option>
						<option <?php if($mnth == '12' ) {echo 'selected=selected';}?> value="12">December</option>
					</select></div>
			
			</td>
		</tr>
	</table>
	
	<div style="height:350px;overflow-y:auto" id="mainDivId">
		<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
			<tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
				<th >Year</th>
				<th >Month</th>
				<th >Salary</th>
				<th >Remark</th>
				<th >Print</th>
			</tr>
			<?php
				if(in_array('v_salary',$thisper))
				{
					$i = 1;
					
					$sql .=" order by `id` DESC LIMIT$dlimit";
					//echo $sql;
					$values = mysql_query($sql,$con)or die(mysql_error());
					while($row =mysql_fetch_array($values))
					{
						$eid = $row[0];
						?>
						<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
							<td ><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
							<td ><?php echo $row[4] ?></td>
							<td ><?php echo date("F", mktime(0, 0, 0,  $row[1], 10)); ?></td>
							<td ><?php echo $row[2] ?></td>
							<?php /*if(in_array('p_salary',$thisper))
{*/
							?>
							
							<td>
								<?php
									
									
									$chkSald = mysql_query("SELECT `id`, `description` FROM `salary_description` WHERE `sal_id` = '$row[0]' AND `employeeid` = '$row[3]' AND `status` = '0'",$con) or die(mysql_error());
									if(mysql_num_rows($chkSald) > 0)
									{
										$rowSlipd = mysql_fetch_array($chkSald);
										$did=$rowSlipd['id'];
										$ddescription=$rowSlipd['description'];
										
										
										
										
										echo "<h3>$ddescription</h3>";
										
										
									}else{
									
									}
								
								
								
								
								
								
								
								
								?>
							
							</td>
							<td >
								<a href="employee/salarySlipview.php?id=<?php echo base64Custom($row[0]);?>&employee=<?php echo base64Custom($row[3]);?>&month=<?php echo base64Custom($row[1]);?>&year=<?php echo base64Custom($row[4]);?>" target="_blank">Print</a>
							</td>
							<?php
								/*}*/
							?>
						
						</tr>
						<?php
						
						$i++;
						$Maxid = $row[0];
						$MaxI = $i;
					}
				}
			?>
			
			<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		</table>
	</div>
<?php
	include('../pagination/pages.php');
?>