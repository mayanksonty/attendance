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
	include ("back_button_faculty.php");
?>

<?php
include("dbconnect.php");

$month=$_REQUEST['month_choice'];
$year=$_REQUEST['year_choice'];
$radio_choice=$_REQUEST['month'];
$boundary=$_REQUEST['boundary'];
$redlist=$_REQUEST['redlist'];
$sub_id=$_REQUEST['sub_id'];

$month_res=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("faculty_exception.php"));
$month_res1=mysqli_fetch_array($month_res);
$month_id=$month_res1[0];


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
$fetch_sem_sec=mysqli_query($con,"select semester,section,subject_name from subject_master where subject_id=$sub_id")or die(include("faculty_exception.php"));
$fetch_sem_sec1=mysqli_fetch_array($fetch_sem_sec);
$semester=$fetch_sem_sec1[0];
$section=$fetch_sem_sec1[1];
$subject_name=$fetch_sem_sec1[2];

    echo"<table style='border:2px solid black; background_color:yellow:' id='generateTable' cellpadding='0'>";
	if($radio_choice==1)
	{
	echo"<tr style='background-color:#8fbc8f;'>"."<td colspan='5' style='font-weight:bolder;'>"."RCET BHILAI/CSE DEPT/SEMESTER:".$semester." /SECTION: ".$section."/".$subject_name."/".$month."/".$year."</td>"."</tr>";
	}
	else if($radio_choice==2)
	{
	echo"<tr style='background-color:#8fbc8f;'>"."<td colspan='5' style='font-weight:bolder;'>"."RCET BHILAI/CSE DEPT/SEMESTER:".$semester." /SECTION: ".$section."/".$subject_name."/UPTO ".$month."/".$year."</td>"."</tr>";
	}
	echo"<tr style='background-color:#8fbc8f'>";
	echo"<th align='left'>ClassRoll</th>"."<th align='left'>StudentName</th>"."<th align='left'>Present</th>"."<th align='left'>Outof</th>"."<th align='left'>Percentage</th>";
	echo"</tr>";
	
//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
//END of BATCH LOGIC
		
	
if($radio_choice==1)	
{
	//particular month
	$student_rs=mysqli_query($con,"select student_name,class_roll,student_id from student_master where semester=$semester && section='$section' order by class_roll")or die(include("faculty_exception.php"));
	while($student_rs1=mysqli_fetch_array($student_rs))
	{
		$attend_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where subject_id=$sub_id && month_id=$month_id && student_id=$student_rs1[2]")or die(include("faculty_exception.php"));
		$attend_rs1=mysqli_fetch_array($attend_rs);
		$present=$attend_rs1[0];
		$out_of=$attend_rs1[1];
		$perc=($present/$out_of)*100;
		if($redlist==1)
			{
			if($perc<$boundary)
			{
			echo"<tr style='background-color:#8fbc8f'>";
			echo"<td>"."$student_rs1[1]"."</td>";
			echo"<td>"."$student_rs1[0]"."</td>";
			echo"<td>"."$present"."</td>";
			echo"<td>"."$out_of"."</td>";
			echo"<td align='left'>".number_format((float)$perc,2, '.', '')."</td>";
			echo"</tr>";	
			}
		}
		
		if($redlist==2)
		{
		if($perc>=$boundary)
		{
		echo"<tr style='background-color:#8fbc8f'>";
		echo"<td>"."$student_rs1[1]"."</td>";
		echo"<td>"."$student_rs1[0]"."</td>";
		echo"<td>"."$present"."</td>";
		echo"<td>"."$out_of"."</td>";
		echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
		echo"</tr>";	
		}
		}
		
	}
	
}

else if($radio_choice==2)
{
	//upto a month
	$student_rs=mysqli_query($con,"select student_name,class_roll,student_id from student_master where semester=$semester && section='$section' order by class_roll")or die(include("faculty_exception.php"));
	while($student_rs1=mysqli_fetch_array($student_rs))
	{
		$attend_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where subject_id=$sub_id && month_id<=$month_id && student_id=$student_rs1[2]")or die(include("faculty_exception.php"));
		$sum_present=0;
		$sum_out_of=0;
		while($attend_rs1=mysqli_fetch_array($attend_rs))
		{
				$present=$attend_rs1[0];
				$out_of=$attend_rs1[1];
				$sum_present+=$present;
				$sum_out_of+=$out_of;
				
		}
		$perc=($sum_present/$sum_out_of)*100;
				if($redlist==1)
				{
				if($perc<$boundary)
				{
				echo"<tr style='background-color:#8fbc8f'>";
				echo"<td>"."$student_rs1[1]"."</td>";
				echo"<td>"."$student_rs1[0]"."</td>";
				echo"<td>"."$sum_present"."</td>";
				echo"<td>"."$sum_out_of"."</td>";
				echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
				echo"</tr>";	
				}
				}
				
				
				if($redlist==2)
				{
				if($perc>=$boundary)
				{
				echo"<tr style='background-color:#8fbc8f'>";
				echo"<td>"."$student_rs1[1]"."</td>";
				echo"<td>"."$student_rs1[0]"."</td>";
				echo"<td>"."$sum_present"."</td>";
				echo"<td>"."$sum_out_of"."</td>";
				echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
				echo"</tr>";	
				}
				}

				
	}
	
}
echo"</table>";
?>

</div>
<?php
	include("dcs_footer.php");
}
?> 