<?
if(!$_COOKIE[user]){
	echo "您还没有登录!<p>";
	echo "点<a href=\"../login.html\">这里</a>进行登录";
	exit();
}
else {
	$OldPwd=md5($_POST["OldPwd"]);
	$Pwd1=md5($_POST["Pwd1"]);
	$Pwd2=md5($_POST["Pwd2"]);
	require "configure.php";
	$id=$_COOKIE[id];
	$sql="select id from $table_user where name='$_COOKIE[user]' and password='$OldPwd'";
	mysql_query($sql,$link) or die(mysql_error());
	$result=mysql_query($sql,$link);
	$num=mysql_num_rows($result);
	if($num<1){
		echo "输入的用户密码有误!";
		echo "<p>";
		echo "请重新输入!";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=change_password.php\">";
	}	
	else {
		$sql="update $table_user set password='$Pwd1' where id='$id'";
		if(mysql_query($sql,$link)){
			echo "修改用户密码成功!<p>";
			echo "请重新登录!";
			echo "<meta http-equiv=\"refresh\" content=\"2;url=../login.html\">";
		}
		else {
			echo "修改用户密码失败,现在返回修改密码页!";
			echo "<meta http-equiv=\"refresh\" content=\"2;url=change_password.php\">";
		}
	}
}
?>
