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

