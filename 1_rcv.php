<?php

	
  include("dbconnect.php");
$a=$_POST['aayush'];
mysqli_query($con,"update admincontrols set attendanceoption=$a"); 
?>
<meta http-equiv="refresh" content="2;url=admin_index.php" />
<script type="text/javascript">
  windows.location.href="admin_index.php"
</script>
<style>
#myProgress {
    position: relative;
    width: 100%;
    height: 30px;
    background-color: grey;
}
#mybar
{
	height:28px;
	background:green;
	width:10000px;
}
</style>
 <div id="jhh" style=" position:absolute; top:200px;"> 
 <p align="center" style="font-size:20px;" >Updation Done!!!Redirecting To Your IndexPage.</p>
  
 <div id="myProgress">
    <marquee style="font-family:Book Antiqua; font_size:20px; color: black" bgcolor="white" scrollamount="65" direction="right"><div id="myBar" >ABC</div></marquee>
    
  <p align="center" style="font-size:20px">Developed By:MAYANK VERMA</p>  
 
</div>
 
 