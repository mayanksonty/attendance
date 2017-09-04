<?php
	
	include("dbconnect.php");
	$student_id=$_REQUEST['student_id'];
	//echo $student_id;
	
	$student_rs=mysqli_query($con,"select student_name,university_roll,class_roll,semester from student_master where student_id=$student_id") or die("error");
	$student_rs1=mysqli_fetch_array($student_rs);
	
?>		

	<table>
      <tr>
    	<td align="right">Student Name:</td>	
        <td><input type='text' name="student_name" <?php echo "value='$student_rs1[0]'" ?> class="formCSS"></td>
      </tr>
      
      <tr>
    	<td align="right">University Roll Number:</td>	
        <td><input type='number' name="university_roll" class="formCSS" <?php echo "value='$student_rs1[1]'" ?>></td>
      </tr>
      
      <tr>
    	<td align="right">Class Roll Number:</td>	
        <td><input type='number' name="class_roll" class="formCSS" <?php echo "value='$student_rs1[2]'" ?>></td>
      </tr>
     
      <tr>
    	<td align="right">Semester:</td>	
        <td><input type='number' name="semester" class="formCSS" <?php echo "value='$student_rs1[3]'" ?>></td>
      </tr>
      
      <tr>
      	<td colspan="2" align="center"><input type="submit" value="Update" class="formButton"></td>
      </tr>
     </table>