// JavaScript Document
	var rem = 20/640*document.documentElement.clientWidth;
	document.documentElement.style.fontSize = rem+'px';
	
	window.onload=window.onresize=function(){
		var rem = 20/640*document.documentElement.clientWidth;
		document.documentElement.style.fontSize = rem+'px';
	}

