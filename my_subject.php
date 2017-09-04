
<?php
	session_start();
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
	$user_id=$_SESSION['user_id'];
	
	
	
	$semsub_rs=mysqli_query($con,"select count(*) from teacher_subject_relation where ((teacher_id=$user_id) && (subject_id in (select subject_id from subject_master where semester=$semester && section='$section')))")or die("bhalu");
	$semsub_rs1=mysqli_fetch_array($semsub_rs);
	$counter=$semsub_rs1[0];
	
	
	
			
		
			if($counter==0)
			die("Sorry,you haven't been alloted any subject to this section in this particular session!");

	

		
	$subject_rs=mysqli_query($con,"select subject_id from teacher_subject_relation where teacher_id=$user_id") or die("SENPAI");
		echo "<table>"."<tr>";	
			
			echo "<td align='right'>"."Subject:"."</td>"."<td>"."<select name='subject_id' id='subject' class='formCSS' onchange='check_entry();'>";
			
			echo "<option value='0'>"."----"."</option>";
			while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$subname_rs=mysqli_query($con,"select subject_name from subject_master where (subject_id=$subject_rs1[0] && semester=$semester && section='$section') order by subject_name") or die("lkj");
				
				
				
					while($subname_rs1=mysqli_fetch_array($subname_rs))
					{
						echo "<option value='$subject_rs1[0]'>".$subname_rs1[0]."</option>";
					}
			
				
			
			} 
			echo"</select>"."</td>";
	
			echo "</tr>";
			
			echo"<tr>"."<td>"."</td>"."<td>"."<input type='button' value='Submit' onclick='validation();' class='formButton' >"."</td>"."</tr>";
	echo"</table>";
?>
