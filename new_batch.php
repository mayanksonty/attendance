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
	include ("back_button.php");
?>
<script src="js/new_batch1.js"></script>
<div id="workBox">
<img src="image/12284211311154772712sheikh_tuhin_Label_Icon.svg.hi.png" />
<form action="new_batch_rcv.php" name="form1" method="post">

<table width="100%" id="form_index" cellspacing="5"  border="0" class="formTable">

   
    <tr><th colspan="2" align="center"><u>Insert New Batch</u></th></tr>
     <tr><td align="right">Batch:</td><td>
     
     <select name="batch_year" id="batch" class="formCSS" onchange="check_entry();">
        	<option value="0">------ </option>
            <option value="2013"> 2013 </option>
            <option value="2014"> 2014 </option>
            <option value="2015"> 2015 </option>
            <option value="2016"> 2016 </option>
            <option value="2017"> 2017</option>
            <option value="2018"> 2018</option>
            <option value="2019"> 2019 </option>
            <option value="2020"> 2020 </option>
            <option value="2021"> 2021 </option>
            <option value="2022"> 2022 </option>
            <option value="2023"> 2023 </option>
            <option value="2024"> 2024 </option>
            <option value="2025"> 2025 </option>
            
		 </select>
     
     </td></tr>
   
	<tr><td align="right">Semester:</td><td>
   <select name="Semester" id="sem" class="formCSS" onchange="check_entry();">
        	<option value="0">------ </option>
            <option value="3"> 3rd Sem </option>
            <option value="4"> 4th Sem </option>
            <option value="5"> 5th Sem </option>
            <option value="6"> 6th Sem </option>
            <option value="7"> 7th Sem</option>
            <option value="8"> 8th Sem</option>         
        <!--    <option value="2020"> 2020 </option>
            <option value="2021"> 2021 </option>
            <option value="2022"> 2022 </option>
            <option value="2023"> 2023 </option>
            <option value="2024"> 2024 </option>
            <option value="2025"> 2025 </option>
            -->
            </select>
  </td></tr>
    <tr><td align="right">Section:</td><td>
    <select name="section" class="formCSS" onchange="check_entry();" id="sec">
    <option value="">---</option>
    <option value="A">A</option>
    <option value="B">B</option>
    </select></td></tr>
    <tr><td align="right">Number of students:</td><td><input type="number" id="studentt" name="number_of_students" class="formCSS" onfocus="check_entry();"></td></tr>
     <tr><td align="center" colspan="2"><input style="width:100px" type="button" value="Submit" onclick="form_feed_val();" class="formButton"></td></tr>
</table>

</form>
</div><!-- EO workBox-->
<script src="js/new_batch2.js"></script> 
 <div id="show_message" style="position:absolute; left:450px; top:320px; color:#F00;">
 
 </div>


<?php
	include("dcs_footer.php");
}
?>