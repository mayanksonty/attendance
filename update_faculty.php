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
	function update_faculty_fun()
		{
			var userid=document.getElementById("user_id").value;
			
		
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_display").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_faculty_ajax.php?userid=" + userid,true);
			i.send();	
		}
		
</script>
<div id="workBox">
<img src="image/ad9a0aaa.png" />
<form action="update_faculty_rcv.php">

	<table width="100%" class="formTable" cellspacing="5">
    	<tr>
        	<th align="center" colspan="2"><u>Update Faculty Details</u></th></tr>
    	<tr>
        	<td align="right">Select Faculty:</td>
			<td>
            	<select name="user_id" id="user_id">
		<?php
		$teacher_rs=mysqli_query($con,"select teacher_name,user_id from user_master where user_type='faculty'");
		while($teacher_rs1=mysqli_fetch_array($teacher_rs))
		{
			echo"<option value=$teacher_rs1[1]>".$teacher_rs1[0]."</option>";
			$i=$teacher_rs1[1];
		}			
		?>    
    			</select>
            </td>
		</tr>
        <tr>
        	<td colspan="2" align="center"><input type="button" value="Show Details" onClick="update_faculty_fun();"></td>
        </tr>
    	
        <tr>
        	<td colspan="2" align="center">
            	<div id="div_display">
    
    			</div>
            </td>
        </tr>
    </table>
    </div>
    
</form>

<?php
	include("dcs_footer.php");
}
?>