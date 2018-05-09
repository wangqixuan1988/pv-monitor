<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
</head>

<body>
<?php
include("../conn/conn.php");
if(isset($_POST['user']) and isset($_POST['pass'])){
	$select=mysql_query("select * from tb_admin where user='".$_POST['user']."' and pass='".$_POST['pass']."'",$conn);
	if(mysql_num_rows($select)==1){
		$_SESSION['adminname']=$_POST['user'];
		echo "<script>alert('登录成功！');window.location.href='index.php';</script>;";
	}else{
		echo"<script>alert('用户名或密码不正确！');window.location.href='admin.php';</script>;";
	}
}
?>
</body>
</html>
