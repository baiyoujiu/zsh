// JavaScript Document
$('#dl_close').click(function(){
	$('#zong_denglu').hide();
})

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数
function sendMessage() {
	curCount = count;
	//设置button效果，开始计时
	$("#dxyz_SJ").attr("disabled", "true");
	$("#dxyz_SJ").val( + curCount + "秒再获取");
	InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
	//timer处理函数
	function SetRemainTime() {
		if (curCount == 0) {
			window.clearInterval(InterValObj);//停止计时器
			$("#dxyz_SJ").removeAttr("disabled");//启用按钮
			$("#dxyz_SJ").val("发送验证码");
			code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
		}
		else {
			curCount--;
			$("#dxyz_SJ").attr("disabled", "true");
			$("#dxyz_SJ").val( + curCount + "秒再获取");
		}
	}
};
$(function(){
	//验证码和用户名切换
	var oxuanxiangka = document.getElementById('xuanxiangka');
	if(oxuanxiangka){
	var aBtn = oxuanxiangka.getElementsByTagName('span');
	var aDiv = oxuanxiangka.getElementsByTagName('section');
	for(var i = 0;i<aBtn.length;i++){
		aBtn[i].index = i;
		aBtn[i].onclick = function(){
			for(var i = 0;i<aBtn.length;i++){
				aBtn[i].className = '';
				aDiv[i].style.display = 'none';
			}
			this.className = 'bor_bot02';
			aDiv[this.index].style.display = 'block';
		};
	}}
});
$('.dl_fs').click(function(){
	var type_dl = $(this).attr('alt');
	if(type_dl == 'yzm_dl'){
		$('.denglu_btnss').removeClass('submit');
		$('.denglu_btnss').addClass('submit_yzm');
	}else if(type_dl == 'mm_dl'){
		$('.denglu_btnss').removeClass('submit_yzm');
		$('.denglu_btnss').addClass('submit');
	}
});
$("#dxyz_SJ").click(function () {
      var phone =  $("#phone").val();
      var xhr = $.ajax({
        url:"/login/verification.html",
        data: { mobile: phone,i:Math.random()},
        dataType: "json",
        type: "POST",
      });
      xhr.done(function (data) {
        if (data.status != 200) {
          alert_model('提示','false',data.msg);
          window.clearInterval(InterValObj);//停止计时器
          $("#dxyz_SJ").removeAttr("disabled");//启用按钮
          $("#dxyz_SJ").val("发送验证码");
        }
      });
});
	  
