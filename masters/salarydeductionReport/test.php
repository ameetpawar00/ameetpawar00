<?php
include("../../include/conFig.php");


function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}




//$sqldel="SELECT `salaryslip`.`id`,`salaryslip`.`employee`, `salaryslip`.`basic`, `salaryslip`.`PF`, `salaryslip`.`slip`, `salaryslip`.`TDS`, `salaryslip`.`TMODE`, `salaryslip_extra`.`pfcamount`, `salaryslip_extra`.`pt`, `salaryslip_extra`.`esice`, `salaryslip_extra`.`esicc`, `salaryslip_extra`.`extra1`, `salaryslip_extra`.`extra2` FROM `salaryslip`,`salaryslip_extra` WHERE `salaryslip`.`id`=`salaryslip_extra`.`sid` AND `salaryslip`.`month`='04' AND `salaryslip`.`year`='2017' AND `salaryslip`.`delete`='0' AND `salaryslip`.`employee` IN (784,721,419,770,265,551,754,764,404,1027,267,361,609,686,64,802,674,463,693,279,744,821,812,552,341,616,31,312,525,893,354,543,597,501,783,785,392,280,668,599,643,874,759,638,789,828,573,250,1022,111,483,844,446,835,540,792,679,834,790,739,747,378,776,458,830,579,637,352,780,833,591,151,777,304,801,953,65,751,758,20,760,820,67,585,594,627,648,66,690)";	
$sqldel="SELECT `salaryslip`.`id`,`salaryslip`.`slip` FROM `salaryslip`,`salaryslip_extra` WHERE `salaryslip`.`id`=`salaryslip_extra`.`sid` AND `salaryslip`.`month`='04' AND `salaryslip`.`year`='2017' AND `salaryslip`.`delete`='0' AND `salaryslip`.`employee` IN (784,721,419,770,265,551,754,764,404,1027,267,361,609,686,64,802,674,463,693,279,744,821,812,552,341,616,31,312,525,893,354,543,597,501,783,785,392,280,668,599,643,874,759,638,789,828,573,250,1022,111,483,844,446,835,540,792,679,834,790,739,747,378,776,458,830,579,637,352,780,833,591,151,777,304,801,953,65,751,758,20,760,820,67,585,594,627,648,66,690)";	
	$getD = mysql_query($sqldel,$con)or die(mysql_error());
	
$parseda="";

		while($rowD = mysql_fetch_assoc($getD))
		{

			$slip=$rowD["slip"];
			$id=$rowD["id"];
			$fullstring = $slip;
			$parsed = get_string_between($fullstring, 'ESIC (Employee Contribution)', 'Net Salary before TDS');
			$parsedas=explode('<td colspan="2" class="txal">ESIC (Company Contribution) </td>',$parsed);
			
			$parseda1=$parsedas[0];
			$parseda2=$parsedas[1];
			$parsedsas1 = get_string_between($parseda1, '<td>', '</td>');
			$parsedsas2 = get_string_between($parseda2, '<td>', '</td>');
			$val_array[$id]=array($parsedsas1,$parsedsas2);
			
		}


print_r($val_array);
foreach($val_array as $key=>$val_arrayval)
{
	
	$escieam=$val_arrayval[0];
	$escicam=$val_arrayval[1];
	$sqldeld="UPDATE `salaryslip_extra` SET `extra1`='$escieam',`extra2`='$escicam' WHERE `sid`='$key'";	
	$getDs = mysql_query($sqldeld,$con)or die(mysql_error());
}
?> 

<!--<textarea hight="100%"><?=$parsedsas1?></textarea>
<textarea hight="100%"><?=$parsedsas2?></textarea>-->
