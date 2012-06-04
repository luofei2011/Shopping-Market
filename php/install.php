<?
/*
安装文件，配置和建立数据库,只需运行一次
author:luofei
email:luofeihit2010@gmail.com
date:2012-05-31 10:53 
*/
header("Content-Type:text/html;charset=utf-8");
$name=$_POST["name"];
$password=md5($_POST["password"]);
$email=$_POST["email"];
$time=date(Y年m月d日);
require "configure.php";
$sql="create table $table_user(
	id int(5) not null auto_increment primary key,
	name varchar(12) not null,
	password varchar(40) not null,
	reg_date varchar(20) not null,
	email varchar(80) not null,
	email1 varchar(80) not null,
	email2 varchar(80) not null,
	admin int(1) not null
)";
mysql_query($sql,$link) or die(mysql_error());
$sql="create table $table_type(
	id int(5) not null auto_increment primary key,
	g_id int(5) not null,
	type_name varchar(12) not null,
	type_description varchar(80) not null,
	type_num int(5) not null default 0
)";
mysql_query($sql,$link) or die(mysql_error());
$sql="create table $table_good(
	id int(5) not null auto_increment primary key,
	good_name varchar(40) not null,
	good_type int(5) not null,
	good_cost varchar(6) not null,
	good_description varchar(200) not null,
	good_num int(5) not null,
	good_sale_num int(5) not null
)";
mysql_query($sql,$link) or die(mysql_error());
$sql="create table $table_order(
	id int(5) not null auto_increment primary key,
	order_user_id int(5) not null,
	order_user_name varchar(20) not null,
	order_good_id int(5) not null,
	order_good_num int(5) not null default 1,
	order_content varchar(80) not null,
	order_cost varchar(10) not null,
	order_state enum('ture','false') not null default 'false',
	order_date varchar(40) not null
)";
mysql_query($sql,$link) or die(mysql_error());
$sql="create table $table_sale(
	id int(5) not null auto_increment primary key,
	sale_order_id int(5) not null,
	sale_date varchar(40) not null
)";
mysql_query($sql,$link) or die(mysql_error());
//系统自动创建的主类别
$sql="insert into $table_type(g_id,type_name,type_description) values('1','主类别1','系统创建的默认主类别')";
mysql_query($sql,$link) or die(mysql_error());
$sql="insert into $table_type(g_id,type_name,type_description) values('1','分类别1','系统创建的默认分类别')";
mysql_query($sql,$link) or die(mysql_error());
$sql="insert into $table_user(
name,password,reg_date,email,email1,email2,admin) values('$name','$password','$time','$email','$email1','$email2','3')";//3表示为admin
mysql_query($sql,$link) or die(mysql_error());
echo "<html>";
echo "<head>";
echo "<title>安装程序</title>";
echo "</head>";
echo "<body>";
echo "<center>";
echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>\n";
echo "<td align=\"center\"><font size=\"5px\">安装程序</font></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td align=\"center\"><font size=\"3px\">成功安装！</font></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td align=\"center\"><font size=\"3px\">删除该文件，以减少潜在危险！</font></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td align=\"center\">点<a href=\"../login.html\">这里</a>进入</td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</center>";
echo "</body>\n";
echo "</html>\n";
?>
