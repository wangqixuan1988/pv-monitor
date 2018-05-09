<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>危险内容管理</title>
<style type="text/css">
<!--
.STYLE2 {	color: #CC0000;
	font-weight: bold;
}
.STYLE4 {	color: #383838;
	font-weight: bold;
	font-size: 12px;
}
.style1 {	FONT-WEIGHT: normal;
	FONT-SIZE: 12px;
	FONT-FAMILY: "宋体";
	line-height: 22px;
	color: #383838;
}
-->
</style>
</head>

<body>
<form id="form2" name="form2" method="post" action="index.php?lmbs=<?php echo urlencode("危险内容管理");?>">
  <table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#E1DAEA">
    <tbody>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#FFFBF0" class="STYLE4">&nbsp;危险内容管理</td>
        <td width="408" bgcolor="#FFFBF0">&nbsp;</td>
      </tr>
      <tr>
        <td width="276" height="30" align="center" bgcolor="#FFFBF0" class="style1">搜索非法主题和内容</td>
        <td width="275" align="middle" bgcolor="#FFFBF0" class="style1">关键字
          <input name="key" type="text" id="key" size="20" /></td>
        <td align="left" valign="center" bgcolor="#FFFBF0" class="style1"><input id="Submit" type="submit" value="搜索" name="Submit" /></td>
      </tr>
    </tbody>
  </table>
  <table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="E1DAEA">
    <tbody>
      <tr class="style1" align="middle" bgcolor="#d0e8ff">
        <td width="95" height="35" align="center" bgcolor="FFEFBA"><span class="STYLE2">用户名</span></td>
        <td width="145" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">主题</td>
        <td width="200" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">内容</td>
        <td width="80" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">是否删除</td>
      </tr>
      <?php 
include("../conn/conn.php");
if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	  $page_count=10;
	if(empty($_POST['key'])){
	  $select=mysql_query("select * from tb_content",$conn);
	  $row=mysql_num_rows($select);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录	
	  $selects=mysql_query("select * from tb_content where id order by id desc limit $offect,$page_count",$conn);
	  while($array=mysql_fetch_array($selects)){
?>
      <tr class="style1" align="middle">
        <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['username'];?></td>
        <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['subject'];?></td>
        <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['content'];?></td>
        <td height="35" align="center" bgcolor="#FFFBF0"><a href="delete2.php?lmbs=<?php echo urlencode("危险内容管理");?>&amp;id=<?php echo $array['id'];?>" class="style6">删除</a></td>
      </tr>
      <?php }?>
<?php
}else{
	if(isset($_POST['key']) and $_POST['Submit']=="搜索"){
	  $select=mysql_query("select * from tb_content",$conn);
	  $row=mysql_num_rows($select);
	  $select=mysql_query("select * from tb_content",$conn);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count; 
	  $sel=mysql_query("select * from tb_content where subject like '%".$_POST['key']."%' or content like '%".$_POST['key']."%' limit $offect,$page_count",$conn);
	  $row=mysql_num_rows($sel);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录
	$select_subject=mysql_query("select * from tb_content where subject like '%".$_POST['key']."%' or content like '%".$_POST['key']."%' order by id desc limit $offect,$page_count",$conn);

	
			while($array_subject=mysql_fetch_array($select_subject)){
			?>
      <tr class="style1" align="middle">
        <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array_subject['username'];?></td>
        <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array_subject['subject'];?></td>
        <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array_subject['content'];?></td>
        <td height="35" align="center" bgcolor="#FFFBF0"><a href="delete2.php?lmbs=<?php echo urlencode("危险内容管理");?>&amp;id=<?php echo $array_subject['id'];?>" class="style6">删除</a></td>
      </tr>
      <?php
			}
			}
	}
	?>
	<?php 
	if(!empty($_POST['key'])){
	?>
	
	<!-- 没有获得参数-->
	<tr class="style1" align="middle">
        <td height="35" colspan="4" align="center" bgcolor="#FFFBF0"><table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr class="style4">
              <td width="45%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条</td>
              <td width="40%" class="#ff0000"> 分页：
			  <?php if($page<=1){  ?>
			        首页&nbsp;
			  <?php }else{ ?>
			  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=1">首页</a> 
			  <?php  } ?>
			  <?php if($page-1<1){ ?>
			        上一页&nbsp;
			  <?php }else{ ?>
			  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php if($page==1){echo $page=1; }else{ echo $page-1; }?>">上一页</a> 
			  <?php  } ?>
			  <?php  if($page+1>$page_page) { ?>
			         下一页
			  <?php }else{ ?>
			         <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php if($page<$page_page){echo $page+1;}else{ echo $page_page;}?>">下一页</a>
			  <?php }?>
			  <?php if($page>=$page_page){ ?>
			        尾页
			  <?php }else{ ?>
			   <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php echo $page_page; ?>">尾页</a></td>
			   <?php  } ?>
              <td width="15%">&nbsp;</td>
            </tr>
	<!-- 没有获得参数-->
	
	<?php }else{ ?>
      <tr class="style1" align="middle">
        <td height="35" colspan="4" align="center" bgcolor="#FFFBF0"><table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr class="style4">
              <td width="45%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条</td>
              <td width="40%" class="#ff0000"> 分页：
			  <?php if($page<=1){  ?>
			        首页&nbsp;
			  <?php }else{ ?>
			  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=1">首页</a> 
			  <?php  } ?>
			  <?php if($page-1<1){ ?>
			        上一页&nbsp;
			  <?php }else{ ?>
			  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php if($page==1){echo $page=1; }else{ echo $page-1; }?>">上一页</a> 
			  <?php  } ?>
			  <?php  if($page+1>$page_page) { ?>
			         下一页
			  <?php }else{ ?>
			         <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php if($page<$page_page){echo $page+1;}else{ echo $page_page;}?>">下一页</a>
			  <?php }?>
			  <?php if($page>=$page_page){ ?>
			        尾页
			  <?php }else{ ?>
			   <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php echo $page_page; ?>">尾页</a></td>
			   <?php  } ?>
              <td width="15%">&nbsp;</td>
            </tr>
		<?php } ?>
        </table></td>
      </tr>
    </tbody>
  </table>
</form>
</body>
</html>
