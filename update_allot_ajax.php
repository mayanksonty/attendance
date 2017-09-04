<?php
	
	include("dbconnect.php");
	$subject_id=$_REQUEST['subject_id'];
	$teacher_id=$_REQUEST['teacher_id'];
	
	$rs_teachername=mysqli_query($con,"select teacher_name from user_master where user_id=$teacher_id");
	$rs_teachername1=mysqli_fetch_array($rs_teachername);
	$rs_teachername2=$rs_teachername1[0];
	
	$rs_subjectname=mysqli_query($con,"select subject_name from subject_master where subject_id=$subject_id");
	$rs_subjectname1=mysqli_fetch_array($rs_subjectname);
	$rs_subjectname2=$rs_subjectname1[0];
	
	mysqli_query($con,"update teacher_subject_relation set teacher_id=$teacher_id where subject_id=$subject_id")or die("SENAPPPPAAATTTI");

echo"<span>".$rs_subjectname2." is now alloted to Prof. ".$rs_teachername2."</span>";
?>