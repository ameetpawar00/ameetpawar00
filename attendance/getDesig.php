<?php
include("../include/conFig.php");
$mnth = date('m');
$year = date('Y');
?>
<br/>
<br/>
<div class="title">Select Month To View Attendance <span style="display:inline-block"></span>
</div>
<br/>
<br/>
<div style="background:#fff;height:500px;overflow-x:auto;overflow-y:auto;" id="mainDivId">
<table width="30%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr>

<td><div class="" style="display:inline-block"><select class="input drop-down" name="Select1" id="month" >
				<option <?php if($mnth == '01' ) {echo 'selected=selected';}?>  value="01">January</option>
				<option <?php if($mnth == '02' ) {echo 'selected=selected';}?> value="02">February</option>
				<option <?php if($mnth == '03' ) {echo 'selected=selected';}?> value="03">March</option>
				<option <?php if($mnth == '04' ) {echo 'selected=selected';}?> value="04">April</option>
				<option <?php if($mnth == '05' ) {echo 'selected=selected';}?> value="05">May</option>
				<option <?php if($mnth == '06' ) {echo 'selected=selected';}?> value="06">June</option>
				<option <?php if($mnth == '07' ) {echo 'selected=selected';}?> value="07">July</option>
				<option <?php if($mnth == '08' ) {echo 'selected=selected';}?> value="08">August</option>
				<option <?php if($mnth == '09' ) {echo 'selected=selected';}?> value="09">September</option>
				<option <?php if($mnth == '10' ) {echo 'selected=selected';}?> value="10">October</option>
				<option <?php if($mnth == '11' ) {echo 'selected=selected';}?> value="11">November</option>
				<option <?php if($mnth == '12' ) {echo 'selected=selected';}?> value="12">December</option>
			</select></div></td>
			
<td><div class="" style="display:inline-block"><select class="input drop-down" name="Select1" id="year" >
				<option <?php if($year == '2014' ) {echo 'selected=selected';}?>  value="2014">2014</option>
				<option <?php if($year == '2015' ) {echo 'selected=selected';}?> value="2015">2015</option>
				<option <?php if($year == '2016' ) {echo 'selected=selected';}?> value="2016">2016</option>
				<option <?php if($year == '2017' ) {echo 'selected=selected';}?> value="2017">2017</option>
				<option <?php if($year == '2018' ) {echo 'selected=selected';}?> value="2018">2018</option>
				<option <?php if($year == '2019' ) {echo 'selected=selected';}?> value="2019">2019</option>
				<option <?php if($year == '2020' ) {echo 'selected=selected';}?> value="2020">2020</option>
				<option <?php if($year == '2021' ) {echo 'selected=selected';}?> value="2021">2021</option>
				<option <?php if($year == '2022' ) {echo 'selected=selected';}?> value="2022">2022</option>
				<option <?php if($year == '2023' ) {echo 'selected=selected';}?> value="2023">2023</option>
				<option <?php if($year == '2024' ) {echo 'selected=selected';}?> value="2024">2024</option>
				<option <?php if($year == '2025' ) {echo 'selected=selected';}?> value="2025">2025</option>
			</select></div></td>
	<td>
		<div class="" style="display:inline-block">
			<select class="input drop-down large" name="" id="empname">
				<option value="">Select Employee</option>
				<option value="all"><b>All USERS</b></option>
				<?php
					$getLoc = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `empstatus`=2  ORDER BY employee.name ASC",$con) or die(mysql_error());
					while($rowLoc = mysql_fetch_array($getLoc))
						{
							echo $a=<<<AAA
											<option value="$rowLoc[0]">$rowLoc[1]</option>
AAA;

						}
				?>	
			</select>
		</div>
	</td>

<td> <input type="button" class="button green" value="GO" onclick="if((document.getElementById('empname').value) != '' && (document.getElementById('month').value) != '' && (document.getElementById('year').value) != '') { getModule('attendance/verify?smonth='+document.getElementById('month').value+'&year='+document.getElementById('year').value+'&empname='+document.getElementById('empname').value,'manipulateContent','viewContent','Attendance View')} else {alert('Please Select The Employee With Month And Year')}"/></td>

</tr>
</table>
