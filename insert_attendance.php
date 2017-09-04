<?php
	
	session_start();

	include("dbconnect.php");
	
	$user_id=$_SESSION['user_id'];
	$month_id=$_SESSION['month_id'];
	$subject_id=$_SESSION['subject_id'];
	$student_id=$_REQUEST['student_id'];
	$outof=$_REQUEST['outof'];
	$present=$_REQUEST['present'];
	$semester=$_SESSION['sem'];
	
	//echo $subject_id."    ";
	//echo $month_id;
	
	
	$str="";
	
	$x=count($outof);
	for($i=0;$i<$x-1;$i++)
	{
		$str=$str."(".$month_id.",".$subject_id.",".$student_id[$i].",".$outof[$i].",".$present[$i].")".",";		
	}
	
		echo $str=$str."(".$month_id.",".$subject_id.",".$student_id[$i].",".$outof[$i].",".$present[$i].")";
		
		//echo $str;
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
	mysqli_query($con,"insert into ".$batch_str."(month_id,subject_id,student_id,total_lectures,present) values".$str )or die(include("faculty_exception.php"));

	header("location:print_entry.php");	
		

?>