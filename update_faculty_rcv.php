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
	
	$userid=$_SESSION['userid'];
	$faculty_name=$_REQUEST['faculty_name'];
	$user_name=$_REQUEST['user_name'];
	$password=$_REQUEST['password'];
	
	mysqli_query($con,"update user_master set user_name='$user_name',password='$password',teacher_name='$faculty_name' where user_id=$userid ") or die(include("faculty_exception.php"));		
	
?>
<?php
include("admin_redirect.php");
}
?>