<?php
	include("dbconnect.php");
	$batch=$_REQUEST['batch'];
	
	$batch_rs=mysqli_query($con,"select count(*) from student_master where batch=$batch");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$batch_year=$batch_rs1[0];
	
	
	
	
	if($batch_year!=0)
	{
		echo "$batch Batch Already Entered";	
		
	}
	else
	{
			echo "$batch Batch NOT Entered!! Please Proceed";	
	}
?>