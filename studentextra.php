<?php
	if($_GET['flag']==3)
	{
?>
<img src="image/logo.png">
                   <form action="checklogin.php" method="post" >
                   <table  width="420" cellspacing="5" class="formTable">
                   <tr><td align="center">LOGIN AS</td>
                   <td><select name="uservalue" class="formCSS" id="loginas" onchange="editform();">
                   <option value="1" onFocus="showbox(1)" <?php if($_GET['flag']==1) echo 'selected="selected"'; ?> >ADMIN</option>
                   <option value="2" onChange="showbox(2)" <?php if($_GET['flag']==2) echo 'selected="selected"'; ?> >FACULTY</option>
                   <option value="3" onChange="showbox(3)" <?php if($_GET['flag']==3) echo 'selected="selected"'; ?> >STUDENT  </option>
                   </select>



</td></tr>


                   <tr><td align="center">USER NAME</td>
                   	   <td><input type="text" name="username" placeholder="Enter Here" class='formCSS'></td></tr><tr>

                   <tr><td align="center">PASSWORD</td>
                   <td><input type="password" name="password" placeholder="Enter Here" class="formCSS"><br></td></tr>

<!-- write your additional student form code here -->

<tr><td align="center">SMESTER</td>
                   <td><select name="uservalue1" class="formCSS" id="loginas" onchange="editform();">
                   <option value="1" onFocus="showbox(1)" selected="selected">3</option>
                   <option value="2" onChange="showbox(2)" >4</option>
                   <option value="3" onChange="showbox(3)" >5</option>
		   <option value="4" onChange="showbox(4)" >6</option>
                   <option value="5" onChange="showbox(5)" >7</option>
	           <option value="6" onChange="showbox(6)" >8</option>
                   

                   </select><br></td></tr>


		   <tr><td align="center">SECTION</td>
                   <td><select name="uservalue" class="formCSS" id="loginas" onchange="editform();">
                   <option value="1" onFocus="showbox(1)" selected="selected">A</option>
                   <option value="2" onChange="showbox(2)" >B</option>
                   
                   </select><br></td></tr>





                   <tr><td align="center"> <input type="Reset" class="formButton"></td><td><input type="submit" value="Login" class="formButton">
                   </td></tr>
                   
                   <tr><td colspan='2' align="center"><marquee style=”height:20;width:200”scrollamount=”200”scrolldelay=”500”>Don't have account? Contact Mr. KAUSHAL SINHA</marquee></td></tr>
                   </table>
                   </form> 
                   </div>
                   </div><!--EO workBox>
                   
<?php
	}
	else
	{
?>
<img src="image/logo.png">
                   <form action="checklogin.php" method="post" >
                   <table  width="420" cellspacing="5" class="formTable">
                   <tr><td align="center">LOGIN AS</td>
                   <td><select name="uservalue" class="formCSS" id="loginas" onchange="editform();">
                   <option value="1" onFocus="showbox(1)" <?php if($_GET['flag']==1) echo 'selected="selected"'; ?> >ADMIN</option>
                   <option value="2" onChange="showbox(2)" <?php if($_GET['flag']==2) echo 'selected="selected"'; ?> >FACULTY</option>
                   <option value="3" onChange="showbox(3)" <?php if($_GET['flag']==3) echo 'selected="selected"'; ?> >STUDENT  </option>
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
                   
<?php
	}
	
?>