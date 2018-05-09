<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
include("conn/conn.php");
if(isset($_POST['Submit']) and $_POST['Submit']=="确认提交"){
	$username=$_POST['username'];
	$true_name=$_POST['true_name'];
	$password=$_POST['password'];
	$sex=$_POST['sex'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$qq=$_POST['QQ'];
	$indexs=$_POST['indexs'];
	$address=$_POST['address'];
	$tx="images/tx/".$_POST['tx']; 
	 if($_POST['password']==$_POST['password2']){
		$insert=mysql_query("insert into tb_user(username,true_name,password,sex,tel,email,qq,indexs,address,tx) values('$username','$true_name','$password','$sex','$tel','$email','$qq','$indexs','$address','$tx')",$conn);
		if($insert){
			echo "<script>alert('注册成功！');window.location.href='index.php';</script>;";
		}else{
			echo "<script>alert('注册失败！');window.location.href='index.php';</script>;";
		}		
	}else{
		echo "<script>alert('两次输入的密码不一致！');window.location.href='login.php';</script>;";
}
}
?>
<body>
</body>
</html>
