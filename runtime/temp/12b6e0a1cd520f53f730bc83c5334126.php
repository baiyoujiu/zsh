<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:33:"../template/mallm/goods\stage.php";i:1567996793;s:49:"D:\wamp\work\zsh\template\mallm\common\header.php";i:1567558230;s:49:"D:\wamp\work\zsh\template\mallm\common\footer.php";i:1567558230;}*/ ?>
<!DOCTYPE html><html><head><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="content-language" content="zh-CN" /><meta name="viewport" content="width=device-width,minimum-scale=1.00001,maximum-scale=1.00001,initial-scale=2.0,user-scalable=no"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta content="telephone=no" name="format-detection"><meta name="applicable-device"content="mobile"><meta name="MobileOptimized" content="320"><meta name="x5-orientation" content="portrait"><meta name="x5-fullscreen" content="true"><meta name="full-screen" content="yes"><meta name="browsermode" content="application"><meta name="x5-page-mode" content="app"><meta name="msapplication-tap-highlight" content="no"><meta name="format-detection" content="email=no" /><title><?php echo $webseo['title'];?></title><link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" /><meta name="keywords" content="<?php echo $webseo['keywords'];?>" /><meta name="description" content="<?php echo $webseo['description'];?>" /><meta property="og:type" content="website" /><meta property="og:site_name" content="<?php echo $webseo['title'];?>"><meta property="og:title" content="<?php echo $webseo['title'];?>"><meta property="og:description" content="<?php echo $webseo['description'];?>"><meta property="og:url" content="<?php echo request()->url(true);?>"><link rel="stylesheet" type="text/css" href="__CSS__/base.css" /><link rel="stylesheet" type="text/css" href="__CSS__/icon.css" /><link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css"><link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" /><script type="text/javascript" src="__JS__/swiper.min.js"></script><script type="text/javascript" src="__JS__/layer/layer.js" ></script><script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script><script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script><script type="text/javascript" src="__JS__/common.js" ></script><script type="text/javascript">var rem = 20/640*document.documentElement.clientWidth;document.documentElement.style.fontSize = rem+'px';window.onload=window.onresize=function(){ var rem = 20/640*document.documentElement.clientWidth;
document.documentElement.style.fontSize = rem+'px';}</script></head><body><img style="display:none;" src="__IMG__/icon.png">
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=xqltRQVqD5bh1G3NPyyQpuuTlgaYv4GR"></script>
<section class="sc_home">
    <section class="ds_home_head">
        <h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a><span id="adrtitle">租借驿站</span></h2>
    </section>
    <section class="zhanwei_hei35"></section>
    <section class="zhanwei_hei01"></section>
    <section>
        <ul class="add_dizhi_lists">
            <li class="right">
                <div class="fl add_address_list_sec" style=" width:49%">
                    <select class="pro_code" >
                        <option value="">浙江省杭州市</option>
                    </select>
                </div>
                <div class="add_address_list_sec fl" style=" width:49%">
                    <select class="areacode" name="area" id="area">
                        <?php foreach($alists as $k=>$v){?>
                            <option value="<?php echo $v['code'];?>"<?php echo $v['code']==$area?"selected='selected'":'';?>><?php echo $v['area'];?></option>
                        <?php }?>
                    </select>
                </div>
            </li>
            <?php foreach($lists as $k1 =>$v){ ?>
                <li class="right">
                    <div class="stagelists" type="hidden" href="javascript:void(0)" data-lo="<?php echo $v['longitude'];?>" data-la="<?php echo $v['latitude'];?>" data-ar="<?php echo $v['area'];?>" data-ad="<?php echo $v['address'];?>"  data-te="<?php echo $v['tel'];?>" id="xx">
                        <p><?php echo $v['area'];?> <span class="fr" ><i class="icon-location"></i>地图</span></p>
                        <p><?php echo $v['address'];?></p>
                    </div>
                </li>
            <?php }?>
        </ul>
    </section>
    <section class="zhanwei_hei01"></section>
    <section>
        <div class="mapinf" id="mapinf"></div>
    </section>

    <!--选择地址-->

<script type="text/javascript">

    $('#area').change(function(){
        var area = $(this).val();
        window.location.href = '/goods/stage.html?area='+area;
    })

	$('.stagelists').click(function(){
        var map = new BMap.Map("mapinf");   //创建地图实例
        map.enableScrollWheelZoom();        //启用滚轮放大缩小，默认禁用
        map.enableContinuousZoom();         //启用地图惯性拖拽，默认禁用
        var longitude=$.trim($(this).data('lo')),latitude=$.trim($(this).data('la')),area=$.trim($(this).data('ar')),address=$.trim($(this).data('ad')),tel=$.trim($(this).data('te'));
        var point = new BMap.Point(longitude,latitude);     //创建聚焦点（传值点）
        map.centerAndZoom(point,14);        //中心点和缩放等级
        var data_info = [
            <?php foreach($lists as $k=>$v){
            echo $k?',':'';
            echo '['.$v['longitude'].','.$v['latitude'].',"'.$v['area'].'<br>'.$v['address'].'<br>驿站图书租还时间(9:00—17:30)"]';
            }?>
        ];                                  //打印需要的地图点
        for(var i=0;i<data_info.length;i++){
            var marker = new BMap.Marker(new BMap.Point(data_info[i][0],data_info[i][1]));  // 创建标注
            var content = data_info[i][2];
            map.addOverlay(marker);         //添加标注
            addClickHandler(content,marker);
        }
        var opts = {         // 创建信息窗口
            width : 200,     // 信息窗口宽度
            height: 105,     // 信息窗口高度
            title :'租借驿站', // 信息窗口标题
        }
        function addClickHandler(content,marker){
            marker.addEventListener("click",function(e){        //添加click事件
                openInfo(content,e)}
            );
        }
        function openInfo(content,e){
            var p = e.target;
            var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
            var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象
            map.openInfoWindow(infoWindow,point); //开启地图点击信息窗口
        }
        var infoWindow = new BMap.InfoWindow(area+'<br>'+address+'<br>驿站图书租还时间(9:00—17:30)',opts);  // 创建信息窗口对象
        map.openInfoWindow(infoWindow,point); //开启默认信息窗口
        marker.addEventListener("click", function(){
            map.openInfoWindow(infoWindow,point); //开启驿站点击信息窗口
        });
	});

    $('.stagelists:first').click();
</script>
<!--占位-->
<section class="zhanwei_hei55"></section>
<section><ul class="clearfix foot_lists"><a href="https://<?php echo request()->host();?>/"><li class="fl"><img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/><p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p></li></a><a href="<?php echo url('cat/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/><p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p></li></a><a href="<?php echo url('cart/index');?>"><li class="fl foot_lists_car"><img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/><span id="num">0</span><p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p></li></a><?php if(isset($userinfo) && $userinfo['username']){?><a href="<?php echo url('uinf/index');?>"><li class="fl"><img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/><p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p></li></a><?php }else{?><a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow"><li class="fl"><img src="__IMG__/wode1.png"/><p class="active">登陆</p></li></a><?php }?></ul></section></section><script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body></html>

