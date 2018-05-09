<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库、数据表中数据的动态输出</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head>
<script language="javascript">
 function chkinput(form){
   if(form.dbname.value==""){
     alert("请输入数据库名!");
     form.dbname.select();
	 return(false);
   }
   if(form.tbname.value==""){
     alert("请输入表名!");
     form.tbname.select();
	 return(false);
   }
  return(true);
 }
 

</script>
<body>
<table id="__01" width="900" border="0" cellpadding="0" cellspacing="0">
	
	<tr>
		<td>
			<img src="" width="900" height="127" alt=""></td>
	</tr>
	<tr>
		<td>
		<table width="567" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <form name="form1" method="post" action="index.php" onsubmit="return chkinput(this)">
	  <tr>
        <td width="104" height="25" align="right">数据库名：</td>
        <td width="112" align="left"><input type="text" name="dbname" size="20" class="inputcss" /></td>
        <td width="201" align="center">表名：
          <input type="text" name="tbname" size="20" class="inputcss" /></td>
        <td width="150"><input type="submit" name="submit" class="buttoncss" value="查看" /></td>
	  </tr>
	  </form>
      <tr>
        <td height="30" colspan="4" align="center">
          <span class="STYLE1">
<?php
if($_POST[submit]!=""){
	$dbname=$_POST[dbname];
	$tbname=$_POST[tbname];
	$conn=mysqli_connect("localhost","root","1",$dbname);
	if(mysqli_connect_errno()) {
    	printf("数据库连接失败: %s\n", mysqli_connect_error());
        exit();
	}
	mysqli_query($conn,"set names utf8");
	$result=mysqli_query($conn,"select * from ".$tbname."");
	echo "该表共有字段&nbsp;".mysqli_num_fields($result)."&nbsp;个!";
	echo "该表共有记录&nbsp;".mysqli_num_rows($result)."&nbsp;条!";
}
?>
          </span></td>
      </tr>
    </table>
<?php
if($conn){
?> 
<table width="550" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFCC33">
	<tr>
<?php 
	for($i=0; $i<mysqli_num_fields($result);$i++){
		$obj=mysqli_fetch_field($result);
?>
		<td height="25" bgcolor="#FFFFFF" ><div align="center"><?php echo $obj->name;?></div></td>
<?php 
	}
?>
	</tr>
<?php
	$query = "select * from ".$tbname."";
	$sql=mysqli_query($conn,$query);
	$info=mysqli_fetch_array($sql);
	if($info==NULL){
		echo "暂无员工信息!";
	}else{
		do{
?>
	<tr>
		<?php 
			for($i=0; $i<mysqli_num_fields($sql);$i++){		  
		?>
    			<td height="25" bgcolor="#FFFFFF"><div align="center"><?php echo $info[$i];?></div></td>
     	<?php 
	 		}
	 	?>
	</tr>
<?php
		}while($info=mysqli_fetch_array($sql));
	}
	mysqli_close($conn);
?>
        </table>
<?php 
}
?>
		</td>
	</tr>
	<tr>
		<td>
			<img src="" width="900" height="70" alt=""></td>
	</tr>
</table>
</body>
</html>
