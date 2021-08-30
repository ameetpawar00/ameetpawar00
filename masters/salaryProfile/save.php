<?php
include("../../include/conFig.php");



//$_POST['valto']="rrrrrr*$*$*-1-,-2-,*$*$*6666666666*$*$*7777777777";

$valto = $_POST['valto'];
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


//print_r($posta);
$profileName=$post[0];
$profileRawVariables=$post[1];
$profileRawVariables=str_ireplace("-","",$profileRawVariables);
$profileRawVariables=rtrim($profileRawVariables,",");
$profileRawVarArray=explode(",",$profileRawVariables);



mysql_query("INSERT INTO `salary_structure_new`(`profileName`, `createdby`) VALUES ('$profileName','$hrmloggedid')",$con) or die(mysql_error($con));

$profileid = mysql_insert_id($con);

$nextCounter=0;
$myQuery="";
foreach($profileRawVarArray as $profileRawVarArrayVal)
{
    $thisId=$profileRawVarArrayVal;
    $thisValue=$posta[$nextCounter];

    $myQuery.="($profileid,$thisId,$thisValue),";
    $nextCounter++;
}

$myQuery=rtrim($myQuery,",");
mysql_query("INSERT INTO `salary_structure_relation_new`(`profileid`, `variableid`, `variablevalue`) VALUES $myQuery",$con) or die(mysql_error($con));

$profilerelationid = mysql_insert_id($con);



$getData = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0' AND `id`='$profileid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="success warnings">
    Designation Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<?php if(in_array('u_MDesi',$thisper))
{
    ?>
    <td class="link-blue" onclick="getModule('masters/salaryProfile/edit?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','salaryProfile')"><?php echo $row['profileName'] ?></td>
    <?php
}
else
{
    ?>
    <td ><?php echo $row['profileName']?></td>
    <?php
}
?>










