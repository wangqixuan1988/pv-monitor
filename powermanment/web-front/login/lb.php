<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>类别信息</title>
<style type="text/css">
<!--
.STYLE2 {color: #CC0000;
	font-weight: bold;
}
.STYLE4 {color: #383838;
	font-weight: bold;
	font-size: 12px;
}
.style1 {FONT-WEIGHT: normal;
	FONT-SIZE: 12px;
	FONT-FAMILY: "宋体";
	line-height: 22px;
	color: #383838;
}
-->
</style>
</head>

<body>
<?php
include("conn/conn.php");
include("index_01.php");
include("index_02.php");
include("index_03.php");
?>
<?php
if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	  $category=$_GET['category'];
	  $page_count=3;
	  $select=mysql_query("select * from tb_content where category='$category'",$conn);
	  $row=mysql_num_rows($select);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录
?>
<table width="987" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#E1DAEA">
  <tbody>
    <tr>
      <td height="30" colspan="2" align="center" bgcolor="#FFFBF0" class="STYLE4"><?php 
	  if(isset($_GET['category'])){
	  $category=$_GET['category'];
	  }else{
	  $category="";
	  }
	  ?>类图书</td>
      <td width="265" bgcolor="#FFFBF0">&nbsp;</td>
    </tr>
  </tbody>
</table>
<?php 
if($row>0){

?>
<table width="987" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="E1DAEA">
  <tbody>
    <tr class="style1" align="middle" bgcolor="#d0e8ff">
      <td width="179" height="35" align="center" bgcolor="FFEFBA"><span class="STYLE2">主题</span></td>
      <td width="311" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">内容</td>
      <td width="70" align="center" bgcolor="FFEFBA" class="STYLE2">发布人</td>
      <td width="140" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">发布时间</td>
    </tr>
    <?php 

	  $selects=mysql_query("select * from tb_content where category='$category' order by id desc limit $offect,$page_count",$conn);
	  while($array=mysql_fetch_array($selects)){
?>
    <tr class="style1" align="middle">
      <td height="35" align="center" bgcolor="#FFFBF0"><a href="lb_ok.php?id=<?php echo $array['id'];?>"><?php echo $array['subject'];?></a></td>
      <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['content'];?></td>
      <td align="center" bgcolor="#FFFBF0"><?php echo $array['username'];?></td>
      <td height="35" align="center" bgcolor="#FFFBF0"><?php echo $array['release_date'];?></td>
    </tr>
  </tbody>
  <?php }?>
  <tr class="style1" align="middle">
    <td height="35" colspan="4" align="center" bgcolor="#FFFBF0"><table width="80%" border="0" cellspacing="0" cellpadding="0">
      <tr class="style4">
        <td width="50%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条&nbsp; </td>
        <td width="39%" class="#ff0000">
		<a href="lb.php?category=<?php echo urlencode($category);?>&amp; page=1">首页</a> 
		<a href="lb.php?category=<?php echo urlencode($category);?>&amp; page=<?php if($page==1){echo $page=1; }else{ echo $page-1; }?>">上一页</a>
		<a href="lb.php?category=<?php echo urlencode($category);?>&amp; page=<?php if($page<$page_page){echo $page+1;}else{ echo $page_page;}?>">下一页</a> 		<a href="lb.php?category=<?php echo urlencode($category);?>&amp; page=<?php echo $page_page; ?>">尾页</a></td>
        <td width="11%">&nbsp;</td>
      </tr
    >
    </table></td>
  </tr>
</table>
<?php 
}
?>
<p>&nbsp;</p>
</body>
</html>
