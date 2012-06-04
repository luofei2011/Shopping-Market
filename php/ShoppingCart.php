<?php
require "header.php";
echo "<html>\n";
echo "<head>\n";
echo "<title>查看购物车</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "<center>\n";
if(!$_POST[mycat])
{
	require "configure.php";
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	echo "<form method=\"post\" action=\"$PATH_INFO\">\n";
	echo "<input type=\"hidden\" name=\"mycat\" value=\"post\">";
	echo "<tr>\n";
	echo "<td colspan=\"4\"><center><h2>您的购物车信息</h2></center></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>选择</td>\n";
	echo "<td>名称</td>\n";
	echo "<td>单价</td>\n";
	echo "<td>数量</td>\n";
	echo "</tr>\n";
	$temp=array_keys($_COOKIE);
	echo $temp;
	$j=0;
	for($i=0;$i<count($temp);$i++)
	{
		if(ereg("cat",$temp[$i]))
		{
			$j++;
			$catid=ereg_replace("cat","",$temp[$i]);
			$sql="select * from $table_good where id='$catid'";
			$result=mysql_query($sql,$link);
			$rows=mysql_fetch_array($result);
			echo "<input type=\"hidden\" name=\"id[]\" value=\"".$rows[id]."\">\n";
			echo "<tr>\n";
			echo "<td><input type=\"checkbox\" name=\"c".$j."\"></td>\n";
			echo "<td>".$rows[good_name]."</td>\n";
			echo "<td><input type=\"text\" value=\"".$rows[good_cost]."\" name=\"m[]\" readonly size=\"5\"></td>\n";
			echo "<td><input type=\"text\" name= \"t[]\" value=\"1\" size=\"3\"></td>\n";
			echo "</tr>\n";
		}
	}
	echo "<tr>\n";
	echo "<td colspan=\"4\"><center>";
	echo "<input type=\"submit\" value=\"结帐\">";
	echo "<input type=\"button\" value=\"继续购物\" onclick=window.close()>";
	echo "</center></td>\n";
	echo "</tr>\n";
	echo "</form>";
	echo "</table>";
}
else
{
	$id=$_POST[id];
	$m=$_POST[m];
	$t=$_POST[t];
	$time=date("Y年m月d日");
	require "configure.php";
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	echo "<tr><td colspan=\"4\"><center>您选购了以下商品:</center></td></tr>";
	echo "<tr>";
	echo "<td>商品名</td>";
	echo "<td>单价</td>";
	echo "<td>数量</td>";
	echo "<td>小计</td>";
	echo "</tr>";
	$j=0;
	for($i=1;$i<=count($id);$i++)
	{
		$c="c".$i;
		if($c!="")
		{
			$temp=$id[$i-1];
			$temp2=$m[$i-1];
			$temp3=$t[$i-1];
			$sql="select * from $table_good where id='$temp'";
			$result=mysql_query($sql,$link);
			$rows=mysql_fetch_array($result);
			echo "<tr>";
			echo "<td>".$rows[good_name]."</td>";
			echo "<td>".$temp2."</td>";
			echo "<td>".$temp3."</td>";
			$z[$j]=$m[$i-1]*$t[$i-1];
			$temp4=$z[$j];
			echo "<td>".$z[$j]."</td>";
			echo "</tr>";
			$j++;
			$sql="insert into $table_order(order_user_id,order_good_id,order_good_num,order_user_name,order_cost,order_date) values('$_COOKIE[id]','$temp','$temp3','$_COOKIE[user]','$temp4','$time')";
			mysql_query($sql,$link) or die(mysql_error());
		}
	}
	for($i=0;$i<count($z);$i++)
	{
		$s=$s+$z[$i];
	}
	echo "<tr><td colspan=\"4\"><center>总计:".$s."</center></td></tr>";
	echo "<tr><td colspan=\"4\">已经生成订单,点<input type=\"button\" value=\"这里结束操作\" onclick=window.close()></td></tr>";
}
?>
