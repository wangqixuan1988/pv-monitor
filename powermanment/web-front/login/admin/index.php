<?php 
session_start();
if(isset($_SESSION['adminname'])){
if(isset($_GET['lmbs'])){
$pt=$_GET['lmbs'];
}else{
$pt="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
</head>

<body>
<table width="1000" align="center">
  <tr>
    <td colspan="2"><?php include("../../11/admin/index_01.php");?></td>
  </tr>
  <tr>
    <td width="190" align="left" valign="top"><table id="__02" width="187" height="333" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<img src="../../11/admin/images/02_01.gif" width="187" height="49" alt=""></td>
	</tr>
	<tr>
		<td rowspan="10">
			<img src="../../11/admin/images/02_02.gif" width="6" height="284" alt=""></td>
		<td>
			<a href="../../11/admin/index.php?lmbs=<?php echo urlencode("栏目管理");?>"><img src="../../11/admin/images/02_03.gif" alt="" width="175" height="25" border="0"></a></td>
		<td rowspan="10">
			<img src="../../11/admin/images/02_04.gif" width="6" height="284" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="../../11/admin/images/02_05.gif" width="175" height="7" alt=""></td>
	</tr>
	<tr>
		<td>
			<a href="../../11/admin/index.php?lmbs=<?php echo urlencode("主题管理");?>"><img src="../../11/admin/images/02_06.gif" alt="" width="175" height="23" border="0"></a></td>
	</tr>
	<tr>
		<td>
			<img src="../../11/admin/images/02_07.gif" width="175" height="9" alt=""></td>
	</tr>
	<tr>
		<td>
			<a href="../../11/admin/index.php?lmbs=<?php echo urlencode("回复主题管理");?>"><img src="../../11/admin/images/02_08.gif" alt="" width="175" height="23" border="0"></a></td>
	</tr>
	<tr>
		<td>
			<img src="../../11/admin/images/02_09.gif" width="175" height="7" alt=""></td>
	</tr>
	<tr>
		<td>
			<a href="../../11/admin/index.php?lmbs=<?php echo urlencode("用户管理");?>"><img src="../../11/admin/images/02_10.gif" alt="" width="175" height="24" border="0"></a></td>
	</tr>
	<tr>
		<td>
			<img src="../../11/admin/images/02_11.gif" width="175" height="7" alt=""></td>
	</tr>
	<tr>
		<td>
			<a href="../../11/admin/index.php?lmbs=<?php echo urlencode("危险内容管理");?>"><img src="../../11/admin/images/02_12.gif" alt="" width="175" height="23" border="0"></a></td>
	</tr>
	<tr>
		<td>
			<img src="../../11/admin/images/02_13.gif" width="175" height="136" alt=""></td>
	</tr>
</table></td>
    <td width="806" align="center" valign="top"><?php switch($pt){
	    case "栏目管理":
		    include "lmgl.php";
		break;	
		case "主题管理":
		    include "ztgl.php";
		break;	
		case "回复主题管理":
		    include "hfztgl.php";
		break;	
		case "用户管理":
		    include "hygl.php";
		break;
		case "危险内容管理":
		    include "ss.php";
		break;	
		default :
		    include "lmgl.php";
		break;	
		}
	?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

</body>
</html>
<?php 
}else{
	echo"<script>alert('不具备管理员权限！');window.location.href='admin.php';</script>;";

}
?>