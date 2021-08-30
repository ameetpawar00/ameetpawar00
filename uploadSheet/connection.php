<?php



/*$con = mysql_connect("localhost","root","");

if (!$con)

  {

  die('Could not connect: ' . mysql_error());

  }

mysql_select_db("scms", $con);





$con = mysql_connect("localhost","marketma_dbs","dbs@123");

if (!$con)

  {

  die('Could not connect: ' . mysql_error());

  }

mysql_select_db("marketma_dbs", $con);



*/
date_default_timezone_set('Asia/Calcutta');
$datetime = date("Y-m-d H:i:s");

$con = mysql_connect("localhost","root","");

if (!$con)

  {

  die('Could not connect: ' . mysql_error());

  }

mysql_select_db("excel_reader", $con);



?>