<?php 
include("include/conFig.php");

$getroll=mysql_query("SELECT * FROM `employee` WHERE `delete`='0' and active = '1'");
$role=$_COOKIE['hrmrole'];

while ($rowrole=mysql_fetch_array($getroll)) {
$name=$rowrole['name'];
if($role=='0') {
$getNoti= mysql_query("SELECT * FROM `jobvacancy` WHERE approval='0' AND `delete` = '0'");
$num_rows= mysql_num_rows($getNoti);

 }
 else if($role=='2') {
$getNoti= mysql_query("SELECT * FROM `refer` WHERE approval='0' AND `delete` = '0'");
mysql_num_rows($getNoti);
 }

 ?>


<div class="dropdown-menu-inner-title">
View Notification</div>
<div style="background:#fff;">
<ul>

<?php 
while($row=mysql_fetch_array($getNoti)) {
$desi = $row['designation'];
$id =  $row['id'];

?>
<hr/>
<?php 
if ($role=='0') {
?>
<li><img  src="noti.jpg" style="width:15px; height:15px;">&nbsp;&nbsp;<span style="color:black"><?php echo 'Job For';?>&nbsp;<?php echo "$desi"; ?>&nbsp;<i onclick="getModule('notification/new?desi=<?php echo $desi;?>&id=<?php echo $id;?>','viewContent','manipulateContent','Notification'); clear()"><p style="color:green;">Refer Candidates</p></i></span>
<div style="float:right;padding-right:10px;">
</div>

<?php
$getapp = mysql_query("SELECT * FROM `refer` where designation='$desi'");
while($app=mysql_fetch_array($getapp)) {
$chk = $app['approval'];
$app['id'];
$designation=$app['designation'];
?>
<span>
<?php 
if($chk==1) {
echo "Approved";
}
if($chk==0) {
 echo "Un-Approved";
}
 ?>
</span>

</li>
<?php } } ?>


<?php 
if ($role=='2') {
?>
<li style="width:auto;"><img  src="noti.jpg" style="width:15px; height:15px;">&nbsp;&nbsp;<span style="color:black"><?php echo $name;?>&nbsp;<?php echo "Refer Post For"; ?>&nbsp;<?php echo "$desi"; ?>&nbsp;<i onclick="getModule('notification/new','viewContent','manipulateContent','Notification')"></i></span>
<div style="float:right;padding-right:10px;">
</div>
</li>
<?php } ?>

<?php  }  }?>
<?php $i++;?>
</ul>
</div>



