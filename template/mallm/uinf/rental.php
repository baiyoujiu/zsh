{include file="common/header" /}
		<section class="dd_home">
			<h2 class="fanhui_head"><a href="<?php echo url('uinf/index');?>"><i class="icon-left"></i></a>租借台</h2>
		</section>
		<!--占位-->
		<section class="zhanwei_hei40"></section>
		<section class="dingdan_nav_list">
        	<?php
            $amun = $undh =$unrk = $abnormal = $end = 0;
			$amunls = $undhls = $unrkls = $abnormalls = $endls = array();
			foreach($lists as $v){
				$amun++;
				$amunls[$v['order_no']]['otime'] = $v['addtime'];
				$amunls[$v['order_no']]['order_no'] = $v['order_no'];
				$amunls[$v['order_no']]['status'] = $v['status'];
				$amunls[$v['order_no']]['goods'][] = $v;
				//租借商品状态：0-待还|1-待验入库|2-异常|8-已还
				switch ($v['status']) {
					case 1:
						$unrk++;
						$unrkls[$v['order_no']]['otime'] = $v['addtime'];
						$unrkls[$v['order_no']]['order_no'] = $v['order_no'];
						$unrkls[$v['order_no']]['status'] = $v['status'];
						$unrkls[$v['order_no']]['goods'][] = $v;
						break;
					case 2:
						$abnormal++;
						$abnormalls[$v['order_no']]['otime'] = $v['addtime'];
						$abnormalls[$v['order_no']]['order_no'] = $v['order_no'];
						$abnormalls[$v['order_no']]['status'] = $v['status'];
						$abnormalls[$v['order_no']]['goods'][] = $v;
						break;
					case 8:
						$end++;
						$endls[$v['order_no']]['otime'] = $v['addtime'];
						$endls[$v['order_no']]['order_no'] = $v['order_no'];
						$endls[$v['order_no']]['status'] = $v['status'];
						$endls[$v['order_no']]['goods'][] = $v;
						break;
					default :
						$undh++;
						$undhls[$v['order_no']]['otime'] = $v['addtime'];
						$undhls[$v['order_no']]['order_no'] = $v['order_no'];
						$undhls[$v['order_no']]['status'] = $v['status'];
						$undhls[$v['order_no']]['goods'][] = $v;
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
					<i>待还图书</i>
					<?php echo $undh?'<span>'.$undh.'</span>':'';?>
				</li>
				<li class="fl">
					<i>待验入库</i>
                    <?php echo $unrk?'<span>'.$unrk.'</span>':'';?>
				</li>
				<li class="fl">
					<i>异常</i>
                    <?php echo $abnormal?'<span>'.$abnormal.'</span>':'';?>
				</li>
				<li class="fl">
					<i>已还</i>
                    <?php echo $end?'<span>'.$end.'</span>':'';?>
				</li>
			</ul>
			<!--全部-->
			<nav style="display:block;">
				<ul class="qbdd_lists">
                	<?php if($amun<1){echo '<section class="dingdan_kong"><div>暂无租阅图书！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($amunls as $v){?>
                    <li>
                        <h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['otime'],0,10);?></span>
							<em class="fr"><?php echo $statusArr[$v['status']];?></em>
						</h3>
                        <?php $booknum = 0;$goodarr = $v['goods'];foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo '【'.$gv['keyv'].'】'.$gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl">应还时间：<b class="red"><?php echo $gv['rentend'];?></b></span><em class="fr">×<?php $booknum += $gv['num'];echo $gv['num'];?></em></p>
                                <?php if($v['status']){?>
                                <p class="clearfix"><span class="fl"><?php echo $statusStr[$v['status']];?>时间：<b class="red"><?php echo $gv['backtime']?$gv['backtime']:$gv['tobacktime'];?></b></span></p>
                                <?php }?>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>合计：　<em><?php echo $booknum;?></em>　本</i></p>
						</div>
                        
						<div class="clearfix qbdd_lists_btns">
                            <?php if($v['status'] == 0){?>
                            <span class="fr back_yellow oreceived" data-no="<?php echo $v['order_no'];?>">还书</span>
                            <?php }?>
							<a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--待还图书-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($undh<1){echo '<section class="dingdan_kong"><div>暂无待还图书！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($undhls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['otime'],0,10);?></span>
							<em class="fr"><?php echo $statusArr[$v['status']];?></em>
						</h3>
                        <?php $booknum = 0;$goodarr = $v['goods'];foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo '【'.$gv['keyv'].'】'.$gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl">应还时间：<b class="red"><?php echo $gv['rentend'];?></b></span><em class="fr">×<?php $booknum += $gv['num'];echo $gv['num'];?></em></p>
                                <?php if($v['status']){?>
                                <p class="clearfix"><span class="fl"><?php echo $statusStr[$v['status']];?>时间：<b class="red"><?php echo $gv['backtime']?$gv['backtime']:$gv['tobacktime'];?></b></span></p>
                                <?php }?>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>合计：　<em><?php echo $booknum;?></em>　本</i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
							<span class="fr back_yellow oreceived" data-no="<?php echo $v['order_no'];?>">还书</span>
                            <a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--待验入库-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($unrk<1){echo '<section class="dingdan_kong"><div>暂无待入库租借图书！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($unrkls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['otime'],0,10);?></span>
							<em class="fr"><?php echo $statusArr[$v['status']];?></em>
						</h3>
                        <?php $booknum = 0;$goodarr = $v['goods'];foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo '【'.$gv['keyv'].'】'.$gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl">应还时间：<b class="red"><?php echo $gv['rentend'];?></b></span><em class="fr">×<?php $booknum += $gv['num'];echo $gv['num'];?></em></p>
                                <?php if($v['status']){?>
                                <p class="clearfix"><span class="fl"><?php echo $statusStr[$v['status']];?>时间：<b class="red"><?php echo $gv['backtime']?$gv['backtime']:$gv['tobacktime'];?></b></span></p>
                                <?php }?>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>合计：　<em><?php echo $booknum;?></em>　本</i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
                            <a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--异常-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($abnormal<1){echo '<section class="dingdan_kong"><div>信用良好。</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($abnormalls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['otime'],0,10);?></span>
							<em class="fr"><?php echo $statusArr[$v['status']];?></em>
						</h3>
                        <?php $booknum = 0;$goodarr = $v['goods'];foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo '【'.$gv['keyv'].'】'.$gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl">应还时间：<b class="red"><?php echo $gv['rentend'];?></b></span><em class="fr">×<?php $booknum += $gv['num'];echo $gv['num'];?></em></p>
                                <?php if($v['status']){?>
                                <p class="clearfix"><span class="fl"><?php echo $statusStr[$v['status']];?>时间：<b class="red"><?php echo $gv['backtime']?$gv['backtime']:$gv['tobacktime'];?></b></span></p>
                                <?php }?>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>合计：　<em><?php echo $booknum;?></em>　本</i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
                            <a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
            <!--已完成-->
			<nav>
				<ul class="qbdd_lists">
					<?php if($end<1){echo '<section class="dingdan_kong"><div>暂已还图书！</div><img src="/images/books/bookszjlc.jpg"/></section>';}?>
					<?php foreach($endls as $v){?>
                    <li>
						<h3 class="clearfix">
							<span class="fl"><?php echo '【'.$v['order_no'].'】'.substr($v['otime'],0,10);?></span>
							<em class="fr"><?php echo $statusArr[$v['status']];?></em>
						</h3>
                        <?php $booknum = 0;$goodarr = $v['goods'];foreach($goodarr as $gv){?>
						<div class="clearfix qbdd_lists_word">
							<img class="fl lazy" data-original='<?php echo $gv['pic'];?>' />
							<div class="fl">
								<h4 class="clearfix"><span class="fl"><?php echo '【'.$gv['keyv'].'】'.$gv['name'];?></span><i class="fr">￥<?php echo number_format($gv['price']/100,2);?></i></h4>
								<p class="clearfix"><span class="fl">应还时间：<b class="red"><?php echo $gv['rentend'];?></b></span><em class="fr">×<?php $booknum += $gv['num'];echo $gv['num'];?></em></p>
                                <?php if($v['status']){?>
                                <p class="clearfix"><span class="fl"><?php echo $statusStr[$v['status']];?>时间：<b class="red"><?php echo $gv['backtime']?$gv['backtime']:$gv['tobacktime'];?></b></span></p>
                                <?php }?>
							</div>
						</div>
                        <?php }?>
						<div class="qbdd_lists_word2 clearfix">
							<p class="fr"><i>合计：　<em><?php echo $booknum;?></em>　本</i></p>
						</div>
						<div class="clearfix qbdd_lists_btns">
							<a href="<?php echo url('uinf/orderinf').'?no='.$v['order_no'];?>"><span class="fr">订单详情</span></a>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			
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
				$.ajax({ 
					type:"POST", 
					async:false, 
					url:"/api/rental.html",
					dataType: "json",
					data:{ono:ono,i:Math.random()},
					success:function(result){
						if(result.status == 200){
							layer.open({skin:'msg',content: result.msg,time:3,end:function(){window.location.reload();}});
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