//登陆
$('.dl_fs').on('click','.submit_yzm',function(){
	var yzm = $('#yzm').val();
	var phone =  $("#phone").val();
	$.ajax({
        url: "/login/yzmlogin.html",
        data: {yzm: yzm,phone: phone,i:Math.random()},
        type: "post",
        dataType: "json",
        success: function(data) {
			if(data.status == 200){
				window.location.reload();
			}else{
				$.openPop({"content":data.msg, "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			}
        }
	})

});
	
$('.dl_fs').on('click','.submit',function(){
	var username = $('#username').val();
	var password =  $("#password").val();
	$.ajax({
		url: "/login/login.html",
		data: {userName: username,password: password,i:Math.random()},
		type: "post",
		dataType: "json",
		success: function(data) {
			if(data.status == 200){
				window.location.reload();
			}else{
				$.openPop({"content":data.msg, "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			}
		}
	})
});
/*
页面JS
*/
$(function(){
	$("#capital").keypress().keyup(function(){
		var v = $.trim($(this).val()).replace(/,/g,'');
		moneyChange(v);
		$("#capital").focus();
	}).blur(function(){
		var v = $(this).val();
		if(v=="" || v==0){
			$("#capital_input").hide();
			$("#buy_next").hide();
			$("#capital_empty").show();
		}
	}).focus(function(){
		$("#capital_input").show();
		$("#buy_next").show();
		$("#capital_empty").hide();
	});
	$("#capital_input a").click(function(){
		if($(this).hasClass('moncuy_no')){
			var capital = getCapital();
			var pzTimes = $(this).attr('pzTimes');
			var money = capital*pzTimes;
			show(money, capital, pzTimes);
			infoTitleChange(money+capital);
			$("#capital_input a[class='moncuy']").removeClass('moncuy').addClass('moncuy_no');
			$(this).removeClass('moncuy_no').addClass('moncuy');
		}
	});
});

//资产管理须知修改
function infoTitleChange(money){
	//console.info(money)
	if(money){
		if(money<500000){
			$("#infoTarget").html("资产管理净值在50万以下创业板股票仓位净值不得超过总仓位净值的50%");
		}else if(money>=500000 && money <1000000){
			$("#infoTarget").html("资产管理净值在50万(含)以上或100万以下主板与中小板单只股票净值不得超过总净值的70%，创业板股票仓位净值不得超过总仓位净值的40%");
		}else if(money>=1000000){
			$("#infoTarget").html("资产管理净值100万（含）以上主板与中小板单只股票净值不得超过总净值的60%，创业板股票仓位净值不得超过总仓位净值的33%");
		}
	}
}

function moneyChange(capital){
	var capital = /^\d+$/.test(capital)?capital:$.trim($("#capital").val()).replace(/,/g,"");
	capital = parseInt(capital);
	if(capital > 0){
		if(capital>1000000){
			capital = 1000000;
		}
		capital = parseInt(capital,10);
		$("#mTab1").html($.formatMoney(capital*parseInt(pzTimesArr[0])));
		$("#mTab2").html($.formatMoney(capital*parseInt(pzTimesArr[1])));
		$("#mTab3").html($.formatMoney(capital*parseInt(pzTimesArr[2])));
		$("#mTab4").html($.formatMoney(capital*parseInt(pzTimesArr[3])));
		$("#mTab5").html($.formatMoney(capital*parseInt(pzTimesArr[4])));
		$("#mTab6").html($.formatMoney(capital*parseInt(pzTimesArr[5])));
		$("#mTab7").html($.formatMoney(capital*parseInt(pzTimesArr[6])));
		$("#mTab8").html($.formatMoney(capital*parseInt(pzTimesArr[7])));
		
		$("#capital").val($.formatMoney(capital,0));
		
		var pzTimes = $.trim($("#capital_input a[class='moncuy']").attr('pzTimes'));
		
		var money = capital*pzTimes;
		infoTitleChange(money+capital);
		show(money, capital, pzTimes);
	}else{
		$("#mTab1").html("0");
		$("#mTab2").html("0");
		$("#mTab3").html("0");
		$("#mTab4").html("0");
		$("#mTab5").html("0");
		$("#mTab6").html("0");
		$("#mTab7").html("0");
		$("#mTab8").html("0");
		
		$("#totalMoney").text("0");
		$("#warnLine").text("0");
		$("#loseLine").text("0");
		$("#interest").text("1.5");
	}
}

function getCapital(){
	var capital = $.trim($("#capital").val()).replace(/,/g,'');
	var capital = /^\d+$/.test(capital)?capital:$.trim($("#capital").val()).replace(/,/g,"");
	capital = parseInt(capital);
	if(capital > 0){
		if(capital>1000000){
			capital = 1000000;
		}
	}else{
		capital = 0;
	}
	return capital;
}

$('#buyNow').click(function(){
	if($("#agreement")[0].checked){
		var capital = getCapital();
		var payPass = $('#payPass').val();
		
		if(!uid){
			$('#zong_denglu').show();
			return false;
		}
		
		if(capital<1){
			$.openPop({"content":"请输入风险保证金", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(capital < 1000 || capital > 1000000){
			$.openPop({"content":"风险保证金最少1千元，最多100万元", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(capital % 1000 != 0){
			$.openPop({"content":"风险保证金必须是1000元的整数倍", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		
		var pzTimes = $.trim($("#capital_input a[class='moncuy']").attr('pzTimes'));
		if(pzTimes == '' || pzTimes == null){
			$.openPop({"content":"请选择管理金额", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(payPass == '' || payPass == null){
			$.openPop({"content":"请输入支付密码", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		saveUrl({margin:capital,pzTimes:pzTimes,payPass:payPass,i:Math.random()});
	}else{
		$.openPop({"content": "请先阅读并同意签署《投顾协议》", "width":300, "buts":[{"lable": "确定", "fun": "$.closePop"}]});
	}
});

$('#buyDNow').click(function(){
	if($("#agreement")[0].checked){
		var capital = getCapital();
		var payPass = $('#payPass').val();
		
		if(!uid){
			$('#zong_denglu').show();
			return false;
		}
		
		if(capital<1){
			$.openPop({"content":"请输入风险保证金", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(capital < 1000 || capital > 1000000){
			$.openPop({"content":"风险保证金最少1千元，最多100万元", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(capital % 100 != 0){
			$.openPop({"content":"风险保证金必须是100元的整数倍", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		
		var pzTimes = $.trim($("#capital_input a[class='moncuy']").attr('pzTimes'));
		if(pzTimes == '' || pzTimes == null){
			$.openPop({"content":"请选择投资金额", "width":250, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(payPass == '' || payPass == null){
			$.openPop({"content":"请输入支付密码", "width":250, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		
		saveUrl({type:'1',margin:capital,pzTimes:pzTimes,payPass:payPass,i:Math.random()});
	}else{
		$.openPop({"content": "请先阅读并同意签署《投顾协议》", "width":300, "buts":[{"lable": "确定", "fun": "$.closePop"}]});
	}
});


$('#buyFNow').click(function(){
	if($("#agreement")[0].checked){
		var capital = getCapital();
		var payPass = $('#payPass').val();

		if(!uid){
			$('#zong_denglu').show();
			return false;
		}
		
		if(capital<1){
			$.openPop({"content":"请输入风险保证金", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(capital < 1000 || capital > 1000000){
			$.openPop({"content":"风险保证金最少1千元，最多100万元", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(capital % 100 != 0){
			$.openPop({"content":"风险保证金必须是100元的整数倍", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		if(payPass == '' || payPass == null){
			$.openPop({"content":"请输入支付密码", "width":300, "buts":[{"lable":"确定", "fun":"$.closePop"}]});
			return false;
		}
		
		saveUrl({type:'2',margin:capital,payPass:payPass,i:Math.random()});
	}else{
		$.openPop({"content": "请先阅读并同意签署《投顾协议》", "width":300, "buts":[{"lable": "确定", "fun": "$.closePop"}]});
	}
})

function saveUrl(data){
	$.ajax({
		url : '/api/pz.html', 
		type : "post",
		dataType : "json",
		cache: false,
		async: true,
		data: data,
		success:function(data){
			if(data.status == 200){
				$.openPop({"content": '投顾资金申请提交成功，马上去查看 >>  ', "width":300, "buts":[{"lable": "确定", "fun": "colseAndUserCenter"}]});
			}else if(data.status == 221){   
				$.openPop({"content": data.msg, "width":300, "buts":[{"lable": "确定", "fun": "colseAndUserLogin"}]});
			}else if(data.status == 222){   
				$.openPop({"content": data.msg, "width":300, "buts":[{"lable": "确定", "fun": "colseAndUserSetting"}]});
			}else if(data.status == 224){   
				$.openPop({"content": data.msg, "width":300, "buts":[{"lable": "确定", "fun": "colseAndUserSetting"}]});
			}else if(data.msg == 223){   
				$.openPop({"content": '账户余额不足！现在去充值 >> ', "width":300, "buts":[{"lable": "确定", "fun": "colseAndUserRecharge"}]});
			}else{
				$.openPop({"content": data.msg, "width":300, "buts":[{"lable": "确定", "fun": "colse"}]});
			}
		},
		error:function(obj){$.openPop({"content": "系统繁忙，请稍后重试！", "width":300, "buts":[{"lable": "确定", "fun": "$.closePop"}]});}
	});
}
function colse(formid){
	$.closePop(formid);
}
function colseAndUserCenter(formid){
	$.closePop(formid);
	window.location.href = "/pzu/tender.html";
}
function colseAndUserSetting(formid){
	$.closePop(formid);
	window.location.href = "/pzu/inf.html";
}
function colseAndUserRecharge(formid){
	$.closePop(formid);
	window.location.href = "/pzu/recharge.html";
}