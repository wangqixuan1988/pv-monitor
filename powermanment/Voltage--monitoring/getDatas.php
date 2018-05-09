<?php
	$db_name = "db_pursey";
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "1";
		
	$index = 0;
	if(isset($_GET['index'])) {
		$index = (int)$_GET['index'];
	} 
	
	$link = mysql_connect($db_host,$db_user,$db_pass) or die("Can't connect DB");
	$db = mysql_select_db($db_name);
	mysql_query("set names utf8");
	
	$pages = (int)((mysql_fetch_row(mysql_query("select count(*) from tb_elec1"))));
	if($index > ($pages-1)) {
		$index = ($pages-1);
	}
	
	$select = "select * from tb_elec1 order by date desc limit ".($index*10).",10";

	$result = mysql_query($select);
	
	$datas = array();
	
	while($row = mysql_fetch_row($result)) {
		$datas[] = $row;
	}
	
	echo json_encode($datas);
?>
