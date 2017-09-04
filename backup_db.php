<?php
	
	include("dbconnect.php");
 
    //ENTER THE RELEVANT INFO BELOW
    $mysqlUserName      = "root";
    $mysqlPassword      = "";
    $mysqlHostName      = "localhost";
    $DbName             = "dcs_4";
    $backup_name        = "mybackup.sql";
/*	
	//Tables Name determining logic
	$table_str="";
	$table_names_rs=mysqli_query($con,"SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'dcs_4'");
	
	$count_table_names_rs=mysqli_query($con,"SELECT count(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'dcs_4'");
	$count_table_names_rs1=mysqli_fetch_array($count_table_names_rs);
	$count=$count_table_names_rs1[0];
	
	//while($table_names_rs1=mysqli_fetch_array($table_names_rs))
	for($i=1;$i<$count;$i++)
	{
		$table_names_rs1=mysqli_fetch_array($table_names_rs);
		$table_str=$table_str."'$table_names_rs1[0]'".",";	
	}
	$table_str=$table_str."'$table_names_rs1[0]'";
	//end of table names logic
	
	
	echo $table_str;
	$tables= array($table_str);
*/
	
$tables=array("month_master","user_master","attendance_master","subject_master","student_master","teacher_subject_relation","semester_master");

   //or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables


  Export_Database($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $tables=array("month_master","user_master","attendance_master","subject_master","student_master","teacher_subject_relation"), $backup_name=false );

    function Export_Database($host,$user,$pass,$name,  $tables=array("month_master","user_master","attendance_master","subject_master","student_master","teacher_subject_relation"), $backup_name=false )
    {
        $mysqli = new mysqli($host,$user,$pass,$name); 
        $mysqli->select_db($name); 
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES'); 
        while($row = $queryTables->fetch_row()) 
        { 
            $target_tables[] = $row[0]; 
        }   
        if($tables !== false) 
        { 
            $target_tables = array_intersect( $target_tables, $tables); 
        }
        foreach($target_tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;     
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) 
            {
                while($row = $result->fetch_row())  
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  
                    { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ; 
                        }
                        else 
                        {   
                            $content .= '""';
                        }     
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }      
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                    {   
                        $content .= ";";
                    } 
                    else 
                    {
                        $content .= ",";
                    } 
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
        $backup_name = $backup_name ? $backup_name : $name.".sql";
        header('Content-Type: application/octet-stream');   
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");  
        echo $content; exit;
    }
?>