
<html>


<head>

<link rel="stylesheet" type="text/css" href="style.css" />

  <script>



  	function bring_sub()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_ajax.php?semester=" + sem + "&section=" + sec,true);
			i.send();
	}
	
	function update_val(x,student_id)
	{	
			var y=document.getElementsByName("total[]");
			var total=y[x].value;
			
			var z=document.getElementsByName("present[]");
			var present=z[x].value;
			
			
			
			//var x=document.getElementByName('total[]');
			//alert(total);
		
				var i=new XMLHttpRequest();
				
				i.onreadystatechange=function()
				{
					if(i.readyState==4 && i.status==200)
					{
						document.getElementById("span_show").innerHTML=i.responseText;	
					}
				};
				
				i.open("GET","update_attend_ajax.php?total=" + total + "&present=" + present + "&student_id=" + student_id,true);
				i.send();
	}

	
	function check_username()
	{
			var user=document.getElementById("user_name").value;
			
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("message").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","addfaculty_ajax.php?username=" + user,true);
			i.send();
	}
	function bring_subjects()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			var year=document.getElementById("year_choice").value;			
			
			if(sem==0)
			{
				alert("Please select a valid SEMESTER value!");	
			}
			else if(sec==0)
			{
				alert("Please select a valid SECTION value!");	
			}
			
			else if(year==0)
			{
				alert("Please select a valid YEAR value!");	
			}
			
			else
			{
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","my_subject.php?semester=" + sem + "&section=" + sec,true);
			i.send();
			}
	}
	function showbox(a)
			{
				alert(a);
			/*	var i=new XMLHttpRequest();
			
				i.onreadystatechange=function()
				{
					if(i.readyState==4 && i.status==200)
					{
						document.getElementById("div_show").innerHTML=i.responseText;	
					}
				};
			
					i.open("GET","my_subject.php?semester=" + sem + "&section=" + sec,true);
					i.send();
			*/
			}
		function fill()
		{
			var x=document.getElementById("num1");
			var studcount=document.getElementById("studcount").value;
			//alert(studcount);
			var i=1;
			
			var y=document.getElementsByName("outof[]");
			for(i=0;i<=studcount-1;i++)
			{
				y[i].value=x.value;	
			}

		}
		
		
		
		
		
		function logout()
		{
				window.location.assign("logout.php");
		}
	
		
		
		
		
		
		
		
		
		
			
			
  </script>
  <style>
  		#logout
		{
			
			position:absolute;
			top:109px;
			left:227px;
		}
  </style>
</head>
  
<body>

<div id="header">
	<img src="image/dcs2 copy.png">
	<div id="BITlogo"><img src="image/rungta.png"><span id="logout"><input type="button" value="LOGOUT" onClick="logout();" class="formButton" style="background-color:#2f4f4f; color:#FFF; height:20px;"></span></div>
</div>

<?php
//session_start();
include("dbconnect.php");
?>

<div id=pageContainer>
