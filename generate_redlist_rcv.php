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

<?php
include("dbconnect.php");
$section=$_REQUEST['sec_choice'];
$semester=$_REQUEST['sem_choice'];
$month=$_REQUEST['month_choice'];
$year=$_REQUEST['year_choice'];
$radio_choice=$_REQUEST['month'];
$boundary=$_REQUEST['boundary'];
$redlist=$_REQUEST['redlist'];

$month_res=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("admin_exception.php"));
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
		window.location.assign("admin_index.php");	
		
	}
	
	
	function open_adminR()
	{
		window.location.assign("admin_review.php");
	}
</script>
<form>
<input type="button" value="PRINT" onclick="printf();" class="formButton" style="position:absolute; left:5px; top:75px;"/>
</form>


<?php
$flag=0;
if($radio_choice==1)
{
		
/*	$ress=mysqli_query($con,"select count(distinct subject_id) from attendance_master where month_id=$month_id")or die(include("admin_exception.php"));
	$ress1=mysqli_fetch_array($ress);
	$count_subjectt=$ress1[0];
	
	if($count_subjectt!=11)
	{	
		$flag=3;
		goto label;	
	}
*/		
?>
<div id="one">
<table width="100%" style="border:2px solid black;" id="generateTable" cellpadding="0" >
	<th style="background-color:#8fbc8f">Class Roll</th><th style="background-color:#8fbc8f">Student Name</th>



<?php
		
		
		
		
		$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester && section='$section' ")or die(include("admin_exception.php"));
		$j=0;
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				$outof_res=mysqli_query($con,"select max(total_lectures) from attendance_master where subject_id=$temp_subject_id && month_id=$month_id")or die(include("admin_exception.php"));
				$outof_res1=mysqli_fetch_array($outof_res);
				$outof[$j]=$outof_res1[0];
				//echo $outof[$j];
				$j++;
				echo"<th style='background-color:#8fbc8f' width='50'>$temp_subject</th>";
		}
		echo"<th style='background-color:#8fbc8f'>Percentage</th>";
		echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester && section='$section' ")or die(include("admin_exception.php"));
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='10'>TOTAL</th>"."<th></th>"."</tr>";
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
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section' && flag=1)")or die(include("admin_exception.php"));
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			
			$sum_total1=0;
			//echo"<tr>";
			
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
			$subject_res=mysqli_query($con,"select subject_id from attendance_master where month_id=$month_id && student_id=$temp_student_id  order by subject_id")or die(include("admin_exception.php"));
			
			$sum_present=0;
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" )or die(include("admin_exception.php"));
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select present,total_lectures from attendance_master where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id  order by subject_id")or die(include("admin_exception.php"));
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
				$temp_present=$attendance_rs1[0];
				$temp_total=$attendance_rs1[1];
				$present_array[$xy]=$temp_present;
				$sum_lec[$xy]=$temp_total;
				$xy++;
				//echo"<td>".$temp_present."</td>";
				
				$sum_present+=$temp_present;
				$sum_total1+=$temp_total;
			}
			$perc=($sum_present/$sum_total1)*100;
			
			if($redlist==1)
			{
					if($perc<$boundary)
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
			}
			
			if($redlist==2)
			{
					if($perc>=$boundary)
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
			}
			
			
		}

}

