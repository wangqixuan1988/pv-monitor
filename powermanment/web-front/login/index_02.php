<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
.STYLE1 {color: #CC6633}
-->
</style></head>
<script language="javascript">
function check(){						//自定义函数
	if(form3.user.value==""){				//判断用户名是否为空
	        alert("请输入用户名!");
   		    form3.user.focus();
			return false;

         }		        		
       if(form3.pwd.value==""){			//判断密码是否为空
			alert("请输入密码!");
			form3.pwd.focus();
			return false ;
		 }
		 	return true;
	 
}	

</script>
<body>
<form id="form3" name="form3" method="post" action="user.php">
  <table width="992" height="56" border="0" align="center" cellpadding="0" cellspacing="0" id="__01">
    <tr>
      <td colspan="7"><img src="images/02_01.gif" width="992" height="7" alt="" /></td>
    </tr>
    <tr>
      <td width="205" rowspan="2"><img src="images/02_02.gif" width="205" height="49" alt="" /></td>
      <td width="190" height="29"><?php echo date("Y-m-d H:i:s");?>&nbsp;</td>
      <?php if(empty($_SESSION['user']))
	  {
	  ?>
      <td width="426" height="29"><span class="STYLE1">用户名：
        <input name="user" type="text" size="20" />
      密码：
      <input name="pwd" type="password" size="20" />
      </span></td>
      <td width="52" height="29"><input type="image" name="imageField2" src="images/02_05.gif" onclick="return check();" /></td>
      <td width="10" rowspan="2"><img src="images/02_06.gif" width="10" height="49" alt="" /></td>
      <td width="48" height="29"><a href="login.php"><img src="images/02_07.gif" width="48" height="29" border="0" /></a></td>
      <td width="61" rowspan="2"><img src="images/02_08.gif" width="61" height="49" alt="" /></td>
      <?php }else{ ?>
	  <td width="426" height="29"><span class="STYLE1">
       
      </span></td>
      <td width="52" height="29"></td>
      <td width="10" rowspan="2"><img src="images/02_06.gif" width="10" height="49" alt="" /></td>
      <td width="48" height="29"></td>
      <td width="61" rowspan="2"><img src="images/02_08.gif" width="61" height="49" alt="" /></td>
	  <?php }?>
    </tr>
    <tr>
      <td colspan="3"><img src="images/02_09.gif" width="668" height="20" alt="" /></td>
      <td><img src="images/02_10.gif" width="48" height="20" alt="" /></td>
    </tr>
  </table>
</form>
</body>
</html>
