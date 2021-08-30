<div class="pagination" style="position:relative;">
<div style="position:fixed;bottom:0px;right:0px;width:auto;">

<ul>
<li><span style="display:inline-block;color:#555">Total <?php echo $Num_Rows;?> Records : <strong> <?php $Num_Pages;?> </strong>Pages : </span>
</li>
	<?php
	if($Prev_Page)
	{
	?>
		<li class='prev' onclick="getModule('<?php echo $folder?>&Page=<?php echo $Prev_Page?>','manipulateContent','viewContent','<?php echo $title?>')"> <a href='#'>&#8592;<span>Prev</span></a></li>
	<?php
	}

	for($i=1; $i<=$Num_Pages; $i++)
	{
		if($i != $Page)
		{
		?>
			<li  onclick="getModule('<?php echo $folder?>&Page=<?php echo $i?>','manipulateContent','viewContent','<?php echo $title?>')"><a href="#"><?php echo $i ?></a></li>
			<?php
			//echo "[ <span href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</span> ]";
		}
		else
		{
		?>
			<li class='active'><a href='#'><?php echo $i?></a></li>
		<?php
		
		}
	}
	if($Page!=$Num_Pages)
	{
	?>
		<li class='next' onclick="getModule('<?php echo $folder?>&Page=<?php echo $Next_Page?>','manipulateContent','viewContent','<?php echo $title?>')"><a href="#"><span class='hidden-480'>Next</span> &#8594; </a></li>
	<?php
	}
	?>
</ul>
</div>
</div>


