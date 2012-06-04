<?
$Username=$_COOKIE[user];
if($Username==null){
	$Username="请登录";
}
$num="0";
echo "<!DOCTYPE HTML>";
echo "<html lang=\"en\">";
echo "<head>";
echo "<meta charset=\"UTF-8\">";
echo "<link href=\"css/style.css\" rel=\"stylesheet\">";
echo "<link rel=\"stylesheet\" href=\"css/login.css\" style=\"text/css\">";
echo "<script type=\"text/javascript\" src=\"js/jquery-1.7.1.js\"></script>";
echo "<script type=\"text/javascript\" src=\"js/xiaoguo.js\"></script>";
echo "</head>";
echo "<body>";
echo "<div id=\"header\">\n";
echo "<ul>\n";
echo "<li class=\"login_no\">\n";
echo "<a href=\"../login.html\">登录</a>\n";
echo "<a href=\"../register.html\">注册</a>\n";
echo "<a href=\"ShoppingCart.php\">购物车\n";
echo "<span class=\"num\">(0)</span>\n";
echo "</a>\n";
echo "</li>\n";
echo "<li class=\"login_user\">\n";
if($Username=="请登录"){
	echo "<span id=\"Username\">Hi!<a href=\"../login.html\">".$Username."</a></span>\n";
	echo "<a href=\"../register.html\">注册</a>\n";
}
else{
	echo "<span id=\"Username\">Hi!<a href=\"personal_message.html\">".$Username."</a></span>\n";
	echo "<a href=\"login_out.php\">退出</a>\n";
	echo "<a href=\"HomePage.php\">首页</a>\n";
	echo "<a href=\"order.php\">我的订单</a>\n";
}
echo "<a href=\"ShoppingCart.php\">购物车(".$num.")</a>\n";	
echo "<a href=\"Manage.html\">管理入口</a>\n";
echo "</div>\n";
?>
