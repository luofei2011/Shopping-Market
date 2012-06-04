<?
$values=$_COOKIE[user];
$email1=$_POST["Email_1"];
$email2=$_POST["Phone"];
require "configure.php";
$sql="update $table_user set  email1='$email1' email2='$email2'";
if(mysql_query($sql,$link)){
	echo "修改个人信息成功!,现在返回首页!";
	echo "<meta http-equiv=\"refresh\" Content=\"2;url=HomePage.php\">";
}

echo "<p>\n";
echo "当前用户:".$values."!\n";
?>
