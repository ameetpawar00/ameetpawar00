<?php
	include("../../include/conFig.php");
	include("dRay.php");
	$eid     = $_GET['eid'];
	$getData = mysql_query("SELECT * FROM `employee` WHERE `id` = '$eid'",$con) or die(mysql_error());
	$row = mysql_fetch_array($getData);
	$depart     = $row['department'];
	$desig     = $row['designation'];
	

	$getData = mysql_query("SELECT `id`, `mtype`, `desc`, `stype`, `createdate`, `modifieddate`,`status`, `extra`, `modifiedby`, `todate`, `duration`, `slab`, `entry`, `department`, `designation` FROM `emp_doc` WHERE `eid`='$eid' AND `delete`='0' ORDER BY `id` DESC" ,$con) or die(mysql_error());
?>
<style>
	/*.disNaone{display: none;}*/
</style>
<div id="myTitle" style="padding-bottom:5px">
	<div class="title" style="display:inline-block">
		Documentation
	</div>
	<?php
		
		if (in_array('a_empdd',$thisper))
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
<?php
	$tryt="display:none";
	
	$mtype_Edit="";
	$stype_Edit="";
	$desc_Edit="";
	$extra_Edit="";
	$todate_Edit="";
	$duration_Edit="";
	$slab_Edit="";
	$entry_Edit="";
	$department_Edit="";
	$designation_Edit="";
	$disnoneRa="display:none";
	$disnoneRa2="";
	$editthk="";
	$mainTitle="Add";
	if(isset($_REQUEST["edit"]))
	{
		$mainTitle="Edit";
		$eid=$_REQUEST["eid"];
		$entid=$_REQUEST["entid"];
		$editthk="&editthk=".$entid;
		$tryt="";
		//echo "SELECT `id`, `eid`, `mtype`, `stype`, `desc`, `status`, `createdate`, `modifieddate`, `modifiedby`, `extra`, `todate`, `duration`, `slab`, `entry`, `department`, `designation` FROM `emp_doc` WHERE `eid`='$eid' AND `id`='$entid'";
		$getDatsa = mysql_query("SELECT `mtype`, `stype`, `desc`, `extra`, `todate`, `duration`, `slab`, `entry`, `department`, `designation` FROM `emp_doc` WHERE `eid`='$eid' AND `id`='$entid'" ,$con) or die(mysql_error());
		$rowgetDatsa=mysql_fetch_assoc($getDatsa);
		$mtype_Edit=$rowgetDatsa["mtype"];
		$stype_Edit=$rowgetDatsa["stype"];
		$desc_Edit=$rowgetDatsa["desc"];
		$extra_Edit=$rowgetDatsa["extra"];
		$todate_Edit=$rowgetDatsa["todate"];
		$duration_Edit=$rowgetDatsa["duration"];
		$slab_Edit=$rowgetDatsa["slab"];
		$entry_Edit=$rowgetDatsa["entry"];
		$department_Edit=$rowgetDatsa["department"];
		$designation_Edit=$rowgetDatsa["designation"];
		
		if($mtype_Edit==3 AND ($stype_Edit==3 OR $stype_Edit==4 OR $stype_Edit==5 OR $stype_Edit==6 OR $stype_Edit==7 OR $stype_Edit==8 OR $stype_Edit==9))
		{
			$disnoneRa="";
			$disnoneRa2="display:none";
			if($stype_Edit==3 OR $stype_Edit==4  OR $stype_Edit==5 OR $stype_Edit==6 OR $stype_Edit==7 OR $stype_Edit==8 OR $stype_Edit==9)
			{
				$disnoneRa2="";
			}
		}
	}
