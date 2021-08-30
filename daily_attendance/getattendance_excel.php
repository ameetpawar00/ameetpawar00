<?php
	include("../include/conFig.php");

    if(isset($_POST['submit']))
    {
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $year = $_POST['year'];

        $startdate_d = strtotime($startdate);
        $start_day=date("j", $startdate_d);

        $enddate_d = strtotime($enddate);
        $end_day=date("j", $enddate_d);

        $report_name = "Daily_Attendance_Excel_".date('d-m-y').".xls";
        header("Content-Disposition: attachment; filename=\"$report_name\"");
        header("Content-Type: application/vnd.ms-excel");
 

 }

 if(isset($_POST['submit_view']))
    {
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $year = $_POST['year'];

        $startdate_d = strtotime($startdate);
        $start_day=date("j", $startdate_d);

        $enddate_d = strtotime($enddate);
        $end_day=date("j", $enddate_d);
?>

<style>
#topviewattend table {
  border: 1px solid #ddd;	
  border-collapse: collapse;
  width: 100%;
}
#topviewattend th, #topviewattend td {
  text-align: center;
  padding:0px 5px; border: 1px solid #ddd;height: 55px;
}
#topviewattend tr:nth-child(even){background-color: #f2f2f2}

#topviewattend th {
  background-color: #4984ef;
  color: white;
}
#rowfixed {
    position: sticky;
    width: 15em;
    left: 0;
    top: auto;
    background-color: #ccc;
}
#topviewattend {
    width: 1300px;
    overflow: scroll;
    padding: 0;
    position: sticky;
    height: 550px;
}
</style> 

 <?php } ?>



<html>
<head>
<title>Daily Attendance Excel <?php echo date('d-m-y'); ?> ></title>
</head>
<body>
<div id="topviewattend">
<table border="1">
<tr>
<div>	
<th id="rowfixed" class="toprowfields">Name</th>
<th class="toprowfields">Designation</th>
<?php for($j=$start_day; $j<=$end_day; $j++) { ?> 
<th class="toprowfields"> <?php echo $j; ?> <!-- Attendance Date --> </th>
<th class="toprowfields">Remark</th>
<th class="toprowfields">Comment</th>
<?php } ?>
</tr>

<?php 
   $get_department = mysql_query("SELECT `id`, `name` FROM `department` WHERE `id`!=1 AND `delete`=0");

   while($row_department = mysql_fetch_array($get_department))
   { $department_id = $row_department['id']; $department_name = $row_department['name']; ?> <!-- Start Department Loop -->

  <tr>
    <td id="rowfixed" style="background-color: green;color: white;"><?php echo $department_name; ?></td> 
    <?php for($k=$startdate; $k<=$enddate; $k++) { ?> 
     <!-- Start K (Selected Dates) Loop -->
     <td></td><td></td><td></td>
     <!-- End K (Selected Dates) Loop -->
   <?php } ?>
  </tr> 

<?php 
   $team = mysql_query("SELECT `id`,`name` FROM `team` WHERE `id`!=1 AND `delete`=0 AND `department_id`=$department_id ORDER BY name ASC");
   while($row_team=mysql_fetch_array($team))
   {
       $team_id=$row_team['id'];
       $team_name=$row_team['name'];

       ?> <!-- Start Team Loop -->

   <tr>
    <td id="rowfixed" style="background-color: blue;color: white;"><?php echo $team_name; ?></td>
    <?php for($k=$startdate; $k<=$enddate; $k++) { ?> 
     <!-- Start K (Selected Dates) Loop -->
     <td></td><td></td><td></td>
     <!-- End K (Selected Dates) Loop -->
   <?php } ?>
  </tr> 

   <?php 
       $teammates=mysql_query("SELECT `mateid` FROM `teamamtes` WHERE `teamid`='$team_id'");
       while ($row_teammates=mysql_fetch_array($teammates)) {
             $mateid = $row_teammates['mateid']; 
    ?>  <!-- Start Team Mates Id Loop -->
 

<?php
     $get_employee=mysql_query("SELECT employee.id,employee.name as ename,designation.name as dname FROM employee,designation WHERE employee.id=$mateid AND employee.designation=designation.id AND designation.id!=1 AND employee.delete = 0 AND employee.empstatus = 2"); 

     while($row_emp_designation = mysql_fetch_array($get_employee))
     {
           $eid=$row_emp_designation['id'];
           $ename=$row_emp_designation['ename'];
           $dname=$row_emp_designation['dname']; 
      ?> <!--  Start employee info loop -->
<tr>   
    <td id="rowfixed"><?php echo $ename; ?></td>
    <td><?php echo $dname; ?></td>

    <?php for($k=$startdate; $k<=$enddate; $k++) { ?>  <!-- Start K (Selected Dates) Loop -->
     <?php    
          $get_attendance = mysql_query("SELECT `id`, `current_date`, `attendance`,`remark`,`comment`,`emp_id` FROM daily_attendance WHERE `current_date` = '$k' AND '$enddate' AND `emp_id`='$eid' AND `delete`=0 AND `status`=1 AND `year`='$year'");
          $atten = mysql_num_rows($get_attendance);
          if($atten>0) { 
          while($row_emp_attendance = mysql_fetch_array($get_attendance))
          {             
              $emp_id=$row_emp_attendance['id'];
              $emp_current_date=$row_emp_attendance['current_date'];
              $emp_attendance=$row_emp_attendance['attendance'];
              $emp_remark=$row_emp_attendance['remark'];
              $emp_comment=$row_emp_attendance['comment'];
           ?> <!-- Start Attendance Loop -->


          
            <td <?php if($emp_attendance==1) { ?> style="background-color: white;color: black;text-align: center;" <?php }elseif($emp_attendance==2) { ?> style="background-color: red;color: white;text-align: center;" <?php }elseif ($emp_attendance==6) { ?>  style="background-color: lightblue;color: black;text-align: center;" <?php
            } ?>> 
			  <?php 
			     if($emp_attendance==1){
			      echo "P";
			     }else if($emp_attendance==2)
			      {
			        echo "A";
			      }else if($emp_attendance==3)
			       {
			        echo "WO-I";
			       }else if($emp_attendance==4)
			        {
			          echo "FHL";
			        }else if($emp_attendance==5)
			         {
			           echo "SHL";
			         }else if($emp_attendance==6)
			          {
			            echo "TP";
			          }else if($emp_attendance==7)
			          {
			            echo "ABSCOND";
			          }else if($emp_attendance==8)
			           {
			            echo "RESIGNATION";
			           }else if($emp_attendance==9)
			           {
			             echo "TERMINATION";
			           } else if($emp_attendance=='')
			           {
			             echo "TERMINATION";
			           } 
			    ?>
			</td>


			<td>
			  <?php 
			     if($emp_remark==1){
			      echo "INT-YES-APP";
			     }else if($emp_remark==2)
			      {
			        echo "INT-YES-UNAPP";
			      }else if($emp_remark==3)
			       {
			        echo "INT-NO-UNAPP";
			       }
			   ?>
            </td>

<td><?php echo $emp_comment; ?></td>



     <?php } } else { ?> <!-- End Attendance Loop -->

     <td style="background-color: yellow;"><?php echo "Holiday"; ?></td>
     <td><?php echo ""; ?></td>
     <td><?php echo ""; ?></td>

     <?php } ?> <!-- Close Else Loop --> <!-- End Else Attendance Loop -->

     <?php } ?> <!-- End K Loop -->
</tr>
   <?php  } ?> <!--  End employee info loop -->

<?php } ?> <!-- END Team Mates Id Loop -->
<?php } ?> <!-- END Team Loop -->
<?php } ?> <!-- END Department Loop -->


