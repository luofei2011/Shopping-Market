function createXMLHttp() {
	var request;
	var browser = navigator.appName;
	if(browser == "Microsoft Explorer"){
		var arrVersions = ["Microsoft.XMLHttp","MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0","MSXML2.XMLHttp.5.0"];
		for(var i=0; i<arrVersions.length; i++){
			try{
				request = new ActiveXObject(arrVersions[i]);
				return request;
			}
			catch(e){
				
			}
		}
	}
	else{
		request = new XMLHttpRequest();
		if(request.overrideMimeType){
			request.overrideMimeType('text/xml');
		}
		return request;
	}
}

var http = createXMLHttp();

function chkUsername() {
	
}

//检验输入密码
function chkpassword() {
	var m = document.admin_form;
	if(m.Pwd1.value.length<8){
		document.getElementById("Pwd1_check").style.display = "block";
		document.getElementById("Pwd1").style.background= "#7744FF";
		document.getElementById("Pwd1_check").innerText = "对不起，密码必须大于8位!";
	}
	else {
		document.getElementById("Pwd1").style.background = "#FFFFFF";
		document.getElementById("Pwd1_check").style.display = "none";
	}
}

//验证两次输入密码是否一致
function chkconfirmPassword() {
	var m = document.admin_form;
	if(m.Pwd1.value != m.Pwd2.value){
		document.getElementById("Pwd2_check").style.display = "block";
		document.getElementById("Pwd2").style.background = "#7744FF";
		document.getElementById("Pwd2_check").innerText = "对不起，两次输入密码不一致!";
	}
	else {
		document.getElementById("Pwd2").style.background = "#FFFFFF";
		document.getElementById("Pwd2_check").style.display = "none";
	}
}

//验证Email是否有效
function chkEmail() {
	var m = document.admin_form;
	var email = m.Email.value;
	var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
	var flag = regex.test(email);
	if(!flag){
		document.getElementById("Email_check").style.display = "block";
		document.getElementById("Email").style.background = "#7744FF";
		document.getElementById("Email_check").innerText = "对不起，电子邮箱无效!";
	}
	else {
		document.getElementById("Email").style.background = "#FFFFFF";
		document.getElementById("Email_check").style.display = "none";
	}
}

//验证码验证
var code;
function createCode() {
	code = "";
	var codeLength = 4;
	var checkCode = document.getElementById("check_code");
	var selectChar = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	for(var i=0; i<codeLength; i++){
		var charIndex = Math.floor(Math.random()*60);
		code += selectChar[charIndex];
	}
	code.toLowerCase();
	if(checkCode){
		checkCode.className="code";
		checkCode.value = code;
	}
}

function create() {
	createCode();
	$("#in_check_code").blur(function(e){
		var inputCode = document.getElementById("in_check_code").value.toLowerCase();
		if(inputCode.length <= 0){
			alert("请输入验证码!");
			$("#in_check_code").focus();
		}
		if(inputCode != code.toLowerCase()){
			alert("验证码不正确!");
			$("#in_check_code").focus();
			createCode();
		}
	});
}

//提交检查函数
function SubmitCheck() {
	var m = document.admin_form;
	if(m.Username.value.length == 0){
		alert("对不起，用户名必须为英文字母、数字或下划线、长度为5~20");
		m.Username.focus();
		return false;
	}
	if(m.Pwd1.value.length == 0){
		alert("密码不能为空！");
		m.Pwd1.focus();
		return false;
	}
	if(m.Pwd1.value != m.Pwd2.value){
		alert("两次密码不一致");
		m.Pwd2.focus();
		return false;
	}
	if(m.Email.length == 0){
		alert("邮箱不能为空!");
		m.Email.focus();
		return false;
	}
	m.submit();
}
