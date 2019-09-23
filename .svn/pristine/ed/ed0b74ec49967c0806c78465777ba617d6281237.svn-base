var pop_id=1000;
$.extend({
	
	clientHeight: function(){
		var winHeight;
		if (window.innerHeight) winHeight = window.innerHeight; 
		else if ((document.body) && (document.body.clientHeight)) 
			winHeight = document.body.clientHeight; 
		if (document.documentElement 
			&& document.documentElement.clientHeight){winHeight = document.documentElement.clientHeight;}
		return winHeight;
	},
	
	clientWidth: function(){
		var winWidth;
		if (window.innerWidth) winWidth = window.innerWidth; 
		else if ((document.body) && (document.body.clientWidth)) 
			winWidth = document.body.clientWidth; 
		if (document.documentElement 
			&& document.documentElement.clientWidth){winWidth = document.documentElement.clientWidth;}

		return winWidth;
	},
	formatMoney : function(num,n) {
	    num = String(num.toFixed(n?n:2));
	    var re = /(-?\d+)(\d{3})/;
	    while(re.test(num)) num = num.replace(re,"$1,$2")
	    return n?num:num.replace(/^([0-9,]+\.[1-9])0$/,"$1").replace(/^([0-9,]+)\.00$/,"$1");;
	},
	round:function(n,mantissa){if(!mantissa)mantissa=0;if(mantissa<=0)return Math.round(n);var v=1;for(var i=0;i<mantissa;i++)v*=10;return Math.round(n*v)/v;},
	
	// {title： 标题(可为空), width: 宽度, content: html内容, buts[{lable:按钮名称, fun:方法}](按钮数组，默认激活第一个按钮)}
	openPop: function(p){
		var id = window.pop_id;
		window.pop_id = window.pop_id+1;
		
		p.width = p.width || 560;
		var left = ($.clientWidth()-p.width)/2;
		
		var shtml = []
		shtml.push("<div class='pop-bg' id='pop-bg-"+id+"' style='z-index: "+id+"; overflow:hidden;'></div>");
		shtml.push("<div class='box-pop' id='pop-"+id+"' style='position: fixed; left: "+left+"px; z-index: "+window.pop_id+";width:"+p.width+"px; margin:30px auto 0'>");
		if(p.title && typeof(p.title) != "undefined"){
			shtml.push("<div class='pop-head shadow5px'>");
			shtml.push("	<span class='pop-tit'>"+p.title+"</span><a onclick='$.closePop("+id+");return false;' class='ico ico-exit'></a>");
			shtml.push("</div>");
		}else{
			shtml.push("<div>");
			shtml.push("<a onclick='$.closePop("+id+");return false;' class='ico ico-exit' style='z-index: "+(id+2)+";'></a>");
			shtml.push("</div>");
		}
		shtml.push("<div class='pop-body'>")
		shtml.push(p.content);
		shtml.push("</div>");
		
		if($.isArray(p.buts)){
			shtml.push("<div class='pop-footer' ");
			if(p.buts.length == 1){
				shtml.push("style='text-align:center;' ");
			}
			shtml.push(">")
			
			var color = "btnred";
			for(var i=0; i<p.buts.length; i++){
				if(i==0){
					color = "btnred";
				}else{
					color = "btnorgd";
				}
				shtml.push("<input id='openWinOkBtn' style='width:80px;' class='btn "+color+" btnsize13' type='button' value='"+p.buts[i].lable+"' onclick='"+p.buts[i].fun+"("+id+")' >");
			}
			shtml.push("</div>");
		}
		shtml.push("</div>");
		$("body").append(shtml.join(""));
		$("#pop-"+id).css("top",(($.clientHeight()-parseInt($("#pop-"+id).height())-50)/2+"px"));
		return id;
	},
	
	closePop: function(id){
		$("#pop-"+id).remove();
		$("#pop-bg-"+id).remove();
	},
	
	formatMoney3 : function(money){
		if(typeof(money) == "undefined"){
			return 0;
		}
		money = money+"";
		var m = parseInt(money);
		var negative = false;
		
		if(m < 0){
			negative = true;
			m = 0-m;
		}
		if(m < 1000){
			if(negative){
				return -m;
			}else{
				return m;
			}
		}
			
		var arr = [];
		var index = 0;
		money = m+"";
		for(var i=money.length-1; i>=0; i--){
			index ++;
			arr.push(money.charAt(i));
			if(index % 3 == 0 && index != money.length){
				arr.push(",");
			}
		}
		
		if(negative){
			return "-"+arr.reverse().join("");
		}else{
			return arr.reverse().join("");
		}
		
	},
	
	formatMoney3Point1 : function(money){
		if(typeof(money) == "undefined"){
			return 0;
		}
		
		var negative = false;
		
		
		money = money+"";
		var point = money.indexOf(".");
		if(point == -1){
			return $.formatMoney3(money);
		}else{
			var pStr = money.substring(point+1, point+2);
			if(pStr == '0'){
				return $.formatMoney3(money);
			}else{
				return $.formatMoney3(money)+"."+pStr;
			}
		}
	},
	
	formatMoney3Point2 : function(money){
		if(typeof(money) == "undefined"){
			return 0;
		}
		money = money+"";
		var point = money.indexOf(".");
		if(point == -1){
			return $.formatMoney3(money);
		}else{
			var pStr = money.substring(point+1, point+3);
			if(pStr == '00'){
				return $.formatMoney3(money);
			}else{
				return $.formatMoney3(money)+"."+pStr;
			}
		}
	},
	
	multiplieMoeny : function(money, pointer){
		var m = parseInt(money);
		var f = parseFloat(pointer);
		var temp = m * f;
		return parseInt(temp);
	},
	
	divideMoeny : function(money, pointer) {
		var m = parseInt(money);
		var f = parseFloat(pointer);
		var temp = m / f;
		return parseInt(temp);
	},
	
	divideMoenyAtFloat : function(money, pointer) {
		var m = parseInt(money);
		var f = parseFloat(pointer);
		return m / f;
	},
	
	positive : function(money){
		var m = parseFloat(money);
		if(m < 0){
			return -m;
		}
		return money;
	},
	
	beInteger : function(money){
		var fmoney = parseFloat(money);
		var imoney = parseInt(money);
		if(fmoney > imoney){
			return imoney+1;
		}else{
			return imoney;
		}
	},
	
	sub : function (arg1,arg2){
	     var r1,r2,m,n;
	     try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
	     try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
	     m=Math.pow(10,Math.max(r1,r2));
	     n=(r1>=r2)?r1:r2;
	     return ((arg1*m-arg2*m)/m).toFixed(n);
	},
	
	vague : function(arg) {
		if (typeof (arg) == "undefined") {
			return ""
		}
		var _arg = arg.toString().trim();
		if (_arg.length < 8) {
			return arg
		}
		return _arg.substring(0, 4)
				+ _arg.substring(4, _arg.length - 3).replace(
						new RegExp(/\w/g), "*")
				+ _arg.substring(_arg.length - 3, _arg.length)
	}
});


function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
	var menu=document.getElementById(name+i);
	var con=document.getElementById("con_"+name+"_"+i);
	menu.className=i==cursel?"hover":"";
	con.className=i==cursel?"block":"hide";
	}
}
//金额格式化  ep,调用：fmoney("12345.675910", 3)，返回12,345.676
function fmoney(s, n) {
	var tag=true;
	if(parseFloat(s)<0){
		tag=false;
		s=-s;
	}
	n = n > 0 && n <= 20 ? n : 2; 
	s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + ""; 
	var l = s.split(".")[0].split("").reverse(), r = s.split(".")[1]; 
	t = ""; 
	
	for (var i = 0; i < l.length; i++) { 
		t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : ""); 
	}
	if(tag){
		return t.split("").reverse().join("") + "." + r;
	}else{
		return "-"+t.split("").reverse().join("") + "." + r;
	}
} 
//还原函数：
function rmoney(s) { 
	return parseFloat(s.replace(/[^\d\.-]/g, "")); 
} 
