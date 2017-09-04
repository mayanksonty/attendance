<?php
	include("dcs_header.php");
	include("back_button.php");
?>

<script>
	function display_student()
	{
		var semester=document.getElementById("semester").value;
		var section=document.getElementById("section").value;
			
			var i=new XMLHttpRequest();
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_display_student").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_student_ajax.php?semester=" + semester + "&section=" + section,true);
			i.send();	
	}
	function display_sdetails()
	{
		var student_id=document.getElementById("student_id").value;
		
			
			var i=new XMLHttpRequest();
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("new_display_student").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_student_ajax2.php?student_id=" + student_id,true);
			i.send();
	}
</script>
<div id="workBox">
<img src="image/540f3d3ed5ae42fe222d2ffc_user-icon-male.png" />
<form action="update_student_rcv.php" method="post">
	<table cellspacing="4" class="formTable">
     <tr><th colspan="2"><u>Update Student Details</u></th></tr>
    
    	<tr>
        	<td align="right">Semester:</td>
            <td>
            	<select name="semester" id="semester" class="formCSS">
                	<option>---</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="5">5th</option>
                    <option value="6">6th</option>
                    <option value="7">7th</option>
                    <option value="8">8th</option>
                </select>
            </td></tr>
            <tr>
            <td align="right">Section:</td>
            <td>
            	<select name="section" id="section" class="formCSS">
                	<option>---</option>
                    <option>A</option>
                    <option>B</option>
                </select>
            </td>
        </tr>
       
       <tr><td colspan="2" align="center">
    		<input type="submit" value="PROCEED" />
        </tr>
       
       
       <!--<tr><td colspan="2" align="center">
    	<div id="div_display_student">
    
   		 </div></td>
 	   </tr>
       
       <tr>
       		<td colspan="2" align="center">
            	 <div id="new_display_student">
   				</div>
       		</td>
       </tr>	   
       -->
    </table>
    
    
</form>
</div>
<?php
	include("dcs_footer.php");
?>