?>
<div class="add-new gray_dark-border" id="addEx" style="<?=$tryt?>;height: 350px;
		overflow: scroll;
		">
	<div class="form-head gray_dark">
		<div class="head-title">
			<i class="add-form">
			</i>
			<?=$mainTitle?> Document
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
					$main_op="";
					$sub_op="";
					$main_counter=1;
					foreach($formali_array as $key=>$value)
					{
						$sell="";
						$sellshow="display:none";
						
						if($mtype_Edit==$main_counter)
						{
							
							$sell="selected='selected'";
							$sellshow="";
						}
						$main_op.='<option value="ddx_'.$main_counter.'" '.$sell.'>'.$key.'</option>';
						$sub_counter=1;
						$sub_op.='<select class="input drop-down large subdrop" style="'.$sellshow.'"  id="ddx_'.$main_counter.'"  onchange="var trt=$(\'#ddx_0\').val();if((this.value==\'sub_3\' || this.value==\'sub_4\' || this.value==\'sub_5\' || this.value==\'sub_6\' || this.value==\'sub_7\' || this.value==\'sub_8\' || this.value==\'sub_9\') && trt==\'ddx_3\'){$(\'.disNaone\').show(); if(this.value==\'sub_8\' || this.value==\'sub_9\'){$(\'.disNaoneas\').hide();}else{$(\'.disNaoneas\').show();} /*if(this.value==\'sub_4\'){$(\'.disNone\').hide();}*/}else{$(\'.disNaone\').hide();}  ">
						<option value="">Please Select One</option>';
						foreach($value as $values)
						{
							$sellpo="";
							if($stype_Edit==$sub_counter AND $mtype_Edit==$main_counter)
							{
								$sellpo="selected='selected'";
							}
							if($values!="First Salary Review" OR isset($_REQUEST["edit"]))
							{
								
								$sub_op.='<option value="sub_'.$sub_counter.'" '.$sellpo.'>'.$values.'</option>';
							}
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
				<textarea class="input huge" id="ddx_<?=$main_counter?>" name="req" style="width: 240px; height: 60px"><?=$desc_Edit?></textarea>
			</td>
		</tr>
		<tr>
			<th>
				Effective From Date
			</th>
			<td>
				<input class="input medium inputCalendar" id="ddx_<?=$main_counter+1?>" name="req" readonly="readonly" onclick="openCalender('calenderid0','ddx_<?=$main_counter+1?>')" value="<?=$extra_Edit?>">
				
				<div class="calender" id="calenderid0"></div>
			</td>
		</tr>
		<tr class="disNaone"  style="<?=$disnoneRa?>">
			<th>
				Effective Till Date
			</th>
			<td>
				<textarea id="ddx_<?=$main_counter+2?>" readonly="readonly" disabled rows="1" cols="10" style="margin: 0px; width: 166px; height: 23px;"><?=$todate_Edit?></textarea>
			</td>
		</tr>
		<tr  class="disNaone"  style="<?=$disnoneRa?>">
			<th>
				Review Duration
			</th>
			<td><select  class="input drop-down large" id="ddx_<?=$main_counter+3?>" onchange="var tdate=$('#ddx_5').val();getModule('employee/documentation/date?date='+tdate+'&duration='+this.value,'ddx_6','','')">
					<option value="">Please Select Duration</option>
					<?php
						for($dueRe=1;$dueRe<=12;$dueRe++)
						{
							$rter="";
							if($duration_Edit==$dueRe)
							{
								$rter="selected='selected'";
							}
							if($dueRe==1)
							{
								echo "<option value='$dueRe' $rter>$dueRe Month</option>";
								
							}else{
								
								echo "<option value='$dueRe' $rter>$dueRe Months</option>";
							}
						}
					?>
				
				</select>
			
			</td>
		</tr>
		<tr  class="disNaone"  style="<?=$disnoneRa?>">
			<th>
				Salary Slab
			</th>
			<td>
                <?php
                
                if((!$extra_Edit) OR ($extra_Edit AND strtotime($extra_Edit) >= strtotime("2019-04-01")))
                {
						$getDataSalary = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0'" ,$con) or die(mysql_error());
						$salpr="";
						while ($rowSalary = mysql_fetch_array($getDataSalary))
						{
							$sal_Id=$rowSalary["id"];
							$sal_profileName=$rowSalary["profileName"];
							$rters="";
							if($slab_Edit==$sal_Id)
							{
								
								$rters="selected='selected'";
							}
							$salpr.=<<<AAA
								<option value="$sal_Id" $rters>$sal_profileName</option>
AAA;
                    }
                   // echo 456;
                }else{
                    $getDataSalary = mysql_query("SELECT `id`, `salprofile` FROM `salary` WHERE `delete`='0'" ,$con) or die(mysql_error());
                    $salpr="";
                    while ($rowSalary = mysql_fetch_array($getDataSalary))
                    {
                        $sal_Id=$rowSalary["id"];
                        $sal_Salprofile=$rowSalary["salprofile"];

                        $rters="";
                        if($slab_Edit==$sal_Id)
                        {
                            $rters="selected='selected'";
                        }
                        $salpr.=<<<AAA
								<option value="$sal_Id" $rters>$sal_Salprofile</option>
AAA;
                    }

                    //echo 123;
						}
                ?>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+4?>" onclick="<?=$main_counter+4?>">
					<option value="">Please Select Salary Slab</option>
                    <?php
						echo $salpr;
					?>
				</select>
			</td>
		</tr>
		<tr  class="disNaone disNone"  style="<?=$disnoneRa?><?=$disnoneRa2?>">
			<th>
				New Department
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+5?>" onclick="<?=$main_counter+5?>">
					<option value="">Please Select Department</option>
					<?php
						$getDataDept = mysql_query("SELECT `id`, `name` FROM `department` WHERE `delete`='0'" ,$con) or die(mysql_error());
						$deppr="";
						while ($rowDept = mysql_fetch_array($getDataDept))
						{
							$dep_Id=$rowDept["id"];
							$dep_Name=$rowDept["name"];
							$deparArray[$dep_Id]=$dep_Name;
							$rtsfsers="";
							if($department_Edit==$dep_Id OR ($depart==$dep_Id AND !isset($_REQUEST["edit"])))
							{
								$rtsfsers="selected='selected'";
							}
							
							$deppr.=<<<AAA
								<option value="$dep_Id" $rtsfsers>$dep_Name</option>
AAA;
						}
						
						echo $deppr;
					?>
				</select>
			</td>
		</tr>
		<tr  class="disNaone disNone"  style="<?=$disnoneRa;?><?=$disnoneRa2?>">
			<th>
				New Designation
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+6?>" onclick="<?=$main_counter+6?>">
					<option value="">Please Select Designation</option>
					<?php
						
						$getDatades = mysql_query("SELECT `id`, `name` FROM `designation` WHERE `delete`='0'" ,$con) or die(mysql_error());
						$desipr="";
						while ($rowDes = mysql_fetch_array($getDatades))
						{
							$des_id=$rowDes["id"];
							$des_name=$rowDes["name"];
							$desigArray[$des_id]=$des_name;
							$rtsers="";
							if($designation_Edit==$des_id OR ($desig==$des_id AND !isset($_REQUEST["edit"])))
							{
								$rtsers="selected='selected'";
							}
							
							$desipr.=<<<AAA
								<option value="$des_id" $rtsers>$des_name</option>
AAA;
							//print_r($rowDes);
						}
						echo $desipr;
					?>
				
				</select>
			</td>
		</tr>
		<?php
			if($stype_Edit==8)
			{
				$disnoneRa="display:none";
			}
		?>
		<tr  class="disNaone disNaoneas" style="<?=$disnoneRa;?> ">
			<th>
				Type Of Entry
			</th>
			<td>
				<select  class="input drop-down large" id="ddx_<?=$main_counter+7?>" onclick="<?=$main_counter+7?>" <?=$disb?>>
					<option value="">Please Select Type</option>
					<?php
						$depspr="";
						foreach ($extd as $kri=>$extdas)
						{
							$rrs="";
							if($entry_Edit==$kri)
							{
								$rrs="selected='selected'";
							}
							if($kri!=5)
							{
								$depspr.=<<<AAA
								<option value="$kri" $rrs>$extdas</option>
AAA;
							}
							
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
				<button class="button green" onclick="SaveData('employee/documentation/save?extraDep=<?=$depart;?>&extraDes=<?=$desig;?>&eid=<?php echo $eid?><?=$editthk?>','ddx_','<?=$main_counter+8?>','','','couResp','8')">
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
			$cnrit=0;
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
						if($cnrit==0)
						{
							$todasYdate=date("Y-n-d");
							$date1=date_create($todasYdate);
							$date2=date_create($todate);
							$diff=date_diff($date1,$date2);
							$dirtek= $diff->format("%R%a days");
							if($dirtek<=0)
							{
								$rc_Id="style='background-color:#f44336'";
							}elseif($dirtek<15)
							{
								$rc_Id="style='background-color:#FFC107'";
							}
						}
					}

							
							


                    if(strtotime($extra) >= strtotime("2019-04-01"))
                    {
                        $getDataSalary = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0' AND `id`='$slab'" ,$con) or die(mysql_error());
                        $rowSalary = mysql_fetch_array($getDataSalary);
                        $sal_Id=$rowSalary["id"];
                        $sal_profileName=$rowSalary["profileName"];
                    }else{
                        $getDataSalary = mysql_query("SELECT `id`, `salprofile` FROM `salary` WHERE `delete`='0' AND `id`='$slab'" ,$con) or die(mysql_error());
                        $rowSalary = mysql_fetch_array($getDataSalary);
                        $sal_Id=$rowSalary["id"];
                        $sal_profileName=$rowSalary["salprofile"];
                    }

					$nhty.= <<<AAA
							<tr $rc_Id>
								<td style="color:#000;display: none; ">
									$mtypea
								</td>
								<td style="color:#000;text-align: center">
									$stypea
								</td>
								<td style="color:#000;text-align: center">
									$desc
								</td>
								<td style="color:#000;text-align: center">
									<span style="color: black;"><b>$sal_profileName</b></span><br><br>
									<span style="background: #fbff00;padding: 2px 25px;"><b>$duration $Months</b></span><br><br>
									<span  style="background-color: #00fff3;padding: 2px 5px;"><b>$extra <span  style="color: red;">TO</span> $todate</b></span>
								</td>
								<td style="color:#000;text-align: center">
									<span>Des: <b>$desigArray[$designation]</b></span><br>
									<span>Depa: <b>$deparArray[$department]</b></span>
								</td>
								<td style="color:#000;text-align: center">
									$extd[$entry]
								</td>
								<td style="color:#000;text-align: center">
AAA;
					
					if (in_array('d_empdd',$thisper))
					{
						$nhty.= <<<AAA
												<div style="color:blue!important" class="link-blue" onclick="getModule('employee/documentation/view?eid=$eid&edit=1&entid=$id','manipulatemoodleContent','viewmoodleContent','Documentation')">Edit</div>
AAA;
					}
					/*					else{
											AND $stype!=7
											$nhty.= "---";
										}*/
					$nhty.= <<<AAA
								</td>
							</tr>
AAA;
					//	print_r($depArray);
					//print_r($desigArray);
					$cnrit++;
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
							<?php
								if (in_array('u_empdd',$thisper))
								{
									?>
									<div style="color:blue!important" class="link-blue" onclick="getModule('employee/documentation/view?eid=<?=$eid?>&edit=1&entid=<?=$id?>','manipulatemoodleContent','viewmoodleContent','Documentation')">Edit <?=$entry?></div>
									<?php
								}
							?>
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
		<caption style="font-size: 24px;padding-bottom: 5px;font-weight: bold;">Salary Documentation </caption>
		<tr>
			<th style="display: none">
				Type
			</th>
			<th style="width: 100px;">
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


