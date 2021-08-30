<?php
    session_start();
    ob_start();
    error_reporting(0);
    include('include/connection.php');
    include('include/chkurlfunction.php');
    $chkurl = curPageURL();
    $url = parse_url($chkurl);
    $curenttUrl  = $url['host'];
    $getChkSql ="SELECT `id` FROM  `companydetail` where `url` =  '$curenttUrl'";
    $rowChk = mysql_query($getChkSql,$con) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>EasyHRM</title>
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/color.css" rel="stylesheet" />
        <link href="css/icon.css" rel="stylesheet" />
        <link href="css/common.css" rel="stylesheet" />


        <?php
            /*echo date("m");
            echo date("d");*/
            $width='width="475"';
            $widthStyle='width: 500px;';


            $occation="holi";
            $occation="ganesha";
            $occation="diwali";
            $occation="";

            if(date("m")==1 AND ((date("d")==25) OR (date("d")==26)))
            {
                $image="26.png";
                $backColor="background-color: #fff";
            }elseif(date("m")==11 AND (date("d")==2))
            {
                $image="bithday.jpg";
                $width='';
                $widthStyle='margin: 5% 0 0 40%;width:65%';

                $backColor="background-image:url(images/bg-repeate.jpg);";
            }elseif($occation=="holi")
            {
                $image=$occation.".png";
                $backColor="background-color: #fff";
            }elseif($occation=="ganesha")
            {
                $image=$occation.".png";
                // $backColor="background-color: #fff";
                //$backColor="background-image:url(images/bg-repeate.jpg);";
                $backColor="background-color: #fff";
                //$backColor="background-image:url(images/bg-repeate.jpg);";
            }elseif($occation=="diwali")
            {
                $image=$occation.".png";
                // $backColor="background-color: #fff";
                //$backColor="background-image:url(images/bg-repeate.jpg);";
                // $backColor="background-color: #fff";
                $width='';
                $widthStyle='margin:0';
                //$backColor="background-image:url(images/bg-repeate.jpg);";
                $backColor="background-image:url(images/bg-repeate.jpg);";
            }else{
                $image="hrm-image.png";
                $backColor="background-image:url(images/bg-repeate.jpg);";
            }
        ?>



        <style>
            body{  <?=$backColor?> }
            .hrm_left{ float:left; width:50%;  }
            .hrm_right{ float:left; width:50%;  }


            /*
            .hrm_left img {
                margin-left: 98px;
                margin-top: -7%;
                padding: 0;
                width: auto;
                filter: drop-shadow(rgba(0, 0, 0, 1.24) 0px 0px 30px);
                position: relative;
                z-index: -1;
            }*/
            .hrm_left img { margin-left: 150px; margin-top:5%; padding: 0; width:auto;}
            .hrm_copyright{float:left; width:100%; text-align:center; color: #000; line-height: 18px; font-size: 11px;}

        </style>

    </head>

    <body>


        <div class="hrm_left">
            <img src="images/banner/<?=$image?>" <?=$width?> style="<?=$widthStyle?>">
            <!--	<img src="images/470.png" width="475" alt=""/>-->
            <!--	<img src="images/470.png" width="475" alt=""/>-->
        </div>
        <!--<div class="hrm_left">  <img src="images/cccaaa.png" style="margin: 0"> </div>
        <div class="hrm_left">  <img src="images/bithday.jpg" style="width: 60%"/> </div>-->


        <div class="hrm_right">
            <center>
                <div style="width:400px;padding-top:15%;">

                    <div style="background-color:rgba(204, 204, 204, 0.5);padding:10px;width:380px;">
                        <br/>
                        <img alt="" src="images/logo.png" style="height:45px;" />



                        <?php
                            if(mysql_num_rows($rowChk) > 0)
                            {
                                include('login.php');
                            }
                            else
                            {
//include('register.php');
                                include('login.php');

                            }
                        ?>

                        <br/>


                    </div>

                </div>

            </center>

        </div>

        <span class="hrm_copyright"> @ 2014 - <?php echo date('Y'); ?>. All Rights Reserved. TriFid Research </span>

    </body>

</html>
