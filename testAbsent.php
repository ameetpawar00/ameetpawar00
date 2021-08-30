<?php
error_reporting(0);
echo fetchAbsent(1)."<br/>";
echo fetchAbsent(1)."<br/>";
echo fetchAbsent(1);

function fetchAbsent($i){
	global $cons;


$cons = $cons+1;	
return $cons;	
}


/*
print_r(fetchAbsent(1)); echo "<br/>";

print_r(fetchAbsent(1)); echo "<br/>";

print_r(fetchAbsent(1)); echo "<br/>";

function fetchAbsent($i){
	global $cons;
	
$cons[] = 1;	
return $cons;	
}
*/
?>