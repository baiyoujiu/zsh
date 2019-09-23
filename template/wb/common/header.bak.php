<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="applicable-device"content="pc">
    <title><?php $pzSeo = json_decode(base64_decode($webSet['seo']),true); echo empty($seotitle)?$pzSeo['title']:$seotitle;?></title>
    <meta name="keywords" content="<?php echo empty($seokeyword)?$pzSeo['keyword']:$seokeyword;?>" />
    <meta name="description" content="<?php echo empty($seodescription)?$pzSeo['description']:$seodescription;?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $webSet['ico'];?>" />
    <link rel="stylesheet" type="text/css" href="__CSSPZ__/base.css">
    <script type="text/javascript" src="__STATIC__/jquery-1.11.1.js"></script>
    <?php if(stristr(request()->path(),'newsinf') && isset($info['news_no'])){?>
    <script type="application/ld+json">
        {
            "@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
            "@id": "<?php echo url('newsinf/'.$info['news_no']);?>",
            "appid": "1610206688364372",
            "title": "<?php echo $info['title'];?>",
            "images": [
                "<?php echo $info['pic'];?>"
            ], //请在此处添加希望在搜索结果中展示图片的url，可以添加0个、1个或3个url
            "pubDate": "<?php echo $info['publish'];?>T17:00:00" // 需按照yyyy-mm-ddThh:mm:ss格式编写时间，字母T不能省去
        }
    </script>
    <?php }?>
</head>
<body>
	<div id="header">
        <div class="site-nav">
          <div class="box">
            <ul>
              <li class="wel">
                 实力在线股票配资服务老平台，安全、专业、正规可靠的线上实盘股票配资公司，操盘手2019年杠杆炒股的首选融资渠道。
              </li>
              <li class="info">
              <?php if(isset($userInfo) && $userInfo['username']){?>
                <a href="<?php echo url('pzu/inf');?>" title="用户中心-<?php echo $webSet['title'];?>">您好！<strong>【<?php echo $userInfo['username'];?>】</strong></a>
                <a href="<?php echo url('login/logout');?>" title="退出登陆-<?php echo $webSet['title'];?>" rel="nofollow">退出</a>
              <?php }else{?>
                 <a href="<?php echo url('login/index');?>" title="用户登录-<?php echo $webSet['title'];?>" rel="nofollow">登录</a>
                 <a href="<?php echo url('login/reg');?>" title="用户注册-<?php echo $webSet['title'];?>" rel="nofollow">注册</a>
              <?php }?>
              <a href="<?php echo url('newsinf/14');?>" title="网站地图-<?php echo $webSet['title'];?>">网站地图</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="header">
            <div class="box">
                <h1 class="logo" style=" margin-top:0px;top:15px; left:0px;"><a href="http://<?php echo request()->host();?>/" title="<?php echo $pzSeo['title'];?>"><img class="fl" src="<?php echo $webSet['logo']?$webSet['logo']:'/pz178/img/logo.png';?>" alt="<?php echo $pzSeo['title'];?>"></a></h1>
                <ul class="bnav">
                   <li<?php echo (request()->path() == '/')?' class="selected"':'';?>><a href="http://<?php echo request()->host();?>/" title="<?php echo $webSet['title'];?>首页">首页</a></li>
                   
                   <li <?php echo (stristr(request()->path(),'newsinf')||stristr(request()->path(),'zx'))?' class="selected"':'';?>><a href="<?php echo url('zx/0');?>" title="股市资讯-<?php echo $webSet['title'];?>">股市资讯</a></li>
                   <?php if($webSet['id']==2){?>
                   <li<?php echo (stristr(request()->path(),'zt/'))?' class="selected"':'';?>><a href="<?php echo url('zt/0');?>" title="股票专题-<?php echo $webSet['title'];?>">股票专题</a></li>
                   <?php }?>
                   <li<?php echo (stristr(request()->path(),'gp24'))?' class="selected"':'';?>><a href="<?php echo url('gp24/0');?>" title="财经资讯-<?php echo $webSet['title'];?>">财经资讯</a></li>
                   <li<?php echo (stristr(request()->path(),'gp/pf'))?' class="selected"':'';?>><a href="<?php echo url('gp/pf');?>" title="股票配资免息投顾-<?php echo $webSet['title'];?>">免息投顾</a></li>
                   <li<?php echo (stristr(request()->path(),'gp/pd'))?' class="selected"':'';?>><a href="<?php echo url('gp/pd');?>" title="股票配资按天投顾-<?php echo $webSet['title'];?>">按天投顾</a></li>
                   <li style="position:relative;" class="selected">
                        <a href="<?php echo url('gp/pz');?>" title="股票配资按月投顾-<?php echo $webSet['title'];?>">按月投顾</a>
                        <img src="__IMGPZ__/gp-sy-hot.png" alt="股票配资按月投顾-<?php echo $webSet['title'];?>"/>
                    </li>
                    <li<?php echo (stristr(request()->path(),'qh/'))?' class="selected"':'';?>><a href="<?php echo url('qh/in');?>" title="期货配资-<?php echo $webSet['title'];?>">期货配资</a></li>
                </ul>
                <a href="<?php echo url('pzu/inf');?>" rel="nofollow" class="myasset" title="用户中心-<?php echo $webSet['title'];?>"><img src="__IMGPZ__/MyAsset.png" alt="用户中心-<?php echo $webSet['title'];?>" /></a>
          </div>
        </div>
    </div>
