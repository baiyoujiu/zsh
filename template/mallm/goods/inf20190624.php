{include file="common/header" /}
		<link rel="stylesheet" href="__CSS__/demo.css" />

		<script type="text/javascript" src="__JS__/demo.js" ></script>
		<script>
			$(function(){
				/*立刻购买,假如购物车*/
				$('.xq_join_btn').click(function(){
					$('.like_back').show();
					$('.like_shop_ym').show();
					$('html,body').addClass('overHidden');
				});
				$('.xq_like_btn').click(function(){
					$('.like_back').show();
					$('.like_shop_ym').show();
					$('html,body').addClass('overHidden');
				});
				$('.like_shop_close').click(function(){
					$('.like_back').hide();
					$('.like_shop_ym').hide();
					$('html,body').removeClass('overHidden');
				});
				$('.like_back').click(function(){
					$('.like_back').hide();
					$('.like_shop_ym').hide();
					$('html,body').removeClass('overHidden');
				});
				/*选择颜色*/
				$('.like_shop_yanse li').click(function(){
					if($(this).val!=3){
						if($(this).val()==0){
							$('.like_shop_yanse li').removeClass('active');
							$(this).addClass('active');
							$('.like_shop_yanse li').val('0');
							$(this).val('1');
							$('.yanse_html').html($(this).html());
						}else if($(this).val()==1){
							$('.like_shop_yanse li').removeClass('active');
							$(this).removeClass('active');
							$(this).val('0');
							$('.yanse_html').html("颜色分类");
						}else if($(this).val()==3){
							$(this).val('3');
						}
					}else{
						return;
					}
				});
				/*选择尺寸*/
				$('.like_shop_chicun li').click(function(){
					if($(this).val()==0){
						$('.like_shop_chicun li').removeClass('active');
						$(this).addClass('active');
						$('.like_shop_chicun li').val('0');
						$(this).val('1');
						$('.chicun_html').html($(this).html());
					}else if($(this).val()==1){
						$('.like_shop_chicun li').removeClass('active');
						$(this).removeClass('active');
						$(this).val('0');
						$('.chicun_html').html("参考尺寸");
					}
				});
				//数量加
				$(".like_jia").click(function(){
					var multi=0;
					var vall=$(this).prev().val();
					var maxmun=$('.maxmun').text();
					vall++;
					if(vall>maxmun){
						vall=maxmun;
						layer.open({
						    content: '太多了吧'
						    ,skin: 'msg'
						    ,time: 3 //3秒后自动关闭
					  	});
					}
					$(this).prev().val(vall);
				});
				//数量减
				$(".like_jian").click(function(){
					var multi=0;
					var vall=$(this).next().val();
					var maxmun=$('.maxmun').text();
					vall--;
					if(vall<=maxmun){
						vall=1;
						layer.open({
						    content: '不能再减了'
						    ,skin: 'msg'
						    ,time: 3 //3秒后自动关闭
					  	});
					}
					$(this).next().val(vall);
				});
				/*确认购买或假如*/
				$('.like_goumai_btn span').click(function(){
					if($('.yanse_html').text()=='颜色分类'){
						layer.open({
						    content: '请选择颜色'
						    ,skin: 'msg'
						    ,time:1
					  	});
					}else if($('.chicun_html').text()=='参考尺寸'){
			        	layer.open({
						    content: '请选择尺寸'
						    ,skin: 'msg'
						    ,time:1
					  	});
					}else{
						layer.open({
						    content: '加入成功'
						    ,skin: 'msg'
						    ,time:1 
					  	});
					}
				});
			});
		</script>

		<section>
			<div class="xiangqing_head_box">
				<ul class="clearfix term_nav">
					<p class="fl lef">.</p>
					<li class="fl cen on"><a href="#section1">商品</a></li>
					<li class="fl cen"><a href="#section2">评价</a></li>
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
				            <?php $picarr = json_decode(base64_decode($ginf['pic']),true);foreach($picarr as $v){?>
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
			<section class="term_box" id="section2">
				<div class="xiangqing_canshu">
					<!--商品评价-->
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
			</section>
			<section class="term_box" id="section3">
				<!--商品详情图片-->
				<div class="xiangqing_tupian">
					<h2 class="xiao_title">—— 详情 ——</h2>
					<ul>
						<li class="clearfix">
							<span class="fl">品牌</span>
							<p class="fl">北京奔驰</p>
						</li>
						<li class="clearfix">
							<span class="fl">产地</span>
							<p class="fl">北京</p>
						</li>
						<li class="clearfix">
							<span class="fl">净含量</span>
							<p class="fl">1200g</p>
						</li>
						<li class="clearfix">
							<span class="fl">存储条件</span>
							<p class="fl">常温/冷藏</p>
						</li>
					</ul>
					<div class="xiangqing_detail">
						哈哈哈哈哈哈哈哈
						<img src="../img/yangtu.jpg" />
						<img src="../img/yangtu.jpg" />
						哈哈哈哈哈哈哈哈
						<img src="../img/yangtu.jpg" />
						哈哈哈哈哈哈哈哈
					</div>
				</div>
			</section>
			<section class="term_box" id="section4">
				<!--详情推荐-->
				<h2 class="xiao_title">—— 推荐 ——</h2>
				<nav class="sousuo_lists" style="background:#fff;">
					<ul class="clearfix sp_lists">
						<li class="fl">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fr">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fl">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fr">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fl">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fr">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fl">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
						<li class="fr">
							<img class="sp_img" src="__IMG__/yangtu.jpg" />
							<div class="sp_lists_word">
								<h4>贵州茅台</h4>
								<h5>贵州茅台镇原粮白酒</h5>
								<p class="clearfix">
									<span class="fl"><em>￥520.00</em>/瓶(500ml)</span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
					</ul>
				</nav>
			</section>
		</section>
		<!--占位-->
		<section class="zhanwei_hei45"></section>
		<section class="xq_join_car clearfix">
			<span class="fl xq_like_btn">立即购买</span>
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
						<img class="fl" src="../img/yangtu.jpg">
						<div class="fl">
							<h2>￥<em>520.00-1314.00</em></h2>
							<h3>库存<em class="maxmun">5</em>件</h3>
							<p>选择&nbsp;<i class="yanse_html">颜色分类</i>&nbsp;<i class="chicun_html">参考尺寸</i></p>
						</div>
						<i class="icon-close-o like_shop_close"></i>
					</div>
					<div class="like_shop_son">
						<div class="like_shop_yanse">
							<h1>颜色分类</h1>
							<ul class="clearfix">
								<li class="fl" value='0'>白色红色</li>
								<li class="fl" value='0'>红色黑色</li>
								<li class="fl disabled" value='3'>绿色红色</li>
								<li class="fl" value='0'>蓝色黑色</li>
								<li class="fl" value='0'>灰色红色</li>
								<li class="fl" value='0'>黑色红色</li>
								<li class="fl" value='0'>白色红色</li>
								<li class="fl" value='0'>红色黑色</li>
								<li class="fl" value='0'>绿色红色</li>
								<li class="fl" value='0'>蓝色黑色</li>
								<li class="fl" value='0'>灰色红色</li>
							</ul>
						</div>
						<div class="like_shop_chicun">
							<h1>参考尺寸</h1>
							<ol class="clearfix">
								<li class="fl" value='0'>100cm</li>
								<li class="fl disabled" value='0'>110cm</li>
								<li class="fl" value='0'>120cm</li>
								<li class="fl" value='0'>130cm</li>
								<li class="fl" value='0'>140cm</li>
								<li class="fl" value='0'>150cm</li>
								<li class="fl" value='0'>100cm</li>
								<li class="fl" value='0'>110cm</li>
								<li class="fl" value='0'>120cm</li>
								<li class="fl" value='0'>130cm</li>
								<li class="fl" value='0'>140cm</li>
								<li class="fl" value='0'>150cm</li>
							</ol>
						</div>
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
					</div>
					<div class="like_goumai_btn clearfix">
						<span class="fl tc_gm_btn">立刻购买</span>
						<span class="fl tc_join_btn">加入购物车</span>
					</div>
				</div>
			</div>
		</section>
	</body>
	<script>
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
	    /*详情联动*/
	   $(function(){
			var posT = $(".header").height()+$(".banner_one").height();
		 	var overstepT = $(".term").height();
		 	var heigtPt = overstepT-$(".term_nav").height();
		 	
			var domH = $(".term_nav li").height();
			var domY,moveY,index,item_top;
			$(".term_nav").on({
		        touchstart: function (e) {
		            startY = e.originalEvent.targetTouches[0].pageY;
		        },
		        touchmove: function (e) {  
		        	e.preventDefault();          
		            $("body").on({
		                touchmove: function (e) {
		                    e.preventDefault();
		                }
		            });
		            domY = $(this).offset().top;
		            moveY = e.originalEvent.targetTouches[0].pageY;
					index = parseInt((moveY-domY)/domH);
					$(".term_nav li").eq(index).addClass("on").siblings().removeClass("on");
		        
					item_top=$('.term_box').eq(index).offset().top-100;
					$(window).scrollTop(item_top);
		        },
		        touchend: function () {
		        	$("body").off("touchmove")
		        }
		 	});
		 	$(".term_nav li").click(function(){
		 		$(this).addClass("on").siblings().removeClass("on");
		 		item_top = $('.term_box').eq($(this).index()).offset().top-100;
		 		$(window).scrollTop(item_top)
		 	})
		 	
		   	$(window).scroll(function(){
		   		if($(window).scrollTop()<=posT){
		   			$(".term_nav").css({
		   				"position":"fixed",
		   				"top":"-3.2rem",
		   				"display":"none",
		   				"transform": "translateY(0)",
		   			});
		   		}
		   		else if(posT<$(window).scrollTop()){
		   			$(".term_nav").css({
		   				"position":"fixed",
		   				"top":"0rem",
		   				"display":"block",
		   			});
		   			$('.more_lists_ym').hide();
		   			$('.more_btn img').val('0');
		   		}
		   		$('.term_box').each(function(){
		            var $details_item_top=$('.term_box').eq($(this).index()).offset().top;
		            var cs = $(".term_box").eq($(this).index()).height();
		            //console.log($details_item_top+" "+$(window).scrollTop())
		            if($details_item_top+cs-100>$(window).scrollTop()){
		                $('.term_nav li').removeClass('on');
		                $('.term_nav li').eq($(this).index()).addClass('on');
		                return false;
		            }
		        });
		   	})
	 	});
    </script>
</html>
