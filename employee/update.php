<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
    $val = str_ireplace("'","\'",$val);
    $post[] .= $val;
}

if($post[42]=="")
{
    $post[42]=0;
}
if($post[43]=="")
{
    $post[43]=0;
}
if($post[44]=="")
{
    $post[44]=0;
}
if($post[45]=="")
{
    $post[45]=0;
}
if($post[47]=="")
{
    $post[47]=0;
}
$getData = mysql_query("SELECT `mobile`, `phone`, `workphone`, `department`, `designation`, `salaryId`, `branch`, `empstatus`, `PF`, `ESIC`, `PT`, `TDS`, `LTB`, `uan_no`,`attenid`,`username`, `password`, `empid`, `salaryId`, `doj`, `dob`, `accountno`,  `PAN_NO`, `active`, `shift`, `aadhar_no`, `role`,`pfaccount`, `ESICNO`, `uan_no`, `salaryIdNew`, `PFFX` FROM `employee` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
if($row[0] != $post[16])
{
    $subject = 'Mobile no. is changed';
    $note = "Previous no.".$row[0]."and new no. is".$post[16].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}
//echo "-".$row['PF']."-".$post[42]."-";
if($row['PF'] != $post[42])
{
    $act1='Deactivated';
    if($post[42]=='1')
    {
        $act1='Activated';
    }
    $pact1='Deactivated';
    if($row['PF']=='1')
    {
        $pact1='Activated';
    }
    $subject = 'PF status changed';
    $note = "Previously $pact1 and Now $act1";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if(!$post[52])
{
    $post[52]=0;
}
echo "--".$row['PFFX']."---".$post[52]."--";
if($row['PFFX'] != $post[52])
{
    $act1='Fixed';
    if($post[52]=='1')
    {
        $act1='Floating';
    }
    $pact1='Fixed';
    if($row['PFFX']=='1')
    {
        $pact1='Floating';
    }
    $subject = 'PFD status changed';
    $note = "Previously $pact1 and Now $act1";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row['ESIC'] != $post[43])
{
    $act2='Deactivated';
    if($post[43]=='1')
    {
        $act2='Activated';
    }
    $pact2='Deactivated';
    if($row['ESIC']=='1')
    {
        $pact2='Activated';
    }
    $subject = 'ESIC status changed';
    $note = "Previously $pact2 and Now $act2";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row['PT'] != $post[44])
{
    $act3='Deactivated';
    if($post[44]=='1')
    {
        $act3='Activated';
    }
    $pact3='Deactivated';
    if($row['PT']=='1')
    {
        $pact3='Activated';
    }
    $subject = 'PT status changed';
    $note = "Previously $pact3 and Now $act3";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row['TDS'] != $post[45])
{
    $act4='Deactivated';
    if($post[45]=='1')
    {
        $act4='Activated';
    }
    $pact4='Deactivated';
    if($row['TDS']=='1')
    {
        $pact4='Activated';
    }
    $subject = 'TDS status changed';
    $note = "Previously $pact4 and Now $act4";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}
if($row['LTB'] != $post[47])
{
    $act5='Deactivated';
    if($post[47]=='1')
    {
        $act5='Activated';
    }
    $pact5='Deactivated';
    if($row['LTB']=='1')
    {
        $pact5='Activated';
    }
    $subject = 'LTB status changed';
    $note = "Previously $pact5 and Now $act5";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row['uan_no'] != $post[48])
{
    $asx=$row['uan_no'];
    $asax=$post[48];
    $subject = 'UAN No. changed';
    $note = "Previously $asx and Now $asax";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row['ESICNO'] != $post[49])
{
    $asxs=$row['ESICNO'];
    $asaxs=$post[49];
    $subject = 'ESIC No. changed';
    $note = "Previously $asxs and Now $asaxs";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row[1] != $post[5])
{
    $subject = 'Phone no. is changed';
    $note = "Previous no.".$row[1]."and new no. is".$post[5].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row[2] != $post[8])
{
    $act='On Job Trainee (OJT)';
    if($post[2]==1)
    {
        $act='Regular';
    }
    $pact='On Job Trainee (OJT)';
    if($post[8]==1)
    {
        $pact='Regular';
    }

    $subject = 'On Job Status is changed';
    $note = "Previously $act and Now $pact";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row[3] != $post[7])
{
    $depA = array();
    $getdep = mysql_query("SELECT `name`,`id` FROM `department` WHERE `id` IN ($row[3],$post[7])",$con) or die(mysql_error());
    while($rowdep = mysql_fetch_array($getdep))
    {
        $depA[$rowdep[1]] = $rowdep[0];
    }
    $subject = 'Department is changed';
    $note = "Previous department is ".$depA[$row[3]]." and new department is ".$depA[$post[7]].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row[4] != $post[6])
{
    $desiA = array();
    $getdesi = mysql_query("SELECT `name`,`id` FROM `designation` WHERE `id` IN ($row[4],$post[6])",$con) or die(mysql_error());
    while($rowdesi = mysql_fetch_array($getdesi))
    {
        $desiA[$rowdesi[1]] = $rowdesi[0];
    }

    $subject = 'Designation is changed';
    $note = "Previous designation is ".$desiA[$row[4]]." and new designation is ".$desiA[$post[6]].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row[5] != $post[11])
{
    $salpA = array();
    $getsalp = mysql_query("SELECT `salprofile`,`id` FROM `salary` WHERE `id` IN ($row[5],$post[11])",$con) or die(mysql_error());
    while($rowsalp = mysql_fetch_array($getsalp))
    {
        $salpA[$rowsalp[1]] = $rowsalp[0];
    }

    $subject = 'Salary Profile is changed';
    $note = "Previous Salary Profile is ".$salpA[$row[5]]." and new Salary Profile is ".$salpA[$post[11]].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}



if($row["salaryIdNew"] != $post[53])
{
    $salpA = array();
    $salaryIdNew=$row['salaryIdNew'];
    $getsalp = mysql_query("SELECT `profileName`,`id` FROM `salary_structure_new` WHERE `id` IN ($salaryIdNew,$post[53])",$con) or die(mysql_error());
    while($rowsalp = mysql_fetch_array($getsalp))
    {
        $salpA[$rowsalp[1]] = $rowsalp[0];
    }

    $subject = 'Salary Profile is changed (New)';
    $note = "Previous Salary Profile is ".$salpA[$salaryIdNew]." and new Salary Profile is ".$salpA[$post[53]].".";
    $note=addslashes($note);
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}



if($row[6] != $post[15])
{
    $branA = array();
    $getbranch = mysql_query("SELECT `name`,`id` FROM `branch` WHERE `id` IN ($row[6],$post[15])",$con) or die(mysql_error());
    while($rowbranch = mysql_fetch_array($getbranch))
    {
        $branA[$rowbranch[1]] = $rowbranch[0];
    }
    $subject = 'Branch is changed';
    $note = "Previous branch is ".$branA[$row[6]]." and new branch is ".$branA[$post[15]].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}
if($row[7] != $post[14])
{
    $empA = array();
    $getempS = mysql_query("SELECT `name`,`id` FROM `employeestatus` WHERE `id` IN ($row[7],$post[14])",$con) or die(mysql_error());
    while($rowempS = mysql_fetch_array($getempS))
    {
        $empA[$rowempS[1]] = $rowempS[0];
    }
    $subject = 'Employee Status is changed';
    $note = "Previous Employee Status is ".$empA[$row[7]]." and new Employee Status is ".$empA[$post[14]].".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}
if($row["username"] != $post[0])
{
    $subject = 'Employee Username is changed';
    $note = "Previous Employee Username is ".$row["username"]." and new Employee Username is ".$post[0].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

/*	if($row["ESICNO"] != $post[49])
	{
		$subject = 'Employee UAN No. is changed';
		$note = "Previous Employee  ESICNO No. is ".$row["ESICNO"]." and new Employee  ESICNO No. is ".$post[49].".";
		
		mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}
	if($row["uan_no"] != $post[48])
	{
		$subject = 'Employee UAN No. is changed';
		$note = "Previous Employee  UAN No. is ".$row["uan_no"]." and new Employee  UAN No. is ".$post[48].".";
		
		mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}*/
if($row["pfaccount"] != $post[29])
{
    $subject = 'Employee PF Account No. is changed';
    $note = "Previous Employee  PF Account No. is ".$row["pfaccount"]." and new Employee  PF Account No. is ".$post[29].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row["empid"] != $post[2])
{
    $subject = 'Employee Id is changed';
    $note = "Previous Employee Id is ".$row["empid"]." and new Employee Id is ".$post[2].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}


if($row["doj"] != $post[13])
{
    $subject = 'Employee Date of Joining is changed';
    $note = "Previous  Date of Joining is ".$row["doj"]." and new  Date of Joining is ".$post[13].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row["dob"] != $post[17])
{
    $subject = 'Employee Date of Birth is changed';
    $note = "Previous  Date of Birth is ".$row["dob"]." and new  Date of Birth is ".$post[17].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}


if($row["accountno"] != $post[28])
{
    $subject = 'Employee Account Number is changed';
    $note = "Previous Account Number is ".$row["accountno"]." and new   Account Number is ".$post[28].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}


if($row["PAN_NO"] != $post[37])
{
    $subject = 'Employee Pan Card Number is changed';
    $note = "Previous Pan Card Number is ".$row["PAN_NO"]." and new Pan Card Number is ".$post[37].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row["aadhar_no"] != $post[38])
{
    $subject = 'Employee Aadhar Card Number is changed';
    $note = "Previous Aadhar Card Number is ".$row["aadhar_no"]." and new Aadhar Card Number is ".$post[38].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}




if($row["role"] != $post[31])
{

    $getShirft = mysql_query("SELECT  `name`, `id` FROM `rolls` WHERE `delete`=0",$con) or die(mysql_error());
    while($arowhift = mysql_fetch_array($getShirft))
    {
        $empsA[$arowhift[1]] = $arowhift[0];
    }


    $subject = 'Employee Role is changed';
    $note = "Previous Role is ".$empsA[$row["role"]]." and new Role is ".$empsA[$post[31]].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row["shift"] != $post[36])
{
    $getShift = mysql_query("SELECT  `name`, `id` FROM `shift` WHERE `delete`=0",$con) or die(mysql_error());
    while($rowhift = mysql_fetch_array($getShift))
    {
        $empA[$rowempS[1]] = $rowempS[0];
    }



    $subject = 'Employee Shift is changed';
    $note = "Previous Shift is ".$empA[$row["shift"]]." and new Shift is ".$empA[$post[36]].".";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}
/*	if($row["active"] != $post[24])
	{
		$subject = 'Employee Active is changed';
		$note = "Previous Active is ".$row["active"]." and new Active is ".$post[24].".";
		
		mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}
	*/
$attendenceId=trim($post[32]," ");
if($row["attenid"] != $attendenceId)
{
    $subject = 'Attendence Id is changed';
    $note = "Previous Attendence Id is ".$row["attenid"]." and new Attendence Id is ".$attendenceId.".";
    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}


if($row[7]==9 AND $post[14]==2)
{
    $fedt=mysql_query("SELECT * FROM `emp_ltb_with_extra` WHERE `eid`='$id'",$con) or die(mysql_error());
    $checkno=mysql_num_rows($fedt);
    $fedtrow=mysql_fetch_array($fedt);
    if($checkno>0)
    {
        mysql_query("UPDATE `emp_ltb_with_extra` SET `updatedby`='$hrmloggedid', `date`='$datetime', `type`='1' WHERE `eid`='$id'",$con) or die(mysql_error());

    }else{
        mysql_query("INSERT INTO `emp_ltb_with_extra`(`eid`, `date`, `updatedby`,`type`) VALUES ('$id', '$datetime', '$hrmloggedid', '1')",$con) or die(mysql_error());
    }
}
//echo $post[50];
mysql_query("UPDATE `employee` SET `name`='$post[3]', `mobile`='$post[16]',`phone`='$post[5]',`workphone`='$post[8]',`username`='$post[0]',`password`='$post[1]',`email`='$post[4]',`workemail`='$post[9]',`empid`='$post[2]',`department`='$post[7]',`designation`='$post[6]', `location`='$post[10]',`salaryId`='$post[11]',`hiresource`='$post[12]',`branch`='$post[15]',`doj`='$post[13]',`dob`='$post[17]',`doa`='$post[20]',`marital`='$post[19]',`gender`='$post[25]',`address`='$post[18]',`city`= '$post[23]',`specialization`='$post[22]',`jobdescription`='$post[21]',`about`='$post[26]',`image`='',`updatedate`='$datetime',`updatedby`='$hrmloggedid',`active`= '$post[24]',`bank`='$post[27]',`accountno`='$post[28]',`pfaccount`='$post[29]', `referredby` = '$post[30]',`role`='$post[31]',`attenid`='$attendenceId',`empstatus` = '$post[14]',`lastname` = '$post[33]',`tempAddress` = '$post[34]',`r_leave` = '$post[35]',`shift` = '$post[36]',`PAN_NO` = '$post[37]',`aadhar_no` = '$post[38]',`dol` = '$post[39]',`dor` = '$post[40]',`dop` = '$post[41]',`PF`='$post[42]',`ESIC`='$post[43]',`PT`='$post[44]',`TDS`='$post[45]',`saldistyp`='$post[46]',`LTB`='$post[47]',`uan_no`='$post[48]',`ESICNO`='$post[49]',`emp_acc_name`='$post[50]',`depcheck`='$post[51]',`PFFX`='$post[52]',`salaryIdNew`='$post[53]' WHERE `id` = '$id'",$con) or die(mysql_error());
$dateOne = date("Y-m-d");
mysql_query("INSERT INTO `salaryprofilestory`(`empId`, `salaryProfile`, `date`, `datetime`)  VALUES ('$id','$post[11]','$dateOne','$datetime')",$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
    Employee Updated Successfully</div>