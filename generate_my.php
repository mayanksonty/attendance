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
?>

<script>
	function form_feed_val()
	{
		var x= document.getElementById("sub_sec").value;
		var y= document.getElementById("month_choice").value;
		var z= document.getElementById("year_choice").value;
		
		if(x==0)
		{
			alert("Please Select A Valid Subject-Section!");	
		}
		
		else if(y==0)
		{
			alert("Please Select A Valid Month!");	
		}
		
		else if(z==0)
		{
			alert("Please Select A Valid Year!");	
		}
		
		else
		{
			document.form1.submit();	
		}
		
	}
	</script>

<?php
	include("dcs_header.php");
	include("back_button_faculty.php");
	echo "<div id='workBox'>";
		$uid=$_SESSION['user_id'];
	echo "<img src='image/076-512.png'>";
	//echo $uid;
	
	echo"<table border='0' cellspacing='5' class='formTable'>"."<tr>"."<th colspan='2' align='center'>"."<u>Generate Attendence</u>"."</th>"."</tr>";
	
	echo "<form action='generate_my_rcv.php' method='post' name='form1'>";
		
		$sub_res=mysqli_query($con,"select teacher_subject_relation.subject_id from teacher_subject_relation,semester_master,subject_master where semester_master.semester=subject_master.semester && subject_master.subject_id=teacher_subject_relation.subject_id && semester_master.keyw=1 && teacher_subject_relation.teacher_id=$uid")or die(include("faculty_exception.php"));
	
	
	//$sub_res=mysqli_query($con,"select subject_id from teacher_subject_relation where teacher_id=$uid")or die(include("faculty_exception.php"));
	
	echo "<tr>"."<td align='right'>"."Subject-Section:"."</td>"."<td>"."<select id='sub_sec' name='sub_id' class='formCSS'>";
	echo"<option value='0'>"."-----"."</option>";
	while($sub_res1=mysqli_fetch_array($sub_res))
	{
		$sub_det=mysqli_query($con,"select subject_name,semester,section from subject_master where subject_id=$sub_res1[0]") or die(include("faculty_exception.php"));
		
		while($sub_det1=mysqli_fetch_array($sub_det))
		{
			echo "<option value='$sub_res1[0]'>"."$sub_det1[0] - $sub_det1[1] - $sub_det1[2]"."</option>";
			
		}	
		
	}
	echo "</select>"."</td>"."</tr>";
?>



   
   
     <tr><td align="right">Month:</td><td>
  <select name="month_choice" id="month_choice" style="width:175px;">
        	<option value="0">------</option>
             <?php
 	$fetch_month_ids=mysqli_query($con,"select month_id,month_name from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$month_idd=$fetch_month_ids1[0];
	$month_namme=$fetch_month_ids1[1];
	echo"<option value='$month_namme'>"." $month_namme "."</option>";
	
}
?>
		 </select> </td>
  
  
  
  </td></tr>
  <tr>
  <td align="right">Year:</td><td>
  <select name="year_choice" id="year_choice" class="formCSS">
        	<option value="0">------ </option>
            <?php
 	$fetch_month_ids=mysqli_query($con,"select distinct year from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$year_val=$fetch_month_ids1[0];
	
	echo"<option value='$year_val'>"." $year_val "."</option>";
	
}
 
 
 ?>
		 </select>
  
  </td></tr>
  <tr><td></td><td colspan="1" ><input type="button" value="Submit" onclick="form_feed_val();" class="formButton"></td></tr>
  
  
  </table>



  </form>

       

</div>
<?php
	include("dcs_footer.php");
}
?>
