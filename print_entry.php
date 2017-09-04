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
	$user_id=$_SESSION['user_id'];
	$month_id=$_SESSION['month_id'];
	$subject_id=$_SESSION['subject_id'];
	
	$month_rs=mysqli_query($con,"select month_name,year from month_master where month_id=$month_id") or die("ERROR");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_name=$month_rs1[0];
	$year=$month_rs1[1];
	
	$sub_rs=mysqli_query($con,"select semester,section,subject_name from subject_master where subject_id=$subject_id") or die("ERROR");
	$sub_rs1=mysqli_fetch_array($sub_rs);
	
	$sem=$sub_rs1[0];
	$sec=$sub_rs1[1];
	$sub=$sub_rs1[2];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$sem group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
	
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	
/*	
	else if($sem==3)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from third_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==3)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from third_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==4)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from fourth_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==5)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from fifth_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==6)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from sixth_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==7)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from seventh_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==8)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from eight_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
*/	

echo "<div style='position:absolute; left:400px; top:10px;'>";	
	echo "<b>"."Attendance of $month_name $year"."</b>"."<br>";
	echo "Semester : $sem"." ";
	echo "Section : $sec"."<br>";
	echo "Subject : $sub";
echo"</div>";
	?>
   
	<table border="1" id="generateTable" style="background-color:#CCC;">
	<tr style="color:#00C;">
    	<th>ROLL NO.</th>
    	<th>STUDENT NAME</th>
        <th>TOTAL</th>
        <th>PRESENT</th>
        <th>PERCENTAGE</th>
    </tr>
<?php
    while($attendance_rs1=mysqli_fetch_array($attendance_rs))
	{	
	
		$stud_name_rs=mysqli_query($con,"select student_name,class_roll from student_master where student_id=$attendance_rs1[0]");
		$stud_name_rs1=mysqli_fetch_array($stud_name_rs);
		
		if($attendance_rs1[1]!=0)
		{
			$x=($attendance_rs1[2]/$attendance_rs1[1])*100;
		}
		else
		{
			$x=0;
		}
		echo"<tr>";
			echo "<td align='center'>"."$stud_name_rs1[1]"."</td>";
			
			echo "<td align='center'>"."$stud_name_rs1[0]"."</td>";
			echo "<td align='center'>"."$attendance_rs1[1]"."</td>";
			echo "<td align='center'>"."$attendance_rs1[2]"."</td>";
			echo "<td align='center'>".number_format((float)$x,2, '.', '')."</td>";
		echo "</tr>";
	}
	echo "</table>";
include("dcs_footer.php");
}
?>