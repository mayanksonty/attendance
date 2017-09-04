<?php
	include("dcs_header.php");

	include("dbconnect.php");
	$section=$_REQUEST['sec_choice'];
	$semester=$_REQUEST['sem_choice'];
	$month=$_REQUEST['month_choice'];
	$year=$_REQUEST['year_choice'];
	
	$month_res=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("admin_exception.php"));
$month_res1=mysqli_fetch_array($month_res);
$month_id=$month_res1[0];

//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
//	mysqli_query($con,"insert into ".$batch_str."(month_id,subject_id,student_id,total_lectures,present) values".$str )or die(include("faculty_exception.php"));


?>

<script>
	var old;
	var newc;

	function printf()
	{
		//window.print();
		
		old=document.getElementsByTagName("body").innerHTML;
		newc=document.getElementById("one").innerHTML;
	
		document.write("<html><body><div id='one'>" + newc + "</div></body></html>");
		window.print();
		
		//window.location.assign("admin_index.php");	
		
		//document.getElementByTagName("body").innerHTML=old;
		
	
	}
	
	
</script>
<form>
<input type="button" value="PRINT" onclick="printf();" class="formButton" style="position:absolute; left:5px; top:75px;"/>
</form>	
	<div id="one">
	

<table width="90%" style="border:1px solid black;" id="generateTable" cellpadding="0" border="1" cellspacing="0" align="center">
	
    <tr><td colspan="14" align="center" style="background-color:#f5ecd4; font-weight:600;">
        	<font size="2">RUNGTA GROUP OF INSTITUTION,&nbsp;Bhilai</font>
        </td></tr>
	<tr><td colspan="14" align="center" style="background-color:#f5ecd4; font-weight:600;">
    <font size="2">
    	<?php 
			echo "DEPARTMENT OF COMPUTER SCIENCE & ENGINEERING ";
		?>
	</font>
    </td></tr>
    <tr><td colspan="14" align="center" style="background-color:#f5ecd4; font-weight:600;">
    <font size="2">
    <?php
    echo"ATTENDANCE REPORT : SEMESTER : ".$semester." / "." SECTION : ".$section." / "."MONTH : UP TO ".$month." ".$year;
	?>
    </font>
	</td></tr>
	
	
    <tr style="background-color:#8fbc8f;  font-weight:600;" align="center"><td colspan="2"></td><td colspan="6" ><font size="2">THEORY</font></td><td colspan="4"><font size="2">LAB</font></td><td colspan="2"></td></tr>

    
	<tr>
    <th style="background-color:#8fbc8f"><font size="2">Class Roll</font></th><th style="background-color:#8fbc8f" align="left" width="50%"><font size="2">Student Name</font></th>

