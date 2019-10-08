<!DOCTYPE html>
<html>
	<head>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="content-language" content="zh-CN" />
        <meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="telephone=no" name="format-detection">
        <meta name="applicable-device"content="mobile">
        <!-- 微软的老式浏览器 -->
        <meta name="MobileOptimized" content="320">
        <!-- QQ强制竖屏 -->
        <meta name="x5-orientation" content="portrait">
        <!-- QQ强制全屏 -->
        <meta name="x5-fullscreen" content="true">
        <!-- UC强制全屏 -->
        <meta name="full-screen" content="yes">
        <!-- UC应用模式 -->
        <meta name="browsermode" content="application">
        <!-- QQ应用模式 -->
        <meta name="x5-page-mode" content="app">
        <!-- windows phone 点击无高光 -->
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="format-detection" content="email=no" />
        
        <title><?php echo $webseo['title'];?></title>
        
        <link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" />
        <meta name="keywords" content="<?php echo $webseo['keywords'];?>" />
        <meta name="description" content="<?php echo $webseo['description'];?>" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="<?php echo $webseo['title'];?>">
        <meta property="og:title" content="<?php echo $webseo['title'];?>">
        <meta property="og:description" content="<?php echo $webseo['description'];?>">
        <meta property="og:url" content="<?php echo request()->url(true);?>">
        
		<link rel="stylesheet" type="text/css" href="__CSS__/base.css" />
		<link rel="stylesheet" type="text/css" href="__CSS__/icon.css" />
		<link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css">
		<link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" />
		<script type="text/javascript" src="__JS__/swiper.min.js"></script>
		<script type="text/javascript" src="__JS__/layer/layer.js" ></script>
		<script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script>
		<script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script>
		<script type="text/javascript" src="__JS__/common.js" ></script>
        <script type="text/javascript">
			var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';}
		</script>
		
	</head>
	<body>
    <img style="display:none;" src="__IMG__/icon300.png">
		
        

		
	