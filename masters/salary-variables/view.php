<?php
include("../../include/conFig.php");


?>
<div id="myTitle">
    <div class="title">View Salary Variables</div>
    <div class="strip">
        <span>Dashboard</span>
        <span>Salary Variables</span>
        <span>View</span>
    </div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            &nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
                <i class="back"></i>Back</button>
        </td>
    </tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
    <br>
    <div style="background: #ffc600;padding: 7px;width: 50%;text-align: center;margin: 0 auto;">
        <select onchange="var a=$(this).val();$('.blcks').hide(); $('#'+a).show(); ">
            <option>Select One Option</option>
            <option>PF</option>
            <option>ESIC</option>
            <option>PT</option>
        </select>
    </div>
    <div style="background: #ffea00;padding: 7px;width: 50%;text-align: center;margin: 0 auto;display:none" class="blcks" id="PF">

        <input  id="inpclallp1" value="pf"  type="hidden"><br>
        PF-Employee % : <input  id="inpclallp2" value="" style="width: ;" type="text"><br>
        PF-Company % : <input  id="inpclallp3" value="" style="width: ;" type="text"><br><br>
        <input class="button blue "  value="Changes will Apply To all" onclick="SaveData('masters/salary-variables/saveall','inpclallp','4','','','','1');" type="button">
    </div>
    <div style="background: #ffea00;padding: 7px;width: 50%;text-align: center;margin: 0 auto;display:none" id="ESIC" class="blcks">
        <input  id="inpclalle1" value="esic" type="hidden"><br>
        ESIC-Employee % : <input  id="inpclalle2" value="" style="width: ;" type="text"><br>
        ESIC-Company % : <input  id="inpclalle3" value="" style="width: ;" type="text"><br><br>
        <input class="button blue "  value="Changes will Apply To all" onclick="SaveData('masters/salary-variables/saveall','inpclalle','4','','','','1');" type="button">
    </div>
    <div style="background: #ffea00;padding: 7px;width: 50%;text-align: center;margin: 0 auto;display:none" id="PT" class="blcks">
        <input  id="inpclallt1" value="pt" type="hidden"><br>
        PT : <input  id="inpclallt2" value="" type="text"><br><br>
        <input class="button blue "  value="Changes will Apply To all" onclick="SaveData('masters/salary-variables/saveall','inpclallt','3','','','','1');" type="button">
    </div>
    <br>

    <table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
        <tr>
            <th >No.</th>
            <th>Profile</th>
            <th>Basic</th>
            <th>PF-Employee %</th>
            <th>PF-Company %</th>
            <th>ESIC-Employee %</th>
            <th>ESIC-Company %</th>
            <th>PT</th>
            <th>Action</th>
        </tr>
        <?php
        $i = 1;
        $sql = "
        SELECT  
            `ssn`.`id` as `spid`,
            `ssn`.`profileName`,
            MAX(CASE WHEN  `ssr`.`variableid` IN (1) THEN  `ssr`.`variablevalue` ELSE NULL END) `basic`,
            MAX(CASE WHEN `ssr`.`variableid` IN (10, 16) THEN `ssr`.`variablevalue` ELSE NULL END) `pfe`,
            MAX(CASE WHEN `ssr`.`variableid` IN (11, 17) THEN `ssr`.`variablevalue` ELSE NULL END) `pfc`,
            MAX(CASE WHEN `ssr`.`variableid` IN (12) THEN `ssr`.`variablevalue` ELSE NULL END) `esice`, 
            MAX(CASE WHEN `ssr`.`variableid` IN (13) THEN `ssr`.`variablevalue` ELSE NULL END) `esicc`,
            MAX(CASE WHEN  `ssr`.`variableid` IN (14) THEN  `ssr`.`variablevalue` ELSE NULL END) `pt`
        FROM  
            `salary_structure_new`  `ssn` 
        LEFT JOIN  
            `salary_structure_relation_new`  `ssr` 
        ON  
            `ssn`.`id` =  `ssr`.`profileid` 
        LEFT JOIN  
            `salary_structure_variables_new`  `ssvn` 
        ON  
            `ssvn`.`id` =  `ssr`.`variableid` 
        GROUP BY  
            `ssn`.`id` ,  
            `ssn`.`profileName`
        ";
       // $sql = "SELECT `salary`.`id` as `spid`, `salary`.`salprofile`, `salary`.`basic`, `salary_variables`.`id`, `salary_variables`.`pfe`, `salary_variables`.`pfc`, `salary_variables`.`esice`, `salary_variables`.`esicc`, `salary_variables`.`pt`, `salary_variables`.`status` FROM `salary` LEFT JOIN `salary_variables` ON `salary`.`id`=`salary_variables`.`spid` WHERE  `salary`.`delete`='0' AND `salary`.`basic`<15000";

        $values = mysql_query($sql,$con)or die(mysql_error());
        $allspid="";
        while($row =mysql_fetch_assoc($values))
        {
//print_r($row);
            $hdder="";
                ?>
                <tr style="<?=$hdder?>" class="d<?php echo $i%2?>  "  id="fetchrow<?php echo $i?>">

                    <td><?=$i;?><span id="ebtbn"></span><input type="hidden" id="inpcl<?=$row['spid']?>0" value="<?=$row['spid']?>"/></td>

                    <td><?=$row['profileName'];?></td>
                    <td><input type="hidden" id="inpcl<?=$row['spid']?>6" value="<?=$row['basic']?>"/><?=$row['basic'];?></td>
                    <td><input class="inpcl<?=$row['spid']?>" type="text" id="inpcl<?=$row['spid']?>1" value="<?=$row['pfe'];?>" style="width: 50px;display:none"/><?=$row['pfe'];?></td>
                    <td><input class="inpcl<?=$row['spid']?>" type="text" id="inpcl<?=$row['spid']?>2" value="<?=$row['pfc'];?>"  style="width: 50px;display:none"/><?=$row['pfc'];?></td>
                    <td><input class="inpcl<?=$row['spid']?>" type="text" id="inpcl<?=$row['spid']?>3" value="<?=$row['esice'];?>"  style="width: 50px;display:none"/><?=$row['esice'];?></td>
                    <td><input class="inpcl<?=$row['spid']?>" type="text" id="inpcl<?=$row['spid']?>4" value="<?=$row['esicc'];?>"  style="width: 50px;display:none"/><?=$row['esicc'];?></td>
                    <td><input class="inpcl<?=$row['spid']?>" type="text" id="inpcl<?=$row['spid']?>5" value="<?=$row['pt'];?>"  style="width: 50px;display:none"/><?=$row['pt'];?></td>
                    <td>
                        <input type="button" class="button blue enpcl<?=$row['spid']?>" value="Edit" onclick="$(this).hide();$('.inpcl<?=$row['spid']?>').show(); $('.snpcl<?=$row['spid']?>').show();" >

                        <input type="button" class="button green snpcl<?=$row['spid']?>" value="Save" onclick="SaveData('masters/salary-variables/save','inpcl<?=$row['spid']?>','7','','','','1');" style="display:none" >

                        <a href="#"  class="inpcl<?=$row['spid']?>" onclick="$('.inpcl<?=$row['spid']?>').hide();$('.enpcl<?=$row['spid']?>').show();$('.snpcl<?=$row['spid']?>').hide();" style="display:none">cancel</a>
                    </td>
                </tr>
                <?php

            $allspid.=$row['spid']."@*@*@".$row['basic']."@*@*@".$row['pfe']."@*@*@".$row['pfc']."@*@*@".$row['esice']."@*@*@".$row['esicc']."@*@*@".$row['pt']."$@$@$";
            $i++;
        }
        ?>
        <input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
        <input id="inpclallp0" type="hidden" value="<?=$allspid?>" />
        <input id="inpclalle0" type="hidden" value="<?=$allspid?>" />
        <input id="inpclallt0" type="hidden" value="<?=$allspid?>" />
    </table>

</div>
<?php
include('../../pagination/pages.php');
?>
