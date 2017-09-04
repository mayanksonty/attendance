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
	<div id="workBox" style="top:50px; left:400px; position:absolute;">
   	
            
        <div id="ghi" style="width:450px;">
        NOTE:Checked Monthes will be provided as an option to Faculties to feed information.
        
        </div>
        <form action="validate_rcv.php" method="get" name="form1" id="form1">
        <?php
        
        include("dbconnect.php");
        //include("dcs_header.php");
        
        echo"<table name='m_y' id='m_y' class='formTable'>";
        echo"<tr>"."<th>"."MONTH"."</th>"."<th>"."YEAR"."</th>"."<th>"."VALID"."</th>"."</tr>";
        $month_yr_rs=mysqli_query($con,"select month_name,year,valid,month_id from month_master");
        while($month_yr_rs1=mysqli_fetch_array($month_yr_rs))
        {
            echo"<tr>";
            $m_name=$month_yr_rs1[0];
            $y_value=$month_yr_rs1[1];
            $valid=$month_yr_rs1[2];
            
            echo"<td align='center'>"."$m_name"."</td>";
            echo"<td align='center'>"."$y_value"."</td>";
            
            if($valid==0)
            {
            echo"<td align='center'>"."<input value='$month_yr_rs1[3]' type='checkbox' name='validity[]' id='validity'>"."</td>";
            }
            
            else if($valid==1)
            {
            echo"<td align='center'>"."<input value='$month_yr_rs1[3]' type='checkbox' name='validity[]' checked id='validity'>"."</td>";
            }
            echo"</tr>";		
        }
		
		echo"<tr>"."<td colspan='3' align='center'>"."<input type='submit' value='Validate' class='formButton'/>";
        
        echo"</table>"
        
        ?>
        
        
   
        </form>
        
     </div>   
<?php
	include("dcs_footer.php");
}
?>