<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="applicable-device"content="pc">
    <title><?php $pzSeo = json_decode(base64_decode($webSet['seo']),true); echo $pzSeo['title'];?></title>
    <meta name="keywords" content="<?php echo $pzSeo['keyword'];?>" />
    <meta name="description" content="<?php echo $pzSeo['description'];?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $webSet['ico'];?>" />
    <link rel="stylesheet" type="text/css" href="__CSSPZ__/base.css">
    <script type="text/javascript" src="__STATIC__/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="__JSPZ__/cfw.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="__CSSPZ__/my.css">
    <link rel="stylesheet" type="text/css" href="__CSSPZ__/tip-yellowsimple.css">
    <link rel="stylesheet" type="text/css" href="__CSSPZ__/system.css">
    <link rel="stylesheet" type="text/css" href="__CSSPZ__/selfperson.css">

</head>
<body>
    <div id="header">
        <div class="site-nav">
          <div class="box">
            <ul>
              <li class="wel">
                  <p><a href="tel:<?php echo $webSet['tel'];?>" title="客服热线:<?php echo $webSet['tel'].'-'.$pzSeo['title'];?>"><i class="icon icon-tel"></i><?php echo $webSet['tel'];?></a></p>
              </li>
              <li class="info">
                  <a href="<?php echo url('pzu/inf');?>" title="用户中心" id="userInf"><strong>【<?php echo $userInfo['username'];?>】</strong></a>
                  <a href="<?php echo url('login/logout');?>" title="退出登陆" class="haslogin">退出</a>
              </li>
            </ul>
          </div>
        </div><!--site-nav end-->

        <div class="header">
            <div class="box">
                <h1 class="logo"><a href="http://<?php echo request()->host();?>/" title="<?php echo $pzSeo['title'];?>"><img class="fl" src="<?php echo $webSet['logo']?$webSet['logo']:'/pz178/img/logo.png';?>" alt="<?php echo $pzSeo['title'];?>"></a></h1>

	             <ul class="bnav">                                    
                    <!--<li><a href="http://<?php echo request()->host();?>/" title="<?php echo $pzSeo['title'];?>首页">首页</a></li>
                    <li><a href="<?php echo url('zx/0');?>" title="股市资讯">股市资讯</a></li>
                    <?php if($webSet['id']==2){?>
                    <li><a href="<?php echo url('zt/0');?>" title="股票专题">股票专题</a></li>
                    <?php }?>
                    <li><a href="<?php echo url('gp/pf');?>" title="免息投顾">免息投顾</a></li>
                    <li><a href="<?php echo url('gp/pd');?>" title="按天投顾">按天投顾</a></li>
                    <li class="selected" style="position:relative;"><a href="<?php echo url('gp/pz');?>" title="按月投顾">按月投顾</a>
                        <img src="__IMGPZ__/gp-sy-hot.png" alt="用户中心"/></li>
                    <li><a href="<?php echo url('qh/in');?>" title="期货配资">期货配资</a></li>-->
                    <li><a href="http://www.yuepeizi.com/" title="悦配资" target="_blank">悦配资</a></li>
                </ul>
                <a href="<?php echo url('pzu/inf');?>" class="myasset" title="用户中心"><img src="__IMGPZ__/MyAsset.png" alt="用户中心" /></a>
          </div>
        </div><!--head end-->
    </div>
<script type="text/javascript" language="javascript">
	var _oztime = (new Date()).getTime();
</script>
<div id="main">
    <div class="userleft">
       <div class="ucnav">
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/inf') || stristr(request()->path(),'pzu/cert'))?' selected':'';?>"><a href="<?php echo url('pzu/inf');?>" title="账户概况">账户概况</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/news'))?' selected':'';?>"><a href="<?php echo url('pzu/news');?>" title="稿件管理">稿件管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/ygorder') || stristr(request()->path(),'pzu/wbinf'))?' selected':'';?>"><a href="<?php echo url('pzu/ygorder');?>" title="约稿订单">约稿订单</a></h2>
            <?php if($userInfo['utype'] == 2){?>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/toyg'))?' selected':'';?>"><a href="<?php echo url('pzu/toyg');?>" title="约稿">约　　稿</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/wbclassic'))?' selected':'';?>"><a href="<?php echo url('pzu/wbclassic');?>" title="经典语录">经典语录</a></h2>
            <?php }?>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/account'))?' selected':'';?>"><a href="<?php echo url('pzu/account');?>" title="资金收支">收支明细</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/withdraw'))?' selected':'';?>"><a href="<?php echo url('pzu/withdraw');?>" title="提现">提　　现</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/withdrawlog'))?' selected':'';?>"><a href="<?php echo url('pzu/withdrawlog');?>" title="提现流水">提现流水</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/card'))?' selected':'';?>"><a href="<?php echo url('pzu/card');?>" title="卡包管理">卡包管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/recharge'))?' selected':'';?>"><a href="<?php echo url('pzu/recharge');?>" title="充值">充　　值</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/rechargelog'))?' selected':'';?>"><a href="<?php echo url('pzu/rechargelog');?>" title="充值流水">充值流水</a></h2>
            
            <?php if($userInfo['userid'] == $supertube){?>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/mnews'))?' selected':'';?>"><a href="<?php echo url('pzu/mnews');?>" title="稿件管理">稿件管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/users'))?' selected':'';?>"><a href="<?php echo url('pzu/users');?>" title="用户管理">用户管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/mcert'))?' selected':'';?>"><a href="<?php echo url('pzu/mcert');?>" title="认证管理">认证管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/login'))?' selected':'';?>"><a href="<?php echo url('pzu/login');?>" title="登陆明细">登陆明细</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/mrecharge'))?' selected':'';?>"><a href="<?php echo url('pzu/mrecharge');?>" title="充值管理">充值管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/mwithdraw'))?' selected':'';?>"><a href="<?php echo url('pzu/mwithdraw');?>" title="提现管理">提现管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/mygorder'))?' selected':'';?>"><a href="<?php echo url('pzu/mygorder');?>" title="订单管理">订单管理</a></h2>
            <h2 class="navtit<?php echo (stristr(request()->path(),'pzu/maccount'))?' selected':'';?>"><a href="<?php echo url('pzu/maccount');?>" title="资金收支">收支明细</a></h2>
            
           	<?php }?>
        </div>
    </div>