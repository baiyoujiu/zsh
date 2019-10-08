{include file="common/header" /}
<section class="sc_home">
    <!--head-->
    <section class="ds_home_head">
        <h2>个人中心 <a href="<?php echo url('uinf/uset');?>"><img class="delete" style="margin:0.7rem" src="__IMG__/uset.png"></a></h2>
    </section>
    <section class="zhanwei_hei30"></section>
    <section class="ds_wode_back">
        <div class="clearfix ds_wode_uname">
            <img class="fl" src="__IMG__/userdef.png" />
            <p class="fl"><?php echo decryptd($userinfo['username']);?><br><?php echo $userinfo['utype']==1?'非租书会成员':'租书会成员<img src="__IMG__/zshvip.png">';?></p>
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
    	<?php
            $amun = $unpay = $unsend = $unsh = $end = 0;
			foreach($olists as $v){
				$amun++;
				//1-下单，待确认|2-卖家确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
				switch ($v['status']) {
					case 1:
						if($v['pay_status'] == 1){
							$unpay++;
						}
						break;
					case 2:
					case 3:
						$unsend++;
						break;
					case 4:
						$unsh++;
						break;
					case 5:
					case 6:
					case 8:
					case 9:
						$end++;
						break;
					default:
						break;
				}
			}
			?>
        <ul class="clearfix personal_lists">
            <a href="<?php echo url('uinf/order');?>"><li class="fl">
                <img src="__IMG__/personal-img5.png">
                <?php echo $amun?'<span>'.$amun.'</span>':'';?>
                <p>全部订单</p>
            </li></a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img1.png">
                <?php echo $unpay?'<span>'.$unpay.'</span>':'';?>
                <p>待付款</p>
            </li>
            </a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img2.png">
                <?php echo $unsend?'<span>'.$unsend.'</span>':'';?>
                <p>待发货</p>
            </li>
            </a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img3.png">
                <?php echo $unsh?'<span>'.$unsh.'</span>':'';?>
                <p>待收货</p>
            </li>
            </a>
            <a href="<?php echo url('uinf/order');?>">
            <li class="fl">
                <img src="__IMG__/personal-img4.png">
                <?php echo $end?'<span>'.$end.'</span>':'';?>
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
                <img class="fl" src="__IMG__/icoyj.png"/>
                <p class="fl">图书租借押金</p>
                
                <em class="fr">￥&nbsp;<b><?php echo number_format($userinfo['balance']/100,2);?></b></em>
            </li>
            <?php }?>
            
            <a href="<?php echo url('uinf/rental');?>">
                <li class="clearfix">
                    <img class="fl" src="__IMG__/shuben.png"/>
                    <p class="fl">租借台<?php echo $glists?'　<b class="red">'.substr($glists[0]['rentend'],0,10).'日前待还'.count($glists).'本</b>':''?></p>
                    <i class="fr icon-right"></i>
                </li>
            </a>
            <a href="<?php echo url('uinf/coupon');?>">
                <li class="clearfix">
                    <img class="fl" src="__IMG__/icoyh.png"/>
                    <p class="fl">优惠券<?php echo $couponinf?'　<b class="red">'.($couponinf['amount']/100).'元租书劵　'.substr($couponinf['endtime'],0,10).'日到期</b>':'';?></p>
                    <i class="fr icon-right"></i>
                </li>
            </a>
          </ul>
     </section>

     <section>
     <ul class="clearfix personal_lists">
            <a href="<?php echo url('uinf/invite');?>">
            <li class="fl">
                <img src="__IMG__/invite.png"/>
                <p>邀请有奖</p>
                
            </li>
            </a>
            <a href="<?php echo url('goods/stage');?>">
            <li class="fl">
                <img src="__IMG__/icoyz.png"/>
                <p>租借驿站</p>
                
            </li>
            </a>
            <a href="<?php echo url('uinf/collect');?>">
            <li class="fl">
                <img src="__IMG__/icosc.png"/>
                <p>收藏</p>
                
            </li>
            </a>
            <a href="<?php echo url('uinf/address');?>">
                <li class="fl">
                    <img src="__IMG__/shouhuo.png"/>
                    <p>收货地址</p>
                   
                </li>
            </a>
            <a href="<?php echo url('newsinf/7');?>">
            <li class="fl">
                <img src="__IMG__/shouhou.png"/>
                <p>客服与售后</p>
                
            </li>
            </a>
            
        </ul>
    </section>
    <!--轮播-->
	<section>
        <div class="home_lunbo">
            <div class="swiper-container">
                <ul class="swiper-wrapper">
                  <li class="swiper-slide"><a href="<?php echo url('goods/stage');?>" title="租借驿站-租书会"><img src="/images/books/bookszjlc.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('goods/191005100');?>" title="租书vip年卡/半年卡/季卡-租书会"><img src="__IMG__/banner00.jpg" alt="租书vip年卡/半年卡/季卡-租书会"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('ztinf/1001');?>" title="一年级必读经典书目-租书会"><img src="__IMG__/banner01.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('ztinf/1002');?>" title="二年级必读经典书目-租书会"><img src="__IMG__/banner02.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('ztinf/1003');?>" title="三年级必读经典书目-租书会"><img src="__IMG__/banner03.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('ztinf/1004');?>" title="四年级必读经典书目-租书会"><img src="__IMG__/banner04.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('ztinf/1005');?>" title="五年级必读经典书目-租书会"><img src="__IMG__/banner05.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                  <li class="swiper-slide"> <a href="<?php echo url('ztinf/1006');?>" title="六年级必读经典书目-租书会"><img src="__IMG__/banner6.jpg" alt="<?php echo $webseo['title'];?>"></a> </li>
                </ul>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!--退出登录-->
    <section>
        <div class="grzx_tcdl">
            <a href="<?php echo url('login/logout');?>"><p>退出登录</p></a>
        </div>
    </section>
<script type="text/javascript">
	/*轮播*/
	var swiper = new Swiper('.swiper-container', {
	  centeredSlides: true,
	  autoplay: {
		delay: 4000,
		disableOnInteraction: false,
	  },
	  pagination: {
		el: '.swiper-pagination',
		clickable: true,
	  },
	});
</script>
    
{include file="common/footer" /}