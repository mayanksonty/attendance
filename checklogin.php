
                             <?php
							 session_start();

                             
							 $user_name=$_REQUEST['username'];
                             $password=$_REQUEST['password'];
							 $user_value=$_REQUEST['uservalue'];
                             
							 
							 
							 
                             include("dbconnect.php");

		if($user_value==3)
		{
			$stud_res=mysqli_query($con,"select student_id,student_name,university_roll,semester,section,class_roll from student_master ") or die(include("login_redirect.php")) ;	
		    $stud_res1=mysqli_fetch_array($stud_res);
			
			if($stud_res1==NULL)
			{
				include("login_redirect.php");
					
			}
			else if($user_name==NULL&&$password==NULL)
			{
				include("login_redirect.php");
			}
			else if($user_name==$stud_res1[2])
			{			
						if($password==$stud_res1[2])
						{
							$_SESSION['student_id']=$stud_res1[0];
							$_SESSION['student_name']=$stud_res1[1];
							$_SESSION['university_roll']=$user_name;
							$_SESSION['semester']=$stud_res1[3];
							$_SESSION['section']=$stud_res1[4];
							$_SESSION['class_roll']=$stud_res1[5];
							
							header("location:student_index.php");
						}
						else
						{
							include("login_redirect.php");
						}
			}
			else
			{
					include("login_redirect.php");		
			}
		}
		else if($user_value==2)
		{
			

                             $rcv=mysqli_query($con,"select user_name,password,user_type,user_id from user_master where(user_name='$user_name');");
                             $r_user=mysqli_fetch_array($rcv);

                             $user=$r_user['user_name'];
                             $pwd=$r_user['password'];
                             $ut=$r_user['user_type'];
                             $uid=$r_user['user_id'];

		
                             if($user_name==NULL&&$password==NULL)
                             { 
							 	include("login_redirect.php");
                             } 
                             else 
                             { 
							 		if($user_name==$user)
                                	{ 
											if($password==$pwd)
                                    		{
										  		//echo "Login successful";
	                                   	  		$_SESSION['user_id']=$uid;
												$_SESSION['suser_name']=$user;			   
			                             		if($ut=='faculty')
			                             		{ 
												 	header("location:faculty_index.php");
			                             		}
												else
												{
													include("login_redirect.php");	
												}
										
							       			}
		                         			else 
		                         			{ 
								 				include("login_redirect.php");
		                         			}
  									 }
	                         		else
	                        		{ 
								
										include("login_redirect.php");
	                        		}
                          }
		
		}
	else
	{
		$rcv=mysqli_query($con,"select user_name,password,user_type,user_id from user_master where(user_name='$user_name');");
                             $r_user=mysqli_fetch_array($rcv);

                             $user=$r_user['user_name'];
                             $pwd=$r_user['password'];
                             $ut=$r_user['user_type'];
                             $uid=$r_user['user_id'];

		
                             if($user_name==NULL&&$password==NULL)
                             { 
							 	include("login_redirect.php");
                             } 
                             else 
                             { 
							 		if($user_name==$user)
                                	{ 
											if($password==$pwd)
                                    		{
										  		
	                                   	  		$_SESSION['user_id']=$uid;
			   
			                             		if($ut=='admin')
			                             		{ 
												 	header("location:admin_index.php");
			                             		}
			                             		/*else if($ut=='faculty')
			                             		{ 
												 	header("location:faculty_index.php");
			                             		}*/
												else
												{
													include("login_redirect.php");	
												}
										
							       			}
		                         			else 
		                         			{ 
								 				include("login_redirect.php");
		                         			}
  									 }
	                         		else
	                        		{ 
										include("login_redirect.php");
	                        		}
                          }
	}

							?>
                    