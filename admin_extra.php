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

<div id="header">
<img src="image/dcs2 copy.png">
	<div id="BITlogo"><img src="image/rungta.png"><span id="logout"><input type="button" value="LOGOUT" onClick="logout();" class="formButton" style="background-color:#2f4f4f; color:#FFF; height:20px;"></span></div>
</div>

	
            <div id="adminIndex">
        
               <div class="adminChoice" align="left" style="top:5px; position:absolute; left:5px; border:0px solid blue;">
				
			                
                 <ul type="disc">
           		        
                    <li><p align="center"><a href="admin_index.php">Back To Home</a></p></li>
                    <li><p align="center"><a href="allot_subject.php">Subject Allotment</a></p></li>
                     <li><p align="center"><a href="delete_attendance.php">Delete Attendance</a></p></li>
                     <li><p align="center"><a href="update_semester.php">Increment Semester</a></p></li>
                     <li><p align="center"><a href="decrement_semester.php">Decrement Semester</a></p></li>
                       <li><p align="center"><a href="backup_db.php">Backup DataBase</a></p></li>
                       
                 </ul>
           
               </div> <!-- EO adminChoice1 -->
            
            
            
            
            
                <div id="adminIndexMatter">
                    
                    <?php
                 //$tuser_name=$_SESSION['suser_name'];
	               $uid=$_SESSION['user_id'];

 	          
             include("dbconnect.php");
        	 $te_rs=mysqli_query($con,"select teacher_name from user_master where user_id=$uid");
	          $te_rs1=mysqli_fetch_array($te_rs);
	          $tname=$te_rs1[0];
 
 
              
              
              $pa_rs=mysqli_query($con,"select user_id from user_master where user_id=$uid");
	            $pa_rs1=mysqli_fetch_array($pa_rs);
	             $path=$pa_rs1[0];
              echo"<img src='image/facultyimg/$path.jpg'>";
                    
                 ?> 
		<p> Welcome Admin! <?php echo $tname; ?></p> 	   
                 </div>     <!-- EO adminIndexMatter -->  
            
           
           
            	<div class="adminChoice" align="right" style="top:5px; position:absolute; left:875px;">
                
                	<ul type="disc">
                    
                    <li><p align="center"><a href="update_student.php">Edit Student</a></p></li>      		            
                    <!--<li><p align="center"><a href="generate_redlist.php">Redlist Report</a></p></li>    -->  		            
                    <li><p align="center"><a href="admin_password.php">Edit Password</a></p></li>
		    <li><p align="center"><a href="remedial_class.php">Remedial Class List</a></p></li>
                    <li><p align="center"><a href="1.php"> Validate Faculty options</a></p></li>
		    <li><p align="center"><a href="generate_compare.php">Compare Attendance</a></p></li>
                    
                    
        		    </ul>
                    
           		 </div>	<!-- EO adminChoice -->
           
           </div><!--EO  adminIndex--> 
            
            

<div id="footer" ">
<div style="margin-top:10px;">&copy; All rights reserved to MAYANK VERMA<br></div>		
</div>

</body>
</html>
<?php
}
?>