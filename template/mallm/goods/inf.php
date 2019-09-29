{include file="common/header" /}
        <script type="text/javascript" src="__JS__/shopcar.js" ></script>
        <script type="text/javascript" src="__JS__/jweixin-1.4.0.js" ></script>
		<section>
			<div class="xiangqing_head_box">
				<ul class="clearfix term_nav">
					<p class="fl lef">.</p>
					<li class="fl cen on"><a href="#section1">商品</a></li>
                    <li class="fl cen" style="display:none;"><a href="#section2">详情</a></li>
					<li class="fl cen"><a href="#section3">详情</a></li>
					<li class="fl cen"><a href="#section4">推荐</a></li>
					<p class="fl rig">.</p>
				</ul>
			</div>
			<section class="term_box" id="section1">
				<!--轮播图-->
				<div class="xiangqing_lunbo">
					<section class="ds_xq_head">
						<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>
						<span class="more_btn" >
							<img src="__IMG__/more.png" value="0"/>
						</span>
						<p class="foot_lists_car">
							<em id="num">0</em>
							<a href="<?php echo url('cart/index');?>"><img class="shopping-cart" src="__IMG__/shop_car.png"></a>
						</p>
					</section>
					<div class="swiper-container">
						<ul class="swiper-wrapper">
                        	<!--<li class="swiper-slide">
                            <video class="lib-video" style=" width:375px; height:28rem" controlslist="" controls="controls" type="video/mp4" src="//cloud.video.taobao.com/play/u/993985578/p/2/e/6/t/1/214379579019.mp4" data-spm-anchor-id="a2615.12330364.autotrace-bestOffer.i1.4fa11739nd6BfL">
