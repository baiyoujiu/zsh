{include file="common/header" /}
		<section class="queren_dingdan">
			<section class="dd_home">
				<h2 class="fanhui_head">
					<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>加入租书会
				</h2>
            </section>

			<!--选择套餐-->
			<section>
				<ul class="clearfix taocan_list">
					<h1>押金方案</h1>
					<li class="fl<?php echo $info['amount'] == 10000?' active':'';?>">
						<h2>￥<em>100</em></h2>
						<h4>普通成员</h4>
						<p>最多可租阅&nbsp;<b>5</b>&nbsp;本图书</p>
                        <p>建议每次租&nbsp;<b>2</b>&nbsp;本图书</p>
					</li>
					<li class="fl<?php echo $info['amount'] == 30000?' active':'';?>">
						<h2>￥<em>300</em></h2>
						<h4>高级成员</h4>
						<p>可租阅&nbsp;<b>30</b>&nbsp;本图书</p>
                        <p>建议每次租&nbsp;<b>5</b>&nbsp;本图书</p>
					</li>
				</ul>
			</section>
			<!--占位-->
			<section class="zhanwei_hei50"></section>
            <section class="dingdan_queren_btn">
                <p id="tobuy">确认支付</p>
            </section>
		</section>
	</body>
	<script type="text/javascript">
	$('#tobuy').click(function(){
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
	});
	$('#tobuy').click();
	
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
					window.location.href = '/uinf/index.html?i='+Math.random();
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
		$(document).ready(function() {
			$('#topay').click(function(){
				var type=$('input:radio[name="zffs"]:checked').val();
				$.ajax({
					url: "/api/tovip.html",
					data: $("#objform").serialize(),
					type: "post",
					dataType: "json",
					success: function(data) {
						if(data.status == 200){
							if(type == 3){
								window.location.href = '/pay/wxpay.html?objno='+data.no;
							}else{
								window.location.href = '/pay/alipay.html?objno='+data.no;
							}
						}else{
							layer.open({skin:'msg',content: data.msg,time:2});
						}
					}
				})
			})
		});
	</script>
</html>