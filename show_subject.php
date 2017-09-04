<?php
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
	
	$subject_rs=mysqli_query($con,"select subject_id,subject_name from subject_master where semester=$semester && section='$section'") or die("SENPAI");
	
	
	echo"<table class='formTable'>";	
	//	echo"<form name='form1'>";
			echo "<tr>"."<td>"."SUBJECTS"."</td>"."<td>"."</td>"."<td colspan='2'>"."FACULTY"."</td>"."</tr>";
			
			while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$teacher_rs=mysqli_query($con,"select user_id,teacher_name from user_master where user_type='faculty' order by teacher_name ");
				
				
				echo "<tr>";
				echo "<td>"."<input type='text'  value='$subject_rs1[1]' name='subject[]' disabled>"."</td>";
				echo "<td>"."<input type='hidden' value='$subject_rs1[0]' name='subject_id[]'>"."</td>";	
				
				echo "<td>"."<select name='teacher_id[]'>";
					while($teacher_rs1=mysqli_fetch_array($teacher_rs))
					{
						echo "<option value='$teacher_rs1[0]'>".$teacher_rs1[1]."</option>";
					}
				echo"</select>"."</td>";
				
				echo "</tr>";
			} 
		
		echo"<tr>"."<td colspan='3' align='center'>"."<input type='submit'>"."</td>"."</tr>";
	echo"</table>";
?>
