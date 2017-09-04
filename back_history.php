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
?><html>
<head>
  <script>
function goBack() {
    window.history.back();
}
</script>
</head>
<body>



<button onClick="goBack()">Go Back</button>

</body>
</html>
<?php
}
?>