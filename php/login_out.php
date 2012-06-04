<?
$temp=array_keys($_COOKIE);//返回COOKIE中的所有数组
echo $temp;
for($i=0; $i<count($temp); $i++){
	setcookie("$temp[$i]","");
}
echo "<title>退出登录成功!</title>\n";
echo "<meta http-equiv=\"refresh\" content=\"2; url=HomePage.php\">";
require "header.php";
echo "退出登录成功，现在转到首页";
echo "</body>";
echo "</html>";
?>
