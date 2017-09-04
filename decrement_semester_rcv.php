
<?php
session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}
else
{

include("dbconnect.php");

//$temp=$_REQUEST['update_semester'];


//if($temp==1)
{
	mysqli_query($con,"update student_master set semester=semester-1 where flag=1")or die("ODD");
	
	mysqli_query($con,"update student_master set flag=1 where semester=9");
	mysqli_query($con,"update student_master set semester=semester-1 where semester>8");
}

/*
else
{
	mysqli_query($con,"update student_master set semester=semester+1")or die("EVEN");
	
	mysqli_query($con,"update student_master set flag=0 where semester>8");
//	mysqli_query($con,"delete from student_master where semester=8");		

	
}
*/
$current_time=time();
$current_date1=date("Y-M-D",$current_time);
$current_time1=date("Gi.s",$current_time);

?>
<?php
include("admin_redirect.php");
}
?>
