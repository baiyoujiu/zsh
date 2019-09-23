{include file="common/header" /}
		<script>
			$(function(){
				$('.yhq_lists li').click(function(){
					$('.yhq_lists li').removeClass('active');
					$('.yhq_ym_box nav').hide();
					$(this).addClass('active');
					$('.yhq_ym_box nav:eq('+$(this).index()+')').show();
				})
			})
		</script>

		<section class="dd_home">
			<h2 class="fanhui_head"><a href="javascript:history.back(-1);"><i class="icon-left"></i></a>我的优惠券</h2>
		</section>
		<!--占位-->
		<section class="zhanwei_hei40"></section>
		<section class="yhq_ym_box">
			<ol class="yhq_lists clearfix">
				<li class="fl active">
					<i>未使用</i>
				</li>
				<li class="fl">
					<i>已使用</i>
				</li>
				<li class="fl">
					<i>已过期</i>
				</li>
			</ol>
			<!--未使用-->
			<nav style="display:block;">
				<ul class="yhq_wsy_list">
					<?php 
					$s1num = $s2num = $s3num = 0;
					foreach($lists as $v){
						if($v['status']!=1){continue;}
						++$s1num;
						?>
                    <li>
						<div class="clearfix">
							<div class="fl yhq_wsy_left">
								<h3>有效</h3>
								<h2>￥<?php echo number_format($v['amount']/100,2);?></h2>
								<h4><?php echo $v['remark'];?></h4>
							</div>
							<span class="up_qiu"></span>
							<span class="center_xian"></span>
							<span class="down_qiu"></span>
							<div class="fl yhq_wsy_right">
								<h3><?php echo $v['name'];?></h3>
								<h2><?php echo $v['rules'];?></h2>
							</div>
						</div>
						<div class="yhq_wsy_xq">
							<span></span>
							<p><?php echo $v['starttime'];?>至<?php echo $v['endtime'];?></p>
						</div>
					</li>
                    <?php }?>
                    <?php if(!$s1num){?>
                    <li><div class="yhq_wsy_xq">
                            <span></span>
							<p>暂无优惠券！</p>
                            <span></span>
                            <p>&nbsp;</p>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--已使用-->
			<nav class="yhq_ysy">
				<ul class="yhq_wsy_list">
					<?php 
					foreach($lists as $v){
						if($v['status']!=2){continue;}
						++$s2num;
						?>
                    <li>
						<div class="clearfix">
							<div class="fl yhq_wsy_left">
								<h3>已使用</h3>
								<h2>￥<?php echo number_format($v['amount']/100,2);?></h2>
								<h4><?php echo $v['remark'];?></h4>
							</div>
							<span class="up_qiu"></span>
							<span class="center_xian"></span>
							<span class="down_qiu"></span>
							<div class="fl yhq_wsy_right">
								<h3><?php echo $v['name'];?></h3>
								<h2><?php echo $v['rules'];?></h2>
							</div>
						</div>
						<div class="yhq_wsy_xq">
							<span></span>
							<p><?php echo $v['starttime'];?>至<?php echo $v['endtime'];?></p>
						</div>
					</li>
                    <?php }?>
                    <?php if(!$s2num){?>
                    <li><div class="yhq_wsy_xq">
                            <span></span>
							<p>暂无已使用优惠券！</p>
                            <span></span>
                            <p>&nbsp;</p>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
			<!--已过期-->
			<nav class="yhq_ygq">
				<ul class="yhq_wsy_list">
					<?php 
					foreach($lists as $v){
						if($v['status']!=3){continue;}
						++$s2num;
						?>
                    <li>
						<div class="clearfix">
							<div class="fl yhq_wsy_left">
								<h3>已过期</h3>
								<h2>￥<?php echo number_format($v['amount']/100,2);?></h2>
								<h4><?php echo $v['remark'];?></h4>
							</div>
							<span class="up_qiu"></span>
							<span class="center_xian"></span>
							<span class="down_qiu"></span>
							<div class="fl yhq_wsy_right">
								<h3><?php echo $v['name'];?></h3>
								<h2><?php echo $v['rules'];?></h2>
							</div>
						</div>
						<div class="yhq_wsy_xq">
							<span></span>
							<p><?php echo $v['starttime'];?>至<?php echo $v['endtime'];?></p>
						</div>
					</li>
                    <?php }?>
                    <?php if(!$s3num){?>
                    <li><div class="yhq_wsy_xq">
                            <span></span>
							<p>暂无已过期优惠券！</p>
                            <span></span>
                            <p>&nbsp;</p>
						</div>
					</li>
                    <?php }?>
				</ul>
			</nav>
{include file="common/footer" /}