<!-- Start verticle Heads List -->
<tr>
  <td style="background-color: darkred;color: white;"><?php echo "Verticle Heads"; ?></td>
  <?php for($k=$startdate; $k<=$enddate; $k++) { ?> 
     <!-- Start K (Selected Dates) Loop -->
     <td></td><td></td><td></td>
     <!-- End K (Selected Dates) Loop -->
   <?php } ?>
</tr>
<?php
 $emp_info=mysql_query("SELECT employee.id,employee.name as ename,designation.name as dname FROM employee,designation WHERE employee.role IN (8,10) AND employee.designation=designation.id AND designation.id!=1 AND employee.delete = 0 AND employee.empstatus = 2"); 
    while($final_emp_info = mysql_fetch_assoc($emp_info))
    {  $veid=$final_emp_info['id']; $emp_name=$final_emp_info['ename']; $emp_dname=$final_emp_info['dname'];  ?> 
      
      <tr>
        <td><?php echo $emp_name; ?></td>
        <td><?php echo $emp_dname; ?></td>
        
         <?php for($k=$startdate; $k<=$enddate; $k++) { ?>  <!-- Start K (Selected Dates) Loop -->
     <?php    
          $get_attendance = mysql_query("SELECT `id`, `current_date`, `attendance`,`remark`,`comment`,`emp_id` FROM daily_attendance WHERE `current_date` = '$k' AND '$enddate' AND `emp_id`='$veid' AND `delete`=0 AND `status`=1 AND `year`='$year'");
          $atten = mysql_num_rows($get_attendance);
          if($atten>0) { 
          while($row_emp_attendance = mysql_fetch_array($get_attendance))
          {             
              $emp_id=$row_emp_attendance['id'];
              $emp_current_date=$row_emp_attendance['current_date'];
              $emp_attendance=$row_emp_attendance['attendance'];
              $emp_remark=$row_emp_attendance['remark'];
              $emp_comment=$row_emp_attendance['comment'];
           ?> <!-- Start Attendance Loop -->


          
            <td <?php if($emp_attendance==1) { ?> style="background-color: green;color: white;text-align: center;" <?php }else { ?> style="background-color: red;color: white;text-align: center;" <?php } ?>>

        <?php 
           if($emp_attendance==1){
            echo "P";
           }else if($emp_attendance==2)
            {
              echo "A";
            }else if($emp_attendance==3)
             {
              echo "WO-I";
             }else if($emp_attendance==4)
              {
                echo "FHL";
              }else if($emp_attendance==5)
               {
                 echo "SHL";
               }else if($emp_attendance==6)
                {
                  echo "TP";
                }else if($emp_attendance==7)
                {
                  echo "ABSCOND";
                }else if($emp_attendance==8)
                 {
                  echo "RESIGNATION";
                 }else if($emp_attendance==9)
                 {
                   echo "TERMINATION";
                 }
          ?>
      </td>


      <td>
        <?php 
           if($emp_remark==1){
            echo "INT-YES-APP";
           }else if($emp_remark==2)
            {
              echo "INT-YES-UNAPP";
            }else if($emp_remark==3)
             {
              echo "INT-NO-UNAPP";
             }
         ?>
            </td>

<td><?php echo $emp_comment; ?></td>

<?php } } else { ?> <!-- End Attendance Loop -->

<td style="background-color: yellow;"><?php echo "Holiday"; ?></td>
<td><?php echo ""; ?></td>
<td><?php echo ""; ?></td>

<?php } ?> <!-- Close Else Loop --> <!-- End Else Attendance Loop -->
 <?php } ?> <!-- End K Loop -->
</tr>
<?php } ?>
<!-- End verticle Heads List -->


</table>
</div>
</body>

</html>