您的浏览器不支持 video 标签。
</video></li>-->
                        
				            <?php $gpicarr = json_decode(base64_decode($ginf['pic']),true);foreach($gpicarr as $v){?>
                            <li class="swiper-slide">
                                <img src="<?php echo $v;?>">
                            </li>
                            <?php }?>
                            
						</ul>
						<div class="swiper-pagination"></div>
					</div>
					<!--商品名，简介-->
					<div class="xiangqing_jianjie">
						<h1><?php echo $ginf['name'];?></h1>
						<h3><?php echo $ginf['recommend'];?></h3>
						<h2><em>￥<?php echo number_format($ginf['sales_price']/100,2);?></em>&nbsp;&nbsp;<i>￥<?php echo number_format($ginf['market_price']/100,2);?></i></h2>
					</div>
				</div>
			</section>
			<!--<section class="term_box" id="section2">
				<div class="xiangqing_canshu">
					<div class="xiangqing_pinglun">
						<h4 class="clearfix">
							<span class="fl">评价(520)</span>
							<em class="fr">查看全部评价</em>
						</h4>
						<ul>
							<li>
								<div class="clearfix pinglun_user">
									<img class="fl" src="__IMG__/yangtu.jpg">
									<span class="fl">张三李四</span>
								</div>
								<div class="pinglun_word">
									<div class="clearfix pinglun_word_son">
										<div class="fl">
											<div class="tbpj-a1-b1">
												<div id="star1">
													<img src="__IMG__/star-on-big.png" alt="1" title="10">
													<img src="__IMG__/star-on-big.png" alt="2" title="20">
													<img src="__IMG__/star-on-big.png" alt="3" title="30">
													<img src="__IMG__/star-on-big.png" alt="4" title="40">
													<img src="__IMG__/star-on-big.png" alt="5" title="50">
													<input type="hidden" name="score" value="5">
												</div>
												<div id="result1" style="display:none;">50</div>
											</div>
										</div>
										<em class="fr">2019-06-19</em>
									</div>
									<p>这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！</p>
								</div>
							</li>
							<li>
								<div class="clearfix pinglun_user">
									<img class="fl" src="__IMG__/yangtu.jpg">
									<span class="fl">张三李四</span>
								</div>
								<div class="pinglun_word">
									<div class="clearfix pinglun_word_son">
										<div class="fl">
											<div class="tbpj-a1-b1">
												<div id="star1">
													<img src="__IMG__/star-on-big.png" alt="1" title="10">
													<img src="__IMG__/star-on-big.png" alt="2" title="20">
													<img src="__IMG__/star-on-big.png" alt="3" title="30">
													<img src="__IMG__/star-on-big.png" alt="4" title="40">
													<img src="__IMG__/star-on-big.png" alt="5" title="50">
													<input type="hidden" name="score" value="5">
												</div>
												<div id="result1" style="display:none;">50</div>
											</div>
										</div>
										<em class="fr">2019-06-19</em>
									</div>
									<p>这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！</p>
								</div>
							</li>
							<li>
								<div class="clearfix pinglun_user">
									<img class="fl" src="__IMG__/yangtu.jpg">
									<span class="fl">张三李四</span>
								</div>
								<div class="pinglun_word">
									<div class="clearfix pinglun_word_son">
										<div class="fl">
											<div class="tbpj-a1-b1">
												<div id="star1">
													<img src="__IMG__/star-on-big.png" alt="1" title="10">
													<img src="__IMG__/star-on-big.png" alt="2" title="20">
													<img src="__IMG__/star-on-big.png" alt="3" title="30">
													<img src="__IMG__/star-on-big.png" alt="4" title="40">
													<img src="__IMG__/star-on-big.png" alt="5" title="50">
													<input type="hidden" name="score" value="5">
												</div>
												<div id="result1" style="display:none;">50</div>
											</div>
										</div>
										<em class="fr">2019-06-19</em>
									</div>
									<p>这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！这个东西好啊，好的不得了啊！</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</section>-->
			<section class="term_box" id="section3">
				<!--商品详情图片-->
				<div class="xiangqing_tupian">
					<h2 class="xiao_title">—— 详情 ——</h2>
                    <ul>
						<?php foreach($listattr as $vo){?>
                        <li class="clearfix">
							<span class="fl"><?php echo $listcatattr[$vo['attrid']];?></span>
                            <?php foreach($vo['items'] as $v){?>
							<p class="fl"><?php echo $listcatattri[$v['attriid']];?></p>
                            <?php }?>
						</li>
                        <?php }?>
					</ul>
					<div class="xiangqing_detail">
                    <?php echo htmlspecialchars_decode($ginf['desc']);?>
                    </div>
				</div>
			</section>
			<section class="term_box" id="section4">
				<!--详情推荐-->
				<h2 class="xiao_title">—— 推荐 ——</h2>
				<nav class="sousuo_lists" style="background:#fff;">
					<ul class="clearfix sp_lists">
                        <?php foreach($listchot as $k=>$v){?>
                        <a href="<?php echo url('goods/'.$v['gno']);?>">
                        <li class="<?php echo $k%2<1?'fl':'fr';?>">
							<img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" />
							<div class="sp_lists_word">
								<h4><?php echo $v['name'];?></h4>
								<h5><?php echo $v['recommend'];?></h5>
								<p class="clearfix">
									<span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
                        </a>
                        <?php }?>
					</ul>
				</nav>
			</section>
		</section>
		<!--占位-->
		<section class="zhanwei_hei45"></section>
		<section class="xq_join_car clearfix">
        	<div class="share_btn1 fl">
				<i class="icon-share"></i>
				<h6>分享</h6>
			</div>
            <div class="follow_btn1 fl gcollect<?php echo empty($collectgood)?'':' red';?>">
                <i class="icon-collect"></i>
                <h6 class="spcxs"><?php echo empty($collectgood)?'收藏':'取消收藏';?></h6>
            </div>
			<span class="fl xq_like_btn">立即<?php echo $ginf['cid']==1?'租阅':'购买'; ?></span>
			<p class="fr xq_join_btn">加入购物车</p>
		</section>
		<!--更多弹窗-->
		<section>
			<!--更多页面-->
			<div class="more_lists_ym">
				<ul class="more_lists">
					<a href="https://<?php echo request()->host();?>/">
						<li class="fl">
							<img src="__IMG__/home3.png"/>
							<p class="active">首页</p>
						</li>
					</a>
					<a href="<?php echo url('cat/index');?>">
						<li>
							<img src="__IMG__/fenlei3.png"/>
							<p>分类</p>
						</li>
					</a>
					<a href="<?php echo url('cart/index');?>">
						<li class="foot_lists_car">
							<img class="shopping-cart" src="__IMG__/shop_car4.png"/>
							<span id="num">0</span>
							<p>购物车</p>
						</li>
					</a>
					<a href="<?php echo url('uinf/index');?>">
						<li>
							<img src="__IMG__/wode3.png"/>
							<p>我的</p>
						</li>
					</a>
					<a href="<?php echo url('goods/track');?>">
						<li>
							<img src="__IMG__/jilu3.png"/>
							<p>足迹</p>
						</li>
					</a>
				</ul>
			</div>
			<!--立刻购买-->
			<div class="like_back"></div>
            <div class="like_shop_ym">
				<div class="like_posi_box">
					<div class="clearfix like_shop_xinxi">
						<img class="fl" src="<?php echo $gpicarr[0];?>">
						<div class="fl">
							<h2>￥<em id="gprices"><?php echo number_format($gspec['minp']/100,2).'-'.number_format($gspec['maxp']/100,2)?></em></h2>
							<h3>库存<em class="maxmun"><?php echo number_format($gspec['num']);?></em>件</h3>
							<p>已选
                            	<?php foreach($spec as $sk=>$sv){?>
                                	<input name="spec<?php echo $sk;?>" class="specv<?php echo $sk;?>" type="hidden" value="-1" />
                            		&nbsp;<i class="yanse_html spect<?php echo $sk;?>"><?php echo $sv['name'];?></i>
                            	<?php }?>
                            </p>
						</div>
						<i class="icon-close-o like_shop_close"></i>
					</div>
					<div class="like_shop_son">
						<?php foreach($spec as $sk=>$sv){?>
                        <div class="like_shop_yanse spec<?php echo $sk;?>">
							<h1><?php echo $sv['name'];?></h1>
							<ul class="clearfix">
								<?php foreach($sv['items'] as $k=>$v){?>
                                <li class="fl <?php echo 's'.$k;?>" data-key='<?php echo $k;?>' value='0'><?php echo $v['name'];?></li>
                                <?php }?>
							</ul>
						</div>
                        <?php }?>
                        <?php if($ginf['group'] == 9){?>
                        <div class="clearfix like_shop_num">
							<img class="fl" src="<?php echo $gpicarr[0];?>">
						</div>
                        <?php }else{?>
						<div class="clearfix like_shop_num">
							<span class="fl">购买数量</span>
							<p class="fr clearfix">
								<i class="like_jian fl">━</i>
								<input class="fl like_mun" value="1">
								<i class="like_jia fl">✚</i>
							</p>
						</div>
                        <!--占位-->
						<section class="zhanwei_hei45"></section>
                        <?php }?>
					</div>
                    <?php if($ginf['group'] != 9){?>
					<div class="like_goumai_btn clearfix">
						<span class="fl tc_gm_btn">立刻<?php echo $ginf['cid']==1?'租阅':'购买'; ?></span>
						<span class="fl tc_join_btn">加入购物车</span>
					</div>
                    <?php }?>
				</div>
			</div>
			
		</section>
	</body>
    
	<script type="text/javascript">
		//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
		$("img.lazy").lazyload({effect: "fadeIn"});
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
		
		//获取判断浏览器用的对象
		var ua = window.navigator.userAgent.toLowerCase(); 
		if (ua.match(/MicroMessenger/i) == "micromessenger") {
			//自定义"分享给朋友"及"分享到QQ"按钮的分享内容（1.4.0）
			//自定义"分享到朋友圈"及"分享到QQ空间"按钮的分享内容（1.4.0）
			var wxtitle = '<?php echo $webseo['title'];?>',wxdesc = '<?php echo $ginf['recommend'];?>';
			var wximgUrl = '<?php echo 'https://'.request()->host().$gpicarr[0];?>',wxlink = '<?php echo url('/goods/'.$ginf['gno']);?>';
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
		
		var pdata = {<?php foreach($listcsp as $k=>$v){ echo $k?',':''; echo 's'.str_replace('|','s',$v['key']);?>:<?php echo '"'.number_format($v['price']/100,2).'"';}?>};
		var ndata = {<?php foreach($listcsp as $k=>$v){ echo $k?',':''; echo 's'.str_replace('|','s',$v['key']);?>:<?php echo '"'.number_format($v['num']).'"';}?>};
		var spnum = <?php echo count($spec);?>,gno = <?php echo $ginf['gno'];?>;
		
		</script>
        <script type="text/javascript" src="__JS__/goodsinf.js" ></script>
        <script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script>
</html>
