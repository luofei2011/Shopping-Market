<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>按种类查看图书</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "<center>\n";
require "header.php";
if(!$_GET[id])
{
	echo "<font size=5>查看所有种类</font>";
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	require "configure.php";
	$sql="select * from $table_type where g_id=0";
	$result=mysql_query($sql,$link);
	while($rows=mysql_fetch_array($result))
	{
		echo "<tr>\n";
		echo "<td colspan=\"2\">";
		echo $rows[type_name];
		echo "（".$rows[type_num]."）";
		echo "</td>\n";
		echo "</tr>\n";
		$i=0;
		$j=0;
		$sql2="select * from $table_type where g_id='$rows[id]' and id>'$rows[id]'";
		$result2=mysql_query($sql2,$link) or die(mysql_error());
		$m_count=mysql_num_rows($result2);
		while($rows2=mysql_fetch_array($result2))
		{
			if($j%2==0) echo "<tr>\n";
			echo "<td width=\"50%\">";
			echo "<a href=scanByType.php?id=".$rows2[id].">".$rows2[type_name]."</a>";
			echo "（".$rows2[type_num]."）";
			echo "</td>\n";
			$i++;
			if(($m_count%2==1) and $i==($m_count))
			{
				echo "<td>&nbsp;</td>";
			}
			if($i%2==1) $j++;
			if($j%2==0) echo "</tr>\n";
		}
	}
	echo "</table>\n";
}
else
{
	require "configure.php";
	$sql="select type_name from $table_type where id='$_GET[id]'";
	$result=mysql_query($sql,$link);
	$type_name=mysql_fetch_array($result);
	echo "<font size=5>查看种类：".$type_name[0]."</font>";
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	$sql="select * from $table_good where good_type='$_GET[id]' order by id desc";	//从列表中读出所有图书记录
	$result=mysql_query($sql,$link) or die(mysql_error());				//发送查找列表请求
	$num=mysql_num_rows($result);				//获取结果条数
	$p_count=ceil($num/10);						//总页数
	if ($_GET["page"]==0 && !$_GET["page"]) $page=1;//当前页
	else $page=$_GET["page"];
	if($num<1)								//如果没有记录
	{
		echo "<tr>\n";
		echo "<td>";
		echo "<center><h2>暂时还没有图书的记录</h2></center>";		//输出相应信息
		echo "</td>\n";
		echo "</tr>\n";
		exit();								//退出所有PHP代码
	}
	else										//如果有记录则执行相应操作
	{
		echo "<tr>\n";
		echo "<td>商品名</td>\n";
		echo "<td>价格</td>\n";
		echo "<td>类别</td>\n";
		echo "<td>简介</td>\n";
		while($rows=mysql_fetch_array($result))		//循环显示记录内容
		{
			echo "<tr>\n";
			echo "<td><a href=\"GoodsDetails.php?id=".$rows[id]."\">".$rows[good_name]."</a></td>\n";	//显示书名
			echo "<td>".$rows[good_cost]."</td>\n";	//显示价格
			$sql2="select type_name from $table_type where id='$rows[good_type]'";
			$result2=mysql_query($sql2);
			$rows2=mysql_fetch_array($result2);
			echo "<td>".$rows2[0]."</td>";			//显示类别
			if(strlen($rows[good_description])>100)
			$rows[good_description]=substr($rows[description],0,100);
			echo "<td>".$rows[book_description]."</td>\n";
			echo "</tr>\n";
		}
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
?>
