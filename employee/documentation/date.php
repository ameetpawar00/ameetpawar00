<?php
	date_default_timezone_set("Asia/Calcutta");
$date=$_REQUEST["date"];
$duration=$_REQUEST["duration"];
	
	echo $effectiveDate = date('Y-n-d', strtotime("+$duration months", strtotime($date)));



?>