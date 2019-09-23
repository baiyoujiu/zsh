{include file="common/uheader" /}
<script type="text/javascript" src="__JSPZ__/cfw.min.js"></script>
<link rel="stylesheet" href="__CSSPZ__/cztx.css">
<div class="userright bg-wh">
    <div class="gp_grzx_wdhydj">
        <div class="clearfix gp_kbgl_title">
            <p class="fl">卡包管理</p>
            <?php if($webSet['id'] == 2){?>
            <p class="fl">　　<a class="colorred" target="_blank" href="<?php echo url('newsinf/20181127110000');?>" title="图文详解配资178充值/提现之卡包管理-配资178">卡包管理业务手册</a></p>
            <?php }?>
            <span class="fr tjyhk_btn">+添加账号</span>
        </div>
        <ul class="gp_yhkzs_lists">
            <?php foreach($lists as $k=>$v){?>
            <li class="clearfix">
                <?php if($v['pay_way'] == 'ALIPAY'){?>
                    <img class="fl" src="__IMGPZ__/zhibubao.png"/>
                <?php }elseif($v['pay_way'] == 'WECHAT'){?>
                    <img class="fl" src="__IMGPZ__/weixin.png"/>
                <?php }else{?>
                    <img class="fl" src="__IMGPZ__/<?php echo $v['pay_way'];?>1.png"/>
                <?php }?>
                <p class="fl">
                <?php if($v['pay_way'] == 'ALIPAY'){?>
                    <span>支付宝</span>&nbsp;&nbsp;<em>账号:<?php echo $v['account'];?></em>
                <?php }elseif($v['pay_way'] == 'WECHAT'){?>
                    <span>微信</span>&nbsp;&nbsp;<em>账号:<?php echo $v['account'];?></em>
                <?php }else{?>
                    <span><?php echo $v['bk_name'];?></span>&nbsp;&nbsp;<em>卡号:<?php echo $v['bk_card'];?></em>
                <?php }?>
                <?php echo ($v['is_def'])?'<em class="colorred">默认</em>':'';?>
                </p>
                <div class="fr clearfix">
                    <?php echo ($v['is_def'])?'':'<em class="fl toup" data-id="'.$v['id'].'">默认</em>';?>
                    <em class="fl toup" data-id="<?php echo $v['id'];?>" data-did="1">解除</em>
                </div>
            </li>
            <?php }?>
            
        </ul>
    </div>
</div>

