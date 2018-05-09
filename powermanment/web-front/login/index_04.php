<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
-->
</style></head>

<body>
<p>
<?php
include("conn/conn.php");
if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	  $page_count=3;
	  $select=mysql_query("select * from tb_category",$conn);
	  $row=mysql_num_rows($select);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录
	  $selects=mysql_query("select * from tb_category where id order by id desc limit $offect,$page_count",$conn);
	  while($array=mysql_fetch_array($selects)){
	  $icon=substr($array['icon'],3,30);
?>

<table width="987" height="88" border="1" align="center" bordercolor="#FFCC99">
  <tr>
    <td width="172" rowspan="2" align="center"><?php echo "<img src=\"$icon\">";?></td>
    <td width="453" height="28"><a href="lb.php?category=<?php echo $array['category'];?>">明日科技出版的[<?php echo $array['category'];?>]类图书</a></td>
    <td width="340" rowspan="2">创建日期：<?php echo $array['create_date'];?><br>
    主题总数：<?php $selectes=mysql_query("select * from tb_content where category='".$array['category']."'",$conn);
		  $count=mysql_num_rows($selectes);
		  echo $count;
		  ?><br>
    今日主题数：<?php $dates=date("Y-m-d");
		  $rows=mysql_query("select * from tb_content where release_date='$dates' and category='".$array['category']."'",$conn);
		  $counts=mysql_num_rows($rows);
		  echo $counts;?></td>
  </tr>
  <tr>
    <td height="25" bgcolor="#FFCC66">版主：<?php echo $array['noderator']?></td>
  </tr>
  <?php 
}
?>
  <tr>
    <td colspan="3"><div align="center">
      <div align="right">共<?php echo $page_page;?>页 每页<?php echo $page_count;?>条 当前第<?php  echo $page; ?>页  
	  <a href="index.php?page=1">首页</a> 
	  <a href="index.php?page=<?php if($page==1){echo $page=1; }else{ echo $page-1; }?>">上一页</a> 
	  <a href="index.php?page=<?php if($page<$page_page){echo $page+1;}else{ echo $page_page;}?>">下一页</a> 
    <a href="index.php?page=<?php echo $page_page; ?>">尾页</a></div></td>
  </tr>
</table>

</body>
</html>
