<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:33:"../template/mallm/index\index.php";i:1569547332;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\footer.php";i:1568792597;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
<section class="ds_home">
			<!--搜索-->
			<section class="home_searchs">
				<div class="clearfix home_search">
					<i class="fl icon-search"></i>
					<p class="fl search_p" id="home_seaech">输入您要找的商品</p>
				</div>
			</section>
			<!--占位-->
			<section class="zhanwei_hei40"></section>
			<!--轮播-->
			<section>
				<div class="home_lunbo">
					<div class="swiper-container">
						<ul class="swiper-wrapper">
                        
                          <li class="swiper-slide"> <img src="/images/books/bookszjlc.jpg" alt="<?php echo $webseo['title'];?>"> </li>
				          <li class="swiper-slide"> <a href="<?php echo url('zt/1001');?>" title="一年级必读经典书目-租书会"><img src="__IMG__/banner01.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                          <li class="swiper-slide"> <a href="<?php echo url('zt/1002');?>" title="二年级必读经典书目-租书会"><img src="__IMG__/banner02.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                          <li class="swiper-slide"> <a href="<?php echo url('zt/1003');?>" title="三年级必读经典书目-租书会"><img src="__IMG__/banner03.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                          <li class="swiper-slide"> <a href="<?php echo url('zt/1004');?>" title="四年级必读经典书目-租书会"><img src="__IMG__/banner04.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                          <li class="swiper-slide"> <a href="<?php echo url('zt/1005');?>" title="五年级必读经典书目-租书会"><img src="__IMG__/banner05.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                          <li class="swiper-slide"> <a href="<?php echo url('zt/1006');?>" title="六年级必读经典书目-租书会"><img src="__IMG__/banner6.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
						</ul>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</section>
			<!--分类-->
			<section class="home_jiu">
				<ul class="clearfix home_fenlei">
					<?php foreach($listscat as $k=>$v){?>
                    
                    <a href="#cat<?php echo $k;?>">
						<li class="fl">
							<img class="lazy" data-original="<?php echo $v['icon'];?>" alt="<?php echo $v['name'];?>"/>
							<p><?php echo $v['name'];?></p>
						</li>
					</a>
                    <?php }?>
				</ul>
				<!--白酒-->
                <?php foreach($listscat as $key=>$val){?>
				<nav class="home_baijiu" id="cat<?php echo $key;?>">
                    <h3 class="clearfix">
						<span class="fl"></span>
						<p class="fl"><?php echo $val['name'];?></p>
                        <a href="<?php echo url('list/'.$val['id']);?>" class="fr">更多<i class="icon-right"></i></a>
					</h3>
					<ul class="clearfix sp_lists" id="home_sp_lists">
						<?php foreach($catgoods[$key] as $k=>$v){?>
                        <a href="<?php echo url('goods/'.$v['gno']);?>">
                        <li class="fl">
							<img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" alt="<?php echo $v['name'];?>" />
							<div class="sp_lists_word">
								<h4><?php echo $v['name'];?></h4>
								<h5><?php echo $v['recommend'];?></h5>
								<p class="clearfix">
									<span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span>
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
            <!--足迹-->
            <section>
                <p class="pailie_list">
                    <a href="<?php echo url('goods/track');?>"><img src='__IMG__/jilu2.png' alt="浏览历史-租书会" /></a>
                </p>
            </section>
            
            
            
			
			<!--搜索弹窗-->
			<section class="ssls_tankuang">
				<div class="ss_searchs">
					<div class="clearfix ss_search">
						<i class="fl icon-left ss_search_close"></i>
						<input class="fl search_inp" type="text" id="sanji_search" placeholder="输入您要搜索的商品"/>
						<span class="fl" id="serchbut">搜索</span>
					</div>
					<ul class="guanlian_list">
						<li>1111</li>
						<li>2222</li>
						<li>3333</li>
						<li>4444</li>
						<li>1111</li>
						<li>2222</li>
						<li>3333</li>
						<li>4444</li>
					</ul>
				</div>
				<!--搜索历史-->
				<nav class="lishi_tuijian">
					<!--<section class="ss_ls" id="ss_ls">
						<h2 class="ss_ls_tit clearfix">
							<span class="fl">搜索历史</span>
							<i class="fr icon-close ss_ls_close"></i>
						</h2>
						<ul class="clearfix">
							<li class="fl">四年级必读书目</li>
							<li class="fl">必读书目</li>
							<li class="fl">汾酒</li>
							<li class="fl">二锅头</li>
							<li class="fl">洋河天之蓝</li>
							<li class="fl">洋河梦之蓝</li>
							<li class="fl">茅台</li>
							<li class="fl">五粮液</li>
							<li class="fl">汾酒</li>
							<li class="fl">二锅头</li>
						</ul>
					</section>-->
					<section class="ss_ls" id="ss_ss">
						<h2 class="ss_ls_tit clearfix">
							<span class="fl">实时热搜</span>
						</h2>
						<ul class="clearfix">
							<?php foreach($hotserchkey as $v){?>
                            <li class="fl"><?php echo $v;?></li>
                            <?php }?>
						</ul>
					</section>
				</nav>
			</section>
	<script type="text/javascript" src="__JS__/jweixin-1.4.0.js" ></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});
			
			/*首页搜索显示*/
			$('#home_seaech').click(function(){
				$('.ssls_tankuang').animate({
					left:'0rem'
				}, 300)
			});
			
			
			$('.ssls_tankuang li').click(function(){
					var kv = $(this).html();
					$('#sanji_search').val(kv);
					$('#serchbut').click();
				})
				
			$('#serchbut').click(function(){
	                var kv = $('#sanji_search').val();
					window.location.href = '/list/0.html?k='+kv;
	            });
			
			/*//关键字联想下拉
			var lenInput1 = $('#sanji_search').val().length;
			$("#sanji_search").keyup(function(){
				lenInput1 = $(this).val().length;
				if(lenInput1>0){
					$('.guanlian_list').show();
				}else{
					$('.guanlian_list').hide();
				};
			});*/
		});

		/*轮播*/
	    var swiper = new Swiper('.swiper-container', {
	      centeredSlides: true,
	      autoplay: {
	        delay: 3000,
	        disableOnInteraction: false,
	      },
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
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
<section><ul class="clearfix foot_lists"><a href="https://<?php echo request()->host();?>/"><li class="fl"><img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/><p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p></li></a><a href="<?php echo url('cat/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/><p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p></li></a><a href="<?php echo url('cart/index');?>"><li class="fl foot_lists_car"><img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/><span id="num">0</span><p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p></li></a><?php if(isset($userinfo) && $userinfo['username']){?><a href="<?php echo url('uinf/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/><p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p></li></a><?php }else{?><a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow"><li class="fl"><img src="__IMG__/wode1.png"/><p class="active">登录</p></li></a><?php }?></ul></section></section><script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body></html>