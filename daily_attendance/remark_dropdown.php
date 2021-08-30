<?php
include("../include/conFig.php");
$cvalue = $_GET['cvalue'];
$mainval = $_GET['mainval'];
$i = $_GET['ival'];

?>
  <?php if($mainval!=1 && $mainval!='' && $mainval!=3 && $mainval!=6 && $mainval!=7 && $mainval!=8 && $mainval!=9){ ?> 
   <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $cvalue; ?>" required="required">
						<option value="">Select Remark</option>
						<option value="1">INT-YES-APP</option>
						<option value="2">INT-YES-UNAPP</option>
						<option value="3">INT-NO-UNAPP</option>
					</select>


 <?php } else { ?>

  <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $cvalue; ?>">
						<option value="">Select Remark</option>
					</select>

 <?php } ?>					