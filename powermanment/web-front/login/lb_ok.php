<?php
session_start();
if(isset($_GET['id'])){
	$id=$_GET['id'];
}else{
	$id="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看帖子详细信息</title>
<style type="text/css">
<!--
.STYLE2 {color: #CC6633}
.STYLE4 {color: #CC6600}
body,td,th {
	font-size: 12px;
}
.STYLE6 {color: #FF0000}
-->
</style>
</head>

<body>
<?php
include("conn/conn.php");
include("index_01.php");
include("index_02.php");
$select=mysql_query("select * from tb_content where id='$id'",$conn);
$array=mysql_fetch_array($select);
$select_user=mysql_query("select * from tb_user where username='".$array['username']."'",$conn);
$array_user=mysql_fetch_array($select_user);
?>

<p align="center"><img src="images/06_01.gif" width="997" height="44" alt="" />
<table width="993" height="452" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC">
  <?php
  if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	if($page<=1){
  ?>
  <tr>
    <td width="188" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><div align="center"><span class="STYLE6">发起人</span></div></td>
    <td width="504" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><span class="STYLE6">主题：<?php echo $array['subject'];?></span></td>
    <td width="204" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><span class="STYLE6">发布日期：<?php echo $array['release_date'];?></span></td>
    <td width="74" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><div align="center"><a href="hfzt.php?h_id=<?php echo $id;?>">回复</a></div></td>
  </tr>
  <tr>
    <td height="106" align="center" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><?php echo $array_user['username'];?>
      <p align="center"><img src="<?php echo $array_user['tx'];?>" />
    <p align="center"><span class="STYLE4">我是：<?php echo $array_user['sex'];?>生</span>
    <p align="center"><span class="STYLE2">email：<?php echo $array_user['email'];?></span>
    <p align="center"><span class="STYLE4">QQ：<?php echo $array_user['qq'];?></span></td>
    <td colspan="3" align="left" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><?php echo $array['content'];?></td>
  </tr>
  <?php }else{?>
   <tr>
    <td width="188"  bo bgcolor="#FFFDF1"></td>
    <td width="504"  bgcolor="#FFFDF1"></td>
    <td width="204"  bgcolor="#FFFDF1"></td>
    <td width="74"   bgcolor="#FFFDF1"><div align="center"><a href="hfzt.php?h_id=<?php echo $id;?>">回复</a></div></td>
  </tr>
   <?php } ?>
<?php
if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
	  	$page=1;
	}
	  $page_count=3;
	  $temp=($page-1)*$page_count;
	  $select2=mysql_query("select * from tb_resume_contents where subject='".$array['subject']."' limit $temp,$page_count",$conn);
	  $select3=mysql_query("select * from tb_resume_contents where subject='".$array['subject']."'",$conn);
	  $row=mysql_num_rows($select3);
	  $page_page=ceil($row/$page_count);
	  $offect=($page-1)*$page_count;   //获取上一页的最后一条记录，从而计算下一页的起始记录
?>
<?php
if(mysql_num_rows($select2)>=1){
	while($array1=mysql_fetch_array($select2)){
		$select3=mysql_query("select * from tb_user where username='".$array1['username']."'",$conn);
		$array2=mysql_fetch_array($select3);
?>
  <tr>
    <td bordercolor="#FFFFFF" bgcolor="#FFFDF1"><div align="center" class="STYLE6">回复人</div></td>
    <td bordercolor="#FFFFFF" bgcolor="#FFFDF1"><span class="STYLE6">回复标题：<span class="STYLE2"><?php echo $array1['resume_subject'];?></span></span></td>
    <td colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><span class="STYLE6"><span class="STYLE6">回复日期：</span><?php echo $array1['resume_date'];?>
    <div align="center"><a href="hfzt.php?h_id=<?php echo $id;?>"></a></div></td>
  </tr>
  <tr>
    <td height="133" align="center" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><span class="STYLE2"><?php echo $array1['username'];?></span>
	 <p align="center"><img src="<?php echo $array2['tx'];?>" />     
	 <p align="center"><span class="STYLE2">我是：<?php echo $array2['sex'];?>生</span>
      <p align="center"><span class="STYLE2">email：<?php echo $array2['email'];?></span>
    <p align="center"><span class="STYLE2">QQ：<?php echo $array2['qq'];?></span>    </td>
    <td colspan="3" align="left" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><span class="STYLE2"><?php echo $array1['resume_contents'];?></span></td>
  </tr>
    <?
  }
  }
  ?>
  <tr>
    <td height="24" colspan="4" align="center" bordercolor="#FFFFFF" bgcolor="#FFFDF1"><table width="80%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr class="style4">
          <td width="50%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条&nbsp; </td>
          <td width="39%" class="#ff0000">
		  
		  <?php if($page<=1){ ?>
		  首页&nbsp;
		  <?php }else{ ?>
		  <a href="lb_ok.php?id=<?php echo $_GET["id"];?>&amp; page=1">首页</a> 
		  <?php } ?>
		  <?php if($page-1<1){ ?>
		  上一页
		  <?php }else{ ?>
		  <a href="lb_ok.php?id=<?php echo $_GET["id"];?>&amp; page=<?php if($page==1){echo $page=1; }else{ echo $page-1; }?>">上一页</a> 
		 <?php } ?>
		 <?php if($page+1>$page_page){ ?>
		 下一页&nbsp;
		 <?php }else{ ?>
		 <a href="lb_ok.php?id=<?php echo $_GET["id"];?>&amp;page=<?php if($page<$page_page){echo $page+1;}else{ echo $page_page;}?>">下一页</a>
		 <?php }?>
		 
		 <?php if($page>=$page_page){ ?>
		  尾页
		 <?php }else{ ?>
		  <a href="lb_ok.php?id=<?php echo $_GET["id"];?>&amp;page=<?php echo $page_page; ?>">尾页</a></td>
		  <?php }?>
		  
          <td width="11%">&nbsp;</td>
        </tr
    >
        </table></td>
  </tr>

 </table>
 <?php
include("index_05.php");
include("index_06.php");
 ?>
</body>
</html>
