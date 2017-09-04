
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
?>
<script>
	function validation()
	{
		var s=document.getElementById("subject").value;
		if(s==0)
		{
			alert("Select a valid Subject-Section !!");	
		}
		
		else
		{
			document.form1.submit();	
		}
	}
		
		
	
	function form_feed_val()
	{
		
		var y= document.getElementById("month_choice").value;
		var z= document.getElementById("year_choice").value;
		var x= document.getElementById("sub_sec").value;
		var w= document.getElementById("boundary").value;
		
		
		
		
		if(y==0)
		{
			alert("Please Select A Valid Month!");	
		}
		
		else if(z==0)
		{
			alert("Please Select A Valid Year!");	
		}
		else if(x==0)
		{
			alert("Please Select A Valid Subject-Section!");	
		}
		
		else if(w=='')
		{
			alert("Boundary Value Cannot be Empty!!");	
		}
		
		else
		{
			document.form1.submit();	
		}
		
	}
	</script>

<!--<link href="style.css" type="text/css" />-->
<div id="workBox">
	<img src="image/arrow-1293400_960_720.png">
	
    <form action="fac_feed_rcv.php" method="post" name="form1">
    
    <input type="hidden"  id="userid" <?php echo"value='$temp_user_id'"; ?>/>
    <table class="formTable">
    
    <tr><td align="right">Date</td><td><input type="radio" value="1" name="choice" checked="checked"/></td></tr>
    <tr><td align="right">Upto Certain Month:</td><td><input type="radio" value="2" name="choice" /></td></tr>
    
    
		<tr><td align="right">Month:</td><td><select name="month_choice" id="month_choice" class="formCSS" >
        	<option value="0">------ </option>
           <?php
 	$fetch_month_ids=mysqli_query($con,"select month_id,month_name from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$month_idd=$fetch_month_ids1[0];
	$month_namme=$fetch_month_ids1[1];
	echo"<option value='$month_namme'>"." $month_namme "."</option>";
	
}
 
 
 ?>		 </select></td></tr>
  
  
  
  <tr><td align="right">
  Year:</td><td>
  <select name="year_choice" id="year_choice" class="formCSS"  >
        	<option value="0">------ </option>
            <?php
 	$fetch_month_ids=mysqli_query($con,"select distinct year from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$year_val=$fetch_month_ids1[0];
	
	echo"<option value='$year_val'>"." $year_val "."</option>";
	
}
 
 
 ?>
            
		 </select>
    </td>
    </tr>
    
    <tr>
    <td align="right">	Semester:</td><td>
         <select name="sem_choice" id="sem_choice" class="formCSS">
        	<option value="0"> ---- </option>
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
          <select name="sec_choice" id="sec_choice" onChange='bring_subjects();' class="formCSS">
          	<option value="0">----</option>
            <option value="A"> A </option>
            <option value="B"> B </option>
          </select></td></tr>
          <tr><td colspan="2" align="center">
        <div id="div_show"  style="height:auto; border:0px solid #003;">
        
        <script>
                function check_entry()
                {
                    var userid=document.getElementById("userid").value;
                    var month=document.getElementById("month_choice").value;
                    var year=document.getElementById("year_choice").value;
                    var subjectid=document.getElementById("subject").value;
                    var semester=document.getElementById("sem_choice").value;                  
									   
                    var i=new XMLHttpRequest();
                        
                        i.onreadystatechange=function()
                        {
                            if(i.readyState==4 && i.status==200)
                            {
                                document.getElementById("show_message").innerHTML=i.responseText;	
                            }
                        };
                        
i.open("GET","fac_chk_entry_ajax.php?userid=" + userid + "&month=" + month + "&year=" + year + "&subjectid=" + subjectid + "&semester=" + semester,true);
                        i.send();	
                }
                 
        </script>

    	</div>
        </td></tr>
        
        
        
        
        
        
        
        
        
   
    </table>
     </form>
</div><!--EO workBox-->
<div id="show_message" style="position:absolute; top:320px; left:380px; color:#F00;"></div>
<?php
	include("dcs_footer.php");
}
?>
