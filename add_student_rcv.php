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

include("dbconnect.php");
$semester=$_REQUEST['sem_choice'];
$section=$_REQUEST['sec_choice'];
$number_student=$_REQUEST['number_student'];
$stud_name=$_REQUEST['stud_name'];

$flag=1;
$batch=$_REQUEST['batch'];

if($section=='A')
{
	mysqli_query($con,"update student_master set class_roll=class_roll + $number_student where semester=$semester && section='B'")or die(include("admin_exception.php"));
	
	$res=mysqli_query($con,"select count(*) from student_master where (semester=$semester && section='A' && flag=1) ");
	$res1=mysqli_fetch_array($res);
	$max_roll_A=$res1[0];
	$roll=$max_roll_A;
$str="";
for($i=0;$i<$number_student-1;$i++)
{
	$roll=$max_roll_A +$i+1;
	$str=$str."(".$roll.","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$flag.")".",";
	
}
$roll=$roll+1;	
$str=$str."(".$roll.","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$flag.")";
	
	mysqli_query($con,"insert into student_master(class_roll,student_name,semester,section,batch,flag) values".$str )or die(include("admin_exception.php"));
	
	
}

else
{
	$res=mysqli_query($con,"select count(*) from student_master where semester=$semester ") or die(include("admin_exception.php"));
	$res1=mysqli_fetch_array($res);
	$max_roll_B=$res1[0];
	
	$roll=$max_roll_B;
	
	$str="";
for($i=0;$i<$number_student-1;$i++)
{
	$roll=$max_roll_B +$i+1;
	//$str=$str."(".$roll.","."'".$stud_name[$i]."'".",".$univ_roll[$i].","."$semester".","."'"."$section"."'".")".",";
	
	$str=$str."(".$roll.","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$flag.")".",";
	
	
}

$roll=$roll+1;	
$str=$str."(".$roll.","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$flag.")";

	
//$str=$str."(".$roll.","."'".$stud_name[$i]."'".",".$univ_roll[$i].","."$semester".","."'"."$section"."'".")";
	
	mysqli_query($con,"insert into student_master(class_roll,student_name,semester,section,batch,flag) values".$str )or die(include("admin_exception.php"));
	
}

?>
<?php
include("admin_redirect.php");
}
?>