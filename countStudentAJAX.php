<?php
include("dbconnect.php");
$section=$_REQUEST['section'];
$semester=$_REQUEST['semester'];
$batch=$_REQUEST['batch'];

$rs=mysqli_query($con,"select count(*) from student_master where batch=$batch && semester=$semester && section='$section'");
$rs1=mysqli_fetch_array($rs);
$count=$rs1[0];

echo "#(students) in batch/".$batch."/semester/".$semester."/section/".$section." is = " .$count;
?>