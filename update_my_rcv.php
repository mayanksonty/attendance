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
	


/*	function checkPresent(j,ev)
	{
			
			var c=document.getElementById("kount").value;
			
			var p=document.getElementsByName("present[]");
			var t=document.getElementsByName("total[]");
			
			
			if(ev.keyCode!=8)
			{
				if(p[j].value>t[j].value && p[j].value!='')
				{
					alert("Present must be less than Total");
	
				}	
			}
			
		
	}*/
</script>

<?php
	
	
    include("dbconnect.php");
	$user_id=$_SESSION['user_id'];
	$month=$_REQUEST['month_choice'];
	$year=$_REQUEST['year_choice'];
	$sub_id=$_REQUEST['sub_id'];

	$_SESSION['subject_id']=$sub_id;
	
	$sem_rs=mysqli_query($con,"select semester from subject_master where subject_id=$sub_id");
	$sem_rs1=mysqli_fetch_array($sem_rs);
	$sem=$sem_rs1[0];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$sem group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
	
	
	$month_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("faculty_exception.php"));
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_id=$month_rs1[0];
	
	
	$_SESSION['month_id']=$month_id;
//	echo $month_id;
	/*
	$sub_rs=mysqli_query($con,"select subject_id from subject_master where semester=$semester && section=$section && subject_name=$subject");
	$sub_rs1=mysqli_fetch_array($sub_rs);
	$subject_id=$sub_rs1[0];
	*/
	
	$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$sub_id order by student_id")or die(include("faculty_exception.php"));
	
$kount_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$sub_id")or die(include("faculty_exception.php"));
$kount_rs1=mysqli_fetch_array($kount_rs);
$kount=$kount_rs1[0];


			echo "<input type='hidden' value='$kount' id='kount'>";	
	?>
   <span id="span_show" style="position:absolute; border:0px solid blue; left:400px; top:10px; height:auto; color:#00C; font-weight:bolder;">
   
   </span>
	<table id="update_attendance_table" cellspacing="4">
	<tr>
    	<th>ROLL NO.</th>
    	<th >STUDENT NAME</th>
        <th >TOTAL</th>
        <th >PRESENT</th>
        <th >PERCENTAGE</th>
    </tr>
<?php
$i=0;
    while($attendance_rs1=mysqli_fetch_array($attendance_rs))
	{	
	
		$stud_name_rs=mysqli_query($con,"select student_name,class_roll from student_master where student_id=$attendance_rs1[0]")or die(include("faculty_exception.php"));
		$stud_name_rs1=mysqli_fetch_array($stud_name_rs);
		if($attendance_rs1[1]!=0)
		$x=($attendance_rs1[2]/$attendance_rs1[1])*100;
		else
		$x=0;


		echo"<tr>";
			echo "<td align='center'>"."$stud_name_rs1[1]"."</td>";
			echo "<td align='center'>"."<input type='text' size='40' name='stud_name[]' value='$stud_name_rs1[0]' class='formCSS' disabled='disabled'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='total[]' value='$attendance_rs1[1]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='present[]' value='$attendance_rs1[2]' id='present[]' class='formCSS' >"."</td>";
			echo "<td align='center'>"."<input type='button' value='update' name='update_button[]' onclick='update_val($i,$attendance_rs1[0])' class='formButton'>"."</td>";
		echo "</tr>";
		
		$i++;
	}
	echo "</table>";
?>
<?php
include("dcs_footer.php");
}
?>

<!--</div>
</body>
</html>-->