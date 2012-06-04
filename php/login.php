<?
/*
验证用户登录
author:luofei
email:luofeihit2010@gmail.com
date:2012-05-31 20:43
 */
$name=$_POST["Id"];
$password=md5($_POST["Pwd"]);
require "configure.php";
$sql="select id from $table_user where name='$name' and password='$password'";
$result=mysql_query($sql,$link) or die(mysql_errno());
$num=mysql_num_rows($result);
if($num==0){
	echo "<center>";
	echo "<h2>输入的用户名或者密码错误！</h2>";
	echo "<h3>请点<a href=\"../login.html\" onclick=history.go(-1)>这里</a>返回重新输入";
	echo "</center>";
	exit();
}
else {
	$rows=mysql_fetch_array($result);
	$id=$rows[id];
	setcookie("user","$name",time()+60*60*24*30,"localhost/youge");
	setcookie("id","$id",time()+60*60*24*30);
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>注册用户登录</title>\n";
	echo "</head>\n";
	echo "<body>\n";
	require "header.php";
	echo "<h2>用户.$user.登录成功!</h2>";
	echo "<h3>两秒后进入商城首页!</h3>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=HomePage.php\">";
	echo "</center>";
	echo "</body>";
	echo "</html>";
}
?>
