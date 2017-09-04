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

<?php
	//session_start();
	$tuser_name=$_SESSION['suser_name'];
	$uid=$_SESSION['user_id'];

	
	
?>
 <?php 
 	include("dbconnect.php");
 	$te_rs=mysqli_query($con,"select teacher_name from user_master where user_id=$uid");
	$te_rs1=mysqli_fetch_array($te_rs);
	$tname=$te_rs1[0];
 
 ?>
 


<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css" />
  <style>
		#logout
		{
			
			position:absolute;
			top:109px;
			left:227px;
		}
	</style>
   
  <script>
	function logout()
		{
				window.location.assign("logout.php");
		}
		
</script>  

</head>
  
<body>



<div id="header" style="position:absolute; top:0px;">
<img src="image/dcs2 copy.png">
	<div id="BITlogo"><img src="image/rungta.png"><span id="logout"><input type="button" value="LOGOUT" onClick="logout();" class="formButton" style="background-color:#2f4f4f; color:#FFF; height:20px;"></span></span></div>
</div>

<div id="adminIndex">

	<div class="adminChoice" style="margin-left:5px; margin-top:5px;">
	 
    	<ul type="disc">
    
        	<li><p align="center"><a href="fac_feed.php">Feed Attendance</a></p></li>
  			<li><p align="center"><a href="update_my_attendance.php">Update Attendance</a></p></li>
   			<li><p align="center"><a href="generate_my.php">Generate Attendance</a></p></li>
            <li><p align="center"><a href="redlist_my.php">Generate Red List</a></p></li>
            <li><p align="center"><a href="edit_password.php">Edit Password</a></p></li>
	  		<li><p align="center"><a href="attd_faculty.php">Total Attendance</a></p></li> 
 
    	</ul>
   
    </div> <!-- EO adminChoice -->
    
    <div id="adminIndexMatter" style="width:500px;">
    
    <?php
     $pa_rs=mysqli_query($con,"select user_id from user_master where user_id=$uid");
	   $pa_rs1=mysqli_fetch_array($pa_rs);
	    $path=$pa_rs1[0];
     echo"<img src='image/facultyimg/$path.jpg'>";
    ?>
    Welcome <?php echo $tname; ?>
    
    
    </div>   <!-- EO adminIndex --> 


<div id="footer">
<div style="margin-top:10px;">&copy; All rights reserved to MAYANK VERMA<br></div>		
</div>
<?php
}
?>

</body>
</html>	