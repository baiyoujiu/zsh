{include file="common/uheader" /}
<link rel="stylesheet" href="__CSSPZ__/cztx.css">
<div class="userright bg-wh congzi">
    <div class="gp_grzx_wdhydj">
        <div class="clearfix gp_kbgl_title">
            <p class="fl">充值</p>
        </div>
        <div class="gp_zhifu_lists">
            <div class="clearfix zhifu_dkwx">
                <span class="fl">充值两步完成</span>
                <b class="fl colorred">1.提交充值申请，通知财务查收。　　2.线下转账。财务收到钱后，资金到账。</b>
            </div>
            <div class="clearfix zhifu_dkwx">
                <span class="fl">账户余额：</span>
                <b class="fl"><i>¥</i><?php echo number_format($finfo['balance']/100,2);?>元</b>
            </div>
            <div class="clearfix zhifu_skwx">
                <span class="fl"><b class="colorred">*</b>充值金额：</span>
                <p class="fl"><i>¥</i><input class="amount" type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" placeholder="请输入充值金额" /><i>元</i></p>
            </div>
            <div class="clearfix zhifu_lists">
                <span class="fl"><i class="colorred">*</i>选择支付方式：</span>
                <section class="fl">
                    <ul class="yhk_lists">
                        <?php foreach($cardlists as $k=>$v){?>
                        <li class="clearfix">
                            <input class="fl pay_type" type="radio" name="yhk" value="<?php echo $v['pay_way'];?>" <?php echo $k?'':'checked="checked"';?> />
                            <?php if($v['pay_way'] == 'ALIPAY'){?>
                                <img class="fl" src="__IMGPZ__/zhibubao.png" alt="支付宝充值"/>
                            <?php }elseif($v['pay_way'] == 'WECHAT'){?>
                                <img class="fl" src="__IMGPZ__/weixin.png" alt="微信充值"/>
                            <?php }else{?>
                                <img class="fl" src="__IMGPZ__/<?php echo $v['pay_type'];?>1.png" alt="银行名称"/>
                            <?php }?>
                            <?php if($v['pay_way'] == 'ALIPAY'){?>
                                <p class="fl yhk_lists_yh">支付宝</p><p class="fl">支付宝账号:<?php echo $v['account'];?></p>
                            <?php }elseif($v['pay_way'] == 'WECHAT'){?>
                                <p class="fl yhk_lists_yh">微信</p><p class="fl">微信账号:<?php echo $v['account'];?></p>
                            <?php }else{?>
                                <p class="fl yhk_lists_yh"><?php echo $v['bk_name'];?></p><p class="fl">卡号:<?php echo $v['bk_card'];?></p>
                            <?php }?>
                        </li>
                        <?php }?>
                    </ul>
                    <p class="clearfix yhk_xzqtzf"><b class="fl">选择其他支付方式</b></p>
                </section>
            </div>
            <div class="tixian_btn">
                <em class="btn-style-3 saveBtn">确认充值</em>
            </div>
            
            <div id="alippay">
                <div class="erweima_zhifu clearfix">
                    <span class="fl"></span>
                    <div class="fl">
                        <p>股东支付宝：<b class="colorred">15336538031</b></p>
                        <p>账户姓名：<b class="colorred">张立事</b></p>
                        <p>手机支付宝扫描二维码，<i class="colorred">0手续费</i>快速转账</p>
                        <img src="__IMGPZ__/alipay-qr.png" alt="支付宝手机转账二维码"/>
                    </div>
                    <div class="fr" style="margin-top:60px;">
                        <p>支付宝官网支付</p>
                        <div style="width:200px; height:200px; border:1px solid #ddd; display:inline-block;">
                            <a href="https://shenghuo.alipay.com/send/payment/fill.htm" style="display:block;" target="_blank"> 
                                <img src="__IMGPZ__/alipay.jpg" alt="支付宝手机转账二维码" style="width:150px; height:40px; margin-top:80px;"> 
                            </a>
                        </div>
                    </div>
                </div>
                <p class="zhihubao_sm">
                    <b>支付宝转账说明：</b></br>
                    1.请尽量使用手机支付宝进行支付，转账快速且无需手续费</br>
                    2.工作日08:30 - 20:30 （30分钟内到账）</br>
                    3.非工作日或20:30 以后（将在下一个工作日的09:00前到账）</br>
                    4.如需加快到账或长时间未到账可拨打：<?php echo $webSet['tel'];?> 或 联系在线客服
                </p>
            </div>
            <div id="bankpay">
                <div class="erweima_zhifu clearfix">
                    <span class="fl"></span>
                    <div class="fl">
                        <p>收款银行：<img class="yhzz_cmb" src="__IMGPZ__/SPDB.png" alt="收款银行"/></p>
                        <p>收款账号：6217 9202 7033 6899</p>
                        <p>股东姓名：张立事</p>
                        <p>开户行：浦发银行钱塘支行</p>
                        <p>开户行所在地：浙江省杭州市</p>
                    </div>
                </div>
                <p class="zhihubao_sm">
                    1、充值之前，请进行实名认证，保证资金安全，提现必须在同名账户进行。</br>
                    2、转账时金额最好有些零头（如800.88），这样我们好确认是您的汇款</br>
                    3、用户转账之后，请务必保留网银转账成功时的截图，并在资金或者转账用途中备注写上自己要转入的豌豆财富网用户名，将回单发到QQ客服，以便尽快到账！
                    <a href="tencent://message/?uin=<?php echo $webSet['qq'];?>&amp;Site=qq&amp;Menu=yes" target="_blank" class="trasnfera">发给QQ客服</a>
                </p>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
function showpay(type){
	if(type == 'ALIPAY'){
		$('#alippay').show();
		$('#bankpay').hide();
	}else{
		$('#alippay').hide();
		$('#bankpay').show();
	}
}
$(function(){
	$('.yhk_lists li').click(function(){
		$(this).parent('.yhk_lists').find('li').hide();
		$(this).show();
		$(this).find('input[type="radio"]').prop('checked','true');
		$('.yhk_xzqtzf b').show();
		var type = $(this).find('input[type="radio"]').val();
		showpay(type);
	});
	$('.yhk_xzqtzf b').click(function(){
		$(this).parent('.yhk_xzqtzf').prev('.yhk_lists').find('li').show();
		$('.yhk_xzqtzf b').hide();
		
		$('#bankpay').hide();
		$('#alippay').hide();
	});
	
	$('.yhk_lists li').parent('.yhk_lists').find('li').hide();
	$('.yhk_lists li').parent('.yhk_lists').find('li').eq(0).show();
	$('.yhk_xzqtzf b').show();
	var type = $('.pay_type').eq(0).val();
	showpay(type);
	
	if(!$.trim(type)){
		CFW.dialog.alert('请先添加卡', 1, { listener: function () {window.location.href='/pzu/card.html'; } });
	}
	
	
	 $('.saveBtn').click(function(){
		    var obj = $(this),alt = obj.data('alt');
			if(alt > 0){
				return false;	
			}
			obj.data('alt',1);
            var amount = $('.amount').val();
            var pay_type = $('.pay_type').val();
            $.ajax({
                url:'/pzu/rechargeSave.html',
                cache: false,
                data: {amount:amount,pay_way:pay_type,i:Math.random()},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
                        CFW.dialog.alert(data.msg,4, { listener: function () {window.location.href="/pzu/rechargelog.html";} });
                    }else{
						obj.data('alt',0);
                        CFW.dialog.alert(data.msg, 3, null);
                    }
                }
            });
        });
});
</script> 
{include file="common/ufooter" /}