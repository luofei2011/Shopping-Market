<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>查看所有销售记录</title>\n";
echo "</head>\n";
echo "<body>\n";
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
	echo "<h2>查看所有的销售记录</h2>";
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	$sql="select id from $table_sale";
	$result=mysql_query($sql,$link);
	$num=mysql_num_rows($result);
	$p_count=ceil($num/10);
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
	else									//如果有记录则执行相应操作
	{
		$s=($page-1)*10;
		$sql="select * from $table_sale order by id limit $s,10";
		$result=mysql_query($sql,$link);
		echo "<tr>\n";
		echo "<td>销售ID</td>\n";
		echo "<td>提交人</td>\n";
		echo "<td>购买ID</td>\n";
		echo "<td>购买价格</td>\n";
		echo "<td>处理日期</td>\n";
		echo "</tr>\n";
		while($rows=mysql_fetch_array($result))
		{
			echo "<tr>\n";
			echo "<td>".$rows[id]."</td>\n";
			$sql2="select * from $table_order where id='$rows[id]'";
			$result2=mysql_query($sql2,$link);
			$rows2=mysql_fetch_array($result2);
			echo "<td>".$rows2[order_user_name]."</td>\n";
			echo "<td>".$rows2[order_good_id]."</td>\n";
			echo "<td>".$rows2[order_cost]."</td>\n";
			echo "<td>".$rows[sale_date]."</td>\n";
			echo "</tr>\n";
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
}
?>
