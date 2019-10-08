{include file="common/header" /}
<style>
.dingdan_queren_btn{position: unset;}
.sp_lists li{ width:31%;}
.sp_lists li .sp_img{ height:10rem;}
.home_jiu nav{ margin-top:0.2rem;}
</style>
<section class="ds_home">
<section class="ds_home_head">
  <h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a><span id="adrtitle">租书会 ● vip月卡</span></h2>
</section>
<!--占位-->
<section class="zhanwei_hei35"></section>
<section class="zhanwei_hei01"></section>
<!--轮播-->
<section> <img src="__IMG__/yoqing0.jpg" alt="<?php echo $webseo['title'];?>"> </section>
<section class="dingdan_queren_btn">
  <a href="<?php echo url('login/reg').'?i='.$i;?>"><p>免费租5本图书30天</p></a>
</section>
<!--分类-->
<section class="home_jiu">
  <?php foreach($gradegood as $key=>$val){?>
  <nav class="home_baijiu">
    <h3 class="clearfix"> <span class="fl"></span>
      <p class="fl"><?php echo $val['name'];?></p>
      <a href="<?php echo url('list/1-0-0-'.$key);?>" class="fr">更多<i class="icon-right"></i></a> </h3>
    <ul class="clearfix sp_lists grade<?php echo $key;?>" id="home_sp_lists">
      <?php foreach($val['goods'] as $k=>$v){?>
      <a href="<?php echo url('goods/'.$v['gno']);?>">
      <li class="fl"> <img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" alt="<?php echo $v['name'];?>" />
        <div class="sp_lists_word">
          <h4><?php echo $v['name'];?></h4>
          <h5><?php echo $v['recommend'];?></h5>
          <p class="clearfix"> <span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span> <img class="fr buy_btn" src="__IMG__/shop_car1.png"></img> </p>
        </div>
      </li>
      </a>
      <?php }?>
    </ul>
  </nav>
  <h2 class="xiao_title" data-g="<?php echo $key;?>">—— 换一批 ——</h2>
  <?php }?>
</section>
<script type="text/javascript" src="__JS__/jweixin-1.4.0.js" ></script> 
<script type="text/javascript">
		$(document).ready(function(){
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});
			
			$('.xiao_title').click(function(){
				var gn = $(this).data('g');
				$.ajax({
					url: "/api/getglists.html",
					data: {gn:gn,i:Math.random()},
					type: "post",
					dataType: "json",
					success: function(data) {
					  if(data.status == 200){
						$('.grade'+gn).html(data.html);
						$("img.lazy").lazyload({effect: "show"});
					  }else{
						layer.open({skin:'msg',content: data.msg,time:2});
					  }
					}
				})
			})
			
		});
		
		//获取判断浏览器用的对象
		var ua = window.navigator.userAgent.toLowerCase(); 
		if (ua.match(/MicroMessenger/i) == "micromessenger") {
			//自定义"分享给朋友"及"分享到QQ"按钮的分享内容（1.4.0）
			//自定义"分享到朋友圈"及"分享到QQ空间"按钮的分享内容（1.4.0）
			var wxtitle = '<?php echo $webseo['title'];?>',wxdesc = '<?php echo $webseo['description'];?>';
			var wximgUrl = '<?php echo 'https://'.request()->host().'/mall/img/icon300.png';?>',wxlink = '<?php echo url('zt/reg').'?i='.$i;?>';
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