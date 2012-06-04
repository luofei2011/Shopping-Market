<?
require "header.php";
echo "<link href=\"../css/login.css\" rel=\"stylesheet\">";
echo "<script type=\"text/javascript\" src=\"../js/Ajax_check.js\"></script>";
echo"<div id=logo></div>\n";
echo"<div class=changePassword>\n";
echo"<form id=CP_form method=POST action=\"changePassword.php\" name=\"admin_form\" onSubmit=\"SubmitCheck()\">\n";

echo"<div id=CP-pwd>\n";

echo"<span class=CP-pwd></span>\n";

echo"<label for=Pwd1 id=CP_label>新密码</label>\n";

echo"<input type=password name=OldPwd id=OldPwd placeholder=旧密码>\n";

echo"</div>\n";

echo"<div id=CP-pwd>\n";

echo"<span class=CP-pwd></span>\n";

echo"<label for=Pwd1 id=CP_label>新密码</label>\n";

echo"<input type=password name=Pwd1 id=Pwd1 placeholder=新密码(大于8位) onBlur=\"chkpassword()\">\n";

echo"</div>\n";
echo "<div id=Pwd1_check></div>\n";
echo"<div id=pwd-again>\n";

echo"<span class=CP-pwd-again></span>\n";

echo"<label for=Pwd2 id=CP_label>再次输入新密码</label>\n";

echo"<input type=password name=Pwd2 id=Pwd2 placeholder=再次输入新密码 onBlur=\"chkconfirmPassword()\">\n";

echo"</div>\n";

echo "<div id=Pwd2_check></div>\n";
echo"<div class=CP_submit>\n";

echo"<input type=submit id=CP_submit value=\"修改\" onclick=\"SubmitCheck()\">\n";

echo"<input type=reset id=CP_reset value=\"取消\">\n";

echo"</div>\n";

echo"</form>\n";

echo"</div>\n";

echo"</body>";

echo"</html>";
?>
