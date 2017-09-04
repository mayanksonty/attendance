<?php
session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['student_id']))
{
	header("location:login.php");
}
else
{


	include("dcs_header.php");
?>
<?php
	$student_name=$_SESSION['student_name'];
	$student_id=$_SESSION['student_id'];
	$semester=$_SESSION['semester'];
	$section=$_SESSION['section'];
	$class_roll=$_SESSION['class_roll'];
	echo "<div align='center' style='font-weight:bold; position:absolute; left:475px; top:5px;'>";
	echo "Hello!"." ".$student_name;
	echo "</div>"."<br>";
?>	

<div id="workBox" style="top:135px;">
<img src="image/graduate-155906_960_720.png" />
</div>

<table width="100%" style="border:2px solid black; top:140px;" id="generateTable" cellpadding="0" >
	<tr>
    <th style="background-color:#8fbc8f">Class Roll</th><th style="background-color:#8fbc8f">Student Name</th>


<?php		
$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester && section='$section' ")or die("ERROR 0");
		$j=0;
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				$outof_res=mysqli_query($con,"select sum(total_lectures) from attendance_master where subject_id=$temp_subject_id && student_id=$student_id")or die("ERROR 1");
				$outof_res1=mysqli_fetch_array($outof_res);
				$outof[$j]=$outof_res1[0];
				//echo $outof[$j];
				$j++;
				echo"<th style='background-color:#8fbc8f' width='50'>$temp_subject</th>";
		}
		echo"<th style='background-color:#8fbc8f'>Percentage</th>";
		echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester && section='$section' ")or die("ERROR 0");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='10'>outof</th>"."<th></th>"."</tr>";
		echo"<tr style='background-color:#8fbc8f'>"."<th colspan='2'></th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			echo"<th style='background-color:#8fbc8f;'>".$outof[$i]."</th>";
			$sum_outof +=$outof[$i];
		}
		echo"<th>100%</th>";
		echo"</tr>";
		
		
			
		
		//$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where semester=$semester && section='$section'")or die("ERROR 1");
		
		
		
		//while($student_res1=mysqli_fetch_array($student_res))
		//{
			//echo"<tr>";
			
			$temp_student_name=$student_name;
			$temp_class_roll=$class_roll;
			$temp_student_id=$student_id;
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
			$subject_res=mysqli_query($con,"select distinct subject_id from attendance_master where student_id=$temp_student_id order by subject_id");
			
			$sum_present=0;
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" )or die("ERROR 2");
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select sum(present) from attendance_master where subject_id=$temp_subject_id && student_id=$temp_student_id  order by subject_id") or die("ERROR 3333");
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
				$temp_present=$attendance_rs1[0];
				
				$present_array[$xy]=$temp_present;
				$xy++;
				//echo"<td>".$temp_present."</td>";
				
				$sum_present+=$temp_present;
			}
			$perc=($sum_present/$sum_outof)*100;
			
			if($perc<70)
			{	
				echo"<tr bgcolor='#FF1C1C'>";
				echo"<td align='center'>".$temp_class_roll."</td>";
				echo"<td align='center'>".$temp_student_name."</td>";
				for($yz=0;$yz<$xy;$yz++)
				{
					echo"<td align='center'>".$present_array[$yz]."</td>";	
				}
				
				
				
			echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
			echo"</tr>";
			}
			else
			{
					echo"<tr bgcolor='#00FF00'>";
				echo"<td align='center'>".$temp_class_roll."</td>";
				echo"<td align='center'>".$temp_student_name."</td>";
				for($yz=0;$yz<$xy;$yz++)
				{
					echo"<td align='center'>".$present_array[$yz]."</td>";	
				}
				
				
				
				
			echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
			echo"</tr>";
			}
			
			
		
	echo "</table>";
	
//

		
?>
<?php
	include("dcs_footer.php");
		}
?>