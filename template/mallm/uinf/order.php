{include file="common/header" /}
		<section class="dd_home">
			<h2 class="fanhui_head"><a href="<?php echo url('uinf/index');?>"><i class="icon-left"></i></a>我的订单</h2>
		</section>
		<!--占位-->
		<section class="zhanwei_hei40"></section>
		<section class="dingdan_nav_list">
        	<?php
            $amun = $unpay = $unsend = $unsh = $end = 0;
			$unpayls = $unsendls = $unshls = $endls = array();
			foreach($lists as $v){
				$amun++;
				//1-下单，待确认|2-卖家确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
				switch ($v['status']) {
					case 1:
						if($v['pay_status'] == 1){
							$unpay++;
							$unpayls[] = $v;
						}
						break;
					case 2:
					case 3:
						$unsend++;
						$unsendls[] = $v;
						break;
					case 4:
						$unsh++;
						$unshls[] = $v;
						break;
					case 5:
					case 6:
					case 8:
					case 9:
					case 10:
						$end++;
						$endls[] = $v;
						break;
					default:
						break;
				}
			}
			?>
			<ul class="clearfix dingdan_lists">
				<li class="fl active">
					<i>全部</i>
                    <?php echo $amun?'<span>'.$amun.'</span>':'';?>
				</li>
				<li class="fl">
					<i>待付款</i>
					<?php echo $unpay?'<span>'.$unpay.'</span>':'';?>
				</li>
				<li class="fl">
					<i>待发货</i>
                    <?php echo $unsend?'<span>'.$unsend.'</span>':'';?>
				</li>
				<li class="fl">
					<i>待收货</i>
                    <?php echo $unsh?'<span>'.$unsh.'</span>':'';?>
				</li>
				<li class="fl">
					<i>已完成</i>
                    <?php echo $end?'<span>'.$end.'</span>':'';?>
				</li>
			</ul>
			<!--全部订单-->
			<nav style="display:block;">
				<ul class="qbdd_lists">
                	<?php if($amun<1){echo '<section class="dingdan_kong"><div>暂无订单！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($lists as $v){?>
                    
                    <li>
						<a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>">
                        <h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['order_time'],0,10);?></span>
							<em class="fr"><?php echo $v['status']==1?($v['pay_status']==1?'待付款':$statusArr[$v['status']]):$statusArr[$v['status']];?></em>
						</h3>
                        <?php $goodarr = json_decode(base64_decode($v['order_good']),true);foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo $gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl"><?php echo $gv['keyv'];?></span><em class="fr">×<?php echo $gv['num'];?></em></p>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>共<?php echo $v['goodnum']?>件</i><i><?php echo '(商)'.number_format($v['good_amount']/100,2);?><?php echo $v['freight']?' + (运)'.number_format($v['freight']/100,2):'';?><?php echo $v['camount']?' - (惠)'.number_format($v['camount']/100,2):'';?>,合计：<em>￥<?php echo number_format($v['amount']/100,2);?></em></i></p>
						</div>
                        </a>
						<div class="clearfix qbdd_lists_btns">
							<?php if($v['status'] == 1 && $v['pay_status'] == 1){?>
                            <a href="<?php echo url('pay/index').'?objno='.$v['order_no'];?>"><span class="fr back_yellow">去付款</span></a><span class="fr oreceived" data-s="10" data-no="<?php echo $v['order_no'];?>">取消订单</span>
                            <?php }else if($v['status'] == 2){?>
                            <span class="fr back_yellow">发货处理中</span>
                            <?php }else if($v['status'] == 4){?>
                            <span class="fr back_yellow oreceived" data-no="<?php echo $v['order_no'];?>">收货</span>
                            <?php }?>
							<a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--待付款-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($unpay<1){echo '<section class="dingdan_kong"><div>暂无订单！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($unpayls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['order_time'],0,10);?></span>
							<em class="fr"><?php echo $v['status']==1?($v['pay_status']==1?'待付款':$statusArr[$v['status']]):$statusArr[$v['status']];?></em>
						</h3>
                        <?php $goodarr = json_decode(base64_decode($v['order_good']),true);foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo $gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl"><?php echo $gv['keyv'];?></span><em class="fr">×<?php echo $gv['num'];?></em></p>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>共<?php echo $v['goodnum']?>件</i><i><?php echo '(商)'.number_format($v['good_amount']/100,2);?><?php echo $v['freight']?' + (运)'.number_format($v['freight']/100,2):'';?><?php echo $v['camount']?' - (惠)'.number_format($v['camount']/100,2):'';?>,合计：<em>￥<?php echo number_format($v['amount']/100,2);?></em></i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
							<a href="<?php echo url('pay/index').'?objno='.$v['order_no'];?>"><span class="fr back_yellow">去付款</span></a><span class="fr oreceived" data-s="10" data-no="<?php echo $v['order_no'];?>">取消订单</span>
							<!--<span class="fr">删除订单</span>-->
                            <a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--待发货-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($unsend<1){echo '<section class="dingdan_kong"><div>暂无订单！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($unsendls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['order_time'],0,10);?></span>
							<em class="fr"><?php echo $v['status']==1?($v['pay_status']==1?'待付款':$statusArr[$v['status']]):$statusArr[$v['status']];?></em>
						</h3>
                        <?php $goodarr = json_decode(base64_decode($v['order_good']),true);foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo $gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl"><?php echo $gv['keyv'];?></span><em class="fr">×<?php echo $gv['num'];?></em></p>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>共<?php echo $v['goodnum']?>件</i><i><?php echo '(商)'.number_format($v['good_amount']/100,2);?><?php echo $v['freight']?' + (运)'.number_format($v['freight']/100,2):'';?><?php echo $v['camount']?' - (惠)'.number_format($v['camount']/100,2):'';?>,合计：<em>￥<?php echo number_format($v['amount']/100,2);?></em></i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
							<span class="fr back_yellow">发货处理中</span>
                            <a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--待收货-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($unsh<1){echo '<section class="dingdan_kong"><div>暂无订单！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($unshls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['order_time'],0,10);?></span>
							<em class="fr"><?php echo $v['status']==1?($v['pay_status']==1?'待付款':$statusArr[$v['status']]):$statusArr[$v['status']];?></em>
						</h3>
                        <?php $goodarr = json_decode(base64_decode($v['order_good']),true);foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo $gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl"><?php echo $gv['keyv'];?></span><em class="fr">×<?php echo $gv['num'];?></em></p>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>共<?php echo $v['goodnum']?>件</i><i><?php echo '(商)'.number_format($v['good_amount']/100,2);?><?php echo $v['freight']?' + (运)'.number_format($v['freight']/100,2):'';?><?php echo $v['camount']?' - (惠)'.number_format($v['camount']/100,2):'';?>,合计：<em>￥<?php echo number_format($v['amount']/100,2);?></em></i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
							<span class="fr back_yellow oreceived" data-no="<?php echo $v['order_no'];?>">收货</span>
                            <a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
            <!--已完成-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($end<1){echo '<section class="dingdan_kong"><div>暂无订单！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($endls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['order_time'],0,10);?></span>
							<em class="fr"><?php echo $v['status']==1?($v['pay_status']==1?'待付款':$statusArr[$v['status']]):$statusArr[$v['status']];?></em>
						</h3>
                        <?php $goodarr = json_decode(base64_decode($v['order_good']),true);foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo $gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl"><?php echo $gv['keyv'];?></span><em class="fr">×<?php echo $gv['num'];?></em></p>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>共<?php echo $v['goodnum']?>件</i><i><?php echo '(商)'.number_format($v['good_amount']/100,2);?><?php echo $v['freight']?' + (运)'.number_format($v['freight']/100,2):'';?><?php echo $v['camount']?' - (惠)'.number_format($v['camount']/100,2):'';?>,合计：<em>￥<?php echo number_format($v['amount']/100,2);?></em></i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
							<a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
							<!--<span class="fr">删除订单</span>-->
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--评价-->
			<!--<nav class="qbdd_pj_box">
				<ol class="clearfix qbdd_pj_title_lists">
					<li class="fl active">
						<i>待评价</i>
					</li>
					<li class="fl">
						<i>已评价</i>
					</li>
				</ol>
				<div class="qbdd_pj_ym" style="display:block;">
					<ul class="qbdd_lists">
						<li>
							<h3 class="clearfix">
								<span class="fl">2019/06/14</span>
								<em class="fr">待评价</em>
							</h3>
							<div class="clearfix qbdd_lists_word">
								<img class="fl lazy" data-original='__IMG__/yangtu.jpg' />
								<div class="fl">
									<h4 class="clearfix"><span class="fl">Dr.Ci:Labo 城野医生 卓效收敛化妆水,卓效收敛化妆水</span><i class="fr">￥1314.00</i></h4>
									<p class="clearfix"><span class="fl">限量版 200毫升</span><em class="fr">×1</em></p>
								</div>
							</div>
							<div class="qbdd_lists_word2 clearfix">
								<p class="fr"><i>共1件</i><i>合计：<em>￥1314.00</em></i></p>
							</div>
							<div class="clearfix qbdd_lists_btns">
								<span class="fr back_yellow">评价</span>
								<span class="fr">订单详情</span>
								<span class="fr">删除订单</span>
							</div>
						</li>
					</ul>
				</div>
				<div class="qbdd_pj_ym">
					<ul class="qbdd_lists">
						<li>
							<h3 class="clearfix">
								<span class="fl">2019/06/14</span>
								<em class="fr">交易完成</em>
							</h3>
							<div class="clearfix qbdd_lists_word">
								<img class="fl lazy" data-original='__IMG__/yangtu.jpg' />
								<div class="fl">
									<h4 class="clearfix"><span class="fl">Dr.Ci:Labo 城野医生 卓效收敛化妆水,卓效收敛化妆水</span><i class="fr">￥1314.00</i></h4>
									<p class="clearfix"><span class="fl">限量版 200毫升</span><em class="fr">×1</em></p>
								</div>
							</div>
							<div class="qbdd_lists_word2 clearfix">
								<p class="fr"><i>共1件</i><i>合计：<em>￥1314.00</em></i></p>
							</div>
							<div class="clearfix qbdd_lists_btns">
								<span class="fr back_yellow">追评价</span>
								<span class="fr">订单详情</span>
								<span class="fr">删除订单</span>
							</div>
						</li>
					</ul>
				</div>
			</nav>-->
		</section>
    <script>
		$(function(){
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});
			/*订单切换*/
			$('.dingdan_nav_list .dingdan_lists li').click(function(){
				$("img.lazy").lazyload({effect: "show"});
				$('.dingdan_nav_list .dingdan_lists li').removeClass('active');
				$('.dingdan_nav_list nav').hide();
				$(this).addClass('active');
				$('.dingdan_nav_list nav:eq('+$(this).index()+')').show();
			});
			/*评价切换*/
			$('.qbdd_pj_box .qbdd_pj_title_lists li').click(function(){
				$('.qbdd_pj_box .qbdd_pj_title_lists li').removeClass('active');
				$('.qbdd_pj_box .qbdd_pj_ym').hide();
				$(this).addClass('active');
				$('.qbdd_pj_box .qbdd_pj_ym:eq('+$(this).index()+')').show();
			});
			
			$('.oreceived').click(function(){
				var ono = $(this).data('no');
				var s = $(this).data('s');
				$.ajax({ 
					type:"POST", 
					async:false, 
					url:"/api/received.html",
					dataType: "json",
					data:{ono:ono,s:s,i:Math.random()},
					success:function(result){
						if(result.status == 200){
							layer.open({skin:'msg',content: result.msg,time:1,end:function(){window.location.reload();}});
						}else{
							layer.open({skin:'msg',content: result.msg,time:2});
						}
					},
					error:function(XMLHttpRequest, textStatus, errorThrown){
						layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
					}	
				});
			});
		})
	</script>
	</body>
</html>
