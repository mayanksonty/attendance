<?php

	include("dbconnect.php");
	
	
	$userid=$_REQUEST['userid'];
	$user_name=$_REQUEST['username'];
	$pass=$_REQUEST['pass'];
	$flag=1;
	
	$user_rs=mysqli_query($con,"select user_name from user_master where user_id<>$userid");
	while($user_rs1=mysqli_fetch_array($user_rs))
	{
		if($user_name==$user_rs1[0])
		{
			$flag=0;
			break;
		}	
	
	}
	
	if($flag==1)
	{	
	mysqli_query($con,"update user_master set user_name='$user_name',password='$pass' where user_id=$userid ") or die(include("faculty_exception.php"));		
	
	echo "Your Username and Password has been Updated";
	}
	else
	{
		echo "Username Already Acquired.Please choose another Username";
	}
?>