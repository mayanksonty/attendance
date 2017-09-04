<?php
	//include("dcs_header.php");
?>    
<html>
<head>
	
<link rel="stylesheet" type="text/css" href="style.css" />

<script>
	function showform()
	{	
		
		
			var ch=document.getElementById("choice").value;
			if(ch==3)
			{
				var i=new XMLHttpRequest();
				i.onreadystatechange=function()
				{
					if(i.readyState==4 && i.status==200)
					{	
						document.getElementById("workBox").innerHTML=i.responseText;	
					}
				};
	
				i.open("GET","login_ajax.php",true);
				i.send();
			}
	}
</script>  
            
</head>     
<body>

<div id="header">
	<img src="image/dcs2 copy.png">
	<div id="BITlogo"><img src="image/rungta.png"></div>
</div>

<?php
session_start();
include("dbconnect.php");

?>

<div id=pageContainer>


                    
	                
                <div id="workBox" style="position:absolute; margin-bottom:10px;">
                  <img src="image/logo.png">  
                   <form action="checklogin.php" method="post" >
                   <table width="420" cellspacing="5" class="formTable">
                   <tr><td align="center">LOGIN AS</td>
                   <td><select name="uservalue" class="formCSS" onChange="showform();" id="choice">
                   <option value="1" >ADMIN</option>
                   <option value="2" selected="selected">FACULTY</option>
                   <option value="3" >STUDENT</option>
                   </select></td></tr>
                   <tr><td align="center">USER NAME</td>
                   	   <td><input type="text" name="username" placeholder="Enter Here" class='formCSS'></td></tr>
                   <tr><td align="center">PASSWORD</td>
                   <td><input type="password" name="password" placeholder="Enter Here" class="formCSS"><br></td></tr>
                   <tr><td align="center"> <input type="Reset" class="formButton"></td><td><input type="submit" value="Login" class="formButton">
                   </td></tr>
                   <tr><td colspan="2">
                   	<span id="stud_login">
                    
                    </span>
                   </td></tr>
                   
                   <tr><td colspan='2' align="center"><marquee style=”height:20;width:200”scrollamount=”200”scrolldelay=”500”> Login Problem ? Contact Prof. KAUSHAL K. SINHA</marquee></td></tr>
                   </table>
                   </form> 
                   </div>
                   </div><!--EO workBox>
                   
                  </div><!--EO mainContainer-->
                  
                   <?php
				   include("dcs_footer.php");
				   ?>
       
