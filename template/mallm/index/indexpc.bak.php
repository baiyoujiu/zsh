<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="applicable-device"content="pc">
<title><?php echo $webseo['title'];?></title>
<link rel="shortcut icon" type="image/x-icon" href="__IMG__/icon.ico" />
<meta name="keywords" content="<?php echo $webseo['keywords'];?>" />
<meta name="description" content="<?php echo $webseo['description'];?>" />
<link rel="stylesheet" type="text/css" href="__CSS__/base.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/icon.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css">
<link rel="stylesheet" type="text/css" href="__CSS__/ds_phone.css" />
<script type="text/javascript" src="__JS__/swiper.min.js"></script>
<script type="text/javascript" src="__JS__/layer/layer.js" ></script>
<script type="text/javascript" src="__JS__/jquery-1.11.1.min.js" ></script>
<script type="text/javascript" src="__JS__/jquery.lazyload.js" ></script>
<script type="text/javascript" src="__JS__/common.js" ></script>
</head>
<body>
<style>
body{ max-width:1080px; margin:0 auto;}
.dd_home {position: inherit;}
</style>
<section class="ds_home">
  <section class="dd_home">
    <h2 class="fanhui_head"><a href="<?php echo 'https://'.request()->host().'/';?>" title="租好会-读好书，租经典"><img src="__IMG__/logo.png" alt="租好会-读好书，租经典"></a></h2>
  </section>
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
      <li class="fl"> <img class="lazy" data-original="<?php echo $v['icon'];?>" alt="<?php echo $v['name'];?>"/>
        <p><?php echo $v['name'];?></p>
      </li>
      </a>
      <?php }?>
    </ul>
    <!--白酒-->
    <?php foreach($listscat as $key=>$val){?>
    <nav class="home_baijiu" id="cat<?php echo $key;?>">
      <h3 class="clearfix"> <span class="fl"></span>
        <p class="fl"><?php echo $val['name'];?></p>
        <a href="#" class="fr">更多<i class="icon-right"></i></a> </h3>
      <ul class="clearfix sp_lists" id="home_sp_lists">
        <?php foreach($catgoods[$key] as $k=>$v){?>
        <li class="fl"> <img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" alt="<?php echo $v['name'];?>" />
          <div class="sp_lists_word">
            <h4><?php echo $v['name'];?></h4>
            <h5><?php echo $v['recommend'];?></h5>
            <p class="clearfix"> <span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span> <img class="fr buy_btn" src="__IMG__/shop_car1.png"></img> </p>
          </div>
        </li>
        <?php }?>
      </ul>
    </nav>
    <?php }?>
  </section>
  <script>
		$(document).ready(function(){
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});
			//layer.open({skin:'msg',content: '该组合不存在，请重新选择！',time:1});
			
			$('.sp_img').mouseenter(function(){
				$(this).attr('src','/mall/img/mindex.png')
			})
			$('.sp_img').mouseleave(function(){
				$(this).attr('src',$(this).data('original'))
			})
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
    </script> 
</section>
</body>
</html>