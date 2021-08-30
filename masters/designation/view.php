<?php
    include("../../include/conFig.php");
    // $sql = "SELECT * FROM `designation` WHERE `delete`='0'";
    $sql = "SELECT `designation`.*,`department`.`name` as `pname` FROM `designation` LEFT JOIN `department` ON `designation`.`department`=`department`.`id` WHERE `designation`.`delete`='0'";
    $getData = mysql_query($sql,$con) or die(mysql_error());
    $Num_Rows = mysql_num_rows($getData);
    $Per_Page = 25;   // Per Page
    include('../../pagination/pagination.php');
    $folder= 'masters/designation/view';
    $title = 'designation';



    //$getData = mysql_query("SELECT * FROM `designation` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error());
?>
<div id="myTitle">
    <div class="title">View All Designation</div>
    <div class="strip">
        <span>Dashboard</span>
        <span>Designation</span>
        <span>View</span>
    </div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            <select class="input"  onchange="$('.allHide').hide();$('.'+$(this).val()).show();">
                <option value='allHide'>All Status</option>
                <option value='staActive'>Active</option>
                <option value='staInactive'>Inactive</option>
            </select>
            <select class="input" onchange="$('.allHide').hide();$('.'+$(this).val()).show();">
                <option value='allHide'>All Department</option>
                <?php

                    $sqlw = "SELECT * FROM `department` WHERE `delete`='0' AND `id`!=1";
                    $getDatas = mysql_query($sqlw,$con) or die(mysql_error());
                    while ($rowDatas=mysql_fetch_assoc($getDatas))
                    {
                        $ids=$rowDatas["id"];
                        $names=$rowDatas["name"];
                        echo "<option value='department".$ids."'>$names</option>";
                    }
                ?>
            </select>
            <?php if(in_array('a_MDesi',$thisper))
            {
                ?>
                <button class="button blue" onclick="getModule('masters/designation/index','manipulateContent','viewContent','Asset')"> <i class="plus"></i>New Designation</button>&nbsp;
                <?php
            }
            ?>
            <?php if(in_array('d_MDesi',$thisper))
            {
                ?>
                <button class="button red" onclick="deleteData('designation','Designation')"> <i class="delete-icon"></i>Delete</button>&nbsp;
                <?php
            }
            ?>
            &nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
                <i class="back"></i>Back</button>
        </td>
    </tr>
</table>

<div style="height:350px;overflow:auto" id="mainDivId">
    <table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
        <tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
            <th >Name</th>
            <th style="height: 30px">Department</th>
            <th style="height: 30px">Status</th>
            <th style="height: 30px">Description</th>
            <th >Modified</th>
        </tr>
        <?php
            $i = 1;
            $sql .=" order by `name` ASC ";//LIMIT $Page_Start , $Per_Page
            $values = mysql_query($sql,$con)or die(mysql_error());
            while($row =mysql_fetch_array($values))
            {

                        if($row['status']==0)
                        {
                            $status= "Active";
                            $statusas= "Active";
                        }else{
                            $status= "Inactive";
                            $statusas= "<span style='color: red'>Inactive</span>";
                        }

                ?>
                <tr class="d<?php echo $i%2?> allHide department<?=$row['department']?> sta<?=$status?>"  id="fetchrow<?php echo $i?>">
                    <td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
                    <?php
                        if(in_array('u_MDesi',$thisper))
                        {
                            ?>
                            <td class="link-blue" onclick="getModule('masters/designation/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Designation')"><?php echo $row['name'] ?></td>
                            <?php
                        }
                        else
                        {
                            ?>
                            <td ><?php echo $row['name']?></td>
                            <?php
                        }
                    ?>
                    <td><?php echo $row['pname'] ?></td>
                    <td>
                        <?=$statusas?>
                    </td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>
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
/*    include('../../pagination/pages.php');
*/?>
