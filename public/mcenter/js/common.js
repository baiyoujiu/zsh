(function($,exports){

    function fiexdFooter(){
    	var winHeight =  $(window).height();  //浏览器可视高度
    	var footerHeight = $('.footer').length>0 ? $('.footer').height():0;	//页脚高度
    	var bodyHeight = $("body").css({height:"auto"}).outerHeight(true);		//文档高度
    	var spaceHeight = winHeight-footerHeight;
    	if(bodyHeight < winHeight){
    		$('.footer').offset({top:spaceHeight})
    	}

    }

    $(window).resize(function(){
        fiexdFooter();
    });
    setTimeout(function(){
        fiexdFooter();
    },20);




})(jQuery);


//设置cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+";path=/";
}
//获取cookie
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}
//清除cookie  
function clearCookie(name) {  
    setCookie(name, "", -1);  
}  
 
function logout(){
	$.ajax({ 
		type:"POST", 
		async:false, 
		url:"/members/logout.html",
		dataType: "json",
		data:{i:Math.floor(Math.random() * 100)},
		success:function(result){
			if(result.status == 200){
				window.location.href = result.msg;
			}else{
				alert(result.msg);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			window.location.reload();
		}	
	});
}
//头部导航选择
function headerNav(typename){
 	$('[data-menuUl="o2owebsite-headerNav"]').children("li").removeClass("o2owebsite-active");
	$('[data-menu="o2owebsite-'+typename+'"]').addClass("o2owebsite-active");
}

function confirmMsg(msg){
	art.dialog.confirm(msg, function() {
		
	}, function() {
		//取消执行操作
		return true;
	});
}

function alertMsg(msg){
	art.dialog.alert(msg);
}

/**
 * get跳转至预览页面
 */
function previewTo(url,name,iWidth,iHeight){
	if(null==url||''==url)return;
	if(null==name||''==name)name='preview';    //网页名称，可为空;
	if(null==iWidth||0>=iWidth)iWidth=673;	   //弹出窗口的宽度;
	if(null==iHeight||0>=iHeight)iHeight=900;  //弹出窗口的高度;
    //获得窗口的垂直位置
    var iTop = (window.screen.availHeight-30-iHeight)/2;        
    //获得窗口的水平位置
    var iLeft = (window.screen.availWidth-10-iWidth)/2;           
	var win=window.open(url,name,'height='+iHeight+',innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=yes,titlebar=no');
	win.focus();
}

/**
 * post跳转至预览页面
 */
 var ow;
function previewToBigData(url,jsonstr,name,iWidth,iHeight){
	if(null==url||''==url)return;
	if(null==name||''==name)name='preview';    //网页名称，可为空;
	if(null==iWidth||0>=iWidth)iWidth=673;	   //弹出窗口的宽度;
	if(null==iHeight||0>=iHeight)iHeight=900;  //弹出窗口的高度;
	//获得窗口的垂直位置
    var iTop = (window.screen.availHeight-30-iHeight)/2;        
    //获得窗口的水平位置
    var iLeft = (window.screen.availWidth-10-iWidth)/2;
	if(ow){
		ow.close();	
	}
	ow=window.open('about:blank',name,'height='+iHeight+',innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=no,titlebar=no');
	 $.ajax({
         type: "POST", url: url,
         async:false,
         data:{"jsonstr":jsonstr,"jsonType":name},
         success:function(data){
	       	ow.document.write(data);
	        ow.focus();
	        ow.document.close();	
         }
     });   
}

function previewToSerialize(url,seridata,name,iWidth,iHeight){
	if(null==url||''==url)return;
	if(null==name||''==name)name='preview';    //网页名称，可为空;
	if(null==iWidth||0>=iWidth)iWidth=673;	   //弹出窗口的宽度;
	if(null==iHeight||0>=iHeight)iHeight=900;  //弹出窗口的高度;
	//获得窗口的垂直位置
    var iTop = (window.screen.availHeight-30-iHeight)/2;        
    //获得窗口的水平位置
    var iLeft = (window.screen.availWidth-10-iWidth)/2;
	if(ow){
		ow.close();	
	}
	ow=window.open('about:blank',name,'height='+iHeight+',innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=no,titlebar=no');
	 $.ajax({
         type: "POST", url: url,
         async:false,
         data:seridata,
         success:function(data){
	       	ow.document.write(data);
	        ow.focus();
	        ow.document.close();	
         }
     });   
}


/************************************************************************************/
//更改头部导航选项
var menutop=function(typename){
	 $('[data-operate="ul-menutop"]').children("li").removeClass("active");
	 $('[data-menutop="'+typename+'"]').addClass("active actives");
    if($('[data-menutop=xcj]').hasClass('active')){
        $('.triangleThird').addClass('active');
    }else{
        $(".triangleThird").removeClass('active');
    }
}
//更改左部导航选项
/*var menuleft=function(typename){
	var $allli=$('#navbarlist').find("li"),
	  $objli=$('[tabindex="'+typename+'"]');
	//去除原有的选中选项
	$allli.removeClass("active");
	$allli.removeClass("activelist");
	//添加当前选中选项
	 $objli.addClass("activelist");
	 $objli.parents("li").addClass("active actives");
}*/

var menuleft=function(typename){
	var $allli=$('#navbarlist').find("li"),
	  $objli=$('[tabindex="'+typename+'"]');
	
	$('#navbarlist').find("ul").hide();
	//去除原有的选中选项
	$allli.removeClass("active");
	$allli.removeClass("activelist");
	//添加当前选中选项
	 $objli.addClass("activelist");
	 $objli.parents("li").addClass("active actives");
	 $objli.parents("ul").show();
}
//左部导航
$(function(){
	$('#navbarlist div').click(function(){
		//var $allli=$('#navbarlist').find("li");
		$('#navbarlist').find("ul").hide();
		$(this).parents("li").find('ul').show();
	})
	
    var $navBarList = $(".ui_navbar"),
	    $navBarListli = $(".ui_navbar>li");
	$navBarListli.on("hover",function(){
	  $(this).addClass("active").siblings().removeClass("active");
	});
	$navBarList.on("mouseleave",function(){
	  $(this).find("li").removeClass("active");
	  $(this).find("li li.activelist").parents("li").addClass("active").siblings().removeClass("active");
	});
	
	var $indexList = $(".index_nav"),
	    $indexListli = $(".index_nav>li");
	$indexListli.on("hover",function(){
	  $(this).addClass("actives").siblings().removeClass("actives");
	});
	$indexList.on("mouseleave",function(){
	  $(this).find("li").removeClass("actives");
	  $(this).find("li.active").addClass("actives").siblings().removeClass("actives");
	})
	
	//众创官网
	$(".xcj").hover(function(){
		$(this).addClass("showTC");
	},function(){
		$(this).removeClass("showTC");
	});
	
	//尾部
	footerAtBottom();
});

//尾部
function footerAtBottom(){
	var browserHeight =  document.documentElement.clientHeight;  //浏览器可视高度
	var footerHeight = $('.footer').length>0 ? $('.footer').height():0;	//页脚高度
	var leftWidth=$('.header').height()+$('.top').height();
	var bodyHeight = $("body").outerHeight(true);		//文档高度
	var spaceHeight = browserHeight-footerHeight;
     $('#j-content').css('min-height',(bodyHeight-footerHeight-leftWidth)+'px')
	if(bodyHeight < browserHeight){
      $('.footer').offset({ top:spaceHeight})
	}
//	console.log(browserHeight+"***"+bodyHeight+"***"+footerHeight+"**"+spaceHeight);
}