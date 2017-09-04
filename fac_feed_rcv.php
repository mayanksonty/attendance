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
?>
<script>
var flag=0;
var label=0;
	function confirm()
	{
			var studcount=document.getElementById("studcount").value;
			var x=document.getElementsByName("outof[]");
			var p=document.getElementsByName("present[]");
			
			var i;
			for(i=0;i<=studcount-1;i++)
			{
				
				if(parseInt(p[i].value) > parseInt(x[i].value) )
				{
			//		alert("Present must be less than Total");
					label=0;
					break;
					
				}
				else
				{
					label=1;	
				}
			
			}
			
		if(label==0)
		{
			alert("Present must be less than Total in row number " + (i+1)  );
		}
		else if(label=1)
		{
			if(flag==0 )
			{
			alert("Kindly Check whether the details filled are correct or not and then press SUBMIT again!");	
			flag=1;
			}
			else if(flag==1)
			{
				enable_button();
				document.form1.submit();	
			}
	
		}
	}
	function checkPresent(z)
		{	
		
		
			var t=document.getElementById("num1").value;
			var studcount=document.getElementById("studcount").value;
			var x=document.getElementsByName("outof[]");
			var p=document.getElementsByName("present[]");
			
		alert (t);
			if(z.value>t)
			{
				alert("Present must be less than Total");
			}	
			/*
		
			for(i=0;i<=studcount-1;i++)
			{
				
				if(p[i].value>t)
				{
					alert("Present must be less than Total");
					break;
				}
				else if(p[i].value<=t)
				{
						
				}	
			
			}*/
		}
		function enable_button()
		{
			//var x=document.getElementById("num1");
			
			var studcount=document.getElementById("studcount").value;
			
			var i=1;
			
			var y=document.getElementsByName("outof[]");
			for(i=0;i<=studcount-1;i++)
			{
				y[i].disabled = false;	
			}
			//fill();
		}
		function disable_button()
		{
			var studcount=document.getElementById("studcount").value;
			var i=1;
			
			var y=document.getElementsByName("outof[]");
			for(i=0;i<=studcount-1;i++)
			{
				y[i].disabled = true;	
			}
				
		}
	</script>
<?php

$choice=$_REQUEST['choice'];
$year=$_REQUEST['year_choice'];
$month=$_REQUEST['month_choice'];
$_SESSION['sem']=$_REQUEST['sem_choice'];
$semester=$_REQUEST['sem_choice'];
$section=$_REQUEST['sec_choice'];
$subject_id=$_REQUEST['subject_id'];
$_SESSION['subject_id']=$subject_id;
//echo $subject_id;


?>

<div id="total" style="position:absolute; top:50px; left:350px;">
<?php
if($choice==1)	
echo "Total Lectures in ". $month." <input type='number' id='num1' name='num1' onkeyup='fill();' onfocus='enable_button();'>"; //change aayush
else
echo "Total Lectures up to ". $month." <input type='number' id='num1' name='num1' onkeyup='fill();' onfocus='enable_button();'>";//change aayush
?>	
</div>

<?php



$monthid_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("faculty_exception.php"));
$monthid_rs1=mysqli_fetch_array($monthid_rs);
$month_id=$monthid_rs1[0];

$_SESSION['month_id']=$month_id;
$student_rs=mysqli_query($con,"select class_roll,student_name,student_id from student_master where semester=$semester && section='$section' order by class_roll") or die(include("faculty_exception.php"));

$studcount_rs=mysqli_query($con,"select count(*) from student_master where semester=$semester && section='$section'") or die(include("faculty_exception.php"));
$studcount_rs1=mysqli_fetch_array($studcount_rs);
$studcount=$studcount_rs1[0];
//echo "$studcount_rs1[0]";

if($choice==1)
{

	echo "<form name='form1' action='insert_attendance.php'>";
}
else
{
	echo "<form name='form1' action='intermediate_attendance.php'>";	
}

echo "<input type='hidden' id='studcount' value='$studcount' name='studcount'>";
echo "<table width='80%' id='update_attendance_table' cellspacing='3'>";
?>
	<tr style="color:#00C">
    	<th align="center">Class Roll Number</th>
        <th align="left">Student Name</th>
        <th align="left">Present</th>
        <th align="left">Total Lectures</th>
    </tr>
<?php

		while($student_rs1=mysqli_fetch_array($student_rs))
		{
			if($semester==3)
			{
			echo "<tr>";
				echo"<td align='center'>".$student_rs1[0]."</td>"."<td>".$student_rs1[1]."</td>"."<td>"."<input type='number' value='0' class='present' name='present[]' >"."</td>"."<td>"."<input type='number' id='outof' name='outof[]' draggable='false'>"."</td>";
			echo "</tr>";
			
			
			echo"<input type='hidden' name='student_id[]' value='$student_rs1[2]'>";	
			}
			else
			{
				echo "<tr>";
				echo"<td align='center'>".$student_rs1[0]."</td>"."<td>".$student_rs1[1]."</td>"."<td>"."<input type='number' value='0' class='present' name='present[]' onfocus='disable_button();'>"."</td>"."<td>"."<input type='number' id='outof' name='outof[]' draggable='false' disabled='disabled'>"."</td>";
			echo "</tr>";
			
			
			echo"<input type='hidden' name='student_id[]' value='$student_rs1[2]'>";	
				
			}
		}
		
			echo "<tr>"."<td>"."</td>"."<td colspan='2' align='left'>"."<input type='button' onclick='confirm();' value='SUBMIT' class='formButton'>"."</td>"."</tr>";

echo "</table>";
echo "</form>";



include("dcs_footer.php");
}
?>