<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:33:"../template/mallm/login\index.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\footer.php";i:1568792597;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
		<section style="background:#fff;">
			<!--header-->
			<section class="fanhui_head mrbd">
				<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>
				<h2>登录</h2>
			</section>
			<section class="padding_lr75" id="xuanxiangka">
            	<div style="text-align:center; margin:3rem 0 1rem;">
            	<img src="__IMG__/logo.png">
                </div>
            
				<form id="login">
                	<?php echo token('__hash__'); ?>
					<!--用户名登录-->
					<ul style="display:block;">
						<li>
							<div class="clearfix denglu_mima_list">
								<img class="fl denglu_touxiang" src="__IMG__/denglu_touxiang.png">
								<input class="fl inp denglu_username_int" name="username" type="text" placeholder="用户名/手机号"/>
								<img class="fr denglu_Group" src="__IMG__/zhuce_Group.png">
							</div>
							<div class="clearfix denglu_mima_list">
								<img class="fl denglu_mima1" src="__IMG__/denglu_mima.png">
								<input class="fl denglu_password_int1" name="password" type="password" placeholder="密码"/>
								<input class="fl denglu_password_int2" name="password0" type="text" style="display:none;" placeholder="密码"/>
								<img class="fr denglu_xianshi" src="__IMG__/denglu_xianshi.png" >
							</div>
						</li>
					</ul>
					
					<p class="clearfix denglu_xyhmm">
						<a href="<?php echo url('login/reg');?>"><span class="fl denglu_zcxyh">注册新用户</span></a>
						<a href="#"><span class="fr denglu_wjmm">忘记密码？</span></a>
					</p>
					<input class="denglu_btn" type="button" value="登  录"/>
				</form>
			</section>
			<!--<section class="padding_lr75">
				<div class="denglu_disanfang">
					<p class="denglu_disanfang_xian">
						<i>您还可使用社交账号登录</i>
					</p>
					<ul class="clearfix denglu_disanfang_fangshi">
						<li class="fl"><img src="__IMG__/denglu_qq.png"/></li>
						<li class="fl"><img src="__IMG__/denglu_wx.png"/></li>
						<li class="fl"><img src="__IMG__/denglu_wb.png"/></li>
					</ul>
				</div>
			</section>-->
		
        
        
		<script type="text/javascript">
            $(function(){
                //监听
                $("form :input").blur(function(){
                    //用户名
                    if ($(this).is(".denglu_username_int")){
                        if($(this).val()==''){
                            $(this).parent().find('.denglu_Group').hide();
                        }else{
                            $(this).parent().find('.denglu_Group').show();
                        };
                    };
                });
                //清空
                $('.denglu_Group').click(function(){
                    $(this).parent().find('.inp').val('');
                    $(this).hide();
                });
                //用户名密码显示隐藏
                var i=0;
                $('.denglu_xianshi').click(function(){
                    i++;
                    if(i%2){
                        $(this).attr('src','__IMG__/denglu_yinchang.png');
                        $('.denglu_password_int2').show();
                        $('.denglu_password_int1').hide();
                        var j=$('.denglu_password_int1').val();
                        $('.denglu_password_int2').val(j);
                    }else{
                        $(this).attr('src','__IMG__/denglu_xianshi.png');
                        $('.denglu_password_int1').show();
                        $('.denglu_password_int2').hide();
                        var j=$('.denglu_password_int2').val();
                        $('.denglu_password_int1').val(j);
                    };
                });
				
				
				$('.denglu_btn').click(function(){
					var returnUrl = "<?php echo $returnUrl;?>";
					$.ajax({
						url: "/login/login.html",
						data: $("#login").serialize(),
						type: "post",
						dataType: "json",
						success: function(data) {
						  if(data.status == 200){
							if(returnUrl){
							  window.location.href = returnUrl;
							}else{
							  window.location.href = '/';
							}
						  }else{
							layer.open({skin:'msg',content: data.msg,time:2,end:function(){window.location.reload();}});
						  }
						}
					})
				})
                
            });
        </script>
<section><ul class="clearfix foot_lists"><a href="https://<?php echo request()->host();?>/"><li class="fl"><img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/><p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p></li></a><a href="<?php echo url('cat/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/><p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p></li></a><a href="<?php echo url('cart/index');?>"><li class="fl foot_lists_car"><img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/><span id="num">0</span><p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p></li></a><?php if(isset($userinfo) && $userinfo['username']){?><a href="<?php echo url('uinf/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/><p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p></li></a><?php }else{?><a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow"><li class="fl"><img src="__IMG__/wode1.png"/><p class="active">登录</p></li></a><?php }?></ul></section></section><script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body></html>
