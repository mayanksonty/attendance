

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
	$temp_semester=$_REQUEST['sem_choice'];
	$temp_section=$_REQUEST['sec_choice'];
	$subject_id=$_REQUEST['subject_id'];
	$teacher_id=$_REQUEST['teacher_id'];
	
	$c=count($subject_id);
	//echo $c;
	
	$str="";
	for($i=0;$i<$c-1;$i++)
	{
			$str=$str."(".$subject_id[$i].",".$teacher_id[$i]."),";
	}
	$str=$str."(".$subject_id[$i].",".$teacher_id[$i].")";
	//echo $str;
	
	mysqli_query($con,"insert into teacher_subject_relation(subject_id,teacher_id) values".$str) or die("senpai");
	
	//header("location:admin_index.php");
?>

<?php
include("admin_redirect.php");
}
?>