<?php

	$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester && section='$section' ")or die(include("login_redirect.php"));
		$j=0;
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				
				
					$min_month_res=mysqli_query($con,"select min(month_id) from ".$batch_str)or die(include("login_redirect.php"));
					$min_month_res1=mysqli_fetch_array($min_month_res);
					$min_month=$min_month_res1[0];
					
					$month_set_res=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month")or die(include("login_redirect.php"));
					
					$sum_total_lectures=0;
					while($month_set_res1=mysqli_fetch_array($month_set_res))
					{
						$temp_month=$month_set_res1[0];
						$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month")or die(include("login_redirect.php"));
						$outof_res1=mysqli_fetch_array($outof_res);
						$sum_total_lectures+=$outof_res1[0];	
						
						
					}
					$outof[$j]=$sum_total_lectures;
				
				
				
				//echo $outof[$j];
				$j++;
				echo"<th style='background-color:#8fbc8f' width='50'>"."<font size='2'>".$temp_subject."</font>"."</th>";
		}
		echo"<th style='background-color:#8fbc8f'>"."<font size='2'>"."Percentage"."</font>"."</th>";
		echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester && section='$section' ")or die(include("login_redirect.php"));
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr>"."<th style='background-color:#8fbc8f'></th>"."<th style='background-color:#8fbc8f'></th>"."<th style='background-color:#8fbc8f' colspan='11'>"."<font size='2'>"."TOTAL"."</font>"."</th>"."<th style='background-color:#8fbc8f'></th>"."</tr>";
		echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th align='right'>"."<font size='2'>"."TOTAL"."</font>"."</th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			echo"<th style='background-color:#8fbc8f'>"."<font size='2'>".$outof[$i]."</font>"."</th>";
			$sum_outof +=$outof[$i];
		}
		echo"<th style='background-color:#8fbc8f'>"."<font size='2'>"."100%"."</font>"."</th>"."</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section' && flag=1)")or die(include("login_redirect.php"));
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			echo"<tr>";
			
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
		$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester && section='$section' order by subject_id")or die(include("login_redirect.php"));
			
			
			
			//$subject_res=mysqli_query($con,"select subject_id from attendance_master where month_id=$month_id && student_id=$temp_student_id  order by subject_id")or die(include("admin_exception.php"));
			
			$sum_present=0;
			$cumm_individual_total=0;
			$mn=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" )or die(include("login_redirect.php"));
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				//$attendance_rs=mysqli_query($con,"select present from attendance_master where month_id<=$month_id && month_id>=$min_month subject_id=$temp_subject_id && student_id=$temp_student_id  order by subject_id") or die("ERROR 3");
				
				$month_set_ress=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month")or die(include("login_redirect.php"));
					
					
				
				
				$sum_present_lectures=0;
				$sum_individual_total=0;
				//while($attendance_rs1=mysqli_fetch_array($attendance_rs))
				while($month_set_ress1=mysqli_fetch_array($month_set_ress))
				{
						$temp_month_idd=$month_set_ress1[0];
						
						$present_res=mysqli_query($con,"select present,total_lectures from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month_idd && student_id=$temp_student_id order by subject_id")or die(include("login_redirect.php"));
						$present_res1=mysqli_fetch_array($present_res);
						
						
						$kount_present_res=mysqli_query($con,"select count(*) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month_idd && student_id=$temp_student_id order by subject_id")or die(include("login_redirect.php"));
						$kount_present_res1=mysqli_fetch_array($kount_present_res);
						
						if($kount_present_res1[0]!=0)
						{
							$sum_present_lectures+=$present_res1[0];
							$sum_individual_total+=$present_res1[1];
						}
						else
						{
							$sum_present_lectures+=0;
							$sum_individual_total+=0;
								
						}
					
				}
				
			{
				
				
				
			
			}
				//$temp_present=$attendance_rs1[0];
				
				$present_array2[$mn]=$sum_present_lectures;
				$total_array2[$mn]=$sum_individual_total;
						
				$mn++;
				//echo"<td>".$sum_present_lectures."</td>";
				$sum_present+=$sum_present_lectures;
				$cumm_individual_total+=$sum_individual_total;
		}

		if($cumm_individual_total!=0)
		{
			$perc=($sum_present/$cumm_individual_total)*100;
		}
		else
		{
			$perc=0;	
		}
			if($perc<70)
			{	
				echo"<tr bgcolor='#FF1C1C'>";
				echo"<td align='center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='left' >"."<font size='2'>".$temp_student_name."</font>"."</td>";
				
				if($cumm_individual_total<$sum_outof)
				{	
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td align='center'>"."<font size='2'>".$present_array2[$yz]."/".$total_array2[$yz]."</font>"."</td>";	
					}
				}
				else
				{
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td align='center'>"."<font size='2'>".$present_array2[$yz]."</font>"."</td>";	
					}
				}
				
				
			echo"<td align='center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			echo"</tr>";
			}
			else
			{
					echo"<tr bgcolor='#00FF00'>";
				echo"<td align='center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='left'>"."<font size='2'>".$temp_student_name."</font>"."</td>";
				
				if($cumm_individual_total<$sum_outof)
				{	
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td align='center'>"."<font size='2'>".$present_array2[$yz]."/".$total_array2[$yz]."</font>"."</td>";	
					}
				}
				else
				{
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td align='center'>"."<font size='2'>".$present_array2[$yz]."</font>"."</td>";	
					}
				}
				
				
				
			echo"<td align='center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			echo"</tr>";
			}
		}
	
	
?>
</table>
</div>

<?php
	include("dcs_footer.php");
?>