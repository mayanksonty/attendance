<?php

session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['batch']))
{
	header("location:login.php");
}
else
{


include("dbconnect.php");
$stud_name=$_REQUEST['stud_name'];
$class_roll=$_REQUEST['class_roll'];


$semester=3;


$section=$_SESSION['section'];
$number_of_students=$_SESSION['number_of_students'];
$batch=$_SESSION['batch'];
$flag=1;

$str="";
for($i=0;$i<$number_of_students-1;$i++)
{
	$str=$str."(".$class_roll[$i].","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$flag.")".",";
	
}

$str=$str."(".$class_roll[$i].","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$flag.")";

$final_str=$str;


mysqli_query($con,"insert into student_master(class_roll,student_name,semester,section,batch,flag) values".$final_str)or die(include("admin_exception.php"));

//header("location:admin_index.php");
include("admin_redirect.php");
}
?>