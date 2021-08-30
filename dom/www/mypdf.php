<?php
include('../../include/conFig.php');
if(isset($_GET['id']) && isset($_GET['employee']))
{
$employee = $_GET['employee'];
$salId = $_GET['id'];
$empSql = "select employee.id,employee.name,employee.empid,employee.doj,employee.accountno,employee.pfaccount,employee.bank,location.name,designation.name from employee,designation,location where employee.id = '$employee' and employee.designation = designation.id and employee.location = location.id";
$getEmp = mysql_query($empSql,$con)or die(mysql_error());
$rowEmp = mysql_fetch_array($getEmp);
//Month Salary Details 
$getSalary = mysql_query("SELECT * FROM  `salaryslip` where `id` = '$salId'",$con) or die(mysql_error());
$rowSal = mysql_fetch_array($getSalary);
$mGross =$rowSal['gross']; 
$mHra=$rowSal['hra']; 
$mConv = $rowSal['conveyance']; 
$mBonus = $rowSal['bonus']; 
$mClaim = $rowSal['claim']; 
$mPf = $rowSal['pf']; 
 $mIns = $rowSal['insurance']; 
$mTotalSal =  $mGross + $mHra + $mConv + $mBonus + + $mClaim ;
$mDeduct =  $mPf+ $mIns;
//Total Salary Information
$getStarting = mysql_query("SELECT * FROM `salary` WHERE `eid` = '$employee' AND `delete` = '0' AND `increment` = '0'",$con) or die(mysql_error());
$rowStarting = mysql_fetch_array($getStarting);
$getInc = mysql_query("SELECT SUM(gross),SUM(hra),SUM(conveyance),SUM(bonus),SUM(pf),SUM(claim),SUM(insurance) FROM `salary` WHERE `eid` = '$employee' AND `delete` = '0' AND `increment` = '1'",$con) or die(mysql_error());
$rowInc = mysql_fetch_array($getInc);
$getDec = mysql_query("SELECT SUM(gross),SUM(hra),SUM(conveyance),SUM(bonus),SUM(pf),SUM(claim),SUM(insurance) FROM `salary` WHERE `eid` = '$employee' AND `delete` = '0' AND `increment` = '2'",$con) or die(mysql_error());
$rowDec = mysql_fetch_array($getDec);
//Calculation
$gross = ($rowStarting['gross'] + $rowInc[0]) - $rowDec[0];
$hra = ($rowStarting['hra'] + $rowInc[1]) - $rowDec[1];
$conv = ($rowStarting['conveyance'] + $rowInc[2]) - $rowDec[2];
$bonus = ($rowStarting['bonus'] + $rowInc[3]) - $rowDec[3];
$pf = ($rowStarting['pf'] + $rowInc[4]) - $rowDec[4];
$claim = ($rowStarting['claim'] + $rowInc[5]) - $rowDec[5];
$ins = ($rowStarting['insurance'] + $rowInc[6]) - $rowDec[6];
$finalSal = $gross + $hra + $conv + $bonus + $pf + $claim + $ins;
$netPay = $finalSal-$mDeduct;
$pdfName = $rowEmp[1]."_Salaryslip_For_Month_".strtoupper(date("F", mktime(0, 0, 0,  $rowSal['month'], 10))).".pdf";
}

$slipHtml .='<html>
<head>
<style>
body
{
margin:0px;
padding:0px;
}

</style>
</head>

<body><div style="width:720px;background: #eee;margin:0px">
<table border="0" cellpadding="0" cellspacing="0" style="width:720px;font-family:"Segoe UI", Tahoma, Geneva, Verdana;font-weight:bold;background: #f7f7f7;" >	
<tbody><tr>
		<td colspan="2" align="center" >
<div style="width:720px;background:#069">

	<!--	<img src="../../img/companylogo.png" alt="" width="150" style="margin:20px">-->
</div>		
</td>
		</tr>	<tr>
			<td colspan="3" align="center" style="height: 30px">Pay Slip for '. strtoupper(date("F", mktime(0, 0, 0,  $rowSal['month'], 10)). " - " .$rowSal['year']) .' </td>
		</tr>
		<tr>
			<td colspan="3" valign="top">
			<table cellpadding="0" cellspacing="0" border="1px" width="720px" style="font-size:13px;font-weight:bold;font-family:"Segoe UI",Arial, Tahoma, Geneva, Verdana;">
			<tbody><tr>
					<td align="left" style="line-height:200%; width: 160px;font-family:"Segoe UI",Arial, Tahoma, Geneva, Verdana;" valign="top">
					Employee Name<br>
Employee Code<br>
Location<br>
Payment<br>
PF A/c No<br>
Absent<br>

			
			</td>
		<td align="center" style=" border-top: 1px solid #000; border-bottom: 1px solid #000; line-height:200%; border-left:0px; width: 20px;" valign="top">
					:<br>:<br>:<br>:<br>:<br>:<br>
			
			
			</td>
			<td valign="top" align="left" style=" line-height:200%; width:  160px;">
'. $rowEmp[1] .'<br/>
'. $rowEmp[2] .'<br/>
'. $rowEmp[5] .'<br/>
'. $rowSal['mode'] .'<br/>
'. $rowEmp[4] .'<br/>
'. $rowSal['absent'] .'<br/>
			</td>
			<td align="left" style="line-height:200%; width:  160px;" valign="top">
