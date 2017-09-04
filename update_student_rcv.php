<?php
session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}
else
{

	include("dcs_header.php");
	include("back_button.php");
?>

<?php
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
?>	
	<table align="center" style="position:absolute; left:15px; top:80px;">
	<tr bgcolor="#99FF00">
    	<th>Class Roll</th>
    	<th>Student Name</th>
        
        <th>Semester</th>
        <th>Section</th>
        <th>Batch</th>
        
    </tr>
	
<?php	
	$stud_rs=mysqli_query($con,"select student_id,class_roll,student_name,batch from student_master where semester=$semester && section='$section'") or die(include("admin_exception.php")); 
	
	
		
	while($stud_rs1=mysqli_fetch_array($stud_rs))
	{
		echo"<tr>";
			
			echo "<td align='center'>"."<input type='number' name='croll[]' value='$stud_rs1[1]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='text' size='40' name='stud_name[]' value='$stud_rs1[2]' class='formCSS'>"."</td>";
			
			echo "<td align='center'>"."<input type='number' name='semester[]' value='$semester' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='text' name='section[]' value='$section' id='present[]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='batch[]' value='$stud_rs1[3]' class='formCSS'>"."</td>";
		echo "</tr>";
		

	}
	
?>
</table>
</div>
<?php
}
include("dcs_footer.php");
?>	