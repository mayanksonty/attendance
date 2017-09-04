
<?php
	include("dbconnect.php");
	$user_id=$_REQUEST['userid'];
	$month=$_REQUEST['month'];
	$year=$_REQUEST['year'];
	$subject_id=$_REQUEST['subjectid'];
	$semester=$_REQUEST['semester'];
	
	$month_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year='$year'");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_id=$month_rs1[0];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
	
	$feed_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$subject_id") or die("ERROR");
	$feed_rs1=mysqli_fetch_array($feed_rs);
	$feed_count=$feed_rs1[0];
	
	$flag=0;
	if($feed_count!=0)
	{
    //echo "Data of $month $year of this subject is Already Entered";	
    
   include("login_redirect2.php");
    exit();
   
	 
   }
	else
	{
			echo "You haven't Entered Attendance of $month $year!! Please Proceed";	
	}
