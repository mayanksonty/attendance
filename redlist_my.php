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
	include ("back_button_faculty.php");
?>
<script>
	function form_feed_val()
	{
		
		var y= document.getElementById("month_choice").value;
		var z= document.getElementById("year_choice").value;
		var x= document.getElementById("sub_sec").value;
		var w= document.getElementById("boundary").value;
		
		
		
		
		if(y==0)
		{
			alert("Please Select A Valid Month!");	
		}
		
		else if(z==0)
		{
			alert("Please Select A Valid Year!");	
		}
		else if(x==0)
		{
			alert("Please Select A Valid Subject-Section!");	
		}
		
		else if(w=='')
		{
			alert("Boundary Value Cannot be Empty!!");	
		}
		
		else
		{
			document.form1.submit();	
		}
		
	}
	</script>
<div id="workBox">
<img src="image/076-512.png" />

<table class="formTable">
	<form action="redlistmy_rcv.php" method="post" name="form1">
    
    
    <tr>  
       
       <td colspan="2" align="center">
        
       <b>Generate Attendance List of Students</b></td></tr>
    <tr>	
      <td align="right">Particular Month :</td><td><input type="radio" checked="checked" name="month" value="1"></td>
     </tr><tr>  <td align="right">Upto a Month :</td><td><input type="radio" name="month" value="2"></td>
     </tr>
     <tr>
<td align="right">Month:</td><td><select style="width:120px" id="month_choice" name="month_choice" class="formCSS">
        	<option value="0">------ </option>
             <?php
 	$fetch_month_ids=mysqli_query($con,"select month_id,month_name from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$month_idd=$fetch_month_ids1[0];
	$month_namme=$fetch_month_ids1[1];
	echo"<option value='$month_namme'>"." $month_namme "."</option>";
	
}
?>
		 </select>
  </td>
 </tr> 
 <tr> 
  <td align="right">
 	Year:</td><td>
  <select style="width:120px" name="year_choice" id="year_choice" class="formCSS">
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
    </td>
    </tr>
    <tr>
    <?php
	$user_id=$_SESSION['user_id'];
	
	$sub_res=mysqli_query($con,"select teacher_subject_relation.subject_id from teacher_subject_relation,semester_master,subject_master where semester_master.semester=subject_master.semester && subject_master.subject_id=teacher_subject_relation.subject_id && semester_master.keyw=1 && teacher_subject_relation.teacher_id=$user_id");
	
	
	//die(include("faculty_exception.php"))
    
	
	echo "<tr>"."<td align='right'>"."Subject-Section:"."</td>"."<td>"."<select id='sub_sec' name='sub_id' class='formCSS'>";
	echo"<option value='0'>"."----"."</option>";
	while($sub_res1=mysqli_fetch_array($sub_res))
	{
		$sub_det=mysqli_query($con,"select subject_name,semester,section from subject_master where subject_id=$sub_res1[0]");
		
		while($sub_det1=mysqli_fetch_array($sub_det))
		{
			echo "<option value='$sub_res1[0]'>"."$sub_det1[0] - $sub_det1[1] - $sub_det1[2]"."</option>";
			
		}	
		
	}
	echo "</select>"
	
	?>
    	    
         </td></tr>
         <tr>
         <td align="right">
        
 		  </td>
    
    </tr>
    
       <tr><td align="right">Below :</td>
       
       <td>
     	<input type="radio" name="redlist" checked="checked" value="1"></td></tr>
       <tr> <td align="right"> Above :</td><td> <input type="radio"  name="redlist" value="2"></td></tr>
       <tr><td align="right"> % Attendance :
    	</td>
        <td><input type="number" name="boundary" id="boundary" style="width:120px;"></td>
    </tr>
    
     <tr>  
        <td colspan="1" align="right">
       <input style="width:100px" type="button" value="Submit" onclick="form_feed_val();" class="formButton">
    	<td>
    </tr>
    </form>
    </table>
</div>  

<?php
	include("dcs_footer.php");
}
?> 