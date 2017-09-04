
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
	$temp_user_id=$_SESSION['user_id'];

	$teacher_rs=mysqli_query($con,"select teacher_name,user_name,password from user_master where user_id=$temp_user_id");
	$teacher_rs1=mysqli_fetch_array($teacher_rs);
	
?>
<script>
	function update_pass(userid)
	{
		var user_name=document.getElementById("user_name").value;
		var pass=document.getElementById("pass").value;
		
		var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_display").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","edit_pass_ajax.php?userid=" + userid + "&username=" + user_name + "&pass=" + pass,true);
			i.send();	
	}
</script>
<div id="workBox">
<table class="formTable">	
    <tr>
    	<td align="right">User Name:</td>	
        <td><input type='text' name="user_name" <?php echo "value='$teacher_rs1[1]'" ?> id="user_name"></td>
      </tr>
      
      <tr>
    	<td align="right">Password:</td>	
        <td><input type='text' name="password" <?php echo "value='$teacher_rs1[2]'" ?> id="pass"></td>
      </tr>
      
      <tr>
      <?php
   	echo"<td colspan='2' align='center'>"."<input type='button' value='Update' onClick='update_pass($temp_user_id);'>"."</td>";
      ?>
	  </tr>
      
</table>
	
            	<div id="div_display" style="color:#00C; position:absolute; left:20px; top:110px; width:400px;">
    
    			</div>
           
</div>
<?php
	include("dcs_footer.php");
}
?>
