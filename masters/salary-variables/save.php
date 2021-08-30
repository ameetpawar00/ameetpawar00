<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$spid=$post[0];
$pfe=$post[1];
$pfc=$post[2];
$esice=$post[3];
$esicc=$post[4];
$pt=$post[5];
$basic=$post[6];

if($basic>15000)
{

    $myQuery="($spid,10,$pfe),";
    $myQuery.="($spid,11,$pfc),";
}else{
    $myQuery="($spid,16,$pfe),";
    $myQuery.="($spid,17,$pfc),";
}

$myQuery.="($spid,12,$esice),";
$myQuery.="($spid,13,$esicc),";
$myQuery.="($spid,14,$pt)";

mysql_query("DELETE FROM `salary_structure_relation_new` WHERE `variableid` IN(10,11,12,13,14,15,16,17) AND `profileid`=$spid",$con) or die(mysql_error());


mysql_query("INSERT INTO `salary_structure_relation_new`(`profileid`, `variableid`, `variablevalue`) VALUES $myQuery",$con) or die(mysql_error($con));

?>




