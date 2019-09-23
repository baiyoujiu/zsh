{include file="common/uheader" /}
<link rel="stylesheet" href="__CSSPZ__/cztx.css">
<div class="userright bg-wh tixian">
    <div class="gp_grzx_wdhydj">
        <div class="clearfix gp_kbgl_title">
            <p class="fl">提现</p>
        </div>
        <div class="gp_zhifu_lists">
            <div class="clearfix zhifu_lists">
                <span class="fl"><b class="colorred">*</b>选择提现方式：</span>
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
                    <p class="clearfix yhk_xzqtzf"><b class="fl colorred">选择其他支付方式</b></p>
                </section>
            </div>
            <div class="clearfix zhifu_dkwx">
                <span class="fl"><i class="colorred">*</i>账户余额：</span>
                <b class="fl"><i>¥</i><?php echo number_format($finfo['balance']/100,2);?>元</b>
            </div>
            <div class="clearfix zhifu_skwx">
                <span class="fl"><b class="colorred">*</b>提现金额：</span>
                <p class="fl"><i>¥</i><input type="text" class="amount" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" placeholder="请输入提现金额" /><i>元</i></p>
            </div>
            <div class="clearfix zhifu_skwx">
                <span class="fl"><b class="colorred">*</b>支付密码：</span>
                <p class="fl"><input style="width:260px;" class="paypass" type="password" placeholder="请输入支付密码" /></p><a class="fl" href="<?php echo url('pzu/inf');?>" title="忘记密码-配资178" rel="nofollow">忘记密码？</a>
            </div>
            <div class="tixian_btn">
                <em class="btn-style-3 saveBtn">确认提现</em>
            </div>
            
            <div class="fetchmoney">
                <div class="clearfix">
                  <ul>
                    <li class="clearfixtwo">
                      <dl>
                        <dt>最快<b class="colorred">15分钟</b>到账</dt>
                        <dd> 最快15分钟，16点左右集中办理并到账<br>
                          所有提现24小时内到账(节假日除外) </dd>
                      </dl>
                    </li>
                    <li class="clearfixtwo">
                      <dl>
                        <dt>提现<b class="colorred">0</b>手续费</dt>
                        <dd> 提现产生的银行手续费全免</dd>
                      </dl>
                    </li>
                    <li class="clearfixthree">
                      <dl>
                        <dt>支持银行多达<b class="colorred">10</b>多家</dt>
                        <dd> 推荐您使用工商银行、建设银行、<br>
                          招商银行、农业银行提现，到账最快 </dd>
                      </dl>
                    </li>
                  </ul>
                </div>
                <div class="lh48 b-t fs14 red" style="font-size: 14px;height: 48px;line-height: 48px;border-top: 1px solid #E9E9E9;color: #CC0000;"> 温馨提示：如需要更快完成提现，可致电：<?php echo $webSet['tel'];?></div>
              </div>
            
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
		$('.yhk_lists li').click(function(){
			$(this).parent('.yhk_lists').find('li').hide();
			$(this).show();
			$(this).find('input[type="radio"]').prop('checked','true');
			$('.yhk_xzqtzf b').show();
		});
		$('.yhk_xzqtzf b').click(function(){
			$(this).parent('.yhk_xzqtzf').prev('.yhk_lists').find('li').show();
			$('.yhk_xzqtzf b').hide();
		});
		$('.yhk_lists li').parent('.yhk_lists').find('li').hide();
		$('.yhk_lists li').parent('.yhk_lists').find('li').eq(0).show();
		$('.yhk_xzqtzf b').show();

		$('.saveBtn').click(function(){
            var amount = $('.amount').val();
            var pay_type = $('.pay_type').val();
            var paypass = $('.paypass').val();
            $.ajax({
                url:'/pzu/withdrawsave.html',
                cache: false,
                data: {amount:amount,pay_way:pay_type,paypass:paypass,i:Math.random()},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200){
                        CFW.dialog.alert(data.msg,4, { listener: function () {window.location.href="/pzu/withdrawlog.html";} });
                    }else{
                        CFW.dialog.alert(data.msg, 3, null);
                    }
                }
            });
        });
	});
</script> 
{include file="common/ufooter" /}