<?php
include("../../include/conFig.php");
$sql = "SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
$Per_Page = 25;   // Per Page
include('../../pagination/pagination.php');
$folder= 'masters/salaryProfile/view';
$title = 'salaryProfile';


$sqla = "SELECT `profileid`, `variable_name`, `variablevalue` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `delete`='0' AND `salary_structure_relation_new`.`variableid`=`salary_structure_variables_new`.`id`";
$getDataa = mysql_query($sqla,$con) or die(mysql_error());

while ($getthRow=mysql_fetch_assoc($getDataa))
{
    $profileid=$getthRow["profileid"];
    $variable_name=$getthRow["variable_name"];
    $variablevalue=$getthRow["variablevalue"];
}

?>
<div id="myTitle">
    <div class="title">View All Salary profile</div>
    <div class="strip">
        <span>Dashboard</span>
        <span>Salary Profile</span>
        <span>View</span>
    </div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            <?php if(in_array('a_MDesi',$thisper))
            {
                ?>
                <button class="button blue" onclick="getModule('masters/salaryProfile/index','manipulateContent','viewContent','Asset')"> <i class="plus"></i>New Designation</button>&nbsp;
                <?php
            }
            ?>
            <?php if(in_array('d_MDesi',$thisper))
            {
                ?>
                <button class="button red" onclick="deleteData('salary_structure_new','Salary Profile')"> <i class="delete-icon"></i>Delete</button>&nbsp;
                <?php
            }
            ?>&nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
                <i class="back"></i>Back</button>
        </td>
    </tr>
</table>

<div style="height:350px;overflow:auto"" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
    <tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
        <th>Profile</th>
        <!--	<th>Travelling Allowance</th>
        <th>Additional Earinings</th>-->
        <?php
        $i = 1;
        $sql .=" order by `profileName` ASC LIMIT $Page_Start , $Per_Page";
        $values = mysql_query($sql,$con)or die(mysql_error());
        while($row =mysql_fetch_array($values))
        {
        ?>
    <tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
        <td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
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

    </tr>

    <?php
    $i++;
    $Maxid = $row['id'];
    $MaxI = $i;
    }
    ?>
    <input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

</div>
<?php
include('../../pagination/pages.php');
?>
