<?php
	echo $q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	$con=mysql_connect('localhost','root','') or die("Database Error");
	mysql_select_db('trifid_hrm',$con);
	$result=mysql_query("SELECT name FROM employee WHERE name LIKE '%$my_data%' ORDER BY name");
		
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['name']."\n";
		}
	}
?>