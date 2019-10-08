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
					<li class="fl">
						<h2>￥<em>100</em></h2>
						<h4>普通成员</h4>
						<p>最多可租阅&nbsp;<b>5</b>&nbsp;本图书</p>
                        <p>建议每次租&nbsp;<b>2</b>&nbsp;本图书</p>
					</li>
					<li class="fl active">
						<h2>￥<em>300</em></h2>
						<h4>高级成员</h4>
						<p>可租阅&nbsp;<b>30</b>&nbsp;本图书</p>
                        <p>建议每次租&nbsp;<b>5</b>&nbsp;本图书</p>
					</li>
				</ul>
			</section>
			<!--订单备注-->
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
			<section class="taocan_btns clearfix">
				<form id="objform">
                <input name="amount" id="amount" type="hidden" value="300" />
                <p class="fl">
					<i><label><b><input type="checkbox" name="agreement" value="1"/></b>已阅读并同意</label></i></br>
					<a href="<?php echo url('newsinf/9');?>"><em>《租书会租阅协议》</em></a>
				</p>
                </form>
				<span class="fl" id="topay">立刻支付￥<em>300</em></span>
			</section>
		</section>
	</body>
	<script>
		//获取判断浏览器用的对象
		var ua = window.navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == "micromessenger") {
			//在微信浏览器中打开
			$('.zffszfb').parent().parent('li').hide();
			$('.zffswx').attr("checked",true);
        }else{
			//非微信浏览器打开
			$('.zffswx').parent().parent('li').hide();
			$('.zffszfb').attr("checked",true);
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
								window.location.href = '/pay/index.html?objno='+data.no;
							}else{
								window.location.href = '/pay/alipay.html?objno='+data.no;
							}
						}else{
							layer.open({skin:'msg',content: data.msg,time:2});
						}
					}
				})
			})
			//选择套餐
			$('.taocan_list li').click(function(){
				$('.taocan_list li').removeClass('active');
				$(this).addClass('active');
				$('.taocan_btns span em').html($(this).find('h2').find('em').html());
				$('#amount').val($(this).find('h2').find('em').html());
			})
		});
	</script>
</html>