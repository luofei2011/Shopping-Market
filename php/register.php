<?
/*
注册信息处理界面
author:luofei
email:luofeihit2010@gmail.com
date:2012-05-31 22:01
 */
$Username=$_POST["Username"];
$password=md5($_POST["Pwd1"]);
$email=$_POST["Email"];
$time=date("Y年m月d日");
require "configure.php";
$sql="select id from $table_user where name='$Username'";
$result=mysql_query($sql,$link);
$nums=mysql_num_rows($result);
if($nums!=0){
	echo "<center>\n";
	echo "<h2>注册的用户名".$Username."已经存在!</h2>";
	echo "<h3>请点<a href=# onclick=history.go(-1)>这里</a>返回,重新输入新的用户名!</h3>";
	echo "</center>";
	exit();
}
else{
	$sql="insert into $table_user(name,password,reg_date,email) values('$Username','$password','$time','$email')";
	mysql_query($sql,$link) or die(mysql_error());
	echo "<center>";
	echo "<h2>新用户".$Username."注册成功!</h2>";
	echo "<h3>点<a href=../login.html>这里</a>进行登录!</h3>";
	echo "</center>";
}
?>
