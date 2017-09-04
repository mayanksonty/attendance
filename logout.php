<?php
	session_start();
	session_destroy();
	header("location:login.php");

?>

<!--
<html>
<head>

<meta http-equiv="refresh" content="3;url=login.php" />
<?php /*
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
<style>
#myProgress {
    position: relative;
    width: 100%;
    height: 30px;
    background-color: grey;
}
#mybar
{
	height:28px;
	background:green;
	width:10000px;
}
</style>

</head>
<body>
  
  <form>
 <input type="button" value="LOGOUT" onClick="logout1()"/>
	</form>
 </body>
 </html> 