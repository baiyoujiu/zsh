/**官网头部**/
(function(){
	$(function(){
		var $body = $('body');
		var strHeader =  '<div class="o2owebsite-header">'+
					'	<div class="o2owebsite-header-info">'+
					'		<div class="o2owebsite-header-info-l leftblock">'+
					'			<a href="javascript:;">'+
					'				<img class="o2owebsite-logo-img o2owebsite-leftblock" src="/static/logo-new.png">'+
					'				<div class="o2owebsite-logo-info o2owebsite-leftblock">'+
					'					<p class="o2owebsite-logo-info-top">刷脸</p>'+
					'					<p class="o2owebsite-logo-info-bottom">基于信任的社交交易App</p>'+
					'				</div>'+
					'			</a>'+
					'		</div>'+
					'		<ul class="o2owebsite-header-nav o2owebsite-leftblock" data-menuUl="o2owebsite-headerNav">'+
					'			<li class="o2owebsite-active" data-menu="o2owebsite-sy"><a href="/">首页</a></li>'+
					'			<li data-menu="o2owebsite-gysl"><a href="/OWebsite/about-sl.html">产品介绍</a></li>'+
					'			<li data-menu="o2owebsite-gsjj"><a href="/OWebsite/about-company.html">公司简介</a></li>'+
					'			<li data-menu="o2owebsite-slkx"><a href="/u/information/index.htm">刷脸快讯</a></li>'+
					'			<li data-menu="o2owebsite-xmhz"><a href="/OWebsite/about-project.html">项目合作</a></li>'+
					'			<li data-menu="o2owebsite-sltd"><a href="/OWebsite/about-team.html">刷脸团队</a></li>'+
					'		</ul>'+
					'		<ul class="o2owebsite-header-login o2owebsite-rightblock">'+
					'			<li data-menu="o2owebsite-zhuce"><a href="/u/web/toRegister.htm" target="_blank">注册</a></li>'+
					'			<li class="o2owebsite-active"><a href="/u/login.htm" target="_blank">登录</a></li>'+
					'		</ul>'+
					'	</div>'+
					'</div>';
		var strFooter =  '<div class="o2owebsite-footer">'+
					'	<div class="o2owebsite-footer-info">'+
					'		<ul class="o2owebsite-footer-info-top o2owebsite-leftblock">'+
					// '			<li><a href="/OWebsite/about-us.html">关于我们</a><div class="o2owebsite-footer-info-line"></div></li>'+
					'			<li><a href="/u/joinUs.htm">加入我们</a><div class="o2owebsite-footer-info-line"></div></li>'+
            		'			<li><a href="/u/userHelp/help.htm">用户帮助</a><div class="o2owebsite-footer-info-line"></div></li>'+
					'			<li><a href="/company/protocol.jsp">服务协议</a><div class="o2owebsite-footer-info-line"></div></li>'+
					'			<li><a href="/OWebsite/contact-way.html">联系方式</a></li>'+
					'		</ul>'+
					'		<p>地址：杭州市滨江区滨盛路1766号UDC星光时代11楼<i>服务热线：400-000-3777</i></p>'+
					'		<p><a class="beian" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010502002362" target="_blank" ><img src="/static/recordImg.png"> <span>浙公网安备 33010502002362号 </span></a>脸谱科技有限公司 ©版权所有 浙ICP备14042086号-4</p>'+
					'	</div>'+
					'</div>';

		$body.prepend(strHeader);
		$body.append(strFooter);
		
		try{  
		  if(typeof(eval(getCookie))=="function"){
			  getCookie();
			  var username=getCookie("username");
				if(username!=""){
					var reglogHtml='<ul class="o2owebsite-rightblock o2owebsite-header-logined">'+
					'			<li class="o2owebsite-active"><a href="/u/index.htm">'+username+'<div class="o2owebsite-header-logined-line"></div></a></li>'+
					'			<li><a href="javascript:logout();">0退出</a></li>'+
					'		</ul>';
					$(".o2owebsite-header-login").removeClass("o2owebsite-header-login").addClass('o2owebsite-header-logined').html(reglogHtml);
				}
		  }
		}catch(e){}  

		
		
	    $(window).resize(function(){
	        fiexdFooter();
	    });
	    setTimeout(function(){
	        fiexdFooter();
	    },20);
	});
})()

function headerNav(typename){
 	$('[data-menuUl="o2owebsite-headerNav"]').children("li").removeClass("o2owebsite-active");
	$('[data-menu="o2owebsite-'+typename+'"]').addClass("o2owebsite-active");
}

function fiexdFooter(){
	var winHeight =  $(window).height();  //浏览器可视高度
	var footerHeight = $('.o2owebsite-footer').length>0 ? $('.o2owebsite-footer').height():0;	//页脚高度
	var bodyHeight = $("body").css({height:"auto"}).outerHeight(true);		//文档高度
	var spaceHeight = winHeight-footerHeight;
	if(bodyHeight < winHeight){
		$('.o2owebsite-footer').offset({top:spaceHeight})
	}

}
var cnzz_s_tag=document.createElement("script");cnzz_s_tag.type="text/javascript",cnzz_s_tag.async=!0,cnzz_s_tag.charset="utf-8",cnzz_s_tag.src="https://s11.cnzz.com/z_stat.php?id=1256279382&async=1";var root_s=document.getElementsByTagName("script")[0];root_s.parentNode.insertBefore(cnzz_s_tag,root_s);