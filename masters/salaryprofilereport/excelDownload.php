<?php
    include("../../include/conFig.php");
    if(isset($_POST['excelDo'])){


        $getSalary = mysql_query("
                                            SELECT 
                                                `salary_structure_new`.`profileName`, 
                                                `employee`.`name` as `empname`,
                                                `designation`.`name` as `desigempname`,
                                                `department`.`name` as `deparempname`
                                            FROM  
                                                `salary_structure_new`,
                                                `employee`,
                                                `designation`,
                                                `department`                                                
                                            where 
                                                `salary_structure_new`.`delete` = '0' 
                                            AND  
                                                `employee`.`delete` = '0' 
                                            AND  
                                                `employee`.`salaryIdNew`=`salary_structure_new`.`id`
                                            AND
                                                `employee`.`empstatus`=2
                                            AND
                                                `employee`.`active`=1
                                            AND 
                                                `employee`.`designation`=`designation`.`id`
                                            AND     
                                                `employee`.`department`=`department`.`id`
                                            
                                            ",$con) or die(mysql_error());

    $headerRow=<<<AAA
                    <th style="background:rgb(194, 214, 154)">Employee</th>
                    <th style="background:rgb(194, 214, 154)">Designation</th>
                    <th style="background:rgb(194, 214, 154)">Department</th>
                    <th style="background:rgb(194, 214, 154)">Profile</th>
AAA;



			
	echo $xasd= <<<AAA
<html>
	<head>
		<title>Excel Salary Profile</title>
	</head>
	<body>
		
		<table border="1">
			<tr>
				<th colspan='4'>
					Trifid Research Pvt. Ltd.
				</th>
			</tr>
			<tr>
				<th colspan='4'>
					Salary Profile Report
				</th>
			</tr>
			<tr>
			    $headerRow
			</tr>

AAA;
			$name = "Excel_Salary_profile_Download.xls";
			header("Content-Disposition: attachment; filename=\"$name\"");
			header("Content-Type: application/vnd.ms-excel");

            $currentRow="";
            while($rowSal = mysql_fetch_assoc($getSalary))
            {
                $profileName=$rowSal["profileName"];
                $empname=$rowSal["empname"];
                $desigempname=$rowSal["desigempname"];
                $deparempname=$rowSal["deparempname"];
                $currentRow.=<<<AAA
                                    <tr>
                                        <th>$empname</th>
                                        <th>$desigempname</th>
                                        <th>$deparempname</th>
                                        <th>$profileName</th>
                                    </tr>
AAA;
            }


			echo $currentRow;
    }
			?>
		</table>
	</body>
</html>