Designation<br>
DOJ<br>
A/C No.<br>
Bank Name<br>
Present Days<br>
Leaves<br>
			
			</td>
			
				<td align="center" style=";line-height:200%;width:20px" valign="top">
			:<br>:<br>:<br>:<br>:<br>:<br>

			
			
			</td>
			<td valign="top" align="left" style="border:1px #222 solid;border-left:0px;;line-height:200%;width: 120px">
'. $rowEmp[6] .'<br>
'. date(('d,M Y'),strtotime($rowEmp[3])) .'<br>
'. $rowEmp[4] .'<br>
'. $rowEmp[5] .'<br>
'. $rowSal['present'] .'<br>
'. $rowSal['leave'] .'<br>


			</td>
			</tr>
			</tbody></table>
			
			
			
			</td>
			</tr>
			<tr>
			<td colsapn="5">
			<table border="1" style="width:720px;" cellpadding="0" cellspacing="0">	
		<tbody><tr>
			<th style="width: 120px">Particulars (Earning)</th>
			<th style="width: 66px">Rate</th>
			<th style="width: 62px">Amount</th>
			<th>Particulars (Deduction)</th>
			<th>Amount</th>
		</tr>
		<tr>
<td valign="top" align="center" style="font-size:13px;line-height:160%; width: 160px;">Basic
		<br>
		HRA<br>Conveyance<br>
		Bonus<br>
		Claim<br/>
		Pf<br>
		Insurance
		<br><br><br><br>		</td>
<td valign="top" align="right" style="font-size:13px;line-height:160%; width: 160px;">

		'. $gross .'&nbsp;&nbsp;<br>
	'. $hra .'&nbsp;&nbsp;<br>
		'. $conv .'&nbsp;&nbsp;<br>
		'. $bonus .'&nbsp;&nbsp;<br>
	'. $claim .'&nbsp;&nbsp;<br>
	'. $pf .'&nbsp;&nbsp;<br>
	'. $ins .'&nbsp;&nbsp;<br>
		</td>
<td valign="top" align="right" style="font-size:13px;line-height:160%; width:  160px">
		'. $mGross .'&nbsp;&nbsp;<br>
	'. $mHra .'&nbsp;&nbsp;<br>
		'. $mConv .'&nbsp;&nbsp;<br>
		'. $mBonus .'&nbsp;&nbsp;<br>
	'. $mClaim .'&nbsp;&nbsp;<br>
		</td>
<td valign="top" align="center" style="font-size:13px;line-height:160%;width:  160px">P.F.
<br>
Insurance
</td>
<td valign="top" align="center" style="font-size:13px;line-height:160%">
	'. $mPf .'&nbsp;&nbsp;<br>
	'. $mIns .'&nbsp;&nbsp;<br>

</td>
		</tr>
		
		<tr>
<td valign="top" align="center" style="font-size:13px;line-height:160%; width:  160px">Total</td>
<td valign="top" align="right" style="font-size:13px;line-height:160%; ">' .$finalSal. '&nbsp;&nbsp;</td>
<td valign="top" align="right" style="font-size:13px;line-height:160%; ">'.$mTotalSal.'&nbsp;&nbsp;</td>
<td valign="top" align="center" style="font-size:13px;line-height:160%">Total Deduct</td>
<td valign="top" align="center" style="font-size:13px;line-height:160%">'.$mDeduct.'&nbsp;&nbsp;</td>
		</tr>
			<tr>
<td valign="top" align="center" style="font-size:13px;line-height:160%; width:  160px;"></td>
<td valign="top" align="right" style="font-size:13px;line-height:160%; ">&nbsp;&nbsp;</td>
<td valign="top" align="right" style="font-size:13px;line-height:160%; ">&nbsp;&nbsp;</td>
<td valign="top" align="center" style="font-size:13px;line-height:160%">Net Payment</td>
<td valign="top" align="center" style="font-size:13px;line-height:160%">'.$netPay.'&nbsp;&nbsp;</td>
		</tr>
	
		
		
	<tr>
	<td colspan="3" style="height:20px;"></td>
	<td></td>
	<td></td>
	</tr>
	</tbody></table>
			</td>
			</tr>
	</tbody></table>
	</div></body>
</html>';
/*require_once("../dompdf_config.inc.php");

// We check wether the user is accessing the demo locally
$local = array("::1", "127.0.0.1");
$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);
  $dompdf = new DOMPDF();
  $dompdf->load_html($slipHtml);
  $dompdf->set_paper('a4', 'portrait');
  $dompdf->render();
	$pdf = $dompdf->output();
 $dompdf->stream($pdfName, array("Attachment" => false));

file_put_contents("saved_pdf.pdf", $pdf);
  exit(0);
 header("Content-type: application/pdf"); // add here more headers for diff. extensions
 header("Content-Disposition: attachment; filename=".$pdfName); // use 'attachment' to force a download*/
*/

?>
<form action="" method="post">
<input type="hidden" value="<?php echo $row[0]?>" name="id"/>
<input type="hidden" value="<?php echo $row[3]?>" name="employee"/>
<input type="hidden" value="<?php echo $row[1]?>" name="month"/>
</form>

	