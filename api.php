<?php
date_default_timezone_set('Asia/Calcutta');
error_reporting(E_ALL);
ini_set('display_errors', 'on');
OnLoad();

class connection_class 
{
   var $con="";
   var $db="swastika_hrm"; 
   var $host="localhost";
   var $user="root";
   var $pass="";  


   public function connection()
   {
      $this->con=mysql_connect($this->host,$this->user,$this->pass) or die(mysql_error());    
      $this->db=mysql_select_db($this->db,$this->con) or die(mysql_error());	
   }
   	
   public function query($sql_q)
   {
      $result=mysql_query($sql_q);
      if(!$result){die(mysql_error());}else{return $result;}
   }  
}
function OnLoad()
{
   $method = $_REQUEST['method'];
   if($method == 'SignIn')
   {
      SignIn();
   }
   if($method == 'EmpDetail')
   {
      EmployeDetail();
   }  
   if($method == 'userAttend')
   {
      UserAttendance();
   }  

}  
//For Sign In
function SignIn()
{	
    $obj=new connection_class();
    $obj->connection();     
    $user_name = $_REQUEST['username'];
    $password  = $_REQUEST['password'];
    $user_name = mysql_real_escape_string($user_name);  
    $password = (mysql_real_escape_string($password));
    
    $output = '';
    
    $sql = "SELECT * FROM `employee` WHERE `username` = '$user_name' AND `password` = '$password' ";
    $res=mysql_query($sql);
    
    if(mysql_num_rows($res)>0)
    { 
        $row=mysql_fetch_array($res); 
        $id = $row['id'];
         
       	   $contents = array(); 
           $contents['id'] = $id;
           $contents['username'] = $row['username'];
           $contents['name'] = $row['name'];
           $contents['email']  =  $row['email']; 
           $role = $row['role'];
           $empId = $row['id'];
			mysql_query("INSERT INTO `userlog`(`employee`, `date`, `login`) VALUES ('$empId','$date','$datetime')",$con) or die(mysql_error());
			$userlogid = mysql_insert_id();
			mysql_query("UPDATE `userlog` SET `logout`='$datetime' WHERE  `employee` = '$empId' and `logout` = '0000-00-00 00:00:00' and `id` != '$userlogid' ",$con) or die(mysql_error());
			$getRole = mysql_query("SELECT `permission` FROM `permission` WHERE `rollid` = '$role'",$con) or die(mysql_error());
			$rolePermis = mysql_fetch_array($getRole);
		    $contents['permission']  =  $rolePermis['permission'];
						
           
           $output = $row;
    }
    else
    {
        $output = "0";
    }
      
return $output; 
}
//For Employee Detail
function EmployeDetail()
{	
    $obj=new connection_class();
    $obj->connection();     
    $output = '';
    
    $sql = "SELECT * FROM `employee` WHERE `delete` = '0' ORDER BY `name` ASC ";
    $res=mysql_query($sql);
    
    if(mysql_num_rows($res)>0)
    { 
        $row=mysql_fetch_array($res); 
       $output = $row;
    }
    else
    {
        $output = "0";
    }
      
return $output; 
}
//Insert Attendance 
function UserAttendance()
{
    $obj=new connection_class();
    $obj->connection();     
    $output = '';
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$employeeId = $_REQUEST['empid'];
$sql = "INSERT INTO `attendance`(`employee`, `date`,`createdate`, `attendance`,`checkin`) VALUES ('$employeeId','$date','$datetime','1','$datetime')";
mysql_query($sql) or die(mysql_error());
$checkid = mysql_insert_id();
$output = '<span class="red button"  onclick="checkOut('.$checkid.')" id="myAttendancechk" >Todays CheckOut</span>';
return $output; 
}
$abc = UserAttendance();
echo $abc;
?>