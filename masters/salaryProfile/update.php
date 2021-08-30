<?php
include("../../include/conFig.php");

//$_GET['i']=16;
//$_GET['id']=103;
//$_POST['valto']='28+2+1 NEW*$*$*-1-,-2-,-3-,-4-,-5-,-6-,-7-,-8-,*$*$*16800*$*$*6720*$*$*1600*$*$*0*$*$*1728*$*$*1152*$*$*2000*$*$*1000';

$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);

$counter=0;
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);

    if($counter<2)
    {
        $post[] = $val;
    }else{
        $posta[] = $val;
    }
    $counter++;

}

$profileName=$post[0];
$profileRawVariables=$post[1];
$profileRawVariables=str_ireplace("-","",$profileRawVariables);
$profileRawVariables=rtrim($profileRawVariables,",");
$profileRawVarArray=explode(",",$profileRawVariables);


mysql_query("UPDATE `salary_structure_new` SET `profileName`= '$profileName',`updatedate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error($con));
mysql_query("DELETE FROM `salary_structure_relation_new` WHERE  `profileid` = '$id'",$con) or die(mysql_error($con));




$nextCounter=0;
$myQuery="";
foreach($profileRawVarArray as $profileRawVarArrayVal)
{
    $thisId=$profileRawVarArrayVal;
    $thisValue=$posta[$nextCounter];

    $myQuery.="($id,$thisId,$thisValue),";
    $nextCounter++;
}

$myQuery=rtrim($myQuery,",");
mysql_query("INSERT INTO `salary_structure_relation_new`(`profileid`, `variableid`, `variablevalue`) VALUES $myQuery",$con) or die(mysql_error($con));

$profilerelationid = mysql_insert_id($con);




$getData = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0' AND `id`='$id'",$con) or die(mysql_error($con));
$row = mysql_fetch_array($getData);

?>

<div class="success warnings">
Designation Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/salaryProfile/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','salaryProfile')"><?php echo $row['profileName'] ?></td>

