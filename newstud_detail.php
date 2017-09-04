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

	
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
	$user_id=$_SESSION['user_id'];
	$new_stud=$_REQUEST['new_stud'];
	
	
	
	
?>
<script>

</script>

<table class="formTable">
	<tr>
    	<th> Serial </th>
    	<th> Student Name </th>
        
    
    </tr>
  <?php echo "<input type='hidden' value='$new_stud' id='total'>"; ?>
 <?php for($j=0;$j<$new_stud;$j++)
  {?>
  	<tr>
    	<td align="center"><?php echo $j+1 ;?></td>
    	<td><input type="text" name="stud_name[]" class="formCSS"></td>
            	
  	</tr>
  <?php
  }?>
	<tr><td></td><td colspan="2" align="left"><input type="button" value="Submit" onclick="form_feed_val2();" class="formButton"></td></tr>

</table>

<?php
}
?>