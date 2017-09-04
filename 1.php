<?php
	include("dcs_header.php");
	include("back_button.php");
  ?>
<div id="workBox">
<img src="image/ad9a0aaa.png" />
 
<form action="1_rcv.php" method="post" name="form1" id="form1">
   <table  width="100%" class="formTable" cellspacing="5">
    	 <tr>
        	<th align="center" colspan="2"><u>Validate Faculty Attendance Option</u></th></tr>
    	</tr>
      <tr>
      <th align="right">Current Enabled:</th>
      <td >
      <?php
      $month_res=mysqli_query($con,"select attendanceoption from admincontrols");
      $month_res1=mysqli_fetch_array($month_res);
      $a=$month_res1[0];
      if($a==1)
      echo" Up certain to month ";
      else if($a==2) 
      echo" Particular Month ";
      else
       echo" Both";
      ?></td> 
      </tr>
      
      
     
        	<th align="right">Select Option:</th>
			
      <td>
  <select name="aayush">
  <option value="1">Enable Up to Certain Month Option</option>
  <option value="2">Enable Particular Month Option</option>
  <option value="3"> Enable Both</option>
  </select>
     </td> 
  </tr>    
   <tr>  
        <td colspan="2" align="center">
       <input style="width:100px" type="submit" value="Submit"  >
    	</td>
    </tr>
   </table> 
   </form>
   </div>
   <?php
  include("dcs_footer.php"); 
   
   ?>
  