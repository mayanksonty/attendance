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
	function fetch_sub_update()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_subject_allot.php?semester=" + sem + "&section=" + sec,true);
			i.send();
	}
	
	
	function update_allot_fn(subject_id,x)
		{	
			
			var y=document.getElementsByName("teacher_id[]");
			var teacher_uid=y[x].value;
		
			var j=new XMLHttpRequest();
			
			j.onreadystatechange=function()
			{
				if(j.readyState==4 && j.status==200)
				{
					document.getElementById("div_new").innerHTML=j.responseText;	
				}
			};
			
			j.open("GET","update_allot_ajax.php?subject_id=" + subject_id + "&teacher_id=" + teacher_uid,true);
			j.send();
			
		}
		

</script>
<div id="div_new" style="width:705px; font-weight:bolder; position:absolute; left:800px; top:20px; height:auto; border:0px solid #003;">
    
    	</div>   <form >
<div id="workBox">
<img src="image/6croyqA9i.png" />
	
     
    <table border="0" cellspacing="5" width="100%">
    <tr><th colspan="2"><u>Update Allotment</u></th></tr>
    <tr><td align="right">
    	Semester:</td><td>
         <select name="sem_choice" id="sem_choice" onChange='fetch_sub_update();' class="formCSS">
        	<option> ---- </option>
           <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select>        
      </td></tr>
      <tr><td align="right">   
         Section:</td><td>
          <select name="sec_choice" id="sec_choice" onChange='fetch_sub_update();' class="formCSS">
          	<option value="A"> A </option>
            <option value="B"> B </option>
          </select></td></tr>
    </table>      
        <div id="div_show" style="width:705px; height:auto; border:0px solid #003;">
    
    	</div>
		     
       
    </form>
</div>
<?php
	include("dcs_footer.php");
}
?> 