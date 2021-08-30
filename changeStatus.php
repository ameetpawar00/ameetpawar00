<?php
include("include/conFig.php");
$id=$_POST['id'];
$table=$_POST['table'];
$coloum=$_POST['coloum'];
$value=$_POST['value'];
$desc=$_POST['desc'];
$name=$_POST['name'];
$qua=$_POST['qua'];
$exp=$_POST['exp'];
$refer=$_POST['refer'];
$email=$_POST['email'];
$contact=$_POST['contact'];

if($value == "Yes")
{
//echo "select * from `jobvacancy` where `designation` ='$refer'";
$select = mysql_query("select * from `jobvacancy` where `designation` ='$refer'");
$Data = mysql_fetch_array($select);
echo $jid = $Data[0];
$value= '1';
mysql_query("INSERT INTO `jobapplicants`(`jobid`, `name`, `contact`, `email`, `qualification`, `experience`, `source`, `resumefile`, `description`,`dateofapply`,`creatdate`, `updatedate`, `updatedby`,`jobtitel`,`method`,`referby`) VALUES ('$jid','$name','$contact','$email','$qua','$exp','HRM','','','','$datetime','$datetime','$hrmloggedid','$desc','Refer','$refer')",$con) or die(mysql_error());

}
else
{
$value= '0';
}
mysql_query("UPDATE `$table` SET  `$coloum` ='$value' WHERE `id`='$id'",$con)or die(mysql_error());
//echo "UPDATE `$table` SET  `$coloum` ='$value' WHERE `id`='$id'";
//echo $table;
?>