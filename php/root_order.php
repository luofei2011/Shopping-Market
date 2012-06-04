<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>查看所有未处理订单</title>\n";
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
	if(!$_POST[c])
	{
		echo "<script language=javascript>
		function checkall(form)
		{
			for (var i=0;i<form.elements.length;i++)
			{
				var e = form.elements[i];
				if (e.name != 'chkall')       e.checked = form.chkall.checked; 
			}
		}
</script>";
		echo "<h2>查看用户所有未处理的订单</h2>";
		echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
		echo "<form method=\"post\" action=\"".$_SERVER[PHP_SELF]."\">\n";
		echo "<tr>\n";
		echo "<td>处理</td>\n";
		echo "<td>提交人</td>\n";
		echo "<td>商品号</td>\n";
		echo "<td>书数量</td>\n";
		echo "<td>订单总额</td>\n";
		echo "</tr>\n";
		$sql="select * from $table_order where order_state='false'";
		$result=mysql_query($sql,$link);
		while($rows=mysql_fetch_array($result))
		{
			echo "<tr>\n";
			echo "<td><input type=checkbox name=c[] value=".$rows[id]."></td>\n";
			echo "<td>".$rows[order_user_name]."</td>\n";
			echo "<td><a href=GoodsDetails.php?id=".$rows[order_good_id]." target=\"_blank\">".$rows[order_good_id]."</a></td>\n";
			echo "<td>".$rows[order_good_num]."</td>\n";
			echo "<td>".$rows[order_cost]."</td>\n";
			echo "</tr>\n";
		}
		echo "<tr>\n";
		echo "<td colspan=\"5\" align=\"center\">\n";
		echo "<input type=\"checkbox\" name=\"chkall\" value=\"on\" onclick=\"checkall(this.form)\">选择所有记录";
		echo "<input type=\"submit\" value=\"提交所选记录\">";
		echo "</td>\n";
		echo "</tr>";
		echo "</form>";
		echo "</table>\n";
	}
	else
	{
		$c=$_POST[c];
		$time=date("Y年m月d日");
		for($i=0;$i<count($c);$i++)
		{
			$temp=$c[$i];
			$sql="update $table_order set order_state='true' where id='$temp'";
			mysql_query($sql,$link);
			$sql2="insert into $table_sale (sale_order_id,sale_date)values('$temp','$time')";
			mysql_query($sql2,$link);
			$sql3="select order_good_id ,order_good_num from $table_order where id='$temp'";
			$result=mysql_query($sql3,$link);
			$rows=mysql_fetch_array($result);
			$sql4="update $table_good set good_sale_num=good_sale_num+'$rows[1]' , where id='$rows[0]'";
			mysql_query($sql4,$link);
		}
		echo "处理订单成功,正在转到销售查看页";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=recoder.php\">";

	}
}
?>
