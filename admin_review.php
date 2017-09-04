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
<script>

	function form_feed_val()
	{
		var m= document.getElementById("month_choice").value;
		var x= document.getElementById("sec_choice").value;
		var y= document.getElementById("sem_choice").value;
		var n= document.getElementById("year_choice").value;

		
		if(m==0)
		{
			alert("Month can't be EMPTY!");	
		}
		else if(n==0)
		{
			alert("Year can't be EMPTY!");	
		}
		else if(x==0)
		{
			alert("Semester can't be EMPTY!");	
		}
		else if(y==0)
		{
			alert("Section of students can't be EMPTY!");	
		}
			
		else
		{	
			
			document.form1.submit();
		}
	}

</script>
<div id="workBox">

<img src="image/rw.jpg" style="position:absolute; width:120px; height:100px; left:165px; top:-100px;">
<form action="admin_review_rcv.php" method="post" name="form1">
<table border="0" cellspacing="5" width="100%" class="formTable">
<tr>
  <th colspan="2"><u>Admin Review</u></th>
</tr>

<tr> 
          <td align="right">Month:</td><td><select  name="month_choice" id="month_choice" class="formCSS">
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
  </td></tr>

	  <tr>
  <td align="right">
 	Year:</td>
    <td>
  <select name="year_choice" class="formCSS" id="year_choice">
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
	<td align="right">
    	Semester:</td>
         <td><select name="sem_choice" id="sem_choice"  class="formCSS">
        	<option value="0"> ------ </option>
             <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select> </td>       
 </tr>        
    
   <tr>    <td align="right"> Section:</td>
       <td>  <select name="sec_choice" id="sec_choice"  class="formCSS">
          	<option value="0"> ------ </option>
            <option value="A"> A </option>
            <option value="B"> B </option>
          </select></td></tr>
         
         
	<tr>  <td></td>
        <td colspan="1" align="left">
       <input style="width:100px" type="button" value="Submit" onclick="form_feed_val();">
    	</td>
    </tr>
   
          
        </table>
        
        
         <div id="div_show" style="width:705px; height:auto; border:0px solid #003;">
    
    	</div>
    </form>
</div>

<?php
}
include("dcs_footer.php");
?>