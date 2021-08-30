<?php 
include("../include/conFig.php");
 $startdate = date('Y-m-01');
 $enddate = date('Y-m-d');

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
  padding: 8px; border: 1px solid #ddd;
}
#topviewattend tr:nth-child(even){background-color: #f2f2f2}

#topviewattend th {
  background-color: #4984ef;
  color: white;
}
</style>

<div class="title">View Attendance</div>
<div class="strip">
	<span>Dashboard</span>
	<span>View Attendance</span>
	<span>Team Attendance</span>
</div>

<?php 
       function userlist($hrmloggedid,$startdate,$enddate,$year)
       { 
           $user_dropdown=mysql_query("SELECT employee.id,employee.name as ename,employee.salaryId,employee.designation,teamamtes.mateid,designation.name as dname FROM employee,team,teamamtes,designation WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 AND employee.designation=designation.id");
           while($row_team=mysql_fetch_array($user_dropdown))
           {
                $empid=$row_team['id'];      
                echo '<tr>';
                echo '<td>'.$row_team['ename'].'</td>';
                echo '<td>'.$row_team['dname'].'</td>';                
           for($k=$startdate; $k<=$enddate; $k++) 
           {
                $get_attendance = mysql_query("SELECT `id`, `current_date`, `attendance`,`remark`,`comment`,`emp_id` FROM daily_attendance WHERE `current_date` = '$k' AND `emp_id`='$empid' AND `delete`=0 AND `status`=1 AND `year`='$year'");
                $atten = mysql_num_rows($get_attendance);
               if($atten>0) 
               { 
                 while($row_emp_attendance = mysql_fetch_array($get_attendance))
                 {             
                    $emp_id=$row_emp_attendance['id'];
                    $emp_current_date=$row_emp_attendance['current_date'];
                    $emp_attendance=$row_emp_attendance['attendance'];
                    $emp_remark=$row_emp_attendance['remark'];
                    $emp_comment=$row_emp_attendance['comment'];

                    /* Start condition for td backdround color */
                    if($emp_attendance==1){
                    echo '<td style="background-color: green;color: white;text-align: center;">';
                    }else{echo '<td style="background-color: red;color: white;text-align: center;">';}
                    /* End condition for td backdround color */

                    if($emp_attendance==1){
                      echo "P";
                    }
                    else if($emp_attendance==2)
                    {
                     echo "A";
                    }
                    else if($emp_attendance==3)
                    {
                      echo "WO-I";
                    }
                    else if($emp_attendance==4)
                    {
                      echo "FHL";
                    }
                    else if($emp_attendance==5)
                    {
                      echo "SHL";
                    }
                    else if($emp_attendance==6)
                    {
                      echo "TP";
                    }
                    else if($emp_attendance==7)
                    {
                      echo "ABSCOND";
                    }
                    else if($emp_attendance==8)
                    {
                      echo "RESIGNATION";
                    }
                    else if($emp_attendance==9)
                    {
                      echo "TERMINATION";
                    } 
                    echo'</td>';

                    echo '<td>';
                    if($emp_remark==1){
                       echo "INT-YES-APP";
                    }
                    else if($emp_remark==2)
                    {
                       echo "INT-YES-UNAPP";
                    }
                    else if($emp_remark==3)
                    {
                       echo "INT-NO-UNAPP";
                    }
                    echo '</td>';

                   echo '<td>'.$emp_comment.'</td>';

                 }
               }
               else 
               { 
                   echo '<td>'." ".'</td>';
                   echo '<td>'." ".'</td>';
                   echo '<td>'." ".'</td>';
                   
               } 
            }           
            echo '</tr>';
            userlist($empid,$startdate,$enddate,$year); 
           }

       }
?>
<div style="overflow-x:scroll;overflow-y:scroll;height:380px" id="topviewattend">
<table>
<tr>
<th>Name</th>
<th>Designation</th>
<?php for($j=$start_day; $j<=$end_day; $j++) { ?> 
<th> <?php echo $j; ?> Attendance</th>
<th>Remark</th>
<th>Comment</th>
<?php } ?>
</tr>
<?php userlist($hrmloggedid,$startdate,$enddate,$year); ?>
</table>
</div>

<?php /* ?>
<div style="overflow-x:scroll;overflow-y:scroll;height:180px" id="topviewattend">
<table>
<tr>
<th>Name</th>
<th>Designation</th>
<?php for($j=$start_day; $j<=$end_day; $j++) { ?> 
<th> <?php echo $j; ?> Attendance</th>
<th>Remark</th>
<th>Comment</th>
<?php } ?>
</tr>


<?php 
   $get_team = mysql_query("SELECT `id` FROM `team` WHERE `leader`='$hrmloggedid' AND `delete`=0");

   while($row_team = mysql_fetch_array($get_team))
   {  $team_id = $row_team['id'];
     
    ?> <!-- Start Department Loop -->
 
<?php $teammates=mysql_query("SELECT `mateid` FROM `teamamtes` WHERE `teamid`='$team_id'");
      while($row_teammates = mysql_fetch_array($teammates))
      {
      	   $teammates_list=$row_teammates['mateid']; 
      ?>

<?php
     $get_employee=mysql_query("SELECT employee.id,employee.name as ename,designation.name as dname FROM employee,designation WHERE employee.id=$teammates_list AND employee.designation=designation.id AND designation.id!=1 AND employee.delete = 0 AND employee.empstatus = 2");

     while($row_emp_designation = mysql_fetch_array($get_employee))
     {
           $eid=$row_emp_designation['id'];
           $ename=$row_emp_designation['ename'];
           $dname=$row_emp_designation['dname']; 
      ?> <!--  Start employee info loop -->
<tr>   
    <td><?php echo $ename; ?></td>
    <td><?php echo $dname; ?></td>

    <?php for($k=$startdate; $k<=$enddate; $k++) { ?> 
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

     <td><?php echo ""; ?></td>
     <td><?php echo ""; ?></td>
     <td><?php echo ""; ?></td>

     <?php } ?> <!-- Close Else Loop -->

     <?php } ?> <!-- End K Loop -->
</tr>
   <?php  } ?> <!--  End employee info loop -->

<?php } } ?> <!-- END Team & Teammates Loop -->


</table>
</div>

<?php */ ?>