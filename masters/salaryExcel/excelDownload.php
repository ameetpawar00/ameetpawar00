<?php
include("../../include/conFig.php");

$month = $_REQUEST['month'];
$year = $_REQUEST['year'];

$name = "Excel_Salary_Download_For_".date('M-y' ,strtotime('01-'.$month.'-'.$year)).".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

    $getBank = mysql_query("SELECT name,id FROM bank WHERE 1",$con)or die(mysql_error());
    while($rowBank=mysql_fetch_array($getBank))
    {
        $allBank[$rowBank["id"]]=$rowBank["name"];
    }
    $getDepart = mysql_query("SELECT name,id FROM department WHERE 1",$con)or die(mysql_error());
    while($rowDepart=mysql_fetch_array($getDepart))
    {
        $allDepart[$rowDepart["id"]]=$rowDepart["name"];
    }
    $getBranch = mysql_query("SELECT name,id FROM branch WHERE 1",$con)or die(mysql_error());
    while($rowBranch=mysql_fetch_array($getBranch))
    {
        $allBranch[$rowBranch["id"]]=$rowBranch["name"];
    }
//employee.id,employee.bank,employee.name,employee.emp_acc_name,employee.accountno
	//$getD = mysql_query("SELECT employee.emp_acc_name,employee.accountno,salaryslip_new.total_salary,bank.name FROM salaryslip_new JOIN employee ON salaryslip_new.employee = employee.id LEFT JOIN bank ON bank.id = employee.bank WHERE salaryslip_new.delete = '0' AND salaryslip_new.month = '$month' AND salaryslip_new.year = '$year' AND  employee.delete='0'  $condQuery",$con)or die(mysql_error());
	$getD = mysql_query("SELECT * FROM  `employee` WHERE empstatus =2 AND  `delete` =0",$con)or die(mysql_error());
	$datV = '01-'.$month.'-'.$year;
if(mysql_num_rows($getD) > 0)
{
    ?>
    <html>
    <head>
        <title>Excel Salary Download For <?php echo date('M - Y' ,strtotime($datV)); ?> ></title>
    </head>
    <body>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Account No.</th>
            <th>Bank Name</th>
            <th>Total Salary</th>
            <th>Remark</th>
            <th>Department</th>
            <th>Branch</th>
        </tr>
        <?php
        $i = 1;
        while($rowD = mysql_fetch_assoc($getD))
        {
           // print_r($rowD);
            $id=$rowD["id"];
            $emp_acc_name=$rowD["emp_acc_name"];
            $bank=$rowD["bank"];
            $branch=$allBranch[$rowD["branch"]];
            $department=$allDepart[$rowD["department"]];
            if(!$emp_acc_name)
            {
                $emp_acc_name=$name;
            }

            $accountno=$rowD["accountno"];

            $name=$rowD["name"];

            $bname="";
            if($allBank[$bank])
            {

                $bname=$allBank[$bank];
            }





            $getSald = mysql_query("SELECT salaryslip_new.total_salary FROM salaryslip_new WHERE salaryslip_new.employee=$id AND salaryslip_new.delete = '0' AND salaryslip_new.month = '$month' AND salaryslip_new.year = '$year'",$con)or die(mysql_error());
            $rowSald=mysql_fetch_array($getSald);
            $total_salary=$rowSald["total_salary"];

            $getsalDesc = mysql_query("SELECT description FROM salary_description WHERE salary_description.employeeid=$id AND salary_description.status = '0' AND salary_description.month = '$month' AND salary_description.year = '$year'",$con)or die(mysql_error());

            $rowSaldesc=mysql_fetch_array($getsalDesc);
            $description=$rowSaldesc["description"];

            ?>
            <tr>
                <th><?=$emp_acc_name?></th>
                <th><?=$accountno?></th>
                <th><?=$bname?></th>
                <th><?=$total_salary?></th>
                <th><?=$description?></th>
                <th><?=$department?></th>
                <th><?=$branch?></th>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    </body>
    </html>
    <?php
}
else
{
    echo '<h1 style="color:red">No Record Found For Download</h1>';
}
?>