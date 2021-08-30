<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


include("../../include/conFig.php");
$eid     = $_GET['eid'];
$getData = mysql_query("SELECT `id`, `mtype`, `desc`, `stype`, `createdate`, `modifieddate`,`status`, `extra`, `modifiedby`, `todate`, `duration`, `slab`, `entry`, `department`, `designation` FROM `emp_doc` WHERE `eid`='$eid' ORDER BY `id` DESC" ,$con) or die(mysql_error());
?>
<style>
	.disNaone{display: none;}
</style>

<div id="myTitle" style="padding-bottom:5px">
	<div class="title" style="display:inline-block">
		Documentation
	</div>
	<?php
	if (in_array('a_empe',$thisper))
	{
		?>
		<div style="float:right;display:inline-block" class="button blue" onclick="$('#addEx').slideToggle('fast')">
			<i class="plus">
			</i>Documents
		</div>
		<?php
	}
	?>


</div>

<div class="add-new gray_dark-border" id="addEx" style="display:none">
	<div class="form-head gray_dark">
		<div class="head-title">
			<i class="add-form">
			</i>
			Add Documents
		</div>
	</div>
	<table width="100%" cellpadding="10" cellspacing="0">
		<tr>
			<td colspan="2" style="text-align:center">
				<div style="display:inline-block;" id="couResp">
				</div>
			</td>
		</tr>

		<tr>
			<th>
				Type
				<span>
					*
				</span>
			</th>
			<td>
				<?php

				$formali_array = array(
					"Joining Formalities"=>array("Offer Letter","Employee Verified","Police Verified","Medically Certified","Appointment Letter"),
					"Exit Formalities"   =>array("Termination Letter","Abscond Letter","Relieving & Experience Letter"),
					"Others Formalities" =>array("Warning Letter","Memo","Promotion cum Increment Letter","Increment Letter","Department Transfer Letter","Re Designation Letter","Re Joining Letter")
				);
				$main_op="";
				$sub_op="";
				
				$main_counter=1;
				foreach($formali_array as $key=>$value)
				{
					$main_op.='<option value="ddx_'.$main_counter.'">'.$key.'</option>';
					$sub_counter=1;
					$sub_op.='<select class="input drop-down large subdrop" style="display:none"  id="ddx_'.$main_counter.'"  onchange="var trt=$(\'#ddx_0\').val();if((this.value==\'sub_3\' || this.value==\'sub_4\') && trt==\'ddx_3\'){$(\'.disNaone\').show();if(this.value==\'sub_4\'){$(\'.disNone\').hide();}}else{$(\'.disNaone\').hide();}">
						<option value="">Please Select One</option>';
					foreach($value as $values)
					{
						$sub_op.='<option value="sub_'.$sub_counter.'">'.$values.'</option>';
						$sub_counter++;
					}
					$sub_op.='</select>';
					$main_counter++;
				}

				?>
				<select class="input drop-down large" name="req" id="ddx_0" onchange="$('.subdrop').hide();$('.subdrop').val('');$('.subdrop').removeAttr('name');$('#'+this.value).show();$('#'+this.value).attr('name','req');">
					<option value="">
						Select Type
					</option>
					<?=$main_op?>
				</select>
				
			</td>
		</tr>
		<tr>
			<th>
				Sub Type
				<span>
					*
				</span>
			</th>
			<td>
			<?=$sub_op?>
			</td>
		</tr>
		<tr>
			<th>
				Description
			</th>
			<td>
				<textarea class="input huge" id="ddx_<?=$main_counter?>" name="req" style="width: 240px; height: 60px"></textarea>
			</td>
		</tr>
		<tr>
			<th>
				Effective From Date
			</th>
			<td>
				<input class="input medium inputCalendar" id="ddx_<?=$main_counter+1?>" name="req" readonly="readonly" onclick="openCalender('calenderid0','ddx_<?=$main_counter+1?>')">
	
			<div class="calender" id="calenderid0"></div>
			</td>
		</tr>
		<tr class="disNaone">
			<th>
				Effective Till Date
			</th>
			<td>
				<textarea id="ddx_<?=$main_counter+2?>" readonly="readonly" disabled rows="1" cols="10" style="margin: 0px; width: 166px; height: 23px;"></textarea>
				
			</td>
		</tr>
		<tr  class="disNaone">
			<th>
				Review Duration
			</th>
			<td><select  class="input drop-down large" id="ddx_<?=$main_counter+3?>" onchange="var tdate=$('#ddx_5').val();getModule('employee/documentation/date?date='+tdate+'&duration='+this.value,'ddx_6','','')">
					<option value="">Please Select Duration</option>
					<?php
					for($dueRe=1;$dueRe<=12;$dueRe++)
					{
						if($dueRe==1)
						{
							echo "<option value='$dueRe'>$dueRe Month</option>";
							
						}else{
							
							echo "<option value='$dueRe'>$dueRe Months</option>";
						}
					}
					?>
					
				</select>
				
			</td>
		</tr>
		<tr  class="disNaone">
			<th>
				Salary Slab
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+4?>" onclick="<?=$main_counter+4?>">
					<option value="">Please Select Salary Slab</option>
					<?php
						
						$getDataSalary = mysql_query("SELECT `id`, `salprofile` FROM `salary` WHERE `delete`='0'" ,$con) or die(mysql_error());
						$salpr="";
						while ($rowSalary = mysql_fetch_array($getDataSalary))
						{
							$sal_Id=$rowSalary["id"];
							$sal_Salprofile=$rowSalary["salprofile"];
							$salaryArray[$sal_Id]=$sal_Salprofile;
							$salpr.=<<<AAA
								<option value="$sal_Id">$sal_Salprofile</option>
AAA;
						
						}
						echo $salpr;
					?>
				</select>
			</td>
		</tr>
		<tr  class="disNaone disNone">
			<th>
				New Department
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+5?>" onclick="<?=$main_counter+5?>">
					<option value="">Please Select Designation</option>
					<?php
						
						$getDatades = mysql_query("SELECT `id`, `name` FROM `designation` WHERE `delete`='0'" ,$con) or die(mysql_error());
						$desipr="";
						while ($rowDes = mysql_fetch_array($getDatades))
						{
							$des_id=$rowDes["id"];
							$des_name=$rowDes["name"];
							$desigArray[$des_id]=$des_name;
							$desipr.=<<<AAA
								<option value="$des_id">$des_name</option>
AAA;
						//print_r($rowDes);
						}
						echo $desipr;
					?>
				</select>
			</td>
		</tr>
		<tr  class="disNaone disNone">
			<th>
				New Designation
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+6?>" onclick="<?=$main_counter+6?>">
					<option value="">Please Select Department</option>
					<?php
						
						$getDataDept = mysql_query("SELECT `id`, `name` FROM `department` WHERE `delete`='0'" ,$con) or die(mysql_error());
						$deppr="";
						while ($rowDept = mysql_fetch_array($getDataDept))
						{
							echo $dep_Id=$rowDept["id"];
							$dep_Name=$rowDept["name"];
							$deparArray[$dep_Id]=$dep_Name;
							$deppr.=<<<AAA
								<option value="$dep_Id">$dep_Name</option>
AAA;
						
						}
						
						echo $deppr;
					?>
				</select>
			</td>
		</tr>
		<tr  class="disNaone">
			<th>
				Type Of Entry
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+7?>" onclick="<?=$main_counter+7?>">
					<option value="">Please Select Type</option>
					<?php
						$depspr="";
						$extd=array("1"=>"Normal","2"=>"Extend");
						foreach ($extd as $kri=>$extdas)
						{
							
							$depspr.=<<<AAA
								<option value="$kri">$extdas</option>
AAA;
						
						}
						echo $depspr;
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td  style="text-align:left">
				<button class="button green" onclick="SaveData('employee/documentation/save?eid=<?php echo $eid?>','ddx_','<?=$main_counter+8?>','','','couResp','8')">
					<i class="save-icon">
					</i>Save
				</button>
				<button class="button gray" onclick="$('#addEx').slideToggle('fast')">
					<i class="close-icon">
					</i>Cancel
				</button>
			</td>
		</tr>
	</table>
