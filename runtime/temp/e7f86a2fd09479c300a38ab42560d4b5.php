<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:28:"../template/mallm/zt\inf.php";i:1568191734;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\footer.php";i:1567558230;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
<style>
.home_jiu nav{ margin-top:0; margin-bottom:1rem;}
</style>
<section class="ds_home">
    <!--分类-->
    <section class="home_jiu">
        <img src="<?php echo $info['icon'];?>" alt="<?php echo $webseo['title'];?>">
<!--	大专题jgp-->

        <!--版块     遍历方式1-->
<!--        --><?php //foreach($listscat as $key=>$val){?>
<!--        <nav class="home_baijiu" id="cat--><?php //echo $key;?><!--">-->
<!--            <img src="--><?php //echo $val['icon'];?><!--" alt="--><?php //echo $webseo['title'];?><!--">-->
<!--            <ul class="clearfix sp_lists" id="home_sp_lists">-->
<!--                --><?php //foreach($catgoods[$key] as $k=>$v){?>
<!--                <a href="--><?php //echo url('goods/'.$v['gno']);?><!--">-->
<!--                <li class="fl">-->
<!--                    <img class="sp_img lazy" data-original="--><?php //$picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?><!--" alt="--><?php //echo $v['name'];?><!--" />-->
<!--                    <div class="sp_lists_word">-->
<!--                        <h4>--><?php //echo $v['name'];?><!--</h4>-->
<!--                        <h5>--><?php //echo $v['recommend'];?><!--</h5>-->
<!--                        <p class="clearfix">-->
<!--                            <span class="fl"><em>￥--><?php //echo number_format($v['sales_price']/100,2);?><!--</em>/--><?php //echo $v['units'];?><!--</span>-->
<!--                            <img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </li>-->
<!--                </a>-->
<!--                --><?php //}?>
<!--            </ul>-->
<!--        </nav>-->
<!--        --><?php //}?>

<!--		方式2-->
		<?php foreach($lists as $v){?>
			<nav class="home_baijiu">
				<img src="<?php echo $v['icon'];?>" alt="<?php echo $webseo['title'];?>">
				<ul class="clearfix sp_lists" id="home_sp_lists">
					<?php foreach($gnolists[$v['id']] as $gn){?>
							<a href="<?php echo url('goods/'.$goodlist[$gn['gno']]['gno']);?>">
								<li class="fl">
									<img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($goodlist[$gn['gno']]['pic']),true);echo $picarr[0];?>" alt="<?php echo $catgoods[$v1['id']]['name'];?>" />
									<div class="sp_lists_word">
										<h4><?php echo $goodlist[$gn['gno']]['name'];?></h4>
										<h5><?php echo $goodlist[$gn['gno']]['recommend'];?></h5>
										<p class="clearfix">
											<span class="fl"><em>￥<?php echo number_format($goodlist[$gn['gno']]['sales_price']/100,2);?></em>/<?php echo $goodlist[$gn['gno']]['units'];?></span>
											<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
										</p>
									</div>
								</li>
							</a>
					<?php }?>
				</ul>
			</nav>
		<?php }?>



	</section>
    <!--占位-->
    <section class="zhanwei_hei45"></section>





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
			var wximgUrl = '<?php echo 'https://'.request()->host().'/mall/img/icon.png';?>',wxlink = '<?php echo 'https://'.request()->host().'/';?>';
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
<section><ul class="clearfix foot_lists"><a href="https://<?php echo request()->host();?>/"><li class="fl"><img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/><p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p></li></a><a href="<?php echo url('cat/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/><p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p></li></a><a href="<?php echo url('cart/index');?>"><li class="fl foot_lists_car"><img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/><span id="num">0</span><p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p></li></a><?php if(isset($userinfo) && $userinfo['username']){?><a href="<?php echo url('uinf/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/><p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p></li></a><?php }else{?><a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow"><li class="fl"><img src="__IMG__/wode1.png"/><p class="active">登陆</p></li></a><?php }?></ul></section></section><script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body></html>