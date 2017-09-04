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
	include ("back_button.php");
?>

<script>
	function incrementSem()
	{
			alert("Be cautious while Decrementing Semesters!!");
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("increment_msg").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","incrementSemajax.php",true);
			i.send();
	}
	
</script>	

<span style="position:absolute; left:800px; top:5px; font-weight:bolder; font-size:12px;">
	NOTE: Please Fill the Details below in Sequential Manner!
</span>



<div id="workBox">

<img src="image/636025609789299493_uincrement-logopng.png" />
<form action="decrement_semester_rcv.php" method="post">
<table width="100%" cellspacing="5" class="formTable">
 <tr>
   <th align="center"><u>
      Decrement semester with one click
   </u></th>
   </tr>
   <!--
   <tr><td align="center"><input type="radio" name="update_semester" value="1">Odd Semester to Even Semester</td></tr>
   <tr><td align="center"><input type="radio" name="update_semester" value="2">Even Semester to Odd Semester</td></tr>
   -->
   <tr><td align="center"><input type="button" name="callin" value="Check Semesters in Database!" onClick="incrementSem();"></td></tr>
   <div id="increment_msg" style="font-weight:bolder; color:#F00; margin-left:50px;">
   </div>
   <tr><td align="center"><input type="submit" name="update" value="Decrement" class="formButton"></td></tr>
</table>

</form>


</div><!--EO workBox-->

<?php
	include("dcs_footer.php");
}
?> 