else if($radio_choice==2)
{
	$selected_monthes=mysqli_query($con,"select distinct month_id from attendance_master where month_id<=$month_id")or die(include("admin_exception.php"));
	while($selected_monthes1=mysqli_fetch_array($selected_monthes))
	{
				$ress=mysqli_query($con,"select count(distinct subject_id) from attendance_master where month_id=$selected_monthes1[0]")or die(include("admin_exception.php"));
				$ress1=mysqli_fetch_array($ress);
				$count_subjectt=$ress1[0];
				
				if($count_subjectt!=11)
				{	
					$flag=3;
					goto label;	
				}
	}
	
	
	?>
	
	<div id="one">
<table width="100%" style="border:2px solid black;" id="generateTable" cellpadding="0" >
	<tr><td>
    

    </td></tr>
	<tr>
    <th style="background-color:#8fbc8f">Class Roll</th><th style="background-color:#8fbc8f">Student Name</th>

<?php
	
	
	
	
	
	$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester && section='$section' ")or die(include("admin_exception.php"));
		$j=0;
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				
				
					$min_month_res=mysqli_query($con,"select min(month_id) from attendance_master")or die(include("admin_exception.php"));
					$min_month_res1=mysqli_fetch_array($min_month_res);
					$min_month=$min_month_res1[0];
					
					$month_set_res=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month")or die(include("admin_exception.php"));
					
					$sum_total_lectures=0;
					while($month_set_res1=mysqli_fetch_array($month_set_res))
					{
						$temp_month=$month_set_res1[0];
						$outof_res=mysqli_query($con,"select total_lectures from attendance_master where subject_id=$temp_subject_id && month_id=$temp_month")or die(include("admin_exception.php"));
						$outof_res1=mysqli_fetch_array($outof_res);
						$sum_total_lectures+=$outof_res1[0];	
						
						
					}
					$outof[$j]=$sum_total_lectures;
				
				
				
				//echo $outof[$j];
				$j++;
				echo"<th style='background-color:#8fbc8f'>$temp_subject</th>";
		}
		echo"<th style='background-color:#8fbc8f'>Percentage</th>";
		echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester && section='$section' ")or die(include("admin_exception.php"));
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		echo"<tr>"."<th style='background-color:#8fbc8f'></th>"."<th style='background-color:#8fbc8f'></th>"."<th style='background-color:#8fbc8f' colspan='10'>TOTAL</th>"."<th style='background-color:#8fbc8f'></th>"."</tr>";
		echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			echo"<th style='background-color:#8fbc8f'>".$outof[$i]."</th>";
			$sum_outof +=$outof[$i];
		}
		echo"<th style='background-color:#8fbc8f'>100%</th>"."</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section' && flag=1)")or die(include("admin_exception.php"));
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			echo"<tr>";
			
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
			$subject_res=mysqli_query($con,"select subject_id from attendance_master where month_id=$month_id && student_id=$temp_student_id  order by subject_id")or die(include("admin_exception.php"));
			
			$sum_present=0;
			$mn=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" )or die(include("admin_exception.php"));
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				//$attendance_rs=mysqli_query($con,"select present from attendance_master where month_id<=$month_id && month_id>=$min_month subject_id=$temp_subject_id && student_id=$temp_student_id  order by subject_id") or die("ERROR 3");
				
				$month_set_ress=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month")or die(include("admin_exception.php"));
					
					
				
				
				$sum_present_lectures=0;
				//while($attendance_rs1=mysqli_fetch_array($attendance_rs))
				while($month_set_ress1=mysqli_fetch_array($month_set_ress))
				{
						$temp_month_idd=$month_set_ress1[0];
						
						$present_res=mysqli_query($con,"select present from attendance_master where subject_id=$temp_subject_id && month_id=$temp_month_idd && student_id=$temp_student_id order by subject_id")or die(include("admin_exception.php"));
						$present_res1=mysqli_fetch_array($present_res);
						$sum_present_lectures+=$present_res1[0];
					
					
				}
				
				
				
				
				
				//$temp_present=$attendance_rs1[0];
				
				$present_array2[$mn]=$sum_present_lectures;
				$mn++;
				//echo"<td>".$sum_present_lectures."</td>";
				$sum_present+=$sum_present_lectures;
		}


			$perc=($sum_present/$sum_outof)*100;

	if($redlist==1)
	{
			if($perc<$boundary)
			{	
				echo"<tr bgcolor='#FF1C1C'>";
				echo"<td align='center'>".$temp_class_roll."</td>";
				echo"<td align='center'>".$temp_student_name."</td>";
				for($yz=0;$yz<$mn;$yz++)
				{
					echo"<td align='center'>".$present_array2[$yz]."</td>";	
				}
				
				
				
			echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
			echo"</tr>";
			}
	}
	
	else if($redlist==2)
		{
		
		 if($perc>=$boundary)
			{
					echo"<tr bgcolor='#00FF00'>";
				echo"<td align='center'>".$temp_class_roll."</td>";
				echo"<td align='center'>".$temp_student_name."</td>";
				for($yz=0;$yz<$mn;$yz++)
				{
					echo"<td align='center'>".$present_array2[$yz]."</td>";	
				}
				
				
				
				
			echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
			echo"</tr>";
			}
		}
	
		}
	
}
label:
if($flag==3)
{
echo"<div id='incomplete' style=' position:absolute; left:400px; top:130px; font-weight:bolder;'>";
echo "One or More Faculty haven't feeded the attendance details yet!!"."<br>"."<br>";
echo "Kindly GO THROUGH Admin Review Option"."<br>";

echo"<input type='button' value='Redirect to Admin Review' onclick='open_adminR();'";
echo"</div>";
}


?>
</table>
</div>
<?php
	include("dcs_footer.php");
}
?> 