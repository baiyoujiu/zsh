<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:32:"../template/mallm/order\cart.php";i:1568169282;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\footer.php";i:1568792597;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
<section class="ds_home">
			<!--head-->
			<section class="ds_home_head shop_car_title">
				<h2><a href="javascript:history.back(-1);"><i class="icon-left"></i></a>购物车<em class="delete">删除</em></h2>
			</section>
			<!--占位-->
			<section class="zhanwei_hei40"></section>
            <?php if(empty($cartlist)){?>
            <!--没有商品-->
			<div class="kongcar">
				<img src="__IMG__/kongcar.png" />
                <?php if($userinfo){?>
				<p>购物车空空如也，<em><a href="https://<?php echo request()->host();?>/">去逛逛</a></em>吧~</p>
                <?php }else{?>
				<p>登录后可同步购物车中商品</p>
				<span><a href="<?php echo url('login/index');?>">登陆</a></span>
                <?php }?>
			</div>
			<!--推荐商品-->
			<section class="term_box" id="section4">
				<!--详情推荐-->
				<h2 class="xiao_title">—— 推荐 ——</h2>
				<nav class="sousuo_lists" style="background:#fff;">
					<ul class="clearfix sp_lists">
						<?php foreach($listchot as $k=>$v){?>
                        <a href="<?php echo url('goods/'.$v['gno']);?>">
                        <li class="<?php echo $k%2<1?'fl':'fr';?>">
							<img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" />
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
			</section>
            
            
            <?php }else{?>
			<!--购物车-->
			<section>
				<ul class="shop_car_lists shop-cart-listbox1" id="box_check">
					<form id="fcart">
					<?php foreach($cartlist as $k=>$v){?>
                    <li class="clearfix index-goods">
						<span class="fl check_btn shop-cart-check2">
							<input type="checkbox" name="gkey[]" class="btn2" value="<?php echo $k;?>"/>
						</span>
						<p class="fl shop_img">
							<a href="<?php echo url('goods/'.$v['gno']);?>"><img class="lazy" data-original="<?php echo $v['pic'];?>" /></a>
						</p>
						<div class="fl shop_word">
							<a href="<?php echo url('goods/'.$v['gno']);?>"><h2><?php echo $v['name'];?></h2></a>
							<a href="<?php echo url('goods/'.$v['gno']);?>"><h3><?php echo $v['keyv'];?></h3></a>
							<div class="clearfix index-goods-textbox">
								<em class="fl">￥<strong class="priceJs"><?php echo $v['price']/100;?></strong></em>
								<div class="fr clearfix shop_num_btns">
									<i class="fl num_btn_jian shop-cart-subtract"></i>
									<b class="fl shop-cart-numer"  id="tb_count"><?php echo $v['num'];?></b>
									<i class="fl num_btn_jia shop-cart-add"></i>
								</div>
							</div>
						</div>
					</li>
                    <?php }?>
                    </form>
					
					<input type="hidden" value="" class="ShopTotal">
				</ul>
			</section>
            
			<!--占位-->
			<section class="zhanwei_hei70"></section>
			<!--购物车-->
			<section>
				<div class="jiesuan_lists clearfix">
					<div class="fl clearfix check_box">
						<label class="fl">
							<input type="checkbox" name="check" id="ckAll"/><em>全选</em>
						</label>
						<p class="fr">合计:￥<i id="AllTotal" class="scart-total-text3">0.00</i>(免运费)</p>
					</div>
					<div class="fr sc_jiesuan_btn">结算</div>
				</div>
			</section>
			<?php }?>
<script type="text/javascript" src="__JS__/cart.js" ></script>
<section><ul class="clearfix foot_lists"><a href="https://<?php echo request()->host();?>/"><li class="fl"><img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/><p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p></li></a><a href="<?php echo url('cat/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/><p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p></li></a><a href="<?php echo url('cart/index');?>"><li class="fl foot_lists_car"><img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/><span id="num">0</span><p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p></li></a><?php if(isset($userinfo) && $userinfo['username']){?><a href="<?php echo url('uinf/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/><p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p></li></a><?php }else{?><a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow"><li class="fl"><img src="__IMG__/wode1.png"/><p class="active">登录</p></li></a><?php }?></ul></section></section><script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body></html>