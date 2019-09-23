<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:32:"../template/mallm/uinf\index.php";i:1568169282;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\footer.php";i:1568792597;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
<section class="sc_home">
    <!--head-->
    <section class="ds_home_head">
        <h2>个人中心 <a href="<?php echo url('uinf/uset');?>"><img class="delete" style="margin:0.7rem" src="__IMG__/uset.png"></a></h2>
    </section>
    <section class="zhanwei_hei30"></section>
    <section class="ds_wode_back">
        <div class="clearfix ds_wode_uname">
            <img class="fl" src="__IMG__/userdef.png" />
            <p class="fl"><?php echo $userinfo['username'];?><br><?php echo $userinfo['utype']==1?'非租书会成员':'租书会成员<img src="__IMG__/zshvip.png">';?></p>
        </div>
        <?php if($userinfo['utype']==1){?>
        <a  href="<?php echo url('uinf/tovip');?>">
        <div class="plus_black_wrap">
            
            <div class="inner">
                <div class="title">
                    <div class="plus_title">享中外经典图书租借服务</div>
                    <div class="plus_subtitle">立即加入</div>
                </div>
            </div>
            
        </div>
        </a>
        <?php }?>
    </section>
    <section>
        <ul class="clearfix personal_lists">
            <a href="<?php echo url('uinf/order');?>"><li class="fl">
                <img src="__IMG__/personal-img5.png">
                <p>全部订单</p>
            </li></a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img1.png">
                <p>待付款</p>
            </li>
            </a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img2.png">
                <p>待发货</p>
            </li>
            </a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img3.png">
                <p>待收货</p>
            </li>
            </a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img4.png">
                <p>已完成</p>
            </li>
            </a>
        </ul>
    </section>
    <section>
        <ul class="person_lists">
            <?php if($userinfo['utype']==1){?>
            <a href="<?php echo url('uinf/tovip');?>">
            <li class="clearfix">
                <img class="fl" src="__IMG__/zhangdan.png"/>
                <p class="fl">非租书会成员</p>
                <i class="fr icon-right"></i>
                <em class="fr">交押金，立即加入</em>
            </li>
            </a>
            <?php }else{?>
            <li class="clearfix">
                <img class="fl" src="__IMG__/zhangdan.png"/>
                <p class="fl">图书租借押金</p>
                
                <em class="fr">￥&nbsp;<b><?php echo number_format($userinfo['balance']/100,2);?></b></em>
            </li>
            <?php }?>
            <a href="<?php echo url('uinf/coupon');?>">
                <li class="clearfix">
                    <img class="fl" src="__IMG__/youhuijuan.png"/>
                    <p class="fl">我的优惠券</p>
                    <i class="fr icon-right"></i>
                </li>
            </a>
            <a href="<?php echo url('uinf/address');?>">
                <li class="clearfix">
                    <img class="fl" src="__IMG__/shouhuo.png"/>
                    <p class="fl">收货地址</p>
                    <i class="fr icon-right"></i>
                </li>
            </a>
            <a href="<?php echo url('uinf/collect');?>">
            <li class="clearfix">
                <img class="fl" src="__IMG__/guanzhu.png"/>
                <p class="fl">我的收藏</p>
                <i class="fr icon-right"></i>
            </li>
            </a>
            <a href="<?php echo url('newsinf/7');?>">
            <li class="clearfix">
                <img class="fl" src="__IMG__/shouhou.png"/>
                <p class="fl">客服与售后</p>
                <i class="fr icon-right"></i>
            </li>
            </a>
            <a href="<?php echo url('goods/stage');?>">
            <li class="clearfix">
                <img class="fl" src="__IMG__/shouhuo.png"/>
                <p class="fl">租借驿站</p>
                <i class="fr icon-right"></i>
            </li>
            </a>
        </ul>
    </section>
    <?php if($userinfo['utype']==1){?>
    <section>
    <a href="<?php echo url('uinf/tovip');?>">
    <img src="__IMG__/tovip.png"/>
    </a>
    </section>
    <?php }?>
    <!--退出登录-->
    <section>
        <div class="grzx_tcdl">
            <a href="<?php echo url('login/logout');?>"><p>退出登录</p></a>
        </div>
    </section>
    <!--占位-->
    <section class="zhanwei_hei40"></section>
<section><ul class="clearfix foot_lists"><a href="https://<?php echo request()->host();?>/"><li class="fl"><img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/><p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p></li></a><a href="<?php echo url('cat/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/><p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p></li></a><a href="<?php echo url('cart/index');?>"><li class="fl foot_lists_car"><img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/><span id="num">0</span><p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p></li></a><?php if(isset($userinfo) && $userinfo['username']){?><a href="<?php echo url('uinf/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/><p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p></li></a><?php }else{?><a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow"><li class="fl"><img src="__IMG__/wode1.png"/><p class="active">登录</p></li></a><?php }?></ul></section></section><script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body></html>