<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>回复主题</title>
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
      <td width="370" height="30" colspan="2" align="center" bgcolor="#FFFBF0" class="STYLE4">&nbsp;回复主题管理</td>
      <td width="220" bgcolor="#FFFBF0">&nbsp;</td>
    </tr>
  </tbody>
</table>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="E1DAEA">
    <?php 
include("../conn/conn.php");
if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	  $page_count=3;
	  $select=mysql_query("select * from tb_resume_contents",$conn);
	  $row=mysql_num_rows($select);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录
	  $selects=mysql_query("select * from tb_resume_contents where id order by id desc limit $offect,$page_count",$conn);
	  while($array=mysql_fetch_array($selects)){
?>
  <tbody>
    <tr class="style1" align="middle" bgcolor="#d0e8ff">
      <td height="35" colspan="3" align="left" bgcolor="FFEFBA"><span class="STYLE2">&nbsp;&nbsp;&nbsp;&nbsp;主 题：<?php echo $array['subject'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="delete4.php?lmbs=<?php echo urlencode("回复主题");?>&amp;id=<?php echo $array['id'];?>;">删 除</a></td>
    </tr>
    
    <tr class="style1" align="middle">
      <td width="192" height="35" rowspan="2" align="center" bgcolor="#FFFBF0"></td>
      <td height="17" colspan="2" align="left" bgcolor="#FFFBF0">&nbsp;&nbsp;回复主题:<?php echo $array['resume_subject'];?>&nbsp;&nbsp;发表时间:<?php echo $array['resume_date'];?></td>
    </tr>
    <tr class="style1" align="middle">
      <td height="17" colspan="2" align="left" bgcolor="#FFFBF0">&nbsp;&nbsp;回复内容：<?php echo $array['resume_contents'];?>&nbsp;</td>
    </tr>
    <?php }?>
    <tr class="style1" align="middle">
      <td height="35" colspan="3" align="center" bgcolor="#FFFBF0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="style4">
          <td width="50%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条&nbsp; </td>
          <td width="39%" class="#ff0000"> 分页：<a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=1">首页</a> 
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
