<?php
	
	session_start();


	
	include("dbconnect.php");
	$user_id=$_SESSION['user_id'];
	$month_id=$_SESSION['month_id'];
	$subject_id=$_SESSION['subject_id'];
	$student_id=$_REQUEST['student_id']; //array
	$outof=$_REQUEST['outof'];	//array
	$present=$_REQUEST['present'];	//array
	
	
	$_SESSION['month_id']=$month_id;
	
	$semester=$_SESSION['sem'];
		
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
		
		
		$min_month_res=mysqli_query($con,"select min(month_id) from ".$batch_str) or die(include("faculty_exception.php"));
		$min_month_res1=mysqli_fetch_array($min_month_res);
		$min_month=$min_month_res1[0];
							
		$month_set_res=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month")or die(include("faculty_exception.php"));

	//$student_rs=mysqli_query($con,"select student_id from student_master where semester=$semester && section='$section' order by class_roll")or die(include("faculty_exception.php"));
		$N=count($student_id);
		
	for($i=0;$i<$N;$i++)
	{
		$attend_rs=mysqli_query($con,"select sum(total_lectures),sum(present) from ".$batch_str." where student_id=$student_id[$i] and subject_id=$subject_id and (month_id between $min_month and ($month_id-1))") or die(include("faculty_exception.php"));
		
		$attend_rs1=mysqli_fetch_array($attend_rs);
		
		$outof[$i]-=$attend_rs1[0];
		$present[$i]-=$attend_rs1[1];
		echo $i." - ".$outof[$i]." - ".$present[$i]."<br>";
	}			
	
	$str="";
	
	//$x=count($outof);
	for($i=0;$i<$N-1;$i++)
	{
		$str=$str."(".$month_id.",".$subject_id.",".$student_id[$i].",".$outof[$i].",".$present[$i].")".",";		
	}
	
		$str=$str."(".$month_id.",".$subject_id.",".$student_id[$i].",".$outof[$i].",".$present[$i].")";
		
		//echo $str;
		
		mysqli_query($con,"insert into ".$batch_str."(month_id,subject_id,student_id,total_lectures,present) values".$str )or die("senpai");
		
		
	header("location:print_entry.php");	
	
?>