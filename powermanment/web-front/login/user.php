<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
</head>

<body>
<?php
include("conn/conn.php");
if(isset($_POST['user']) and isset($_POST['pwd'])){
$select=mysql_query("select * from tb_user where username='".$_POST['user']."' and password='".$_POST['pwd']."'",$conn);
if(mysql_num_rows($select)==1){
	$array=mysql_fetch_array($select);	
	$_SESSION['user']=$_POST['user'];
	$_SESSION['sex']=$array['sex'];
	$_SESSION['email']=$array['email'];
	$_SESSION['qq']=$array['qq'];
	$_SESSION['tx']=$array['tx'];
	echo "<script>alert('登录成功！');window.location.href='index.php'</script>;";	
}else{
	echo "<script>alert('登录失败！');window.location.href='index.php'</script>;";	
}
}
?>
</body>
</html>
