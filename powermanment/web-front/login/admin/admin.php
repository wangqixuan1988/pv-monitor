<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>版主登录</title>
</head>
<script>
function check(){
	if(form1.user.value==""){
		alert("请输入用户名！");
		form1.user.focus;
		return false;
	}
	if(form1.pass.value==""){
		alert("请输入密码！");
		form1.pass.focus;
		return false;
	}
		return true;
}
</script>
<body>
<form id="form1" name="form1" method="post" action="admin_ok.php">
  <table width="331" height="241" border="0" align="center" cellpadding="0" cellspacing="0" id="__01">
    <tr>
      <td colspan="7"><img src="images/07_01.gif" width="331" height="57" alt="" /></td>
    </tr>
    <tr>
      <td colspan="2" rowspan="4"><img src="images/07_02.gif" width="128" height="60" alt="" /></td>
      <td colspan="4"><input name="user" type="text" id="user" size="18" /></td>
      <td rowspan="6"><img src="images/07_04.gif" width="50" height="183" alt="" /></td>
    </tr>
    <tr>
      <td colspan="4"><img src="images/07_05.gif" width="153" height="8" alt="" /></td>
    </tr>
    <tr>
      <td colspan="4"><input name="pass" type="password" id="pass" size="18" /></td>
    </tr>
    <tr>
      <td colspan="4"><img src="images/07_07.gif" width="153" height="7" alt="" /></td>
    </tr>
    <tr>
      <td rowspan="2"><img src="images/07_08.gif" width="85" height="123" alt="" /></td>
      <td height="29" colspan="2"><input type="image" name="imageField" src="images/07_09.gif" onclick="return check();" /></td>
      <td rowspan="2"><img src="images/07_10.gif" width="25" height="123" alt="" /></td>
      <td width="64" height="29"><input type="image" name="imageField2" src="images/07_11.gif" /></td>
      <td rowspan="2"><img src="images/07_12.gif" width="43" height="123" alt="" /></td>
    </tr>
    <tr>
      <td colspan="2"><img src="images/07_13.gif" width="64" height="94" alt="" /></td>
      <td><img src="images/07_14.gif" width="64" height="94" alt="" /></td>
    </tr>
    <tr>
      <td><img src="images/分隔符.gif" width="85" height="1" alt="" /></td>
      <td><img src="images/分隔符.gif" width="43" height="1" alt="" /></td>
      <td><img src="images/分隔符.gif" width="21" height="1" alt="" /></td>
      <td><img src="images/分隔符.gif" width="25" height="1" alt="" /></td>
      <td><img src="images/分隔符.gif" width="64" height="1" alt="" /></td>
      <td><img src="images/分隔符.gif" width="43" height="1" alt="" /></td>
      <td><img src="images/分隔符.gif" width="50" height="1" alt="" /></td>
    </tr>
  </table>
  <img src="images/07_05.gif" width="153" height="8" />
</form>
</body>
</html>
