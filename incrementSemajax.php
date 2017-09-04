<?php
	include("dbconnect.php");
	
	
	$sems_rs=mysqli_query($con,"select distinct semester from student_master where flag=1 order by semester")or die("incrementing");
	while($sems_rs1=mysqli_fetch_array($sems_rs))
	{
	$semesters=$sems_rs1[0];
	echo "SEM".$semesters."  ";
	}
	echo "data are present in Database!";
	
	
	
?>