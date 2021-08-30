<?php
include("include/conFig.php");
$id=$_POST['id'];
$table=$_POST['table'];
$coloum=$_POST['coloum'];
$value=$_POST['value'];
echo $desc=$_POST['desc'];
echo $name=$_POST['name'];
echo $qua=$_POST['qua'];
echo $exp=$_POST['exp'];
echo $refer=$_POST['refer'];
echo $email=$_POST['email'];
echo $contact=$_POST['contact'];

if($value == "Yes")
{
$value= '1';
mysql_query("INSERT INTO `jobapplicants`(`jobid`, `name`, `contact`, `email`, `qualification`, `experience`, `source`, `resumefile`, `description`,`dateofapply`,`creatdate`, `updatedate`, `updatedby`,`jobtitel`,`method`,`referby`) VALUES ('$desc','$name','$contact','$email','$qua','$exp','HRM','','','','$datetime','$datetime','$hrmloggedid','$desc','Refer','$refer')",$con) or die(mysql_error());

}
else
{
$value= '0';
}
mysql_query("UPDATE `$table` SET  `$coloum` ='$value' WHERE `id`='$id'",$con)or die(mysql_error());
//echo "UPDATE `$table` SET  `$coloum` ='$value' WHERE `id`='$id'";
//echo $table;
?>