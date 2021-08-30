<?php
error_reporting(0);
if(isset($_POST['query']))
{
include("include/connection.php");
$query = $_POST['query'];
$result = mysql_query($query,$con) or die(mysql_error());
while($row = mysql_fetch_array($result))
{
print_r($row);
echo "<br/><br/>";
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>
<form action="query.php" method="post">
<textarea name="query" cols="20" rows="2"></textarea>
<br/>
<input name="Submit1" type="submit" value="submit" />
</form>

</body>

</html>