<div class="popup_bg"></div>
<!--添加银行卡-->
<div class="gp_tj_yhk">
    <div class="gp_tj_yhk_head">添加账号</div>
    <div class="gp_tj_yhk_lists">
        <div class="gp_tj_wxzfs">
            <div class="gp_tj_wxzf clearfix">
                <img class="fl" src="__IMGPZ__/weixin.png">
                <p class="fl">添加微信</p>
                <input class="fr zhifu" type="radio" name="zhifu" value="2"/>
            </div>
            <div class="tj_wxzf_xinxi">
                <div class="clearfix tj_wxzf_xinxi_xm">
                    <p class="fl"><span class="colorred">*</span>真实姓名：</p>
                    <input class="fl" type="text" value="<?php echo $uinfo['real_name'];?>"<?php echo $uinfo['real_name']?' disabled="disabled"':'';?>/>
                </div>
                <div class="clearfix">
                    <p class="fl"><span class="colorred">*</span>微信手机号：</p>
                    <input class="fl keshuru wx_account" type="text" placeholder="请您输入微信账号" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"/>
                </div>
            </div>
        </div>
        <div class="gp_tj_wxzfs">
            <div class="gp_tj_wxzf clearfix">
                <img class="fl" src="__IMGPZ__/zhibubao.png">
                <p class="fl">添加支付宝</p>
                <input class="fr zhifu" type="radio" name="zhifu" value="3"/>
            </div>
            <div class="tj_zfbzf_xinxi">
                <div class="clearfix tj_wxzf_xinxi_xm">
                    <p class="fl"><span class="colorred">*</span>真实姓名：</p>
                    <input class="fl" type="text" value="<?php echo $uinfo['real_name'];?>"<?php echo $uinfo['real_name']?' disabled="disabled"':'';?>/>
                </div>
                <div class="clearfix">
                    <p class="fl"><span class="colorred">*</span>支付宝账号：</p>
                    <input class="fl keshuru zfb_account" type="text" placeholder="请您输入支付宝账号"/>
                </div>
            </div>
        </div>
        <div class="gp_tj_wxzfs">
            <div class="gp_tj_wxzf clearfix">
                <img class="fl" src="__IMGPZ__/wyinhangka.png">
                <p class="fl">添加银行卡</p>
                <input class="fr zhifu" type="radio" name="zhifu" value="4"/>
            </div>
            <div class="tj_yhkzf_xinxi">
                <div class="clearfix tj_wxzf_xinxi_xm">
                    <p class="fl"><span class="colorred">*</span>真实姓名：</p>
                    <input class="fl" type="text" placeholder="请您输入真实姓名" value="<?php echo $uinfo['real_name'];?>"<?php echo $uinfo['real_name']?' disabled="disabled"':'';?>/>
                </div>
                <div class="clearfix tj_wxzf_xinxi_xm">
                    <p class="fl"><span class="colorred">*</span>银行名称：</p>
                    <div class="fl xz_yhk">
                        <div class="xz_yhk_titles">
                            <input class="xz_yhk_title" type="text" placeholder="--请选择银行--" readonly/>
                            <img class="imgss" src=""/>
                        </div>
                        <ul class="xz_yhk_lists" value="0">
                            <?php foreach($cardlist as $k=>$v){if($k){?>
                            <li class="clearfix" data-id="<?php echo $k;?>">
                                <img class="fl" src="__IMGPZ__/<?php echo $v;?>" alt="银行名称"/>
                            </li>
                            <?php }}?>
                        </ul>
                    </div>
                </div>
                <div class="clearfix tj_wxzf_xinxi_xm">
                    <p class="fl"><span class="colorred">*</span>开户银行：</p>
                    <input class="fl bk_fname" type="text" placeholder="请您输入开户银行"/>
                </div>
                <div class="clearfix tj_wxzf_xinxi_xm">
                    <p class="fl"><span class="colorred">*</span>银行卡号：</p>
                    <input class="fl bk_card" type="text" placeholder="请您输入银行卡号" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"/>
                </div>
            </div>
        </div>
        <div class="kb_qrbtn">
        	<input type="hidden" class="pay_type" value=""/>
            <p>保存</p>
        </div>
        <div class="Closebtn"></div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
		$('.tjyhk_btn').click(function(){
			$('.popup_bg').show();
			$('.gp_tj_yhk').show();
			$('.zhifu').click();
			$(document.body).css({ "overflow-y": "hidden"});
		});
		$('.popup_bg,.Closebtn').click(function(){
			$('.popup_bg').hide();
			$('.gp_tj_yhk').hide();
			$(document.body).css({ "overflow-y": "auto"});
		});
		//微信,支付宝，银行卡支付
		$('.zhifu').click(function(){
			if($(this).val()==2){
				$('.tj_wxzf_xinxi').show();
				$('.tj_zfbzf_xinxi').hide();
				$('.tj_yhkzf_xinxi').hide();
				$('.pay_type').val('WECHAT');	
			}else if($(this).val()==3){
				$('.tj_wxzf_xinxi').hide();
				$('.tj_zfbzf_xinxi').show();
				$('.tj_yhkzf_xinxi').hide();
				$('.pay_type').val('ALIPAY');
			}else if($(this).val()==4){
				$('.tj_wxzf_xinxi').hide();
				$('.tj_zfbzf_xinxi').hide();
				$('.tj_yhkzf_xinxi').show();
				$('.pay_type').val('');
			};
		});
		//选择银行
		$('.xz_yhk_titles').click(function(){
			if($('.xz_yhk_lists').val()==0){
				$('.xz_yhk_lists').show();
				$('.xz_yhk_lists').val('1');
			}else if($('.xz_yhk_lists').val()==1){
				$('.xz_yhk_lists').hide();
				$('.xz_yhk_lists').val('0');
			}
		});
		$('.xz_yhk_lists li').click(function(){
			$(this).parent('.xz_yhk_lists').parent('.xz_yhk').find('.xz_yhk_titles input').hide();
			var imgsss=$(this).find('img')[0].src;
			$('.imgss').attr('src',imgsss).show();
			$('.xz_yhk_lists').hide();
			$('.xz_yhk_lists').val('0');
			
			var bankId = $(this).data('id');
			$('.pay_type').val(bankId);
		});
		
		//添加卡包
        $('.kb_qrbtn').click(function(){
            var pay_type = $('.pay_type').val();
            var wx_account = $('.wx_account').val();
            var zfb_account = $('.zfb_account').val();
            var bk_card = $('.bk_card').val();
            var bk_fname = $('.bk_fname').val();
            $.ajax({
                url: '/pzu/cardsave.html',
                cache: false,
                data: {pay_type:pay_type,wx_account:wx_account,zfb_account:zfb_account,bk_card:bk_card,bk_fullname:bk_fname,i:Math.random()},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
                        window.location.href="/pzu/card.html";
                    }else{
                        CFW.dialog.alert(data.msg, 3, null);
                    }
                }
            });
        });
		
		//默认解除
		$('.toup').click(function () {
			var obj = $(this),objid = $(this).data('id'),del = $(this).data('did');
			$.ajax({
                url: '/pzu/cardjc.html',
                cache: false,
                data: {objid:objid,del:del,i:Math.random()},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
						window.location.href="/pzu/card.html";
                    }else{
                        CFW.dialog.alert(data.msg, 3, null);
                    }
                }
            });
		});
});
</script> 
{include file="common/ufooter" /}