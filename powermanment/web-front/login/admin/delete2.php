<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>危险内容管理</title>
</head>

<body>
<?php 
include("../conn/conn.php");
$delete=mysql_query("delete from tb_content where id='".$_GET['id']."'",$conn);
		if($delete){
			echo "<script>alert('删除成功！');window.location.href='index.php?lmbs=".$_GET['lmbs']."';</script>";
		}else{
			echo "<script>alert('删除失败！');window.location.href='index.php?lmbs=".$_GET['lmbs']."';</script>";

		}
?>
</body>
</html>
