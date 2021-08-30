<?php

?>

<div id="ase<?php echo $rows[4]?>" <?php if($rows[3] == '1') {echo 'class = "green"';} else {echo 'class ="maroon"';}?> onclick="changeStatus('returned','asset','<?php echo $rows[4]?>','ase')"  ><?php if($rows[3] == '1') {echo 'Returned';} else {echo 'Not Returned';}?></div>
