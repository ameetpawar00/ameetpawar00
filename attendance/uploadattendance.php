<?php
include("../include/conFig.php");
$mnth = date('m');
?>

<div id="myTitle">
<div class="title">Attendance</div>
<div class="strip">
<span>Dashboard</span>
<span>Upload Attendance</span>
</div>
</div>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Upload Sheet</div>
</div>
<form action="attendance/uploadsheet.php" method="post" enctype="multipart/form-data" target="empFrame" onsubmit="$('#loading').show()">
<table cellpadding="0" cellspacing="0" width="100%">
 
<tr>
<td valign="top" style="vertical-align:top;text-align:right;">Select Year</td>
<td><select class="input drop-down" name="syear" id="syear" required="" >
				<?php 
				$currentY = date("Y");
				$lastY = $currentY-5;
				
				
				for($j=$currentY;$j>=$lastY;$j--)
				{
				?>
				<option <?php if($sYear== $j) {echo 'selected=selected';}?>  value="<?php echo $j?>"><?php echo $j?></option>
				<?php
				}
				?>
				</select></td>
</tr><tr>
<td valign="top" style="vertical-align:top;text-align:right;">Select Month</td>
<td><select class="input drop-down" name="month" id="month" required="">
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
			</select></td>
</tr>
<tr>
<td valign="top" style="vertical-align:top;text-align:right;">Upload File</td>
<td>
<input type="file" name="datasheet" required/>
</td>
</tr>
<tr>
<td></td>
<td>
<input type="submit" name="uploadSheet" value="Upload Data" class="blue button" >
<input type="button" name="cancel" value="Cancel" class="red button">
<div id="couResp"></div>
</td>
</tr>

</table>
</form>
<iframe  name="empFrame" id="empFrame" frameborder="0" height="100px" width="300px" scrolling="no" style="display:none"></iframe>
	</div>
</div>


