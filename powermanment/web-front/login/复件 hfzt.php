<?php
session_start();
if(isset($_SESSION['user'])){
include("conn/conn.php");
include("index_01.php");
include("index_02.php");
if(isset($_POST['subject']) and $_POST['Submit']=="提交"){
	$select=mysql_query("select * from tb_content where id='".$_GET['h_id']."'",$conn);
	$array=mysql_fetch_array($select);  
	$category=$array['category'];
	$subject=$array['subject'];
	$date=date("Y-m-d");
	$id=$_GET["h_id"];
	$insert=mysql_query("insert into tb_resume_contents(resume_subject,resume_contents,resume_date,username,category,subject) values('".$_POST['subject']."','".$_POST['content']."','$date','".$_SESSION['user']."','$category','$subject')",$conn);
	if($insert){
		echo "<script>alert('回复成功！');window.location.href='lb_ok.php?id=$id';</script>";
	}else{
		echo "<script>alert('回复失败！');window.location.href='lb_ok.php?id=$id';</script>";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>回复主题</title>
<style type="text/css">
<!--
.STYLE2 {color: #CC6633}
.STYLE4 {color: #CC6600}
body,td,th {
	font-size: 12px;
}
-->
</style>
</head>

<body>
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
            <td width="104" align="left"><span class="STYLE2">回复标题：</span></td>
            <td colspan="2" align="left"><input name="subject" type="text" size="40" /></td>
          </tr>
          <tr>
            <td height="51" align="left"><span class="STYLE2">表情：</span></td>
            <td width="409" align="left"><?php 		  
			  $select1=mysql_query("select * from tb_expression",$conn);
			while($array1=mysql_fetch_array($select1)){
			 ?>
              <input type="radio" name="tx" value="<?php echo $array1['id'];?>" />
              <img src="<?php echo "../05/image_1.php?recid=".$array1['id'];?>" width="24" height="24" />
              <?php 
				}
			
			?></td>
            <td width="104" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td height="226" align="left"><span class="STYLE2">回复内容：</span></td>
            <td colspan="2" align="left"><textarea name="content" cols="45" rows="15" id="content"></textarea></td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input type="submit" name="Submit" value="提交" />
                <input type="submit" name="Submit2" value="重置" /></td>
          </tr>
      </table></td>
      <td rowspan="8"><img src="images/06_04.gif" width="9" height="456" alt="" /></td>
      <td><img src="images/分隔符.gif" width="1" height="60" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="28" align="center" bgcolor="#FFFDF1"><?php echo $_SESSION['user'];?>
        &nbsp;</td>
      <td><img src="images/分隔符.gif" width="1" height="28" alt="" /></td>
    </tr>
    <tr>
      <td><img src="images/06_06.gif" width="244" height="78" alt="" /></td>
      <td><img src="images/分隔符.gif" width="1" height="78" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="28" align="center" bgcolor="#FFFDF1"><span class="STYLE4">我是：
        <?php echo $_SESSION['sex'];?>
        生</span></td>
      <td><img src="images/分隔符.gif" width="1" height="28" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="35" align="center" bgcolor="#FFFDF1"><span class="STYLE2">email：
        <?php echo $_SESSION['email'];?>
      </span></td>
      <td><img src="images/分隔符.gif" width="1" height="35" alt="" /></td>
    </tr>
    <tr>
      <td width="244" height="35" align="center" bgcolor="#FFFDF1"><span class="STYLE4">QQ：
        <?php echo $_SESSION['qq'];?>
      </span></td>
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
include("index_05.php");
include("index_06.php");
?>
</body>
</html>
<?php 
	}else{
	?>
		<script language="javascript">
		alert('没登录');
		//alert('您没有登录');
		window.location.href='index.php';
		</script>
<?php
}
?>
