<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>查看登录用户历史订单</title>\n";
echo "</head>\n";
echo "<body>\n";
require "header.php";
if(!$_COOKIE[user])
{
	echo "你没有登录,没有权限执行这项操作！<p>";
	echo "点<a href=\"../login.html\">这里</a>进行登录";
	exit();
}
else
{
	require "configure.php";
	echo "<h2>查看用户".$_COOKIE[user]."的订单记录</h2>";
	$sql="select id from $table_order where order_user_id='$_COOKIE[id]'";				//从列表中读出所有图书记录
	$result=mysql_query($sql,$link) or die(mysql_error());				//发送查找列表请求
	$num=mysql_num_rows($result);				//获取结果条数
	$p_count=ceil($num/10);						//总页数
	if ($_GET["page"]==0 && !$_GET["page"]) $page=1;//当前页
	else $page=$_GET["page"];
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	if($num<1)								//如果没有记录
	{
		echo "<tr>\n";
		echo "<td>";
		echo "<center><h2>暂时还没有该用户的订单记录</h2></center>";		//输出相应信息
		echo "</td>\n";
		echo "</tr>\n";
		exit();								//退出所有PHP代码
	}
	else										//如果有记录则执行相应操作
	{
		echo "<tr>\n";
		echo "<td>购买商品ID</td>\n";
		echo "<td>购买数量</td>\n";
		echo "<td>购买总额</td>\n";
		echo "<td>订单状态</td>\n";
		echo "<td>提交日期</td>\n";
		echo "</tr>\n";
		$s=($page-1)*10;
		$sql="select * from $table_order where order_user_id='$_COOKIE[id]' order by id limit $s,10";
		$result=mysql_query($sql,$link);
		while($rows=mysql_fetch_array($result))
		{
			echo "<tr>\n";
			echo "<td>".$rows[order_good_id]."</td>\n";
			echo "<td>".$rows[order_good_num]."</td>\n";
			echo "<td>".$rows[order_cost]."</td>\n";
			echo "<td>".$rows[order_state]."</td>\n";
			echo "<td>".$rows[order_date]."</td>\n";
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
