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
<?php
	
	$user_id=$_SESSION['user_id'];
	$month_choice=$_REQUEST['month_choice'];
	$year_choice=$_REQUEST['year_choice'];
	$subject_id=$_REQUEST['sub_id'];
  ?>
  <script>
	function printf()
	{
		old=document.getElementsByTagName("body").innerHTML;
		newc=document.getElementById("one").innerHTML;
	
		document.write("<html><body><div id='one'>" + newc + "</div></body></html>");
		window.print();
		window.location.assign("faculty_index.php");	
		
	}
</script>
<form>
<input type="button" value="PRINT" onclick="printf();" class="formButton" style="position:absolute; left:5px; top:75px;"/>
</form>

<div id="one">
	
	<?php
	$month_id_res=mysqli_query($con,"select month_id from month_master where month_name='$month_choice' && year=$year_choice")or die(include("faculty_exception.php"));
	$month_id_res1=mysqli_fetch_array($month_id_res);
	$month_id=$month_id_res1[0];
	
	
	$month_rs=mysqli_query($con,"select month_name,year from month_master where month_id=$month_id")or die(include("faculty_exception.php"));
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_name=$month_rs1[0];
	$year=$month_rs1[1];
	
	$sub_rs=mysqli_query($con,"select semester,section,subject_name from subject_master where subject_id=$subject_id")or die(include("faculty_exception.php"));
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
  
	?>
   <?php
  	echo"<table border='1' id='generateTable' style='background-color:#CCC;'>"  ;
   echo"<tr style='background-color:#CCC;'>"."<td colspan='5' style='font-weight:bolder;'>"."RCET BHILAI/CSE DEPT/SEMESTER:".$sem." /SECTION: ".$sec."/".$sub."/".$month_name."/".$year."</td>"."</tr>";
	echo"<tr style='background-color:#CCC'>";
	echo"<th align='left'>Roll NO</th>"."<th align='left'>STUDENT NAME</th>"."<th align='left'>TOTAL</th>"."<th align='left'>PRESENT</th>"."<th align='left'>PERCENTAGE</th>";
	echo"</tr>";
  ?>
<?php
    while($attendance_rs1=mysqli_fetch_array($attendance_rs))
	{	
	
		$stud_name_rs=mysqli_query($con,"select student_name,class_roll from student_master where student_id=$attendance_rs1[0]")or die(include("faculty_exception.php"));
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
?>
</div>
<?php
	include("dcs_footer.php");
}
?>
