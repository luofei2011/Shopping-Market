<?
if(!$_COOKIE[user]){
	echo "您还没有登录!<p>";
	echo "点<a href=\"../login.html\">这里</a>进行登录";
	exit();
}
else {
	$email1=$_POST["Email_1"];
	$email2=$_POST["Phone"];
	$id=$_COOKIE[id];
	require "configure.php";
	$sql="update $table_user set email1='$email1', email2='$email2' where id='$id'";
	if(mysql_query($sql,$link)){
		echo "修改用户信息成功,现在返回首页!<p>";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=HomePage.php\">";
	}
	else {
		echo "修改用户信息失败,现在返回修改信息页!";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=personal_message.html\">";
	}

}
?>
