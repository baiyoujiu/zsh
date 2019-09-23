{include file="common/header" /}
<section class="ds_home">
			<!--head-->
			<section class="ds_home_head shop_car_title">
				<h2><a href="javascript:history.back(-1);"><i class="icon-left"></i></a>购物车<em class="delete">删除</em></h2>
			</section>
			<!--占位-->
			<section class="zhanwei_hei40"></section>
            <?php if(empty($cartlist)){?>
            <!--没有商品-->
			<div class="kongcar">
				<img src="__IMG__/kongcar.png" />
                <?php if($userinfo){?>
				<p>购物车空空如也，<em><a href="https://<?php echo request()->host();?>/">去逛逛</a></em>吧~</p>
                <?php }else{?>
				<p>登录后可同步购物车中商品</p>
				<span><a href="<?php echo url('login/index');?>">登陆</a></span>
                <?php }?>
			</div>
			<!--推荐商品-->
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
            
            
            <?php }else{?>
			<!--购物车-->
			<section>
				<ul class="shop_car_lists shop-cart-listbox1" id="box_check">
					<form id="fcart">
					<?php foreach($cartlist as $k=>$v){?>
                    <li class="clearfix index-goods">
						<span class="fl check_btn shop-cart-check2">
							<input type="checkbox" name="gkey[]" class="btn2" value="<?php echo $k;?>"/>
						</span>
						<p class="fl shop_img">
							<a href="<?php echo url('goods/'.$v['gno']);?>"><img class="lazy" data-original="<?php echo $v['pic'];?>" /></a>
						</p>
						<div class="fl shop_word">
							<a href="<?php echo url('goods/'.$v['gno']);?>"><h2><?php echo $v['name'];?></h2></a>
							<a href="<?php echo url('goods/'.$v['gno']);?>"><h3><?php echo $v['keyv'];?></h3></a>
							<div class="clearfix index-goods-textbox">
								<em class="fl">￥<strong class="priceJs"><?php echo $v['price']/100;?></strong></em>
                                &nbsp;&nbsp;<i>￥<?php echo $v['mprice']/100;?></i>
								<div class="fr clearfix shop_num_btns">
									<i class="fl num_btn_jian shop-cart-subtract"></i>
									<b class="fl shop-cart-numer"  id="tb_count"><?php echo $v['num'];?></b>
									<i class="fl num_btn_jia shop-cart-add"></i>
								</div>
							</div>
						</div>
					</li>
                    <?php }?>
                    </form>
					
					<input type="hidden" value="" class="ShopTotal">
				</ul>
			</section>
            
			<!--占位-->
			<section class="zhanwei_hei70"></section>
			<!--购物车-->
			<section>
				<div class="jiesuan_lists clearfix">
					<div class="fl clearfix check_box">
						<label class="fl">
							<input type="checkbox" name="check" id="ckAll"/><em>全选</em>
						</label>
						<p class="fr">合计:￥<i id="AllTotal" class="scart-total-text3">0.00</i>(免运费)</p>
					</div>
					<div class="fr sc_jiesuan_btn">结算</div>
				</div>
			</section>
			<?php }?>
<script type="text/javascript" src="__JS__/cart.js" ></script>
{include file="common/footer" /}