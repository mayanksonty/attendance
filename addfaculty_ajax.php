<?php
include("dbconnect.php");
$username=$_REQUEST['username'];

$i=0;
$res=mysqli_query($con,"select user_name from user_master where user_name='$username'");
while($res1=mysqli_fetch_array($res))
{
$i++;	
	
};

if($i>0)
{
echo "&times;Username exists ALREADY!";	
	
}


?>