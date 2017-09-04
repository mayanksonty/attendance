
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

	mysqli_query($con,"update student_master set semester=semester+1 ")or die("ODD");
	
	//mysqli_query($con,"update student_master set flag=0 where semester>8");
	
	$batch_rs=mysqli_query($con,"select batch,semester from student_master group by semester");
	while($batch_rs1=mysqli_fetch_array($batch_rs))
	{
		$str_sem=$batch_rs1[1];
		$str_batch=$batch_rs1[0];
		$str=$str_sem.$str_batch."attd";
		//echo $str."<br>";
		
		mysqli_query($con,"create table ".$str."(select * from attendance_master)") or die("senpai");
		
	}



?>
<?php
include("admin_redirect.php");
}
?>
