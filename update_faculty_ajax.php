<?php
	session_start();
	include("dbconnect.php");
	$user_id=$_REQUEST['userid'];
	$_SESSION['userid']=$user_id;
	$teacher_rs=mysqli_query($con,"select teacher_name,user_name,password from user_master where user_id=$user_id");
	$teacher_rs1=mysqli_fetch_array($teacher_rs);
	
	
?>
	<table>
      <tr>
    	<td align="right">Faculty Name:</td>	
        <td><input type='text' name="faculty_name" <?php echo "value='$teacher_rs1[0]'" ?>></td>
      </tr>
      
      <tr>
    	<td align="right">User Name:</td>	
        <td><input type='text' name="user_name" <?php echo "value='$teacher_rs1[1]'" ?>></td>
      </tr>
      
      <tr>
    	<td align="right">Password:</td>	
        <td><input type='text' name="password" <?php echo "value='$teacher_rs1[2]'" ?>></td>
      </tr>
      
      <tr>
      	<td colspan="2" align="center"><input type="submit" value="Update"></td>
      </tr>
     </table>