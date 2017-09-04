<?php
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
?>		
      <table class>  
        <tr>
        	<td align="right">Select Student:</td>
			<td>
            	<select name="student_id" id="student_id" class="formCSS">
		<?php
		$student_rs=mysqli_query($con,"select student_name,student_id from student_master where semester=$semester && section='$section'");
		while($student_rs1=mysqli_fetch_array($student_rs))
		{
			echo"<option value=$student_rs1[1]>".$student_rs1[0]."</option>";
			$i=$student_rs1[1];
		}			
		?>    
    			</select>
            </td>
		</tr>
        <tr>
        	<td colspan="2" align="center"><input type="button" value="Show Details" onClick="display_sdetails();"></td>
        </tr>
      </table> 