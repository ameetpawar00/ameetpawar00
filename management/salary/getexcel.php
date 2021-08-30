<?php
    include("../../include/conFig.php");
    include("../../include/calculateAbsent_trifid.php");


    function getcalendar($month_at,$year_at)
    {
        include("../../include/conFig.php");
        $sqlCalCount = 0;
        $caldate = array();
        $sqlCalendar = mysql_query("SELECT `date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$month_at' AND  YEAR(`date`) ='$year_at' AND `delete` = '0' AND `holidayType`='0'",$con);
//echo "SELECT `date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$month_at' AND  YEAR(`date`) ='$year_at' AND `delete` = '0'";
        $sqlCalCount = mysql_num_rows($sqlCalendar);
        while($rowCal = mysql_fetch_array($sqlCalendar))
        {
            $caldate[] = $rowCal[0];
        }
        return $caldate;
    }
    function getsunday($date_at)
    {
        $day = strftime("%A",strtotime(date($date_at)));
        return $day;
    }
    function getStatus($chIn,$chOut,$date_at,$caldate,$day,$shift,$department)
    {
        include("../../include/conFig.php");

        $sqlShift = mysql_query("SELECT * FROM  `shift` WHERE id ='$shift' AND `delete` = '0'",$con);
        $sqlShiftCount = mysql_num_rows($sqlShift);
        $rowShi = mysql_fetch_array($sqlShift);
        $lcfhc=$rowShi["lcfhc"];
        $lcshc=$rowShi["lcshc"];
        $shiftTime=$rowShi["starttime"];

        $shiftOutTime=$rowShi["endtime"];
        $first_half_dayout_time=$rowShi["fhdot"];
        $seconfd_half_dayin_time=$rowShi["shdit"];

        $newa = strtotime ( '-1 hour' , strtotime ( $shiftOutTime ) ) ;
        $shiftOutTime_m1 = date ( 'H:i:s' , $newa );

        if($day == 'Saturday')
        {
            //$shiftTime=$rowShi["starttime"];
            //$new = strtotime ( '+1 hour' , strtotime ( $shiftTime ) ) ;
            //$shiftTime = date ( 'H:i:s' , $new );
            $shiftTime = "10:00:00";
            $shiftOutTime = "18:30:00";
            if($department==5 OR $department==13)
            {
                //$shiftOutTime=$rowShi["endtime"];
                //$new = strtotime ( '-4 hour' , strtotime ( $shiftOutTime ) ) ;
                //$shiftOutTime = date ( 'H:i:s' , $new );
                //$shiftTime = "10:00:00";
                $shiftOutTime = "14:00:00";
            }
        }
        $notPunchDate = array();
        $status = "";
        //echo $date_at."<br>";
        //$caldate."<br>";
        //print_r($caldate);
        if(in_array($date_at,$caldate))
        {
            $status = 'Holiday';
        }
        else
        {
            //echo $chOut."<".$shiftOutTime."&&".$chOut."<".$halfTime."date:".$date_at.'<br/>';
            if($chIn == "00:00:00" && $chOut == "00:00:00")
            {
                if($day != 'Sunday')
                {
                    $status = 'Absent';
                }
            }
            else if($chIn != "00:00:00" && $chOut == "00:00:00")
            {
                $status = 'Checkout Punch Missing';
                if($chIn>$shiftOutTime)
                {
                    $status = 'CheckIn Punch Missing';
                }
                //$notPunchDate = $date_at;
            }
            else if($chIn>$lcfhc)
            {
                $status = 'First Half OFF';
            }
            /*else if($chIn>$lcfhc)
            {
                $status = 'First Half Deduction';
            }*/
            else if($chIn < $seconfd_half_dayin_time && $chIn > $shiftTime && $chIn > $lcfhc)
            {
                $status = 'First Half OFF';
            }
            else if($chOut < $shiftOutTime && $chOut > $first_half_dayout_time)
            {

                if($chOut>$shiftOutTime_m1) //############################### one hrs early going
                {
                    $status = 'Present';
                }else{
                    $status = 'Second Half OFF';
                }
            }
            else
            {
                $status = 'Present';
            }

            if($chIn > $lcshc AND $status != 'CheckIn Punch Missing')
            {
                $status = 'Absent';
            }

        }
        return $status;
    }
    $emp = $_GET['eid'];
    $month_at = $_GET['smonth'];
    $year_at = $_GET['year'];
    $empname = $_GET['empname'];
    $startTime = date('Y-'.$month_at.'-1');
    //echo '<br>';
    $endTime  = '';
    $month_atDays = cal_days_in_month(CAL_GREGORIAN, $month_at,$year_at);
    $days = getSundayCount($startTime, $endTime, $month_atDays);
    $sundayCount = count($days);
    $totalDay = $month_atDays-$sundayCount;



    $sql = "SELECT attendance.id,employee.name,attendance.checkin,attendance.checkout,attendance.date,attendance.attendance,employee.shift,employee.department FROM employee,attendance WHERE employee.id = attendance.employee AND MONTH(attendance.date) ='$month_at' AND  YEAR(attendance.date) ='$year_at' AND employee.id = '$emp'";


    //echo $sql;
    $getData = mysql_query($sql,$con) or die(mysql_error());
    $Num_Rows = mysql_num_rows($getData);
    //$Per_Page = 500;   // Per Page
    //include('../../pagination/pagination.php');
    //$folder= 'attendance/verify?smonth='.$month_at.'&year='.$year_at.'&empname='.$empname;
    //$title = 'Attendance';
?>
<div id="myTitle">
    <div class="title">Attendance</div>
</div>
<div style="height:350px;overflow:auto" id="mainDivId">
    <table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Date</th>
            <th>Day</th>
            <th>CheckIn Time</th>
            <th>CheckOut Time</th>
            <th>Status</th>
        </tr>
        <?php
            $i = 1;
            $sql .=" order by employee.name,DATE(attendance.date) ASC";
            //echo $sql;
            $values = mysql_query($sql,$con)or die(mysql_error());
            while($row = mysql_fetch_array($values))
            {
                $findday = $row[4];
                $attStatus = $row[5];
                $shift = $row[6];
                $department = $row[7];
                $day = getsunday($findday);
                $holidays = getcalendar($month_at,$year_at);
                $status = getStatus($row[2],$row[3],$row[4],$holidays,$day,$shift,$department);
                ?>
                <?php
                if($status == 'Holiday' OR $day=="Sunday")
                {
                    $atc='#dce05b';
                    $att='none';
                }else
                {
                    $atc='';
                    $att='';
                } ?>
                <tr class="d<?php echo $i%2?>"  style="background: <?=$atc?>!important"  id="fetchrow<?php echo $i?>">
                    <td  style="background: <?=$att?>!important"></td>
                    <td  style="background: <?=$att?>!important"><?php echo $row[1] ?></td>
                    <td style="background: <?=$att?>!important">
                        <?php echo $row[4]?>
                    </td>
                    <td style="background: <?=$att?>!important">
                        <?php
                            echo $day;
                        ?>
                    </td>
                    <td style="background: <?=$att?>!important"><?php echo $row[2] ?></td>
                    <td style="background: <?=$att?>!important"><?php echo $row[3] ?></td>

                    <td style="background: <?=$att?>!important"><?=$status;?></td>
                </tr>
                <?php
                $i++;
                $Maxid = $row[0];
                $MaxI = $i;
            }
        ?>
        <input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
    </table>
    <br/><br/><br/><br/><br/><br/>
</div>
<?php
    //include('../../pagination/pages_att.php');
?>

