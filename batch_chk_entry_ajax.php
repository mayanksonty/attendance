<?php
	include("dbconnect.php");
	$batch=$_REQUEST['batch'];
	$sec=$_REQUEST['sec'];
	
	if($batch!=0 && $sec!='')
	{
				$batch_rs=mysqli_query($con,"select count(*) from student_master where batch=$batch && section='$sec'") or die(include("admin_exception.php"));
				$batch_rs1=mysqli_fetch_array($batch_rs);
				$batch_count=$batch_rs1[0];
				
				
				
				
				if($batch_count!=0)
				{
					echo "$batch Batch / SECTION: $sec Already Entered";	
					
				}
				else
				{
						echo "$batch Batch / SECTION: $sec NOT Entered!! Please Proceed";	
				}
	}
	else if($batch==0)
	{
			echo "Please Select Batch!";
	}
	else if($sec=='')
	{
		echo "Please Select Section!";
	}
?>