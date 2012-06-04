<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>增加新的商品</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "<center>\n";
require "header.php";
require "configure.php";
$sql="select admin from $table_user where id='$_COOKIE[id]'";
$result=mysql_query($sql,$link);
$rows=mysql_fetch_array($result);
if($rows[0]!=3)
{
	echo "你没有权限执行这项操作！";
	exit();
}
else
{
	if(!$_POST[book_name])
	{
		$sql="select id,type_name from $table_type where g_id=0";
		$result=mysql_query($sql,$link);
		$i=0;
		while($rows=mysql_fetch_array($result))
		{
			$j=0;
			$temp[$i][0]=$rows[type_name];
			$flag[$i][0]=$rows[id];
			$sql2="select id,type_name from $table_type where g_id='$rows[id]'";
			$result2=mysql_query($sql2,$link);
			while($rows2=mysql_fetch_array($result2))
			{
				$j++;
				$temp[$i][$j]=$rows2[type_name];
				$flag[$i][$j]=$rows2[id];
			}
			$i++;
		}
		echo "<script language=javascript>
function Juge(theForm)
{
    if (theForm.book_name.value == \"\")
  {
    alert(\"请输入商品名!\");
    theForm.book_name.focus();
    return (false);
  }
    if (theForm.cost.value == \"\")
  {
    alert(\"请输入商品的价格!\");
    theForm.cost.focus();
    return (false);
  }
    if (theForm.book_num.value == \"\")
  {
    alert(\"请输入数量!\");
    theForm.book_num.focus();
    return (false);
  }
    if (theForm.book_description.value == \"\")
  {
    alert(\"请输入内容简介!\");
    theForm.book_description.focus();
    return (false);
  }
}
function change(){
for(var i=document.f.s_type.length;i>=0;i--) document.f.s_type.options[i]=null;
switch(document.f.m_type.options[document.f.m_type.selectedIndex].text){\n";
for($i=0;$i<count($temp);$i++)
{
	echo "case "."\"".$temp[$i][0]."\":\n";
	for($j=1;$j<count($temp[$i]);$j++)
	echo "document.f.s_type.options[".($j-1)."]=new Option(\"".$temp[$i][$j]."\",\"".$flag[$i][$j]."\",false,false);\n";
	echo "break;\n";
}
echo "}\n}\n</script>\n";
echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\" name=\"f\"  ENCTYPE=\"multipart/form-data\">\n";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><h2>增加新商品第一步</h2></center></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入商品名称：</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"book_name\">";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入售价：</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"book_cost\">";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>选择所属类别：</td>\n";
		echo "<td>";
		echo "主类别：";
		echo "<select size=\"1\" name=\"m_type\"  onchange=\"change()\">\n";
		for($i=0;$i<count($temp);$i++)
		{
			echo "<option value=".$flag[$i][0].">".$temp[$i][0];
		}
		echo "</select>\n<br>";
		echo "分类别：";
		echo "<select size=\"1\" name=\"s_type\">\n";
		for($i=1;$i<count($temp[0]);$i++)
		{
			echo "<option value=".$flag[0][$i].">".$temp[0][$i];
		}
		echo "</select>\n";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入该商品的数量：</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"book_num\">";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入该商品的简介：</td>\n";
		echo "<td>";
		echo "<textarea name=\"book_description\" cols=\"30\" rows=\"5\"></textarea>";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>上传该商品的封面扫描图：</td>\n";
		echo "<td>";
		echo "<input type=\"file\" name=\"photo\">";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><input type=submit value=\"下一步\"></td>\n";
		echo "</tr>\n";
		echo "</form>\n";
		echo "</table>\n";
		echo "</center>\n";
		echo "</body>";
		echo "</html>\n";
	}
	else
	{
		$book_name=$_POST[book_name];
		$book_cost=$_POST[book_cost];
		$m_type=$_POST[m_type];
		$s_type=$_POST[s_type];
		$book_num=$_POST[book_num];
		$book_description=$_POST[book_description];
		if($photo)
		{
			$filepath="images/";
			$file_temp=explode(".",$photo_name);
			$filename=$filepath.date(YmdHis).".".$file_temp[1]; 
			copy($photo,$filename);
			unlink($photo);
		}
		$sql="insert into $table_good (good_name,good_type,good_cost,good_description,good_num,good_photo) values('$book_name','$s_type','$book_cost','$book_description','$book_num','$filename')";
		mysql_query($sql,$link) or die(mysql_error());
		if(mysql_query($sql,$link))
		{
			$sql="update $table_type set type_num=type_num+1 where id='$m_type'";
			mysql_query($sql,$link);
			$sql="update $table_type set type_num=type_num+1 where id='$s_type'";
			mysql_query($sql,$link);
			echo "添加新的商品操作成功，现在返回！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=addNewGoods.php\">";
		}
		else
		{
			echo "添加新的商品操作失败，现在返回重新输入！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=addNewGoods.php\">";
		}
	}
}
?>