</div>
<br/>
<?php

//	print_r($depArray);
	?>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
	<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
		<tr>
			<th>
				Type
			</th>
			<th>
				Sub Type
			</th>
			<th>
				Date
			</th>
			<th>
				Description
			</th>
			
			<th>
				Action
			</th>
		</tr>
		<?php
			//print_r($depArray);
		$i = 1;
		$allKeys = array_keys($formali_array);
			$allValues  = array_values($formali_array);
			$nhty="";
		while ($row = mysql_fetch_array($getData))
		{//print_r($row);
			$mtype = $row["mtype"];
			$stype = $row["stype"];
			
			
			
			$id=$row["id"];
			$desc=$row["desc"];
			$createdate=$row["createdate"];
			$modifieddate=$row["modifieddate"];
			$status=$row["status"];
			$extra=$row["extra"];
			$modifiedby=$row["modifiedby"];
//			$extra=$row["extra"];
			//print_r($mary);
			
			 $mtypea=$allKeys[$mtype-1];
			
			$stypea=$allValues[$mtype-1][$stype-1];
			//$type=$formali_array[$stype];
			//$mary[$mtypea]=array($id,$stypea,$desc,$createdate,$status,$extra);
			//$mary[$mtypea]=array($id,$stype,$desc,$createdate,$status,$extra);
			if($mtype==3 AND ($stype==3 OR $stype==4))
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
				$todasYdate=date("Y-n-d");
				$date1=date_create($todasYdate);
				$date2=date_create($todate);
				$difcf=date_diff($date1,$date2);
				
				$nhty.= <<<AAA
							<tr>
								<td style="color:#000;display: none">
									$mtypea $difcf
								</td>
								<td style="color:#000;text-align: center">
									$stypea
								</td>
								<td style="color:#000;text-align: center">
									$desc
								</td>
								<td style="color:#000;text-align: center">
									<span style="color: red;"><b>$salaryArray[$slab]</b></span><br><br>
									<span style="background: #fbff00;padding: 2px 25px;"><b>$duration $Months</b></span><br><br>
									<b>$extra <span  style="color: red;">TO</span> $todate</b>
								</td>
								<td style="color:#000;text-align: center">
									<span>Des: <b>$desigArray[$designation]</b></span><br>
									<span>Depa: <b>$deparArray[$department]</b></span>
								</td>
								<td style="color:#000;text-align: center">
									$extd[$entry]
								</td>
								<td style="color:#000;text-align: center">
								edit
								</td>
							</tr>
AAA;
			
			//	print_r($depArray);
				//print_r($desigArray);
			}else{
			
			
			?>


			<tr  class="d<?php echo $i % 2?>"  id="fetchrow<?php echo $i?>">
				<td style="color:#000;wisdth:120px">
					<?php echo $mtypea?>
				</td>
				<td style="color:#000;width:120px">
					<?php echo $stypea?>
				</td>
				<td style="color:#000;width:120px">
					<?php echo $extra?>
				</td>
				<td style="color:#000;width:120px">
					<?php echo $desc?>
				</td>
				<td style="color:#000;width:180px">
					<button class="button green" >
					<i class="fa fa-check "></i> Yes
				</button>
				</td>
			</tr>
			<?php
				$i++;
			}
			
			//$Maxid = $row['id'];
			//$MaxI  = $i;
		}//print_r($mary);
		
	?>
	</table>
	<br>
	<br>
	<br>
	<br>
		<table width="100%" cellpadding="5" cellspacing="0"  border="1" class="fetch" id="">
			<tr>
				<th style="display: none">
					Type
				</th>
				<th>
					Sub Type
				</th>
				<th>
					Description
				</th>
				<th>
					Slab, Duration,	Dates
				</th>
				<th>
					Department &
					Designation
				</th>
				<th>
					Entry Type
				</th>
				<th>
					Action
				</th>
			</tr>
		<?php
			echo $nhty;
			//print_r($depArray);
		?>
		<!--<input class="input medium" id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />-->
	</table>

</div>




?>