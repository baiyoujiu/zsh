{include file="common/header" /}
<section class="sc_home">
    <section class="ds_home_head">
        <h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a><span id="adrtitle">租书会 ● 租借驿站</span></h2>
    </section>
    <section class="zhanwei_hei35"></section>
    <section class="zhanwei_hei01"></section>
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
     <!--租借驿站-->      
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
            <?php foreach($lists as $k =>$v){ ?>
                <li class="right">
                    <div class="stagelists" data-pic="<?php echo $k;?>">
                        <p><b><?php echo $v['area'];?></b> <span class="fr" ><i class="icon-location"></i>地图</span></p>
                        <p><?php echo $v['address'];?></p>
                    </div>
                </li>
                <?php if($v['pic']){?>
                <li class="picshow pic<?php echo $k;?>" style="display:none;"><img src="<?php echo $v['pic'];?>" /></li>
            <?php }}?>
        </ul>
    </section>
    <section class="zhanwei_hei01"></section>


<!--选择地址-->
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
	$(document).ready(function(){
		$('.picshow').hide();
		$('#area').change(function(){
			var area = $(this).val();
			window.location.href = '/goods/stage.html?area='+area;
		})
	
		$('.stagelists').click(function(){
			$('.picshow').hide();
			$('.pic'+$(this).data('pic')).show();
		});
	
		$('.stagelists:first').click();
	})
	
	//获取判断浏览器用的对象
	var ua = window.navigator.userAgent.toLowerCase(); 
	if (ua.match(/MicroMessenger/i) == "micromessenger") {
		//自定义"分享给朋友"及"分享到QQ"按钮的分享内容（1.4.0）
		//自定义"分享到朋友圈"及"分享到QQ空间"按钮的分享内容（1.4.0）
		var wxtitle = '<?php echo $webseo['title'];?>',wxdesc = '<?php echo $webseo['description'];?>';
		var wximgUrl = '<?php echo 'https://'.request()->host().'/mall/img/icon300.png';?>',wxlink = '<?php echo url('goods/stage');?>';
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
{include file="common/footer" /}

