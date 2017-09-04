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
	include("back_button_faculty.php");
?>

<?php

	include("dbconnect.php");
	$sem_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
	$fetch_month_ids=mysqli_query($con,"select month_id,month_name from month_master where valid=1 ") or die(include("login.php"));
	
?>

<html>
<body>
<div id="workBox">
<form action="attendance.php" method="post">
<table width="420" cellspacing="5" class="formTable">
	<tr><td align="center" >MONTH</td>
    <td>
	<select class="formCSS" name="month_choice">
	<?php      
	  
     while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
	{
        $month_idd=$fetch_month_ids1[0];
        $month_namme=$fetch_month_ids1[1];
        echo"<option value='$month_namme'>"." $month_namme "."</option>";
        
	}
     ?>     
     </select>	
     </td></tr>           
     
     <td align="Center">
 	YEAR</td>
    <td>
  <select name="year_choice" id="year_choice" class="formCSS">
        	
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
	<td align="center">SEMESTER</td>
    <td>
    	<select class="formCSS" name="sem_choice">
        <?php
			
        	while($sem_rs1=mysqli_fetch_array($sem_rs))
			{
				echo"<option value='$sem_rs1[0]'>".$sem_rs1[0]."</option>";	
			}
        ?>
		</select>
    </td>
    </tr>
   
    <tr>
    <td align="center">SECTION</td>
    <td><select class="formCSS" name="sec_choice">
    		<option value="A">A</option>
            <option value="B">B</option>
    	</select>
    </td>
    </tr>
                   
    <tr>
    <td></td>
    <td align="left"><input type="submit" value="submit" class="formButton"></td>
    </tr>	
    
</table>
<form>
</div>
<?php
include("dcs_footer.php");
}
?>
