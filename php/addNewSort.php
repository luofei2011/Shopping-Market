<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>增加新的图书类别</title>\n";
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
	if(!$_POST[type])
	{
		echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\">\n";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><h2>创建图书分类第一步</h2></center></td>\n";
		echo "</tr>";
		echo "<tr>\n";
		echo "<td>选择创建类别</td>\n";
		echo "<td>";
		echo "<select size=\"1\" name=\"type\">\n";
		echo "<option value=\"1\">主类别</option>\n";
		echo "<option value=\"2\">分类别</option>\n";
		echo "</select>\n";
		echo "</td>\n";
		echo "</tr>";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><input type=submit value=\"下一步\"></td>\n";
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
		echo "\t\ttheForm.topic_name.focus();\n";
		echo "\t\treturn (false);\n";
		echo "\t}\n";
		echo "\tif (theForm.type_description.value == \"\")\n";
		echo "\t{\n";
		echo "\t\talert(\"请输入类别介绍！\");\n";
		echo "\t\ttheForm.topic_description.focus();\n";
		echo "\t\treturn (false);\n";
		echo "\t}\n";
	  	echo "}\n";
		echo "</script>\n";
		echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\"  onsubmit=\"return juge(this)\">\n";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><h2>创建图书分类第二步</h2></center></td>\n";
		echo "</tr>";
		echo "<input type=\"hidden\" name=\"type\" value=\"".$_POST[type]."\">";
		if($_POST[type]==2)
		{
			echo "<tr>\n";
			echo "<td>选择分类别所属主类</td>\n";
			echo "<td>";
			echo "<select size=\"1\" name=\"g_id\">\n";
			$sql="select id,type_name from $table_type where g_id=0";
			$result=mysql_query($sql,$link);
			echo "11111111111";
			echo $result;
			while($rows=mysql_fetch_array($result))
			{
				echo "<option value=\"".$rows[id]."\">".$rows[type_name]."</option>\n";
			}
			echo "</select>\n";
			echo "</td>\n";
			echo "</tr>";
		}
		echo "<tr>\n";
		echo "<td>输入类别名称</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"type_name\">\n";
		echo "</td>\n";
		echo "</tr>";
		echo "<tr>\n";
		echo "<td>输入类别介绍</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"type_description\">\n";
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
		$type=$_POST[type];
		$type_name=$_POST[type_name];
		$type_description=$_POST[type_description];
		if($type==2)
		{
			$g_id=$_POST[g_id];
		}
		else $g_id=0;
		$sql="insert into $table_type(g_id,type_name,type_description)values('$g_id','$type_name','$type_description')";
		if(mysql_query($sql,$link))
		{
			echo "增加新类别操作成功，现在返回首页！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=HomePage.php\">";
		}
		else
		{
			echo "增加新类别操作失败，现在返回！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=addNewSort.php\">";
		}
	}
}
?>
