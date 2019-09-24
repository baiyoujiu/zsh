{include file="common/header" /}
<section class="ds_home">
<!--head-->
<section class="ds_home_head shop_car_title">
  <h2><a href="javascript:history.back(-1);"><i class="icon-left"></i></a><?php echo $webseo['title'];?><em class="delete more_btn"><img src="__IMG__/more.png" value="0"/></em></h2>
</section>

<!--占位-->
<section class="zhanwei_hei40"></section>
<!--轮播-->
<section>
  <div class="keben_lunbo">
    <div class="swiper-container">
      <ul class="swiper-wrapper">
      	<?php for($p=0; $p<=$info['booknum']; $p++){?>
        <li class="swiper-slide"><img src="/images/keben/<?php echo $info['pic'].$p;?>.jpg" alt="<?php echo $webseo['title'];?>"></li>
        <?php } ?>
      </ul>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<section> 
  <!--更多页面-->
  <div class="more_lists_ym">
    <ul class="more_lists">
      <a href="https://<?php echo request()->host();?>/">
      <li class="fl"> <img src="__IMG__/home3.png"/>
        <p class="active">首页</p>
      </li>
      </a> <a href="<?php echo url('cat/index');?>">
      <li> <img src="__IMG__/fenlei3.png"/>
        <p>分类</p>
      </li>
      </a> <a href="<?php echo url('cart/index');?>">
      <li class="foot_lists_car"> <img class="shopping-cart" src="__IMG__/shop_car4.png"/> <span id="num">0</span>
        <p>购物车</p>
      </li>
      </a> <a href="<?php echo url('uinf/index');?>">
      <li> <img src="__IMG__/wode3.png"/>
        <p>我的</p>
      </li>
      </a> <a href="<?php echo url('goods/track');?>">
      <li> <img src="__IMG__/jilu3.png"/>
        <p>浏览历史</p>
      </li>
      </a>
    </ul>
  </div>
</section>
<script type="text/javascript" src="__JS__/jweixin-1.4.0.js" ></script> 
<script type="text/javascript">
$(document).ready(function(){
	//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
	$("img.lazy").lazyload({effect: "fadeIn"});
});

/*轮播*/
var swiper = new Swiper('.swiper-container', {
  centeredSlides: true,
  autoplay:false,
  pagination: {
	el: '.swiper-pagination',
	clickable: true,
  },
});

//获取判断浏览器用的对象
var ua = window.navigator.userAgent.toLowerCase(); 
if (ua.match(/MicroMessenger/i) == "micromessenger") {
	//自定义"分享给朋友"及"分享到QQ"按钮的分享内容（1.4.0）
	//自定义"分享到朋友圈"及"分享到QQ空间"按钮的分享内容（1.4.0）
	var wxtitle = '<?php echo $webseo['title'];?>',wxdesc = '<?php echo $webseo['description'];?>';
	var wximgUrl = '<?php echo 'https://'.request()->host().'/mall/img/icon.png';?>',wxlink = '<?php echo url('/books/'.$info['bno']);?>';
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