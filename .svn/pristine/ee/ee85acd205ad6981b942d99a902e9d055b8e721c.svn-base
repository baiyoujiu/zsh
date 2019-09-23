{include file="common/header" /}
		<link rel="stylesheet" href="__CSS__/demo.css" />
		<!--确认订单-->
		<section class="queren_dingdan">
			<section class="dd_home">
				<h2 class="fanhui_head">
					<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>
                    确认订单
				</h2>
			</section>
            <form id="tobuyf">
            <input name="cart" type="hidden" value="<?php echo $cart;?>"/>
            <input name="orderano" type="hidden" id="orderano" value="<?php echo isset($lists[0]['ano'])?$lists[0]['ano']:'';?>"/>
			<!--收货地址-->
			<section>
				<div class="clearfix dingdan_dizhi">
					<?php if(count($lists)){?>
                    <div class="fl dingdan_dizhi_xinxi">
						<h1><?php $adrinf = $lists[0];echo $adrinf['recname'];?>　<em><?php echo $adrinf['phone'];?></em></h1>
						<p><?php echo $arealist[$adrinf['province']].$arealist[$adrinf['city']].$arealist[$adrinf['area']].'　'.($adrinf['school']?'<b>'.$stagels[$adrinf['address']]['area'].'</b><br>('.$stagels[$adrinf['address']]['address'].')':$arealist[$adrinf['street']].$adrinf['address']);?></p>
					</div>
					<i class="icon-right fr qrdd_xgdz"></i>
                    <?php }else{?>
                    <div class="fl dingdan_dizhi_xinxi">
						<h1>无收货地址</h1>
                        <p class="add_dizhi" style="margin-top:0;"><span>添加新地址</span></p>
					</div>
                    <?php }?>
				</div>
			</section>
			<!--商品详情-->
			<section class="dingdan_shop_ym">
				<ol>
					<li>
						<ul class="dingdan_shop_lists">
							<?php 
							$amount = $anum = 0;
							foreach($goodslist as $v){
								$amount += $v['price']*$v['num'];
								$anum += $v['num'];
							?>
                            <li class="dingdan_shop clearfix">
								<img class="fl lazy" data-original="<?php echo $v['pic'];?>"/>
								<div class="fr dingdan_shop_xin">
									<h2><?php echo $v['name'];?></h2>
									<p><em><?php echo $v['keyv'];?></em></p>
									<h3 class="clearfix">
										<span class="fl">￥<?php echo number_format($v['price']/100,2);?><?php echo ($userinfo['utype']<2 && $v['rent'] == 1)?'　<span class="red">免押金，加3倍租金</span>':'';?></span>
										<i class="fr"><?php echo $v['num'];?>件</i>
									</h3>
								</div>
							</li>
                            <?php }?>
						</ul>
						<div class="clearfix dingdan_xiaoji">
							<p class="fr">小计:<i>￥<?php echo number_format($amount/100,2);?></i></p>
							<em class="fr">共<?php echo $anum;?>件</em>
						</div>
					</li>
					
				</ol>
			</section>
            <section class="diandan_beizhu">
                <ul class="diandan_beizhu_lists">
					<li class="clearfix diandan_beizhu_list2">
						<span class="fl">订单备注</span>
						<input class="fr beizhu_word" type="text" name="remark" placeholder="订单备注，选填"/>
					</li>
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
            
			<!--订单信息-->
			<section class="dingdan_xinxi">
				<ul class="dingdan_xinxi_lists">
					<li class="clearfix">
						<span class="fl">商品金额</span>
						<p class="fr">￥<?php echo number_format($amount/100,2);?></p>
					</li>
					<li class="clearfix">
						<span class="fl">运费</span>
						<p class="fr freight">￥<?php echo $adrinf['school']?number_format($freightsc/100,2):number_format($freight/100,2);?></p>
					</li>
					<li class="clearfix">
						<h6 class="fr amount">￥<?php echo $adrinf['school']?number_format(($amount+$freightsc)/100,2):number_format(($amount+$freight)/100,2);?></h6>
						<h5 class="fr">总价：</h5>
					</li>
                    <?php if($couponinf){?>
                    <li class="clearfix">
						<span class="fl">使用优惠劵：￥<?php echo number_format($couponinf['amount']/100,2);?></span>
						<input class="fr" name="couponid" type="checkbox" value="<?php echo $couponinf['id'];?>" checked="checked"/>
					</li>
                    <?php }?>
				</ul>
			</section>
            </form>
			<!--占位-->
			<section class="zhanwei_hei50"></section>
			<section class="dingdan_queren_btn">
				<p id="tobuy">去付款</p>
			</section>
		</section>
		<!--收货地址-->
		<section class="qrdd_dizhi" style="display:none;">
			<section class="dd_home">
				<h2 class="fanhui_head"><i class="icon-left qrdd_xgdz_hide"></i>收货地址</h2>
			</section>
			<ul class="shdz_lists">
				<?php foreach($lists as $v){?>
                <li class="clearfix">
					<div class="fl shdz_list_btns">
						<p class="clearfix">
							<input class="fl addrcheck" type="radio" data-no="<?php echo $v['ano'];?>" data-school="<?php echo $v['school'];?>" name="dizhi" <?php echo $v['flg']?'checked':'';?>/>
						</p>
					</div>
					<div class="fl shdz_lists_left">
						<div class="shdz_list_user clearfix">
							<span class="fl"><?php echo $v['recname'];?></span>
							<p class="fl"><?php echo $v['phone'];?></p>
						</div>
						<div class="shdz_list_dz">
							<p><?php echo $arealist[$v['province']].$arealist[$v['city']].$arealist[$v['area']].'　'.($v['school']?'<b>'.$stagels[$v['address']]['area'].'</b><br>('.$stagels[$v['address']]['address'].')':$arealist[$v['street']].$v['address']);?></p>
						</div>
					</div>
					<div class="fr shdz_lists_right adredit" data-no="<?php echo $v['ano'];?>" data-p="<?php echo $v['phone'];?>" data-n="<?php echo $v['recname'];?>" data-adr="<?php echo $v['address'];?>" data-area="<?php echo $v['area'];?>" data-school="<?php echo $v['school'];?>" data-stage="<?php echo $v['school']?$stagels[$v['address']]['area']:'';?>" data-sadress="<?php echo $v['school']?$stagels[$v['address']]['address']:'';?>" data-pic="<?php echo $v['school']?$stagels[$v['address']]['pic']:'';?>">编辑</div>
				</li>
                <?php }?>
			</ul>
			<div class="add_dizhi">
				<span class="addbtn">添加新地址</span>
			</div>
		</section>
		<!--新增编辑地址-->
		<section class="xinzeng_dizhi" style="display:none;">
			<section class="dd_home">
				<h2 class="fanhui_head"><i class="icon-left"></i><span id="adrtitle">新增收货地址</span></h2>
			</section>
			<section>
            	<form id="objform">
                <input name="ano" type="hidden" id="ano" value=""/>
				<ul class="add_dizhi_lists">
					<p>地址信息</p>
					<li>
						<input type="text" name="recname" class="recname" placeholder="收货人姓名（请使用真实姓名）"/>
					</li>
					<li>
						<input type="text" name="phone" class="phone" placeholder="手机号码"/>
					</li>
					<li class="right">
                        <div class="fl add_address_list_sec">
                          <select class="pro_code" >
                            <option value="">浙江省杭州市</option>
                          </select>
                        </div>
                        <div class="add_address_list_sec fl">
                          <select class="areacode" data-alt="stcode" name="area" >
                            <option value="">请选择区/县</option>
                            <?php foreach($alists as $k=>$v){?>
                              <option value="<?php echo $v['code'];?>"><?php echo $v['area'];?></option>
                            <?php }?>
                          </select>
                        </div>
                        <div class="add_address_list_sec fl">
                          <select class="stcode" data-alt="sccode" name="street">
                            <option value="">街道/镇</option>
                          </select>
                        </div>
                        
                    </li>
					<li class="right">
                        <div class="add_address_list_sec fl">
                          <select class="sccode" name="sccode">
                            <option value="0">其它地址</option>
                          </select>
                        </div>
                      </li>
                    <li>
                        <input type="text" name="address" class="input" id="address" placeholder="请输入详细地址">
                    </li>
                    <li>
                        <div class="mapshow" data-lon="" data-lat="" data-area="" data-address="" data-pic="">
                          <span class="adrinf"></span>
                          <span class="fr">　<i class="icon-location"></i>地图</span>
                        </div>
                    </li>
				</ul>
                </form>
                <div class="mapinf" id="mapinf"><img class="fl" src="/images/stages/zjyz1001.png" /></div>
				<div class="add_dizhi">
					<span id="savebtn">保存</span>
				</div>
			</section>
			
		</section>
        <script type="text/javascript">
			//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
			$("img.lazy").lazyload({effect: "fadeIn"});
			
		    var freight = <?php echo $freight;?>,amount=<?php echo $amount;?>,freightsc = <?php echo $freightsc;?>;
			
			$('.mapinf').hide();$('.mapshow').hide();
			/*获取地址*/
			$(document).ready(function() {
				
				/*订单修改地址*/
				$('.qrdd_xgdz').click(function(){
					$('.qrdd_dizhi').show();
				    $('.queren_dingdan').hide();
				});
				/*订单修改地址隐藏*/
				$('.qrdd_xgdz_hide').click(function(){
					$('.queren_dingdan').show();
					$('.qrdd_dizhi').hide();
				});
				/*新增地址显示*/
				$('.addbtn').click(function(){
					$('#adrtitle').html('新增收货地址');
					
					$('.recname').val('');
					$('.phone').val('');
					$('.areacode').val('');
					$('.stcode').empty();
					$('.stcode').html('<option value="">街道/镇</option>');
					$('.sccode').empty();
					$('.sccode').html('<option value="0">其它地址</option>');
					$('#address').val('');	
					$('#address').show();
					
					$('.mapshow').hide();
					$('.mapinf').hide();
					
					$('.xinzeng_dizhi').show();
				    $('.queren_dingdan').hide();
				});
				
				/*新增地址隐藏*/
				$('.xinzeng_dizhi .icon-left').click(function(){
					$('.xinzeng_dizhi').hide();
				    $('.queren_dingdan').show();
				});
				/*更改地址*/	
				$('.addrcheck').click(function(){
					var recname = $(this).parents('li').find('.shdz_list_user span').html();
					var phone = $(this).parents('li').find('.shdz_list_user p').html();
					var addressinf = $(this).parents('li').find('.shdz_list_dz p').html();
					
					$('#orderano').val($(this).data('no'));
					var school = $(this).data('school');
					if(school<1){
						$('.freight').html('￥'+((freight)/100).toFixed(2));
						$('.amount').html('￥'+((amount+freight)/100).toFixed(2));
					}else{
						$('.freight').html('￥'+((freightsc)/100).toFixed(2));
						$('.amount').html('￥'+((amount+freightsc)/100).toFixed(2));
					}
					$('.dingdan_dizhi_xinxi h1').html(recname+'　<em>'+phone+'</em>');
					$('.dingdan_dizhi_xinxi p').html(addressinf);
					$('.qrdd_xgdz_hide').click();
				})
				
				$('.adredit').click(function(){
					$('#adrtitle').html('编辑收货地址')
					$('.xinzeng_dizhi').show();
					$('.shouhuo_dizhi').hide();
					$('.mapinf').hide();
					
					$('.recname').val($(this).data('n'));
					$('.phone').val($(this).data('p'));
					$('.areacode').val($(this).data('area'));
					
					var ano = $.trim($(this).data('no')),school=parseInt($(this).data('school'));
					$('#ano').val(ano);
					if(school<1){
						$('#address').show();
						$('#address').val($(this).data('adr'));
						
						$('.mapshow').hide();
					}else{
						$('#address').hide();
						$('#address').val('');
						
						$('.mapshow').data('lon',$(this).data('longitude'));
						$('.mapshow').data('lat',$(this).data('latitude'));
					
						$('.mapshow').data('area',$(this).data('stage'));
						$('.mapshow').data('address',$(this).data('sadress'));
						$('.adrinf').html($(this).data('sadress'));
						
						$('.mapshow').show();
						$('.mapinf img').attr('src',$(this).data('pic'));
						$('.mapinf').show();
					}
					$.ajax({ 
							type:"POST", 
							async:false, 
							url:"/api/adred.html",
							dataType: "json",
							data:{ano:ano,i:Math.random()},
							success:function(result){
								if(result.status == 200){
									var sthtml='<option value="">街道/镇</option>',schtml='<option value="0">其它地址</option>';
									sthtml += result.sthtml;
									schtml += result.schtml;
									$('.stcode').empty();
									$('.stcode').html(sthtml);
									$('.sccode').empty();
									$('.sccode').html(schtml);
								}else{
									layer.open({skin:'msg',content: result.msg,time:2});
								}
							},
							error:function(XMLHttpRequest, textStatus, errorThrown){
								layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
							}	
					});
				});
				
				
				$(".areacode").change(function () {
					var code = parseInt($(this).val());
					if(code<1){
						return false;
					}
					$.ajax({
						url:'/api/getchildarea.html',
						cache: false,
						data: {code:code,i:Math.random()},
						type: 'post',
						dataType: 'json',
						success: function (data) {
						  if (data.status == 200) {
							$('.mapshow').hide();
							$('#address').show();
							var stcode = '<option value="">街道/镇</option>',sccode = '<option value="0">其它地址</option>';
							stcode += data.html;
							$('.stcode').empty();
							$('.stcode').html(stcode);
							
							sccode += data.schtml;
							$('.sccode').empty();
							$('.sccode').html(sccode);
							
							$('#mapinf').hide();
						  }
						}
					});
				});
				$(".sccode").change(function () {
					var code = parseInt($(this).val());
					if(code<1){
						$('#address').show();
						$('.mapshow').hide();
						$('.mapinf').hide();
					}else{
						$('#address').hide();
						$('.mapshow').show();
						var adsites = $(".sccode option:selected");
						$('.mapinf img').data('pic',adsites.attr('pic'));
						$('.mapinf').show();
					}
				});
				
				$('#savebtn').click(function(){
					
					$.ajax({ 
						type:"POST", 
						async:false, 
						url:"/api/adrsave.html",
						dataType: "json",
						data:$("#objform").serialize(),
						success:function(result){
							if(result.status == 200){
								layer.open({skin:'msg',content: result.msg,time:1,end:function(){
									window.location.reload();
									}});
							
							}else{
								layer.open({skin:'msg',content: result.msg,time:2});
							}
						},
						error:function(XMLHttpRequest, textStatus, errorThrown){
							layer.open({skin:'msg',content:'网络异常，请稍后重试！',time:2});
						}	
					});
				});
				
				
				
				
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
				
				$('#tobuy').click(function(){
					var type=$('input:radio[name="zffs"]:checked').val();
					$.ajax({
						url: "/order/tobuy.html",
						data: $("#tobuyf").serialize(),
						type: "post",
						dataType: "json",
						success: function(data) {
						  	if(data.status == 200){
								if(data.amount){
									if(type == 3){
										window.location.href = '/pay/index.html?objno='+data.no;
									}else{
										window.location.href = '/pay/alipay.html?objno='+data.no;
									}
								}else{
									window.location.href = '/uinf/order.html';
								}
						  	}else{
								layer.open({skin:'msg',content: data.msg,time:2});
						  	}
						}
					})
				})
				
				
			});
		</script>
	</body>
</html>