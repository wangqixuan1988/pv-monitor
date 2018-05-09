<?php         
	include("conn/conn.php");
	if(isset($_GET['recid'])){
    $result=mysql_query("select * from tb_expression where id='".$_GET['recid']."'",$conn);
    if(!$result) die("error: mysql query"); 
    $num=mysql_num_rows($result); 
    if($num<1) die("error: no this recorder");     
    $data = mysql_result($result,0,"expression"); 
    mysql_close($conn); 
    echo $data;
	}
?> 
