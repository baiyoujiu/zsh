{include file="common/header" /}
		<script>
			$(function(){
				//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
				$("img.lazy").lazyload({effect: "fadeIn"});
				$('.pingtuan_persons').click(function(){
					$('.pt_xq_tc').show();
					$('.like_back').show();
				});
				$('.pt_xq_tc .icon-close-o').click(function(){
					$('.pt_xq_tc').hide();
					$('.like_back').hide();
				});
			});
		</script>

	<section class="zuji_ym">
		<section class="dd_home">
			<h2 class="fanhui_head">
				<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>
				拼团详情
				<span class="more_btn">
					<img src="__IMG__/more.png" />
				</span>
			</h2>
		</section>
		<!--占位-->
		<section class="zhanwei_hei40"></section>
		<!--拼团人数-->
		<section class="pingtuan_persons">
			<ul class="clearfix">
				<li><p>拼团成功</p></li>
				<li>
					<label><img src="__IMG__/denglu_qq.png"/><i>拼主</i></label>
					<img src="__IMG__/denglu_qq.png"/>
					<img src="__IMG__/denglu_qq.png"/>
					<img src="__IMG__/denglu_qq.png"/>
				</li>
			</ul>
		</section>
		<!--推荐列表-->
		<section class="zuji_liebiao">
			<h2 class="xiao_title">—— 推荐 ——</h2>
			<nav class="sousuo_lists">
				<ul class="clearfix sp_lists">
					<?php foreach($listchot as $v){?>
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
		<!--占位-->
		<section class="zhanwei_hei40"></section>
		<!--更多弹窗-->
		<section>
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
							<p>浏览历史</p>
						</li>
					</a>
				</ul>
			</div>
		</section>
		<!--拼团详情弹窗-->
		<div class="like_back"></div>
		<section class="pt_xq_tc">
			<ul class="pt_xq_tc_lits">
				<div>
					<i class="icon-close-o"></i>
					<label>
						<img src="__IMG__/check1.png" />
						<em class="">拼主</em>
					</label>
					<p>看淡人生</p>
					<span>2019/07/19 15:09:09发起拼单</span>
				</div>
				<li class="clearfix">
					<img class="fl" src="__IMG__/check1.png" />
					<p class="fl">看淡人生</p>
					<span class="fr">2019/07/19 15:09:09拼单</span>
				</li>
				<li class="clearfix">
					<img class="fl" src="__IMG__/check1.png" />
					<p class="fl">看淡人生</p>
					<span class="fr">2019/07/19 15:09:09拼单</span>
				</li>
				<nav>已有3人参团</nav>
			</ul>
		</section>
	</section>
    </body>
</html>
