<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布主题</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
.STYLE2 {color: #CC6633}
.STYLE4 {color: #CC6600}
.STYLE5 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style></head>

<body>
<?php
include("conn/conn.php");
$select=mysql_query("select * from tb_category",$conn);
if(isset($_SESSION['user']) and $_SESSION['user']!=null){
	if(isset($_POST['Submit']) and $_POST['Submit']=="主题提交"){
		$date=date("Y-m-d");
		$insert=mysql_query("insert into tb_content(category,subject,content,username,release_date) values('".$_POST['category']."','".$_POST['subject']."','".$_POST['content']."','".$_SESSION['user']."','$date')",$conn);
		if($insert){
			echo "<script>alert('发布成功！');window.location.href='index.php';</script>;";
		}else{
			echo "<script>alert('发布失败！');window.location.href='fbzt.php';</script>;";
		}
	}
}else{
	echo "<script>alert('请先登录！');window.location.href='index.php';</script>";
}
?>
<?php
include("index_01.php");
include("index_02.php");
?>
<form id="form1" name="form1" method="post" action="">
  <table width="998" height="500" border="0" align="center" cellpadding="0" cellspacing="0" id="__01">
    <tr>
      <td colspan="3"><img src="images/06_01.gif" width="997" height="44" alt="" /></td>
      <td><img src="images/分隔符.gif" width="1" height="44" alt="" /></td>
    </tr>
    <tr>
      <td><img src="images/06_02.gif" width="244" height="60" alt="" /></td>
      <td width="744" height="448" rowspan="7" align="center" valign="middle" bgcolor="#FFFDF1"><table width="633" height="376">
        <tr>
          <td width="104" align="left"><span class="STYLE2">类别：</span></td>
          <td colspan="2" align="left">
		 
		  <select name="category">
		   <?php
		  while($array=mysql_fetch_array($select)){
		  ?>
            <option value="<?php echo $array['category']?>"><?php echo $array['category'];?></option>
			 <?php   }?>
          </select>		           </td>
        </tr>
        <tr>
          <td align="left"><span class="STYLE2">主题：</span></td>
          <td colspan="2" align="left"><input name="subject" type="text" size="40" /></td>
        </tr>
        <tr>
          <td height="51" align="left"><span class="STYLE2">表情：</span></td><td width="386" align="left">
         <?php 		  
			$select1=mysql_query("select * from tb_expression",$conn);
			while($array1=mysql_fetch_array($select1)){
		  ?>
		  <input type="radio" name="tx" value="<?php echo $array1['id'];?>" /> <img src="<?php echo "../11/image_1.php?recid=".$array1['id'];?>" width="24" height="24">
		<?php 
		}
		?></td>
          <td width="127" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td height="226" align="left"><span class="STYLE2">内容：</span></td>
          <td colspan="2" align="left"><p>
            <textarea name="content" cols="45" rows="15" id="content"></textarea>
          </p>
            <p align="center" class="STYLE5">注意：字数不要超过200个！</p></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><input type="submit" name="Submit" value="主题提交" />
            <input type="submit" name="Submit2" value="重置信息" /></td>
          </tr>
      </table></td>
      <td rowspan="8"><img src="images/06_04.gif" width="9" height="456" alt="" /></td>
      <td><img src="images/分隔符.gif" width="1" height="60" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="28" align="center" bgcolor="#FFFDF1"><?php echo $_SESSION['user'];?>&nbsp;</td>
      <td><img src="images/分隔符.gif" width="1" height="28" alt="" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFDF1"><div align="center"><img src="<?php echo $_SESSION['tx'];?>" width="60" height="60" /></div></td>
      <td><img src="images/分隔符.gif" width="1" height="78" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="28" align="center" bgcolor="#FFFDF1"><span class="STYLE4">我是：<?php echo $_SESSION['sex'];?>生</span></td>
      <td><img src="images/分隔符.gif" width="1" height="28" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="35" align="center" bgcolor="#FFFDF1"><span class="STYLE2">email：<?php echo $_SESSION['email'];?></span></td>
      <td><img src="images/分隔符.gif" width="1" height="35" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="35" align="center" bgcolor="#FFFDF1"><span class="STYLE4">QQ：<?php echo $_SESSION['qq'];?></span></td>
      <td><img src="images/分隔符.gif" width="1" height="35" alt="" /></td>
    </tr>
    <tr>
      <td rowspan="2"><img src="images/06_10.gif" width="244" height="192" alt="" /></td>
      <td><img src="images/分隔符.gif" width="1" height="184" alt="" /></td>
    </tr>
    <tr>
      <td><img src="images/06_11.gif" width="744" height="8" alt="" /></td>
      <td><img src="images/分隔符.gif" width="1" height="8" alt="" /></td>
    </tr>
  </table>
</form>
<?php

include("index_06.php");
?>
</body>
</html>
