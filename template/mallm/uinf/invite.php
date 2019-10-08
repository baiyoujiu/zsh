{include file="common/header" /}
<section class="ds_home">
<section class="ds_home_head">
  <h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a><span id="adrtitle">邀请有奖</span></h2>
</section>
<!--占位-->
<section class="zhanwei_hei35"></section>
<section class="zhanwei_hei01"></section>
<!--轮播-->
<section> <img src="__IMG__/yoqing1.jpg" alt="<?php echo $webseo['title'];?>"> <a href="<?php echo url('zt/reg').'?i='.($userinfo['id']+5000);?>"><img src="__IMG__/yoqing2.jpg" alt="<?php echo $webseo['title'];?>"></a> <img src="__IMG__/yoqing3.jpg" alt="<?php echo $webseo['title'];?>"> </section>
<script type="text/javascript" src="__JS__/jweixin-1.4.0.js" ></script> 
<script type="text/javascript">
		$(document).ready(function(){
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});
		});
		
		//获取判断浏览器用的对象
		var ua = window.navigator.userAgent.toLowerCase(); 
		if (ua.match(/MicroMessenger/i) == "micromessenger") {
			//自定义"分享给朋友"及"分享到QQ"按钮的分享内容（1.4.0）
			//自定义"分享到朋友圈"及"分享到QQ空间"按钮的分享内容（1.4.0）
			var wxtitle = '<?php echo $webseo['title'];?>',wxdesc = '<?php echo $webseo['description'];?>';
			var wximgUrl = '<?php echo 'https://'.request()->host().'/mall/img/icon300.png';?>',wxlink = '<?php echo url('zt/reg').'?i='.($userinfo['id']+5000);?>';
			wx.config({
				//debug: true,
				appId: '<?php echo $wxsignPackage["appId"];?>',
				timestamp: '<?php echo $wxsignPackage["timestamp"];?>',
				nonceStr: '<?php echo $wxsignPackage["nonceStr"];?>',
				signature: '<?php echo $wxsignPackage["signature"];?>',
				jsApiList: [
				  'updateAppMessageShareData','updateTimelineShareData','onMenuShareWeibo'
				]
			});
			
			wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
				wx.updateAppMessageShareData({ 
					title: wxtitle, // 分享标题
					desc: wxdesc, // 分享描述
					link: wxlink, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: wximgUrl, // 分享图标
					success: function () {
					  // 设置成功
					}
				})
				wx.updateTimelineShareData({ 
					title: wxtitle, // 分享标题
					link: wxlink, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: wximgUrl, // 分享图标
					success: function () {
					  // 设置成功
					}
				})
				wx.onMenuShareWeibo({
					title: wxtitle, // 分享标题
					desc: wxdesc, // 分享描述
					link: wxlink, // 分享链接
					imgUrl: wximgUrl, // 分享图标
					success: function () {
					// 用户确认分享后执行的回调函数
					},
					cancel: function () {
					// 用户取消分享后执行的回调函数
					}
				});
			});
		}
</script> 
{include file="common/footer" /}