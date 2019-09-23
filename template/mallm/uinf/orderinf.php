{include file="common/header" /}

		<section class="dd_home">
			<h2 class="fanhui_head">
				<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>订单详情
			</h2>
		</section>
		<!--占位-->
		<section class="zhanwei_hei35"></section>
		<!--订单状态-->
		<section>
			<div class="dingdan_zt">
				<h2><?php echo $info['pay_status']==1?'待付款':$statusArr[$info['status']];?></h2>
				<h3><?php echo $info['pay_status']==1?'订单等待支付':$statusinfArr[$info['status']];?></h3>
			</div>
		</section>
		<!--收货地址-->
		<section>
			<div class="clearfix dingdan_dizhi">
				<div class="fl dingdan_dizhi_xinxi">
					<h1><?php $adrinf = json_decode(base64_decode($info['address']),true); echo $adrinf['recname'];?>　<em><?php echo $adrinf['phone'];?></em></h1>
					<p><?php echo $arealist[$adrinf['province']].$arealist[$adrinf['city']].$arealist[$adrinf['area']].$arealist[$adrinf['street']].'　'.($adrinf['school']?$arealist[$adrinf['address']]:$adrinf['address']);?></p>
				</div>
			</div>
		</section>
		<!--商品详情-->
		<section class="dingdan_shop_ym">
			<ol>
				<li>
					
					<ul class="dingdan_shop_lists">
						<?php $goodarr = json_decode(base64_decode($info['order_good']),true);foreach($goodarr as $gv){?>
                        <a href="<?php echo url('goods/'.$gv['gno']);?>">
                        <li class="dingdan_shop clearfix">
							<img class="fl lazy" data-original="<?php echo $gv['pic'];?>"/>
							<div class="fr dingdan_shop_xin">
								<h2><?php echo $gv['name'];?></h2>
								<p><em><?php echo $gv['keyv'];?></em></p>
								<h3 class="clearfix">
									<span class="fl">￥<?php echo number_format($gv['price']/100,2);?></span>
									<i class="fr"><?php echo $gv['num'];?>件</i>
								</h3>
							</div>
						</li>
                        </a>
                        <?php }?>
						
					</ul>
					<div class="clearfix dingdan_xiaoji">
						<p class="fr">小计:<i>￥<?php echo number_format($info['amount']/100,2);?></i></p>
						<em class="fr">共<?php echo $info['goodnum']?>件</em>
					</div>
				</li>
			</ol>
		</section>
        <?php if($info['group']){?>
		<!--订单拼团人员-->
		<section class="xq_pt_lists">
			<div class="clearfix">
				<span class="fl">拼单成功</span>
				<a href="<?php echo url('uinf/orderpinf');?>">
                <p class="fr clearfix">
					<img class="fl" src="__IMG__/check1.png" />
					<img class="fl" src="__IMG__/check1.png" />
					<i class="fl icon-right"></i>
				</p>
                </a>
			</div>
		</section>
        <?php }?>
		<!--订单信息-->
		<section class="dingdan_xinxi">
			<ul class="dingdan_xinxi_lists">
				<li class="clearfix">
					<span class="fl">订单编号</span>
					<p class="fr"><?php echo $info['order_no'];?></p>
				</li>
				<li class="clearfix">
					<span class="fl">下单时间</span>
					<p class="fr"><?php echo $info['order_time'];?></p>
				</li>
				<li class="clearfix">
					<span class="fl">商品金额</span>
					<p class="fr">￥<?php echo number_format($info['good_amount']/100,2);?></p>
				</li>
				<li class="clearfix">
					<span class="fl">运费</span>
					<p class="fr">￥<?php echo number_format($info['freight']/100,2);?></p>
				</li>
				<li class="clearfix">
					<h6 class="fr">￥<?php echo number_format($info['amount']/100,2);?></h6>
					<h5 class="fr">总价：</h5>
				</li>
			</ul>
		</section>
		<!--占位-->
		<section class="zhanwei_hei50"></section>
		<section class="dingdan_queren_btn clearfix">
			<em class="fr">再次购买</em>
			<span class="fr">删除订单</span>
		</section>
    <script>
	//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
	$("img.lazy").lazyload({effect: "fadeIn"});
	</script>
	</body>
</html>
