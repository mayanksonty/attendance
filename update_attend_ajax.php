<?php
include("dbconnect.php");
session_start();
$total=$_REQUEST['total'];
$present=$_REQUEST['present'];
$student_id=$_REQUEST['student_id'];

$month_id=$_SESSION['month_id'];
$subject_id=$_SESSION['subject_id'];

//echo $month_id."   ". $present."  ". $total."   ".$subject_id."  ". $student_id;
$stud_rs=mysqli_query($con,"select student_name,semester from student_master where student_id=$student_id");
$stud_rs1=mysqli_fetch_array($stud_rs);
$student_name=$stud_rs1[0];
$semester=$stud_rs1[1];

//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	

mysqli_query($con,"update ".$batch_str." set total_lectures=$total , present=$present where (student_id=$student_id && month_id=$month_id && subject_id=$subject_id)")or die("ERROR");

echo "Attendance of ".$student_name." is Updated";
?>