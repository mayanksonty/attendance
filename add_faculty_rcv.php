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

$faculty_name=$_REQUEST['faculty_name'];
$faculty_user=$_REQUEST['faculty_user'];
$faculty_pswd=$_REQUEST['faculty_pswd'];
$user_type=$_REQUEST['user_type'];

mysqli_query($con,"insert into user_master(user_name,password,user_type,teacher_name) values ('$faculty_user','$faculty_pswd','$user_type','$faculty_name')") or die(include("admin_exception.php")); 

?>
<?php
include("admin_redirect.php");
}
?>



