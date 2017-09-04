<?php
	//include("dcs_header.php");
?>    
<html>
<head>
	
<link rel="stylesheet" type="text/css" href="style.css" />
</head>     
<body>

<div id="header">
	<img src="image/dcs.png">
	<div id="BITlogo"><img src="image/bitdurg.png"></div>
</div>

<?php
session_start();
include("dbconnect.php");

?>

<div id=pageContainer>


                    
	<!--		        <div id="loginHeader">
                      <h1>#CSE DEPARTMENT</h1><br>
                    </div> EO loginHeader --> 
                   
                    
                <div id="workBox" style="position:absolute; margin-bottom:10px;">
                  <img src="image/logo.png">
                   <form action="checklogin.php" method="post" >
                   <table  width="420" cellspacing="5" class="formTable">
                   <tr><td align="center">LOGIN AS</td>
                   <td><select name="uservalue" class="formCSS">
                   <option value="1" onFocus="showbox(1)">ADMIN</option>
                   <option value="2" onChange="showbox(2)" selected="selected">FACULTY</option>
                   <option value="3" onChange="showbox(3)" >STUDENT  </option>
                   </select>


</td></tr>


                   <tr><td align="center">USER NAME</td>
                   	   <td><input type="text" name="username" placeholder="Enter Here" class='formCSS'></td></tr><tr>

                   <tr><td align="center">PASSWORD</td>
                   <td><input type="password" name="password" placeholder="Enter Here" class="formCSS"><br></td></tr>
                   <tr><td align="center"> <input type="Reset" class="formButton"></td><td><input type="submit" value="Login" class="formButton">
                   </td></tr>
                   
                   <tr><td colspan='2' align="center"><marquee style=”height:20;width:200”scrollamount=”200”scrolldelay=”500”>Don't have account? Contact Mr. KAUSHAL SINHA</marquee></td></tr>
                   </table>
                   </form> 
                   </div>
                   </div><!--EO workBox>
                   
                  </div><!--EO mainContainer-->
                  
                   <?php
				   include("dcs_footer.php");
				   ?>
       