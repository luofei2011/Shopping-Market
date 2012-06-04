<?php
echo "<html>\n";
echo "<head>\n";
echo "<title>查看商品详情</title>\n";
echo "</head>\n";
echo "<body>\n";
require "header.php";
if(!$_GET[id])
{
	echo "没有请求ID！<br>";
	echo "点<a href=\"HomePage.php\">这里</a>返回首页！";
}
else
{
	echo "<script language=\"javascript\" src=\"js/mycat.js\">\n";
	echo "</script>";
	require "configure.php";
	$sql="select * from $table_good where id='$_GET[id]'";
	$result=mysql_query($sql,$link);
	$rows=mysql_fetch_array($result);
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
	echo "<tr>\n";
	echo "<td colspan=\"2\"><center><h2>查看商品详情</h2></center></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=\"30%\">商品名称：</td>\n";
	echo "<td>".$rows[good_name]."</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>售价：</td>\n";
	echo "<td>".$rows[good_cost]."元</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>所属类别：</td>\n";
	echo "<td>".$rows[good_type]."</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>该书的数量：</td>\n";
	echo "<td>".$rows[good_num]."本</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>该书的简介：</td>\n";
	echo "<td>".$rows[good_description]."</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>该书的封面扫描图：</td>\n";
	echo "<td>";
	if(!$rows[good_photo])
	{
		$rows[good_photo]="images/jisuanji.jpg";
	}
	echo "<img src=\"".$rows[good_photo]."\">";
	echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td colspan=\"2\" align=\"center\">
		<input type=\"button\" value=\"把该商品加入购物车\" onclick=SetCookie(\"cat".$rows[id]."\",\"1\")>
		</td>\n";
//echo"	<td colspan=\"2\" align=\"center\">\n";
//	echo"	<form method=post action=\"$PATH_INFO\">\n";
//echo "		<input type=hidden value=\"OK\" name=OK>\n";
//	echo "	<input type=submit value=\"把该商品添加到购物车\">\n";	
//	echo "	</form>\n";
//echo "	</td>\n";
//if($_POST[OK]){
//	setcookie("")
//}
	echo "</tr>\n";
	echo "</table>\n";
	echo "</center>\n";
	echo "</body>";
	echo "</html>\n";
}
?>
