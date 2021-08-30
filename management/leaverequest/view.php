<?php
include("../../include/conFig.php");
	
	$rytyt=rtrim(display_children($hrmloggedid,0),",");
	function display_children($hrmloggedid,$level) {
		$result = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
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
	

	
	
	
if (isset($_GET["init"]))
{
	$qqtli = "";
}
elseif(isset($_GET["search"]))
{
	$frm_sea=$_GET["frm_sea"];
	$to_sea=$_GET["to_sea"];
	$rtype_sea=$_GET["rtype_sea"];
	$emppname=$_GET["emppname"];
	if($emppname=="all")
	{
		$nameasd="";
	}else{		
		$nameasd="AND `employee`.`id`='$emppname'";
	}
	
	if($rtype_sea==4)
	{
		$qqtli = " AND `leaverequest`.`fromdate`>='$frm_sea' AND `leaverequest`.`todate` <='$to_sea' $nameasd";
	}elseif($rtype_sea==3)
	{
		$qqtli = " AND `leaverequest`.`fromdate`>='$frm_sea' AND `leaverequest`.`todate` <='$to_sea' AND `leaverequest`.`extra`>'0' $nameasd";
	}else{
		$qqtli = " AND `leaverequest`.`fromdate`>='$frm_sea' AND `leaverequest`.`todate` <='$to_sea' AND `leaverequest`.`status`='$rtype_sea' $nameasd";
	}
}else{
	$qqtli = " AND `leaverequest`.`createdate`> DATE_SUB(now(), INTERVAL 3 MONTH)";
}

//
if($rytyt!="")
{
	$sql = "SELECT `leaverequest`.`id`, `leaverequest`.`days`, `leaverequest`.`fromdate`, `leaverequest`.`todate`, `leaverequest`.`updatedate`, `leaverequest`.`leavetime`, `leaverequest`.`status`, `leaverequest`.`description`, `employee`.`name`, `employee`.`id`, `leaverequest`.`leavetype`, `department`.`name`, `leaverequest`.`extra`, `leaverequest`.`extra1` FROM `leaverequest` JOIN `employee` ON `employee`.`id` = `leaverequest`.`updatedby` LEFT JOIN `department` ON `employee`.`department`=`department`.`id` WHERE `employee`.`id` IN($rytyt) AND `leaverequest`.`delete` = '0'$qqtli AND `employee`.`delete`=0 AND employee.empstatus = 2";
}else{
	$sql = "SELECT `leaverequest`.`id`, `leaverequest`.`days`, `leaverequest`.`fromdate`, `leaverequest`.`todate`, `leaverequest`.`updatedate`, `leaverequest`.`leavetime`, `leaverequest`.`status`, `leaverequest`.`description`, `employee`.`name`, `employee`.`id`, `leaverequest`.`leavetype`, `department`.`name`, `leaverequest`.`extra`, `leaverequest`.`extra1` FROM `leaverequest` JOIN `employee` ON `employee`.`id` = `leaverequest`.`updatedby` JOIN `teamamtes` ON `teamamtes`.`mateid` = `employee`.`id` JOIN `team` ON `teamamtes`.`teamid` = `team`.`id` LEFT JOIN `department` ON `employee`.`department`=`department`.`id` WHERE `team`.`leader` = '$hrmloggedid' AND `leaverequest`.`delete` = '0'$qqtli AND `employee`.`delete`=0 AND employee.empstatus = 2";
}


if (in_array('full_leav_access',$thisper))
{
	$sql = "SELECT `leaverequest`.`id`, `leaverequest`.`days`, `leaverequest`.`fromdate`, `leaverequest`.`todate`, `leaverequest`.`updatedate`, `leaverequest`.`leavetime`, `leaverequest`.`status`, `leaverequest`.`description`, `employee`.`name`, `employee`.`id`, `leaverequest`.`leavetype`, `department`.`name`, `leaverequest`.`extra`, `leaverequest`.`extra1` FROM `leaverequest` JOIN `employee` ON `employee`.`id` = `leaverequest`.`updatedby` LEFT JOIN `department` ON `employee`.`department`=`department`.`id` WHERE `leaverequest`.`delete` = '0'$qqtli AND `employee`.`delete`=0 AND  `employee`.`delete`=0 AND employee.empstatus = 2";
}

$getData = mysql_query($sql,$con) or die(mysql_error());

/*Get all leave*/

$sqlLeave = mysql_query("SELECT `prefix`,`id`,`type` FROM `leavetype` WHERE `delete` = '0'",$con) or die(mysql_error());

$ltypee = array();
while ($getLeave = mysql_fetch_array($sqlLeave))
{
	$ltypee[] = array("prefix1"=>$getLeave['prefix'],"prefix2"=>$getLeave['prefix']."**LWP","type"=>$getLeave['type']);
}
array_push($ltypee,"LWP");
//echo $nameasd;
?>
<div class="title">
	Manage Leave Request
</div>
<div class="strip">
	<span>
		Dashboard
	</span>
	<span>
		Management
	</span>
	<span>
		Manage Leave Requests
	</span>
</div>
<table cellpadding="0" cellspacing="0" width="100%" style="display: none">
	<tr>
		<td style="width: 30%">
		</td>
		<td align="right" style="width: 70%">
			<button class="button gray" onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')" style="display: none">
				<i class="back">
				</i>Back
			</button>&nbsp;&nbsp;
		</td>
	</tr>
</table>
<div id="mainDivId" style="height: 350px; overflow: auto">

	<?php

	if (isset($_GET["init"]))
	{
		$qqtli =<<<AAA
		<span style = "color: red"> Only showing Full data Click for Less Data</span> &nbsp; <button class = "button green" onclick="getModule('management/leaverequest/view','viewContent','manipulateContent','Manage Leave Request');" style ="display:">View Less</button>
AAA;
	}
	else
	{
		$qqtli =<<<AAA
		<span style= "color:red"> Only showing Last 3 Months data Click for ALL Data</span> &nbsp; <button class="button green" onclick="getModule('management/leaverequest/view?init=1','viewContent','manipulateContent','Manage Leave Request');" style="display: ">View All</button>
AAA;
	}



	echo $qqtli;
	
	
	if (in_array('adv_search_access',$thisper))
	{
		
	
	?>
	<button class="button blue" onclick="var adret=$('#adv_search_frm').html(); $('#viewmoodleContent').html(adret);ToggleBox('bigMoodle','block','');ToggleBox('viewmoodleContent','block','')" style="display: ">
		Advanced Search
	</button>
	<style>
		#myTable_new_filter
		{
			display: none
		}
	</style>
	<div id="adv_search_frm" style="display: none">
			<h2>
				Advanced Search option 
			</h2>
			<div style='height:400px;overflow-x:hidden;overflow-y:scroll' id='mainDivId'>
				<table  class='fetch' id='' style='text-align:center' cellspacing='0' cellpadding='5' border='1' width='100%'>
					<tr>
							<th>
								Name
							</th>
							<td>
							
								<select id="emppname">
									<option value="all">
										All
									</option>
									
									<?php
									
									$sqle     = "SELECT employee.id, employee.name FROM employee WHERE employee.delete = '0' AND employee.active = '1' AND employee.empstatus = '2' ORDER BY `name`";
									$sqlem = mysql_query($sqle,$con) or die(mysql_error());
									while ($getLeaveemp = mysql_fetch_array($sqlem))
									{
										
										$eiid=$getLeaveemp['id'];
										$enname=$getLeaveemp['name'];
										echo "<option value='$eiid'>$enname</option>"; 
									}
									
									
									?>
								</select>
							</td>
							</tr>
							<tr>
							<th>
								From Date
							</th>
							<td>
								<input id="frm_sea" readonly="readonly" class="inputCalendar input small" onclick="openCalender('frm_seacal','frm_sea');$('#to_sea').val('')"  type="test">
								<div class="calender" id="frm_seacal">
								</div>
							</td>
							</tr>
							<tr>
							<th>
								To Date
							</th>
							<td>
								<input id="to_sea" readonly="readonly" class="inputCalendar input small" onclick="openCalender('to_seacal','to_sea');"  type="test">
								<div class="calender" id="to_seacal">
								</div>
							</td>
						</tr>
						<tr>
							<th>
								Type
							</th>
							<td>
								<select id="rtype_sea" class="">
									<option value="4">
										All
									</option>
									<option  value="0">
										Waiting
									</option>
									<option  value="1">
										Approved
									</option>
									<option  value="3">
										Cancellation
									</option>
									<option  value="2">
										Unapproved
									</option>
								</select>
							</td></tr>
							<tr>
							<td>
							</td>
							<td>
								<button class="button blue" onclick="var frm_sea=$('#frm_sea').val(); var to_sea=$('#to_sea').val(); var rtype_sea=$('#rtype_sea').val(); var rtype_sea=$('#rtype_sea').val(); var emppname=$('#emppname').val(); getModule('management/leaverequest/view?search=1&frm_sea='+frm_sea+'&to_sea='+to_sea+'&rtype_sea='+rtype_sea+'&emppname='+emppname,'manipulateContent','viewContent','Leave Advance Search');ToggleBox('bigMoodle','none','');ToggleBox('viewmoodleContent','none','')" style="display: ">
									Search
								</button>
							</td>
						</tr>
				</table>
		</div>
	</div>
	<?php }?>
	<table class="display dataTable " width="100%" cellspacing="0"  id="myTable_new">
		<thead>
			<tr>
				<th>
					No
				</th>
				<th>
					Employee Name and Department
				</th>
				<th>
					From date
				</th>
				<th>
					To Date
				</th>
				<th>
					Leave Time
				</th>
				<th>
					Leave Type
				</th>
				<th>
					Description
				</th>
				<th>
					Applied On
				</th>
				<th>
					Action
				</th>
				<th>
					Story
				</th>
			</tr>
		</thead>
		<tfoot style="display: table-header-group;position: relative;top: 0px;">
			<tr>
				<th>
				</th>
				<th>
					Employee Name
				</th>
				<th>
					From date
				</th>
				<th>
					To Date
				</th>
				<th>
					Leave Time
				</th>
				<th>
					Leave Type
				</th>
				<th>
					Description
				</th>
				<th>
					Applied On
				</th>
				<th>
					Action
				</th>
				<th>
				</th>
			</tr>
		</tfoot>
		<tbody>

			<?php
			$i = 1;
			$sql .= " order by leaverequest.id ASC";
			/*SELECT column_name(s)
			FROM table_name
			WHERE column_name BETWEEN value1 AND value2;*/
			$values = mysql_query($sql,$con)or die(mysql_error());
			while ($row = mysql_fetch_array($values))
			{
				//print_r($row);
				$disi = "";
				if ($row["extra"] == 1)
				{
					$disi = "#ffff00";
				}
				else
				if ($row["extra"] == 2)
				{
					$disi = "#ffd8d6";
				}
				
				$kjnd = "";
				if ($row["extra1"] == 1)
				{
					$kjnd = "display:none";
				}
				
				
				?>
				<tr id="fetchrow<?php echo $i?>" class="d<?php echo $i % 2?>" style="background: <?=$disi?>">
					<td>
						<?=$i?>
					</td>
					<td style="background: <?=$disi?>">
						<b>
							<?php echo $row[8] ?>
						</b><br>
						<small>
							<?=$row[11];?>
						</small>
					</td>

					<?php
					$var    = '';
					$border = '';
					if ($row[6] == 2) {
						$var         = "disabled";
						$selectLeave = '<option>'.$row[10].'</option>';
						$border      = 'style="border-color:red"';
					}
					else
					{
						//print_r($ltypee);
						//$selectLeaveAll = ' <option value = "0"> Select Leave Type</option> ';
						$selectLeaveAll = '';

						foreach ($ltypee as $ltypeea)
						{
							if (is_array($ltypeea))
							{


								$prefix1 = $ltypeea["prefix1"];
								$prefix2 = $ltypeea["prefix2"];
								$type = $ltypeea['type'];

								$sel1    = "";
								$sel2    = "";
								if ($row[10] == $prefix1)
								{
									$sel1 = "selected='selected'";
								}
								if ($row[10] == $prefix2)
								{
									$sel2 = "selected='selected'";
								}
								//added for special leave type restriction by-:amit pawar 27-02-2017
								if($type!=1)
									{
										
										$selectLeaveAll .= "<option value='$prefix1' $sel1>$prefix1</option>";
										if($hrmloggedid==93 OR $hrmloggedid==86)
											{
												$selectLeaveAll .= "<option value='$prefix2' $sel2>$prefix2</option>";
											}
									}else{
										
										if(in_array('sp_lreqs',$thisper))
										{
											$selectLeaveAll .= "<option value='$prefix1' $sel1>$prefix1</option>";
											if($hrmloggedid==93 OR $hrmloggedid==86)
											{ $selectLeaveAll .= "<option value='$prefix2' $sel2>$prefix2</option>";
											}
											//$selectLeaveAll .='<option value="'.$prefix.'**00">'.$prefix.' + Special</option>';
										} 
										
										
									}
									//added for special leave type restriction by-:amit pawar 27-02-2017
									
								/*$selectLeaveAll .= "<option value='$prefix1' $sel1>$prefix1</option>";
								$selectLeaveAll .= "<option value='$prefix2' $sel2>$prefix2</option>";*/
								
								
							}
							else
							{
								if ($row[10] == $ltypeea)
								{
									$sel2 = "selected='selected'";
								}
								$selectLeaveAll .= "<option value='$ltypeea' $sel2>$ltypeea</option>";
							}

						}
						$border = 'style="border-color:red"';

					}
					if ($row[6] == 1) {
						$var    = "disabled";
						//$selectLeave = ' <option> '.$row[10].'</option> ';
						$border = 'style="border-color:green"';
					}

					if (in_array('a_MLreq',$thisper))
					{
						$var = "";
					}
					?>
					<td>
						<?=date(('d M,Y') ,strtotime($row[2])) ?>
						<input name="" <?php echo $border;?>  id="levr1asas<?=$i?>" type="test" readonly="readonly" class="inputCalendar input small" style="width:130px" onclick="openCalender('calenderidl0aas<?=$i?>','levr1asas<?=$i?>');$('#levr2asdfa<?=$i?>').val('')" value="<?=$row[2]?>" <?php echo $var;?>/>
						<div class="calender" id="calenderidl0aas<?=$i?>">
						</div>
					</td>
					<td>
						<?php echo  date(('d M,Y') ,strtotime($row[3])) ?>

						<input name="" <?php echo $border;?>  id="levr2asdfa<?=$i?>" type="" readonly="readonly" class="inputCalendar input small" style="width:130px" onclick="openCalender('calenderidl1asas<?=$i?>','levr2asdfa<?=$i?>')" onblur="if($('#levr1asas<?=$i?>').val()==''){alert('Please Select From Date');$('#calenderidl1asas<?=$i?>').hide();$('#levr2asdfa<?=$i?>').val('');}else{}" value="<?=$row[3]?>" <?php echo $var;?>/>
						<div class="calender" id="calenderidl1asas<?=$i?>">
						</div>
					</td>

					<td id="leavedays_<?php echo $i;?>">

						<?php
						$ar = str_replace(" + ","**","$row[10]");
						echo "<b>
						<span id='days$i'>".$row[1]."</span>
						<span id='selectit_old$i' style='display:none'>".$ar."</span>
						</b><br>";

						$sar = array("Full Day Leave","First Half Leave","Second Half Leave");
						$counter = 1;
						$aa      = "";
						foreach ($sar as $sarray)
						{
							$sel = "";
							if ($counter == $row[5])
							{
								$sel = "selected";
							}
							$aa.=<<<AAA
							<option value = "$counter" $sel> $sarray</option>

AAA;
							$counter++;
						}
						?>

						<select  class="input drop-down small " <?php echo $border;?> <?php echo $var;?> id="leavetime_sel_<?=$i;?>">
							<?=$aa;?>
						</select>
					</td>
					<td>
						<select id="selectit<?php echo $i; ?>" <?php echo $border;?> <?php echo $var;?> class="input drop-down small " name="Select1" onchange="checkLeavestatus($('#selectit<?=$i?>').val(),<?=$row[9]?>,2,<?=$i?>)">
							<?php
							if ($row[6] == 2)
							echo $selectLeave;
							else
							echo $selectLeaveAll;
							?>
						</select>
					</td>


					<td>
						<?php echo $row[7] ?>
					</td>
					<td>
						<?php echo  date(('d M,Y') ,strtotime($row[4])) ?>
					</td>
					<td style="text-align: center;">
						<div id="leaveStat<?php echo $i?>">
							<?php
							if ($row[6] == 1)
							{
								//echo "";
								//echo "";

								echo $a =<<<AAA
								<div id = "approved_status_$i">
								<div style = 'color:green'> Approved</div>
AAA;


								if (in_array('u_MLreq',$thisper) AND $row["extra"] != 1)
								{
									echo $a = '<div style="color:blue!important" class="link-blue" onclick="approved_status_change('.$i.',1)">Change</div>';
								}
								if ($row["extra"] != 1)
								{
									if (in_array('s_MLreq',$thisper))
									{

										echo $a =<<<AAA

										</div>
										<div id = "approved_buttons_$i" style = "display:none;">
										<input type = "button" class = "button green" onclick = "var r = confirm('Are You Sure Want to Approve this leave'); if(r == true){checkLeave($('#selectit$i').val(),'$row[9]',$('#levr1asas$i').val(),$('#levr2asdfa$i').val(),'$row[0]','$row[6]',$i,$('#leavetime_sel_$i').val(),3)}" value = "App" style = "padding: 5px 0px;font - size: 12px;">
										<input type = "button" class = "button red"  onclick = "var r = confirm('Are You Sure Want to Unapproved this leave'); if(r == true){checkLeave('$row[10]','$row[9]','$row[2]','$row[3]','$row[0]','$row[6]',$i,'$row[5]',4)}" value = "Unap" style = "padding: 5px 0px;font - size: 12px;">
										<span style = "color:blue!important;font - size: 12px;" class = "link - blue" onclick = "approved_status_change($i,2)"> Cancel</span>
										</div>
AAA;
									}
								}
								else
								{
									if (in_array('s_MLreq',$thisper))
									{
										echo $a =<<<AAA


										<div id = "approved_buttons_$i" style = "">

										<input type = "button" class = "button red"  onclick = "var r = confirm('Are You Sure Want to Unapproved this leave'); if(r == true){checkLeave('$row[10]','$row[9]','$row[2]','$row[3]','$row[0]','$row[6]',$i,'$row[5]',5)}" value = "Unap" style = "padding: 5px 0px;font - size: 12px;">

										</div>
AAA;
									}
									else
									{
										echo '<span style="color:blue!important;font-size: 12px;" class="link-blue" onclick="">Waiting</span>';
									}
								}
								$wwhat = "";

							}
							elseif ($row[6] == 0)
							{
								if (in_array('s_MLreq',$thisper))
								{
									echo $a =<<<AAA
									<input type = "button" class = "button green" onclick = "var r = confirm('Are You Sure Want to Approve this leave'); if(r == true){checkLeave($('#selectit$i').val(),'$row[9]',$('#levr1asas$i').val(),$('#levr2asdfa$i').val(),'$row[0]','$row[6]','$i',$('#leavetime_sel_$i').val(),1)}" value = "App" style = "padding: 5px 0px;font - size: 12px;">
									<input type = "button" class = "button red" onclick = "var r = confirm('Are You Sure Want to Unapproved this leave'); if(r == true){checkLeave($('#selectit$i').val(),'$row[9]','$row[2]','$row[3]','$row[0]','$row[6]','$i','$row[5]',2)}" value = "Unap" style = "padding: 5px 0px;font - size: 12px;">
AAA;
								}
								else
								{
									echo '<span style="color:blue!important;font-size: 12px;" class="link-blue" onclick="">Waiting</span>';
								}
								$wwhat = "none";
							}
							else
							{

								if($row["extra"]==2)
											{
												//$sstt="<span style='color:red'>Canceled</span>";	
												echo "<span style='color:red'>Canceled</span>";
											}else{
												echo "<span style='color:red'>Unapproved</span>";
												echo "<br>";
												
												if($hrmloggedid==93 OR $hrmloggedid==86 OR $hrmloggedid==1286)
												{
												echo $a =<<<AAA
												<input type = "button" class = "button red" onclick = "var r = confirm('Are You Sure Want to Deduct for this leave'); if(r == true){checkLeave($('#selectit$i').val(),'$row[9]','$row[2]','$row[3]','$row[0]','$row[6]','$i','$row[5]',786)}" value = "Deduction" style = "padding:0px 5px;$kjnd">
AAA;
												}
											}	
								$wwhat = "";
							}

							?>
						</div>

					</td>
					<td>
						<div style="width: 100%;display: flex;">
							<div class="button green" style="cursor:pointer;padding:4px;" onclick="getModule('management/salary/story/view?eid=<?php echo $row[9];?>&name=<?php echo $row[8] ?>','manipulatemoodleContent','viewmoodleContent','Story Line')">
								Story
							</div>
							<?php
							if (in_array('d_MLreq',$thisper))
							{
								?>
								<!--<i class="fa fa-trash" style="font-size: 20px;color: red;cursor: pointer;margin-top: 7px;margin-left: 10px;display:<?=$wwhat;?>"  onclick="var r=confirm('Are You Sure Want to Delete this Request'); if(r==true){checkLeave('','','','','<?=$row[0]?>','','<?=$i?>','',5)}"></i>-->
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				<?php
				$i++;
				//$Maxid = $row[0];
				//$MaxI = $i;
			}
			?>
			<!--<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
			-->
		</tbody>
	</table>
</div>
<?php
//include('../../pagination / pages.php');
?>