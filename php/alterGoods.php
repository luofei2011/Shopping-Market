<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>修改已有的商品</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "<center>\n";
require "configure.php";
require "header.php";
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
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	if(!$_POST[id])
	{
		$sql="select id from $table_good";				//从列表中读出所有商品记录
		$result=mysql_query($sql,$link) or die(mysql_error());				//发送查找列表请求
		$num=mysql_num_rows($result);				//获取结果条数
		$p_count=ceil($num/10);						//总页数
		if ($_GET["page"]==0 && !$_GET["page"]) $page=1;//当前页
		else $page=$_GET["page"];
		if($num<1)								//如果没有记录
		{
			echo "<tr>\n";
			echo "<td>";
			echo "<center><h2>暂时还没有商品的记录</h2></center>";		//输出相应信息
			echo "</td>\n";
			echo "</tr>\n";
			exit();								//退出所有PHP代码
		}
		else										//如果有记录则执行相应操作
		{
			$s=($page-1)*10;
			$sql="select * from $table_good order by id limit $s,10";
			$result=mysql_query($sql,$link);
			echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\">";
			echo "<tr>\n";
			echo "<td colspan=\"5\"><center><h2>已有商品第一步：选择记录</h2></center></td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td>选择</td>\n";
			echo "<td>商品名</td>\n";
			echo "<td>价格</td>\n";
			echo "<td>类别</td>\n";
			while($rows=mysql_fetch_array($result))		//循环显示记录内容
			{
				echo "<tr>\n";
				echo "<td><input type=\"radio\" name=\"id\" value=\"".$rows[id]."\"></td>\n";
				echo "<td><a href=\"GoodsDetails.php?id=".$rows[id]."\">".$rows[good_name]."</a></td>\n";	//显示书名
				echo "<td>".$rows[good_cost]."</td>\n";	//显示价格
				$sql2="select type_name from $table_type where id='$rows[good_type]'";
				$result2=mysql_query($sql2);
				$rows2=mysql_fetch_array($result2);
				echo "<td>".$rows2[0]."</td>";			//显示类别
				echo "</tr>\n";
			}
			echo "<tr>\n";
			echo "<td colspan=\"5\"><center><input type=\"submit\" value=\"修改选择项\"></center></td>\n";
			echo "</tr>\n";
			echo "</form>\n";
		}
		echo "</table>";
		$prev_page=$page-1;
		$next_page=$page+1;
		echo "             <p align=\"center\"> ";
		if ($page>1)
		{
			echo "<a href='$PATH_INFO?page=1'>第一页</a> | ";
		}
		if ($prev_page>=1)
		{
			echo "<a href='$PATH_INFO?page=$prev_page'>上一页</a> | ";
		}
		if ($next_page<=$p_count)
		{
			echo "<a href='$PATH_INFO?page=$next_page'>下一页</a> | ";
		}
		if ($page<$p_count)
		{
			echo "<a href='$PATH_INFO?page=$p_count'>最后一页</a></p>\n";
		}
		echo "</center>";
		echo "</body>";
		echo "</html>";
	}
	else if(!$_POST[book_name])
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
		$sql="select * from $table_good where id='$_POST[id]'";
		$result=mysql_query($sql,$link);
		$rows=mysql_fetch_array($result);
echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\" name=\"f\"  ENCTYPE=\"multipart/form-data\">\n";
		echo "<input type=\"hidden\" name=\"id\" value=\"".$_POST[id]."\">";
		echo "<tr>\n";
		echo "<td colspan=\"2\"><center><h2>修改已有图书第二步：修改相关信息</h2></center></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入商品名称：</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"book_name\" value=\"".$rows[good_name]."\">";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入售价：</td>\n";
		echo "<td>";
		echo "<input type=\"text\" name=\"book_cost\" value=\"".$rows[good_cost]."\">";
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
		echo "<input type=\"text\" name=\"book_num\" value=\"".$rows[good_num]."\">";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>输入该商品的简介：</td>\n";
		echo "<td>";
		echo "<textarea name=\"book_description\" cols=\"30\" rows=\"5\">".$rows[good_description]."</textarea>";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>上传该商品的扫描图：<br>（如果无改变请留空）</td>\n";
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
		$id=$_POST[id];
		$book_name=$_POST[book_name];
		$book_cost=$_POST[book_cost];
		$m_type=$_POST[m_type];
		$s_type=$_POST[s_type];
		$book_num=$_POST[book_num];
		$book_description=$_POST[book_description];
		if($photo)
		{
			$filepath="uploads/";
			$file_temp=explode(".",$photo_name);
			$filename=$filepath.date(YmdHis).".".$file_temp[1]; 
			copy($photo,$filename);
			unlink($photo);
			$sql="update $table_good set good_name='$book_name',good_cost='$book_cost',good_type='$s_type',good_num='$book_num',good_description='$book_description',good_photo='$filename'";
		}
		else
		{
			$sql="update $table_good set good_name='$book_name',good_cost='$book_cost',good_type='$s_type',good_num='$book_num',good_description='$book_description'";
		}
		if(mysql_query($sql,$link))
		{
			echo "修改已经有的图书操作成功，现在返回查看全部图书页！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=HomePage.php\">";
		}
		else
		{
			echo "修改已经有的图书失败，现在返回重新输入！";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=alterGoods.php\">";
		}	
	}
}
?>
