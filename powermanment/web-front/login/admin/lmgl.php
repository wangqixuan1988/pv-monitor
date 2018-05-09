<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目管理</title>
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
<?php
include("../conn/conn.php");
$top=("../images/tx/photo.jpg");
$df=("../images/tx/photoes.jpg");
if(isset($_POST['noderator']) and $_POST['zhuijia']=="追加栏目"){
	$date=date("Y-m-d");
	$insert=mysql_query("insert into tb_category(icon,category,noderator,create_date) values('".$_POST['icon']."','".$_POST['category']."','".$_POST['noderator']."','$date')",$conn);
	if($insert){
		echo "<script>alert('追加成功！');window.location.href='index.php?lmbs=".$_GET['lmbs']."';</script>";
	}else{
		echo "<script>alert('追加失败！');window.location.href='index.php?lmbs=".$_GET['lmbs']."';</script>";
	}
}
?>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#E1DAEA">
  <form action="index.php?lmbs=栏目管理" method="post" 
        enctype="multipart/form-data" name="myform" id="myform">
    <tbody>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#FFFBF0" class="STYLE4">&nbsp;栏目管理</td>
        <td width="220" bgcolor="#FFFBF0">&nbsp;</td>
      </tr>
      <tr>
        <td width="170" height="30" align="middle" bgcolor="#FFFBF0" class="style1">&nbsp;版主:
          <input 
            id="noderator" size="15" name="noderator" />
        </td>
        <td width="200" align="middle" bgcolor="#FFFBF0" class="style1">所属专区:
          <select id="category" size="1" 
            name="category">
              <option value="asp" selected="selected">ASP</option>
              <option 
              value="jsp">JSP</option>
              <option value="delphi">Delphi</option>
              <option value="visual basic">Visual Basic</option>
              <option 
              value="visual foxpro">Visual Foxpro</option>
              <option 
              value="visual c++">Visual C++</option>
              <option value="power">Power 
                Buider</option>
              <option value=".net">.net</option>
          </select></td>
        <td align="left" valign="center" bgcolor="#FFFBF0" class="style1">&nbsp;&nbsp;图标:
          <input type="radio" name="icon" value="<?php echo $top;?>" />
            <img src='../images/tx/photo.jpg' width='45' height='40' />
            <input type="radio" name="icon" value="<?php echo $df;?>" />
            <img src='../images/tx/photoes.jpg' width='45' height='40' /></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFBF0">&nbsp;</td>
        <td bgcolor="#FFFBF0" class="style1">&nbsp;
            <input id="zhuijia" type="submit" value="追加栏目" name="zhuijia" /></td>
      </tr>
    </tbody>
  </form>
</table>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="E1DAEA">
  <tbody>
    <tr class="style1" align="middle" bgcolor="#d0e8ff">
      <td width="95" height="35" align="center" bgcolor="FFEFBA"><span class="STYLE2">图 标</span></td>
      <td width="70" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">所属专区</td>
      <td width="145" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">版 主</td>
      <td width="200" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">时间</td>
      <td width="80" height="35" align="center" bgcolor="FFEFBA" class="STYLE2">是否删除</td>
    </tr>
    <?php  

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
          if($selects){
        while($myrow=mysql_fetch_array($selects)){  ?>
    <tr class="style1" align="middle">
      <td height="44" align="center" bgcolor="#FFFBF0"><img src="<?php echo $myrow['icon'];?>" width="40" height="40" /></td>
      <td height="44" align="center" bgcolor="#FFFBF0"><?php echo $myrow['category'];?></td>
      <td height="44" align="center" bgcolor="#FFFBF0"><?php echo $myrow['noderator'];?></td>
      <td height="44" align="center" bgcolor="#FFFBF0"><?php echo $myrow['create_date'];?></td>
      <td height="44" align="center" bgcolor="#FFFBF0"><a href="delete3.php?lmbs=<?php echo urlencode("栏目管理");?>&amp;id=<?php echo $myrow['id'];?>">删除</a></td>
    </tr>
	    <?php }}?>
    <tr class="style1" align="middle">
      <td height="44" colspan="5" align="center" bgcolor="#FFFBF0"><table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr class="style4">
          <td width="50%" class="#ff0000">&nbsp;&nbsp;页次：<?php echo $page;?>/<?php echo $page_page;?>页 记录：<?php echo $row;?>条&nbsp; </td>
          <td width="39%" class="#ff0000">
		  <a href="index.php?lmbs=<?php echo urlencode($_GET['lmbs']);?>&amp; page=1">首页</a> 
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
