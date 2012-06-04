$(document).ready(function (){
	$("#item_1").mouseover(function () {
		$("#item_1").css("background-color","white");
		$("#item_1").css("border","1px solid #CC00CC");
		$("#good_1").css("display","block");
		});
	$("#good_1").mouseover(function() {
			$("#good_1").css("display","block");
		});
	$("#good_1").mouseout(function() {
			$("#good_1").css("display","none");
		});
	$("#item_1").mouseout(function () {
		$("#item_1").css("background-color","#9999FF");
		$("#item_1").css("border","none");
		$("#good_1").css("display","none");
	});
	$("#item_2").mouseover(function () {
		$("#item_2").css("background-color","white");
		$("#item_2").css("border","1px solid #CC00CC");
		$("#good_2").css("display","block");
	});
	$("#item_2").mouseout(function () {
		$("#item_2").css("background-color","#9999FF");
		$("#item_2").css("border","none");
		$("#good_2").css("display","none");
	});
	$("#item_3").mouseover(function () {
		$("#item_3").css("background-color","white");
		$("#item_3").css("border","1px solid #CC00CC");
		$("#good_3").css("display","block");
	});
	$("#item_3").mouseout(function () {
		$("#item_3").css("background-color","#9999FF");
		$("#item_3").css("border","none");
		$("#good_3").css("display","none");
	});
	$("#item_4").mouseover(function () {
		$("#item_4").css("background-color","white");
		$("#item_4").css("border","1px solid #CC00CC");
		$("#good_4").css("display","block");
	});
	$("#item_4").mouseout(function () {
		$("#item_4").css("background-color","#9999FF");
		$("#item_4").css("border","none");
		$("#good_4").css("display","none");
	});
	$("#nav > span").mouseover(function (){
		$(this).addClass("curr");
	});
	$("#nav > span").mouseout(function (){
		$(this).removeClass("curr");
	});

});
