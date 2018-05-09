<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>论坛主题</title>
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
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#E1DAEA">
  <tbody>
    <tr>
      <td width="370" height="30" colspan="2" align="center" bgcolor="#FFFBF0" class="STYLE4">&nbsp;主题管理</td>
      <td width="220" bgcolor="#FFFBF0">&nbsp;</td>
    </tr>
  </tbody>
</table>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="E1DAEA">
  <tbody>
    <tr class="style1" align="middle" bgcolor="#d0e8ff">
      <td width="195" height="35" align="center" bgcolor="FFEFBA"><span class="STYLE2">主 题</span></td>
      <td width="571" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">内 容</td>
      <td width="103" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">发布者</td>
      <td width="103" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">是否删除</td>
    </tr>
     <?php 
include("../conn/conn.php");
if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	  $page_count=3;
	  $select=mysql_query("select * from tb_content",$conn);
	  $row=mysql_num_rows($select);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录
	  $selects=mysql_query("select * from tb_content where id order by id desc limit $offect,$page_count",$conn);
	  while($array=mysql_fetch_array($selects)){
?>
    <tr class="style1" align="middle">
      <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['subject'];?>&nbsp;</td>
      <td height="35" align="left" valign="top" bgcolor="#FFFBF0"><?php echo $array['content'];?>&nbsp;</td>
      <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['username'];?>&nbsp;</td>
      <td height="35" align="center" bgcolor="#FFFBF0"><a href="delete1.php?lmbs=<?php echo urlencode("主题管理");?>&amp;id=<?php echo $array['id'];?>" class="style3">删除</a></td>
    </tr>
    <?php }?>
    <tr class="style1" align="middle">
      <td height="35" colspan="4" align="center" bgcolor="#FFFBF0"><table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr class="style4">
          <td width="50%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条&nbsp; </td>
          <td width="39%" class="#ff0000"> 分页： <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=1">首页</a> 
	  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php if($page==1){echo $page=1; }else{ echo $page-1; }?>">上一页</a> 
	  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php if($page<$page_page){echo $page+1;}else{ echo $page_page;}?>">下一页</a> 
    <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=<?php echo $page_page; ?>">尾页</a></td>
          <td width="11%">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
