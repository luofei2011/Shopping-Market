<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>修改现有的图书类别</title>\n";
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
		if(!$_POST[id])
		{
		echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\">\n";
		echo "<tr>\n";
		echo "<td colspan=\"4\"><center><h2>修改图书分类第一步</h2></center></td>\n";
		echo "</tr>";
		echo "<tr>\n";
		echo "<td>选择图书分类</td>\n";
		echo "<td>分类类型</td>\n";
		echo "<td>图书分类名称</td>\n";
		echo "<td>该类别简介</td>\n";
		echo "</tr>";
		$sql="select id,g_id,type_name,type_description from $table_type";
		$result=mysql_query($sql,$link);
		while($rows=mysql_fetch_array($result))
		{
			echo "<tr>\n";
			echo "<td><input type=\"radio\" name=\"id\" value=\"".$rows[id]."\"></td>\n";
			echo "<td>";
			if($rows[g_id]==0)
			{
				echo "主分类";
			}
			else
			{
				echo "子分类";
			}
			echo "</td>\n";
			echo "<td>".$rows[type_name]."</td>\n";
			echo "<td>".$rows[type_description]."</td>\n";
			echo "</tr>\n";
		}
		echo "<tr>\n";
		echo "<td colspan=\"4\"><center><input type=submit value=\"下一步\"></td>\n";
		echo "</tr>\n";
		echo "</form>\n";
		echo "</table>\n";
		echo "</center>\n";
		echo "</body>";
		echo "</html>\n";

	}
	else if(!$_POST[type_name])
	{
		echo "<script language=\"javascript\">\n";
		echo "function juge(theForm)\n";
		echo "{\n";
		echo "\tif (theForm.type_name.value == \"\")\n";
		echo "\t{\n";
		echo "\t\talert(\"请输入类别名称！\");\n";
		echo "\t\ttheForm.type_name.focus();\n";
		echo "\t\treturn (false);\n";
		echo "\t}\n";
		echo "\tif (theForm.type_description.value == \"\")\n";
		echo "\t{\n";
		echo "\t\talert(\"请输入类别介绍！\");\n";
		echo "\t\ttheForm.type_description.focus();\n";
		echo "\t\treturn (false);\n";
		echo "\t}\n";
	  	echo "}\n";
		echo "</script>\n";
		echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\"  onsubmit=\"return juge(this)\">\n";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><h2>修改图书分类第二步</h2></center></td>\n";
		echo "</tr>";
		echo "<input type=\"hidden\" name=\"id\" value=\"".$_POST[id]."\">";
		$sql="select * from $table_type where id='$_POST[id]'";
		$result=mysql_query($sql,$link);
		$rows=mysql_fetch_array($result);
		if($rows[g_id]!=0)
		{
			echo "<tr>\n";
			echo "<td>选择子类别所属主类</td>\n";
			echo "<td>";
			echo "<select size=\"1\" name=\"g_id\">\n";
			$sql2="select id,type_name from $table_type where g_id=0";
			$result2=mysql_query($sql2,$link);
			while($rows2=mysql_fetch_array($result2))
			{
				echo "<option value=\"".$rows2[id]."\"";
				if($rows2[id]==$rows[g_id]) echo " checked";
				echo ">".$rows2[type_name]."</option>\n";
			}
			echo "</select>\n";
			echo "</td>\n";
			echo "</tr>";
		}
		echo "<tr>\n";
		echo "<td>输入类别名称</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"type_name\" value=\"".$rows[type_name]."\">\n";
		echo "</td>\n";
		echo "</tr>";
		echo "<tr>\n";
		echo "<td>输入类别介绍</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"type_description\" value=\"".$rows[type_description]."\">\n";
		echo "</td>\n";
		echo "</tr>";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><input type=button value=\"上一步\" onclick=\"history.go(-1)\"><input type=submit value=\"下一步\"></td>\n";
		echo "</tr>\n";
		echo "</form>\n";
		echo "</table>\n";
		echo "</center>\n";
		echo "</body>";
		echo "</html>\n";
	}
	else
	{
		$id=$_POST[id];
		$type=$_POST[type];
		$type_name=$_POST[type_name];
		$type_description=$_POST[type_description];
		if($_POST[g_id])
		{
			$g_id=$_POST[g_id];
		}
		else
		{
			$g_id=0;
		}
		$sql="update  $table_type set g_id='$g_id',type_name='$type_name',type_description='$type_description' where id=$id";
		if(mysql_query($sql,$link))
		{
			echo "修改图书分类操作成功，现在返回图书分类列表！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=Manage.html\">";
		}
		else
		{
			echo "修改图书分类操作失败，现在返回！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=alterSort.php\">";
			echo $g_id;
		}
	}
}
?>
