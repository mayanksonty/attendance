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
<div id="workBox2">
<img src="image/rw.jpg" style="position:absolute; width:120px; height:100px; left:165px; top:-100px;">
<?php

$year=$_REQUEST['year_choice'];
$month=$_REQUEST['month_choice'];
$semester=$_REQUEST['sem_choice'];
$section=$_REQUEST['sec_choice'];

$monthid_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year") or die(include("admin_exception.php"));
$monthid_rs1=mysqli_fetch_array($monthid_rs);
$month_id=$monthid_rs1[0];

echo"<table class='formTable' border='0' cellspacing='0'>";
echo "<tr>";
echo"<th colspan='2'>"."Faculty - Subject"."</th>"."<th>"."Feed Status"."</th>";
echo "</tr>";

$subject_rs=mysqli_query($con,"select subject_id from subject_master where semester=$semester && section='$section'") or die(include("admin_exception.php"));
while($subject_rs1=mysqli_fetch_array($subject_rs))
{
	
	$subject_teacher_rs=mysqli_query($con,"select teacher_name from user_master where user_id in (select teacher_id from teacher_subject_relation where subject_id=$subject_rs1[0])");
	$subject_teacher_rs1=mysqli_fetch_array($subject_teacher_rs);
	$teacher_name=$subject_teacher_rs1[0];
	
	$subject_name=mysqli_query($con,"select subject_name from subject_master where subject_id=$subject_rs1[0]");
	$subject_name1=mysqli_fetch_array($subject_name);
	$subject_name_result=$subject_name1[0];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester	group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
		
	
	$abc=mysqli_query($con,"select distinct subject_id from ".$batch_str." where month_id=$month_id && subject_id=$subject_rs1[0]") or die(include("admin_exception.php"));
	$abc2=mysqli_fetch_array($abc);
	if($abc2==NULL)
	{
		$a=0;	
	}
	else
	{
		$a=1;	
	}
	echo"<tr>";
	if($a==1)
	{
		echo"<td colspan='2' style='width:80%;' align='center'>"."$teacher_name"." - "."$subject_name_result"."</td>";
		echo"<td align='center'>"."<img src='image/right.png' style='width:20px; height:20px; position:relative;'>"."</td>";
	}
	else if($a==0)
	{
		echo"<td colspan='2' style='width:80%;' align='center'>"."$teacher_name"." - "."$subject_name_result"."</td>";
		echo"<td align='center'>"."<img src='image/wrong.png' style='width:20px; height:20px; position:relative;'>"."</td>";
			
	}
	echo"</tr>";	
}


echo "</table>";
?>

</div>
<?php
include("dcs_footer.php");
}
?>