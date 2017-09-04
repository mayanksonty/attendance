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
<script src="js/new_batch_rcv.js"></script>
<?php
 $number_of_students=$_REQUEST['number_of_students'];
 $section=$_REQUEST['section'];
 $batch_year=$_REQUEST['batch_year'];
 
 $_SESSION['number_of_students']=$number_of_students;
 $_SESSION['section']=$section;
 $_SESSION['batch']=$batch_year;
 
 ?>
 
 <div id="workBox">
 <form action="insert_student.php" name="form1" method="post">
 <table class="formTable">
    <tr>
      <th>SNo.</th>
      <th>Class Roll Number </th>
      <th> Name</th>
      
    </tr>
    <?php
	echo"<input type='hidden' id='hid' value='$number_of_students'>";
	for($i=1;$i<=$number_of_students;$i++)
	{	
		 echo "<tr>";
		 	echo "<td align='center'>".$i."</td>";
		   echo "<td>"."<input type='number' name='class_roll[]' class='formCSS'>"."</td>";
		   echo "<td>"."<input type='text' name='stud_name[]' class='formCSS'>"."</td>";
		     
		 echo "</tr>";
	}
	?>
	 <tr><td colspan="3" align="center"><input type="button" value="Submit" onclick="form_feed_val();" class="formButton">   </td></tr>
 </table>

 </form>
 </div>
<?php
	include("dcs_footer.php");
}
?> 