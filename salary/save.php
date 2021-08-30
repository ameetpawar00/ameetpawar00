<?php
include("../include/conFig.php");
$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($_GET['increment'])
{
mysql_query("INSERT INTO `salary`(`eid`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `createdate`, `updatedate`, `updatedby`,`increment`) VALUES ('$eid','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$datetime','$datetime','$hrmloggedid','2')",$con) or die(mysql_error());

//mysql_query("INSERT INTO `salary` ( `eid`, `gross`, `hra`, `conveyance`, `bonus`,`pf`, `claim`,  `insurance`, `createdate`, `updatedate`, `updatedby`,`increment`) VALUES ( '$eid', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]', '$post[6]', '$datetime', '$datetime','$hrmloggedid','2')",$con) or die(mysql_error());
}
else if($_GET['count'] > 0)
{
mysql_query("INSERT INTO `salary`(`eid`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `createdate`, `updatedate`, `updatedby`,`increment`) VALUES ('$eid','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$datetime','$datetime','$hrmloggedid','1')",$con) or die(mysql_error());

//mysql_query("INSERT INTO `salary` ( `eid`, `gross`, `hra`, `conveyance`, `bonus`,`pf`, `claim`,  `insurance`, `createdate`, `updatedate`, `updatedby`,`increment`) VALUES ( '$eid', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]', '$post[6]', '$datetime', '$datetime','$hrmloggedid','1')",$con) or die(mysql_error());
}
else
{
mysql_query("INSERT INTO `salary`(`eid`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `createdate`, `updatedate`, `updatedby`) VALUES ('$eid','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());

//mysql_query("INSERT INTO `salary` ( `eid`, `gross`, `hra`, `conveyance`, `bonus`,`pf`, `claim`,  `insurance`, `createdate`, `updatedate`, `updatedby`) VALUES ( '$eid', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]', '$post[6]', '$datetime', '$datetime','$hrmloggedid')",$con) or die(mysql_error());

}
?>
BREAKSTRINGFORSAVEDATA