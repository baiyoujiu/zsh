{include file="common/header" /}
<style>
.home_jiu nav{ margin-top:0.2rem; margin-bottom:1rem;}
</style>
<section class="ds_home">
    <!--分类-->
    <section class="home_jiu">
        <img src="<?php echo $info['icon'];?>" alt="<?php echo $webseo['title'];?>">
		<?php foreach($lists as $v){?>
			<nav class="home_baijiu">
				<img src="<?php echo $v['icon'];?>" alt="<?php echo $webseo['title'];?>">
				<ul class="clearfix sp_lists" id="home_sp_lists">
					<?php foreach($gnolists[$v['id']] as $gn){?>
							<a href="<?php echo url('goods/'.$goodlist[$gn['gno']]['gno']);?>">
								<li class="fl">
									<img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($goodlist[$gn['gno']]['pic']),true);echo $picarr[0];?>" alt="<?php echo $catgoods[$v1['id']]['name'];?>" />
									<div class="sp_lists_word">
										<h4><?php echo $goodlist[$gn['gno']]['name'];?></h4>
										<h5><?php echo $goodlist[$gn['gno']]['recommend'];?></h5>
										<p class="clearfix">
											<span class="fl"><em>￥<?php echo number_format($goodlist[$gn['gno']]['sales_price']/100,2);?></em>/<?php echo $goodlist[$gn['gno']]['units'];?></span>
											<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
										</p>
									</div>
								</li>
							</a>
					<?php }?>
				</ul>
			</nav>
		<?php }?>
	</section>
    <!--占位-->
    <section class="zhanwei_hei45"></section>

	<script type="text/javascript" src="__JS__/jweixin-1.4.0.js" ></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});

		});
		//获取判断浏览器用的对象
		var ua = window.navigator.userAgent.toLowerCase();
		if (ua.match(/MicroMessenger/i) == "micromessenger") {
			//自定义"分享给朋友"及"分享到QQ"按钮的分享内容（1.4.0）
			//自定义"分享到朋友圈"及"分享到QQ空间"按钮的分享内容（1.4.0）
			var wxtitle = '<?php echo $webseo['title'];?>',wxdesc = '<?php echo $webseo['description'];?>';
			var wximgUrl = '<?php echo 'https://'.request()->host().'/mall/img/icon.png';?>',wxlink = '<?php echo 'https://'.request()->host().'/';?>';
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