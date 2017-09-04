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

<script src="js/add_faculty.js"></script>


	<div id="workBox">
    <img src="image/community-users-icon.png" />
	<form action="add_faculty_rcv.php" method="post" name="form1">
    	<table cellspacing="5" border="0" width="100%" class="formTable">
        <tr>
          <th colspan="2"><u>Faculty Signup</u></th>
          </tr>
            <tr>
              <td align="right">Faculty Type:</td>
             <td align="left"><select name="user_type" class="formCSS" >
                     <option value="faculty" selected="selected">Faculty</option>
                     <option value="admin">Admin</option>
                     </select></td></tr>
        	<tr><td align="right">Faculty Name:</td><td><input type="text" name="faculty_name" class="formCSS" id="fac1"></td></tr>
            <tr><td align="right">Username:</td><td><input type="text" id="user_name" name="faculty_user" class="formCSS" ><span id="message" style="color:red;">
    
    </span></td></tr>
            <tr><td align="right">Password:</td><td><input type="password" name="faculty_pswd" onFocus="check_username();" class="formCSS" id="fac3"></td></tr>
            <tr><td colspan="2" align="center"><input type="button" value="Submit" class="formButton" onclick="form_feed_val();"></td></tr>
            
            
        </table>
	

	</form>
    </div><!--EO workBox-->
<?php
	include("dcs_footer.php");
}
?>
