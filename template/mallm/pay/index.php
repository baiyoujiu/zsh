{include file="common/header" /}

		<section class="dd_home">
			<h2 class="fanhui_head">
				<a href="<?php echo url('uinf/order');?>"><i class="icon-left"></i></a>订单支付
			</h2>
		</section>
		<!--占位-->
		<section class="zhanwei_hei35"></section>
		<!--收货地址-->
		<section>
			<div class="clearfix dingdan_dizhi">
				<div class="fl dingdan_dizhi_xinxi">
					<h1><?php $adrinf = json_decode(base64_decode($info['address']),true); echo $adrinf['recname'];?>　<em><?php echo decryptd($adrinf['phone']);?></em></h1>
					<p><?php echo $arealist[$adrinf['province']].$arealist[$adrinf['city']].$arealist[$adrinf['area']].$arealist[$adrinf['street']].'　'.($adrinf['school']?'<b>'.$stagels[$adrinf['address']]['area'].'</b><br>('.$stagels[$adrinf['address']]['address'].')':$arealist[$adrinf['street']].$adrinf['address']);?></p>
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
        
        <section class="diandan_beizhu">
            <ul class="diandan_beizhu_lists">
                <li class="diandan_beizhu_list">
                    <p class="clearfix">
                        <img class="fl" src="__IMG__/zfbzf.png"/>
                        <em class="fl">支付宝</em>
                        <input class="fr zffszfb" name="zffs" type="radio" value="2"/>
                    </p>
                </li>
                <li class="diandan_beizhu_list">
                    <p class="clearfix">
                        <img class="fl" src="__IMG__/wxzf.png"/>
                        <em class="fl">微信支付</em>
                        <input class="fr zffswx" name="zffs" type="radio" value="3"/>
                    </p>
                </li>
            </ul>
        </section>
        
        
        
        
		<!--占位-->
		<section class="zhanwei_hei50"></section>
		<section class="dingdan_queren_btn">
            <p id="tobuy">确认支付</p>
        </section>
    <script type="text/javascript">
	//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
	$("img.lazy").lazyload({effect: "fadeIn"});

	var objno = '<?php echo $info['order_no'];?>';
	/*选择其他支付方式*/
	$('#tobuy').click(function(){
		var type=$('input:radio[name="zffs"]:checked').val();
		//支付宝
		if(type==2){
			window.location.href = '/pay/alipay.html?objno='+objno;
		//微信
		}else{
			if (typeof WeixinJSBridge == "undefined"){
				if( document.addEventListener ){
					document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
				}else if (document.attachEvent){
					document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
					document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
				}
			}else{
				jsApiCall();
			}
		}
	});
	
	//获取判断浏览器用的对象
	var ua = window.navigator.userAgent.toLowerCase(); 
	if (ua.match(/MicroMessenger/i) == "micromessenger") {
		//在微信浏览器中打开
		$('.zffszfb').parent().parent('li').hide();
		$('.zffswx').attr("checked",true);
		$('#tobuy').click();
	}else{
		//非微信浏览器打开
		$('.zffswx').parent().parent('li').hide();
		$('.zffszfb').attr("checked",true);
	}
	
	//调用微信JS api 支付
	function jsApiCall(){
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+'>desc>'+res.err_desc+'>msg>'+res.err_msg);
				if(res.err_msg == 'get_brand_wcpay_request:ok'){
					// 支付成功
					window.location.href = '/uinf/order.html';
				}else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
					// 支付失败
					layer.open({content: '支付失败',skin: 'msg',time:2});
				}else if(res.err_msg == 'get_brand_wcpay_request:fail'){
					// 支付过程中用户取消
					layer.open({content: '支付取消',skin: 'msg',time:2});
				}
			}
		);
	}
	</script>
	</body>
</html>
