{include file="common/uheader" /}
<div class="user_right_box2017">
  <div class="personself" style="padding:20px;">
    <div class="myin_row1_box">
        <!--<h1><i></i><span class="notice_box"><a href="/">...</a><span class="day"></span></span></h1>-->
        <div class="remaining_money">
            <p class="title"><i></i>账户余额
            </p>
            <p class="btnmoney_inout">
                <span class="balance"><strong><?php echo number_format($finfo['balance']/100,2);?></strong>元</span>
                <a href="<?php echo url('pzu/withdraw');?>" title="提现" class="active">提现</a>
                <a href="<?php echo url('pzu/recharge');?>" title="充值">充值</a>
                <span style="margin-right:1px;">|</span>
                <a href="<?php echo url('pzu/account');?>" title="账户收支明细">账户收支明细</a>
            </p>
        </div>
    </div>
    
    <div class="personselftitle">
      <h1><i></i><a href="#">我的头像</a></h1>
      <div class="personselftitle-one">
        <dl>
          <dt><img src="<?php echo empty($info['head_pic'])? '__IMGPZ__/my_default_icon.png': $info['head_pic'];?>"></dt>
          <dd class="Calle"> <span class="Call">用户名：<?php echo $info['username'];?></span> <span class="Calla"></span> </dd>
          <dd> <span class="Callc">手机</span> <span class="Callb-a"><?php echo substr($info['phone'],0,3).'****'.substr($info['phone'],-4);?></span> </dd>
          <dd class="Calld">上传个性头像，方便用户记住你。建议头像大小200*200，格式为：gif、jpg、png、jpeg。</dd>
        </dl>
        <span class="personselftitle-two"><a href="javascript:void(0);" id="AccountRestAvatarBtn">重置头像</a></span> </div>
    </div>
    
    <!--我的资料 head-->
    <div class="ZiLiaoHead">
        <span class="MyZiliao"><i></i><a href="#">我的资料</a></span>
        <?php if($webSet['id'] == 2){?>
        <span class="MyZiliao">　　<a style="color:red;" target="_blank" href="<?php echo url('zt/1812030');?>" title="帮助中心-配资178">查看平台业务手册></a></span>
        <?php }?>
    </div>
    <div class="IMF">
      <dl class="IMFone">
        <dt></dt>
        <dd class="IMFonea"> <span class="IMFoneO">账户设置</span>
          <span class="IMFoneT">用户名：<?php echo $info['username'];?></span>
        </dd>
        <dd class="IMFoneb"> <span class="IMFtwo">账户信息设置</span> </dd>
        <dd class="IMFonec"> <a class="Shiming" data_index="7">设置</a> </dd>
      </dl>
      <dl class="IMFone">
        <dt></dt>
        <dd class="IMFonea"> <span class="IMFoneO">实名认证</span>
          <?php if($uinfo['status'] != 1){?>
          <span class="IMFoneT" id="uploadpic" style="color:red;">未认证</span><span class="IMFimg"></span>
          <?php }else{?>
          <span class="IMFoneT">已认证：<?php echo $uinfo['real_name'];?></span>
          <?php }?>
        </dd>
        <dd class="IMFoneb"> <span class="IMFtwo">实名认证后才能进行资金操作</span> </dd>
        <dd class="IMFonec"> <a class="Shiming" data_index="1"><?php echo ($uinfo['status'] != 1) ? '认证':'查看';?></a></dd>
      </dl>
      <dl class="IMFthree">
        <dt></dt>
        <dd class="IMFthreea"> <span class="IMFthreeO">绑定手机</span> <span class="IMFthreeT">已绑定： <?php echo substr($info['phone'],0,3).'****'.substr($info['phone'],-4)?></span> </dd>
        <dd class="IMFthreeb"> <span class="IMFtwo">手机号码是您在<?php echo $pzSeo['title'];?>的重要身份凭证</span> </dd>
        <dd class="IMFthreec"> <a class="Shiming" data_index="2">修改</a> </dd>
      </dl>
      <dl class="IMFfive">
        <dt></dt>
        <dd class="IMFfivea"> <span class="IMFfiveO">登录密码</span> <span class="IMFfiveT">已设置</span> </dd>
        <dd class="IMFfiveb"> <span class="IMFtwo">登录<?php echo $pzSeo['title'];?>时需要输入的密码</span> </dd>
        <dd class="IMFfivec"> <a class="Shiming" data_index="3">修改</a> </dd>
      </dl>
      <dl class="IMFsix">
        <dt></dt>
        <dd class="IMFsixa"> <span class="IMFsixO">支付密码</span>
          <?php if(empty($finfo['paypass'])){?>
          <span class="IMFfourT" style="color:red;">未绑定</span><span class="IMFimg"></span>
          <?php }else{?>
          <span class="">已设置</span>
          <?php }?>
        </dd>
        <dd class="IMFsixb"> <span class="IMFtwo" style="color:#989898;">保障资金安全，支付需要设置支付密码</span> </dd>
        <dd class="IMFsixc">
          <?php if(empty($finfo['paypass'])){?>
          <a class="Shiming" data_index="5">设置</a>
          <?php }else{?>
          <a class="Shiming" data_index="4">修改</a> <a class="Shiming " data_index="6"style="float: right;width: 90px;height: 24px;background: #ff5256;color: white;line-height: 25px;text-align: center;margin-top: 3px;">重置密码</a>
          <?php }?>
        </dd>
      </dl>
    </div>
  </div>
  
  <!--弹窗区域-->
  <div class="bg_black"></div>
  <div class="md_pop"> 
    <!-- 实名认证 -->
    <div class="shortcut_keyboard" id="aa">
      <!--关闭按钮-->
      <div class="Closebtn"></div> 
      <div class="user-box-con-1">
        <form id="ucert" onsubmit="btnCertCard()">
        <table cellpadding="0" cellspacing="0" class="SMifm" style="width: 100%;margin-top: 15px;height: 70%;border: 1px solid #DEDEDE;">
          <tr>
            <th class="label"> 用户名 </th>
            <td><span><?php echo $info['username'];?></span></td>
          </tr>
          <tr>
            <th class="label"> 真实姓名<span class="colorred">*</span></th>
            <td><input class="BrdHei"  placeholder="请输入您的姓名" name="real_name" id="real_name" type="text" value="<?php echo $uinfo['real_name'];?>" /></td>
          </tr>
          <tr>
            <th class="label"> 身份证号<span class="colorred">*</span></th>
            <td><input class="BrdHei" id="identity" name="identity" type="text" value="<?php echo $uinfo['identity'];?>"  placeholder="请输入身份证号"/></td>
          </tr>
          <?php if($uinfo['status'] != 1){?>
          <tr>
            <td colspan="4" align="center"><input type="submit" value="提交" class="btn btn-s"/></td>
          </tr>
          <?php }?>
        </table>
        
        </form>
      </div>
      <div class="Closebtn"></div>
    </div>
    <!--绑定手机-->
    <div class="BDmobile">
      <h1>绑定手机</h1>
      <table cellpadding="0" cellspacing="0" id="first-step" style="width: 100%;margin-top: 25px;height: 40%;border: 1px solid #DEDEDE;">
        <tr>
          <th class="JianJu"> 原手机号码 </th>
          <td><?php echo substr($info['phone'],0,3).'****'.substr($info['phone'],-4)?>
            <input type="hidden" id="OrgVCodeTick" name="OrgVCodeTick" value="0" /></td>
        </tr>
        <tr>
          <th> 验证码 </th>
          <td><input class="BrdHei" style="vertical-align:middle; width:100px;" maxlength="6" id="OrgVCode" name="OrgVCode" type="text" value="" placeholder="验证码"/>
            <input class="BtnSty disable" id="getOrgVCode" disabled="disabled" type="button" value="获取验证码" /></td>
        </tr>
        <tr>
          <th> </th>
          <td><input class="BtnSty" type="button" onclick="nextStep()" value=" 下一步"  style="margin-top:20px;margin-bottom:20px;width:150px;"/></td>
        </tr>
      </table>
      <div style="display: none;" id="second-step">
        <table cellpadding="0" cellspacing="0">
          <tr>
            <th> 新手机号码 </th>
            <td><input type="hidden" id="NewVCodeTick" name="NewVCodeTick" value="0" placeholder="请输入新手机号码" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"/>
              <input type="text" value="" id="NewMobile" class="newphonenum" /></td>
          </tr>
          <tr>
            <th> 验证码 </th>
            <td><input type="text" value="" maxlength="6" id="NewVCode" name="NewVCode" class="newphonenum" />
              <input id="getNewVCode" class="newphonebtn disable" type="button" disabled="disabled" value="获取验证码" /></td>
          </tr>
          <tr>
            <th> </th>
            <td><input class="newphonebtn" id="submitBtn" type="button" onclick="UpdateNewPhone()" value="确认修改" /></td>
          </tr>
        </table>
      </div>
      <div class="Closebtn"></div>
    </div>
    <!--登录密码-->
    <div class="Enterpsw">
      <h1>登录密码</h1>
      <form id="logpass">
      <table cellpadding="0" cellspacing="0" style="  width: 100%;margin-top: 25px;height: 70%;border: 1px solid #DEDEDE;">
        <tr>
          <th> 原密码 </th>
          <td><input class="BrdHei" id="OrgPayPassword" name="orgpass" type="password" placeholder="请输入原密码"/></td>
        </tr>
        <tr>
          <th> 新密码 </th>
          <td><input class="BrdHei" name="newpass" id="PayPassword" type="password" onchange="CheckNewPwd()" placeholder="请输入新密码"/></td>
        </tr>
        <tr>
          <th> 确认新密码 </th>
          <td><input class="BrdHei" name="renewpass" id="ConfirmPayPassword" type="password" onchange="CheckConfirmPwd()" placeholder="请确认新密码"/></td>
        </tr>
        <tr>
          <th class="label"> </th>
          <td><input class="BtnSty" type="button" onclick="BtnSubmitPwd()" value="提交" style="margin:20px 0px;width:150px;" /></td>
        </tr>
      </table>
      </form>
      <div class="Closebtn"></div>
    </div>
    <!--修改支付密码-->
    <div class="TXpsw">
      <h1>修改支付密码</h1>
      <form id="upaypass">
      <table cellpadding="0" cellspacing="0" style="width: 100%;margin-top: 25px;height: 70%;border: 1px solid #DEDEDE;">
        <tr>
          <th class="label"> 原支付密码 </th>
          <td><input class="BrdHei" id="orgWithdrawPwd" name="orgpass" type="password" placeholder="请输入原支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> 新支付密码 </th>
          <td><input class="BrdHei" id="newWithdrawPwd" name="newpass" type="password" onchange="CheckWDNewPwd()" placeholder="请输入新支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> 确认支付密码 </th>
          <td><input class="BrdHei" id="confirmWithdrawPwd" name="renewpass" type="password" onchange="CheckConfirmWDPwd()" placeholder="请确认支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> </th>
          <td><input class="BtnSty" type="button" onclick="BtnSubmitwdPwd()" value="提交" style="margin:20px 0; width:150px;" /></td>
        </tr>
      </table>
      </form>
      <div class="Closebtn"></div>
    </div>
    <!--设置支付密码-->
    <div class="TXpsw">
      <h1>设置支付密码</h1>
      <form id="spaypass">
      <table cellpadding="0" cellspacing="0" style="width: 100%;margin-top: 25px;height: 70%;border: 1px solid #DEDEDE;">
        <tr>
          <th class="label"> 支付密码 </th>
          <td><input class="BrdHei" id="setWithdrawPwd" type="password" name="newpass" onchange="CheckSetWDNewPwd()" placeholder="请输入支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> 确认支付密码 </th>
          <td><input class="BrdHei" id="confirmSetWithdrawPwd" type="password" name="renewpass" onchange="CheckConfirmSetWDPwd()" placeholder="请输入确认支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> </th>
          <td><input class="BtnSty" type="button" onclick="BtnSubmitSetwdPwd()" value="提交" style="margin:20px 0; width:150px;" /></td>
        </tr>
      </table>
      </form>
      <div class="Closebtn"></div>
    </div>
    <!--重置支付密码-->
    <div class="forgerpsw">
      <h1>重置支付密码</h1>
      <form id="rpaypass">
      <table cellpadding="0" cellspacing="0" style="width: 100%;margin-top: 25px;height: 70%;border: 1px solid #DEDEDE;">
        <tr>
          <th class="label"> 手机号 </th>
          <td><span><?php echo substr($info['phone'],0,3).'****'.substr($info['phone'],-4)?></span></td>
        </tr>
        <tr>
          <th class="label"> 验证码 </th>
          <td><input class="BrdHei" style="vertical-align:middle; width:80px;" id="forGetVCode" name="forGetVCode" type="text" value="" placeholder="验证码"/>
            <input class="BtnSty disable" id="forGetVCodeVCode" disabled="disabled" type="button" value="获取验证码" /></td>
        </tr>
        <tr>
          <th class="label"> 新支付密码 </th>
          <td><input class="BrdHei" type="password" id="newPayPwdId" name="newpass" onchange="CheckNewPayPwd()" placeholder="请输入新支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> 确认支付密码 </th>
          <td><input class="BrdHei" type="password" id="confimPayPwdId" name="renewpass" onchange="CheckConfirmNewPayPwd()" placeholder="请确认支付密码"/></td>
        </tr>
        <tr>
          <th class="label"> </th>
          <td><input class="BtnSty" type="button" onclick="BtnSubmitNewPayPwd()" value="提交" style="margin:20px 0; width:150px;" /></td>
        </tr>
      </table>
      </form>
      <div class="Closebtn"></div>
    </div>
    <!--账户设置-->
    <div class="Enterpsw">
          <h1>账户设置</h1>
          <form id="uset">
          <table cellpadding="0" cellspacing="0" style="  width: 100%;margin-top: 25px;height: 70%;border: 1px solid #DEDEDE;">
              <tr>
                  <th> 用户名<span class="colorred">*</span></th>
                  <td colspan="2"><input class="BrdHei" id="user_name" name="user_name" type="text" value="<?php echo $info['username'];?>" placeholder="请输入用户名" /></td>
              </tr>
              
              <?php if($info['utype'] == 1){?>
              <tr>
                  <th>周交稿数<span class="colorred">*</span></th>
                  <td><input class="BrdHei" id="weeknum" name="weeknum" type="number"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="<?php echo $infomore['weeknum'];?>" placeholder="请输入理论周交稿数" /></td>
                  <th>开启约稿<span class="colorred">*</span></th>
                  <td><input name="free" type="radio" value="1"<?php echo $infomore['free']==1?' checked':''; ?> />我有空　<input name="free" type="radio" value="2"<?php echo $infomore['free']==2?' checked':''; ?>/>稿期已满</td>
              </tr>
              <?php }else{?>
              <tr>
                  <th>周需稿数<span class="colorred">*</span></th>
                  <td colspan="3"><input class="BrdHei" id="weeknum" name="weeknum" type="number"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="<?php echo $infomore['weeknum'];?>" placeholder="请输入理论周需稿数" /></td>
              </tr>
              <tr>
                  <th>联系人姓名<span class="colorred">*</span></th>
                  <td><input class="BrdHei" id="linkman" name="linkman" type="text" value="<?php echo $infomore['linkman'];?>" placeholder="请输入联系人姓名" /></td>
                  <th>联系人手机<span class="colorred">*</span></th>
                  <td><input class="BrdHei" id="linkphone" name="linkphone" type="text" value="<?php echo empty($infomore['linkphone'])?$info['phone']:$infomore['linkphone'];?>" placeholder="请输入联系人手机" /></td>
              </tr>
              <?php }?>
              
              <tr>
                  <th> QQ号</th>
                  <td><input class="BrdHei" id="user_qq" name="user_qq" type="text" value="<?php echo $info['qq'];?>" placeholder="请输入QQ号" /></td>
                  <th> 微信号</th>
                  <td><input class="BrdHei" id="user_weixin" name="user_weixin" type="text" value="<?php echo $info['weixin'];?>" placeholder="请输入微信号" /></td>
              </tr>
              <tr>
                  <th><?php echo ($info['utype'] == 1)?'简介':'稿件要求';?><span class="colorred">*</span></th>
                  <td colspan="3"><textarea id="feedback" name="content" cols="69" rows="5" placeholder="<?php echo ($info['utype'] == 1)?'简介':'稿件要求，案例稿等';?>" ><?php echo $infomore['content'];?></textarea></td>
              </tr>
              <tr>
                  <td colspan="4" align="center"><input class="BtnSty" type="button" onclick="BtnSubmitUname()" value="提交" style="margin:20px 0px;width:150px;" /></td>
              </tr>
          </table>
          </form>
          <div class="Closebtn"></div>
      </div>
  </div>
</div>
<form action="<?php echo url('pzu/restpic');?>" class="form-horizontal" id="restHeadForm" target="uploadframe" enctype="multipart/form-data" method="post" accept-charset="utf-8" style="display:none;">
<input name="userfile" type="file" id="restHeadFile" />
<input name="restHeadSubmit" type="submit" id="restHeadSubmit"/>
</form>  
<iframe style="display:none" mce_style="display:none" name="uploadframe"></iframe>   
  
  <!--<script src="/Scripts/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Scripts/jquery.validate.unobtrusive.min.js" type="text/javascript"></script>
<script src="/content/js.lib/plupload-2.1.2/plupload.full.min.js" type="text/javascript"></script>--> 
  
<script type="text/javascript">
	$('#AccountRestAvatarBtn').click(function(){
		$('#restHeadFile').click();
	});  
  	$('#restHeadFile').change(function(){
		$('#restHeadSubmit').click();
	});
  	
    $(function () {
        $(".Shiming").click(function () {
            var index = parseInt($(this).attr("data_index"));
            $(".md_pop").show();
            $(".md_pop>div").eq(index - 1).show();
            $(".bg_black").show();
            //var dh = $(".md_pop>div").eq(index).outerHeight();
            var dh = 460;
            var ih = $(window).height();
            var zh = (ih - dh) / 2;
            $(".md_pop>div").eq(index - 1).css("top", zh);

        });
        $(".Closebtn").click(function() {
            $(this).parent("div").hide().parent(".md_pop").hide();
            $(".bg_black").hide();
        });
    });

    window.orgTicks = 0;
    window.newTicks = 0;
	 window.forGetTicks = 0;
    $(function () {
        window.orgT = setInterval(checkGetOrgVCodeBtn, 1000);
        window.newT = setInterval(checkGetNewVCodeBtn, 1000);
		window.forGetT = setInterval(checkGetforGetVCodeBtn, 1000);
    });
	
	/*修改手机号*/
    function checkGetOrgVCodeBtn() {
        window.orgTicks--;
        var getOrgVCodeBtn = $("#getOrgVCode");
        if (window.orgTicks <= 0) {
            getOrgVCodeBtn.removeClass("disable");
            getOrgVCodeBtn.attr("disabled", false);
            getOrgVCodeBtn.val("获取验证码");
            clearInterval(window.orgT);
        } else {
            if (!getOrgVCodeBtn.hasClass("disable")) {
                getOrgVCodeBtn.addClass("disable");
                getOrgVCodeBtn.attr("disabled", true);
            }
            getOrgVCodeBtn.val(window.orgTicks + " 秒后重新获取");
        }
    }
    function checkGetNewVCodeBtn() {
        window.newTicks--;
        var VCodeBtn = $("#getNewVCode");
        if (window.newTicks <= 0) {
            VCodeBtn.removeClass("disable");
            VCodeBtn.attr("disabled", false);
            VCodeBtn.val("获取验证码");
            clearInterval(window.newT);
        } else {
            if (!VCodeBtn.hasClass("disable")) {
                VCodeBtn.addClass("disable");
                VCodeBtn.attr("disabled", true);
            }
            VCodeBtn.val(window.newTicks + " 秒后重新获取");
        }
    }
	$('#getOrgVCode').click(function(){
		var VCodeBtn = $(this);
		VCodeBtn.addClass("disable");
		VCodeBtn.attr("disabled", true);
        VCodeBtn.val("获取验证码");
		$.ajax({
            url: '/pzu/sendcode.html',
            cache: false,
            data: { type:'original',i:Math.random()},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
					 window.orgTicks = 90;
					 window.orgT = setInterval(checkGetOrgVCodeBtn, 1000);
                }
            }
        });
	});
	$('#getNewVCode').click(function(){
		var VCodeBtn = $(this);
		
		var newMobile = $("#NewMobile").val();
        var reg = /^[1]\d{10}$/;
        if (!reg.test(newMobile)) {
            CFW.dialog.alert('请输入正确的手机号码', 0, null);
            return;
        }
		
		VCodeBtn.addClass("disable");
		VCodeBtn.attr("disabled", true);
        VCodeBtn.val("获取验证码");
		$.ajax({
            url: '/pzu/sendcode.html',
            cache: false,
            data: { type: 'newMobile', mobile: newMobile,i:Math.random()},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
					 window.newTicks = 90;
					 window.newT = setInterval(checkGetNewVCodeBtn, 1000);
                }else{
					
				}
            }
        });
	});
    function nextStep() {
        var nextBtn = $("#nextBtn");
		var getNewVCode = $('#getNewVCode');
        if (!nextBtn.hasClass("disable")) {
            nextBtn.addClass("disable");
            nextBtn.attr("disabled", true)
        }
        var orgVCode = $("#OrgVCode").val();
        var reg = /^\d{6}$/;
        if (orgVCode == "") {
            nextBtn.removeClass("disable");
            nextBtn.attr("disabled", false);
            CFW.dialog.alert('请输入手机验证码', 0, null);
            return;
        }

        if (reg.test(orgVCode)) {
            $.ajax({
                url: '/pzu/checkCode.html',
                cache: false,
                data: {code:orgVCode,i:Math.random()},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
						getNewVCode.removeClass("disable");
                        getNewVCode.attr("disabled", false);
                        $("#first-step").css("display", "none");
                        $("#second-step").css("display", "block");
                    } else {
						nextBtn.removeClass("disable");
                        nextBtn.attr("disabled", false);
                        CFW.dialog.alert(data.msg, 0, null);
                    }
                }
            });
        } else {
            nextBtn.removeClass("disable");
            nextBtn.attr("disabled", false);
            CFW.dialog.alert('请输入正确的验证码', 0, null);
        }
    }
    function UpdateNewPhone(){
        var newMobile =$("#NewMobile").val();
        var newVCode =$("#NewVCode").val();
        $.ajax({
            url: '/pzu/savephone.html',
            cache: false,
            data: { newMobile: newMobile, code: newVCode,i:Math.random()},
            type: 'post',
			dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () { window.location.reload(); } });
                }else{
					CFW.dialog.alert(data.msg, 1, null);
                }

            }
        });
    }

	/*修改登陆密码*/
    function BtnSubmitPwd(){
        var orgPayPassword =$("#OrgPayPassword").val();
        var payPassword =$("#PayPassword").val();
        //var pwdVCode =$("#pwdVCode").val();
        var confirmPayPassword =$("#ConfirmPayPassword").val();

        if (orgPayPassword =="") {
            CFW.dialog.alert('原密码不能为空', 0, null);
            return;
        }
        if (payPassword =="") {
            CFW.dialog.alert('新密码不能为空', 0, null);
            return;
        }
        if (confirmPayPassword =="") {
            CFW.dialog.alert('确认密码不能为空', 0, null);
            return;
        }

        if (payPassword.length <6 ||payPassword.length >20 ) {
            CFW.dialog.alert('密码长度为6到20个字符', 0, null);
            return;
        }

        if (payPassword !=confirmPayPassword) {
            CFW.dialog.alert('两次输入的帐号密码不一致', 0, null);
            return;
        }


        $.ajax({
            url: '/pzu/savelogpass.html',
            type: "post",
            cache: false,
			dataType : 'json',
            data:$("#logpass").serialize(),
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () {window.location.reload(); } });
                }else{
                    CFW.dialog.alert(data.msg, 0, null);
                }

            }
        });
    }
    function CheckNewPwd(){
        var payPassword =$("#PayPassword").val();
        if (payPassword.length <6 ||payPassword.length >20 ) {
            CFW.dialog.alert('密码长度为6到20个字符', 0, null);
        }
    }
    function CheckConfirmPwd(){
        var payPassword =$("#PayPassword").val();
        var confirmPayPassword =$("#ConfirmPayPassword").val();
        if (payPassword !=confirmPayPassword) {
            CFW.dialog.alert('两次输入的帐号密码不一致', 0, null);
        }
    }

	/*修改支付密码*/
    function BtnSubmitwdPwd(){
        var orgWithdrawPwd =$("#orgWithdrawPwd").val();
        var newWithdrawPwd =$("#newWithdrawPwd").val();
       // var withdrawVcode =$("#withdrawVcode").val();
        var confirmWithdrawPwd =$("#confirmWithdrawPwd").val();

        if (orgWithdrawPwd =="") {
            CFW.dialog.alert('原支付密码不能为空', 0, null);
            return;
        }
        if (newWithdrawPwd =="") {
            CFW.dialog.alert('新支付密码不能为空', 0, null);
            return;
        }
        if (confirmWithdrawPwd =="") {
            CFW.dialog.alert('确认支付密码不能为空', 0, null);
            return;
        }

        if (newWithdrawPwd.length <8 ||newWithdrawPwd.length >20 ) {
            CFW.dialog.alert('密码长度为8到20个字符', 0, null);
        }

        if (newWithdrawPwd !=confirmWithdrawPwd) {
            CFW.dialog.alert('两次输入的支付密码码不一致', 0, null);
        }

        $.ajax({
            url:'/pzu/upaypass.html',
            type: "post",
			dataType : 'json',
            cache: false,
            data:$("#upaypass").serialize(),
            success : function(data) {
				if(data.status == 200 ) {  
					CFW.dialog.alert(data.msg, 4, { listener: function () { window.location.reload(); } });
				}else{    
					CFW.dialog.alert(data.msg, 1, null);
				}  
			},
			error : function(){
				alert("异常！");   
			}
        });
    }
    function CheckWDNewPwd(){
        var newWithdrawPwd =$("#newWithdrawPwd").val();
        if (newWithdrawPwd.length <8 ||newWithdrawPwd.length >20 ) {
            CFW.dialog.alert('密码长度为8到20个字符', 0, null);
        }
    }
    function CheckConfirmWDPwd(){
        var newWithdrawPwd =$("#newWithdrawPwd").val();
        var confirmWithdrawPwd =$("#confirmWithdrawPwd").val();
        if (newWithdrawPwd !=confirmWithdrawPwd) {
            CFW.dialog.alert('两次输入的支付密码不一致', 0, null);
        }
    }

	/*设置支付密码*/
    function BtnSubmitSetwdPwd(){
        var setWithdrawPwd =$("#setWithdrawPwd").val();
        if (setWithdrawPwd =="") {
            CFW.dialog.alert('支付密码不能为空', 0, null);
            return;
        }
        if (confirmSetWithdrawPwd =="") {
            CFW.dialog.alert('确认支付密码不能为空', 0, null);
            return;
        }

        if (setWithdrawPwd.length <8 ||setWithdrawPwd.length >20 ) {
            CFW.dialog.alert('密码长度为8到20个字符', 0, null);
            return;
        }

        var confirmSetWithdrawPwd =$("#confirmSetWithdrawPwd").val();
        if (setWithdrawPwd !=confirmSetWithdrawPwd) {
            CFW.dialog.alert('两次输入的支付密码不一致', 0, null);
            return;
        }
        $.ajax({
            url:'/pzu/spaypass.html',
            type: "post",
			dataType : 'json',
            cache: false,
            data:$("#spaypass").serialize(),
			success : function(data) {
				if(data.status == 200 ) {  
					CFW.dialog.alert(data.msg, 4, { listener: function () { window.location.reload(); } });

				}else{    
					CFW.dialog.alert(data.msg, 1, null);
				}  
			},
			error : function(){
				alert("异常！");   
			}
			
        });
    }

    function CheckSetWDNewPwd(){
        var setWithdrawPwd =$("#setWithdrawPwd").val();
        if (setWithdrawPwd.length <8 ||setWithdrawPwd.length >20 ) {
            CFW.dialog.alert('密码长度为8到20个字符', 0, null);
        }
    }
    function CheckConfirmSetWDPwd(){
        var setWithdrawPwd =$("#setWithdrawPwd").val();
        var confirmSetWithdrawPwd =$("#confirmSetWithdrawPwd").val();
        if (setWithdrawPwd !=confirmSetWithdrawPwd) {
            CFW.dialog.alert('两次输入的支付密码不一致', 0, null);
        }
    }

	/*重置支付密码*/
    function checkGetforGetVCodeBtn() {
        window.forGetTicks--;
        var getVCodeBtn = $("#forGetVCodeVCode");
        if (window.forGetTicks <= 0) {
            getVCodeBtn.removeClass("disable");
            getVCodeBtn.attr("disabled", false);
            getVCodeBtn.val("获取验证码");
            clearInterval(window.forGetT);
        } else {
            if (!getVCodeBtn.hasClass("disable")) {
                getVCodeBtn.addClass("disable");
                getVCodeBtn.attr("disabled", true);
            }
            getVCodeBtn.val(window.forGetTicks + " 秒后重新获取");
        }
    }
	$('#forGetVCodeVCode').click(function(){
		var getVCodeBtn = $("#forGetVCodeVCode");
        window.forGetTicks = 90;
        getVCodeBtn.addClass("disable");
        getVCodeBtn.attr("disabled", true);

        $.ajax({
            url: '/pzu/sendcode.html',
            cache: false,
            data: { type: 'restpay', i: Math.random() },
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status != 200) {
                    CFW.dialog.alert(data.msg, 0, null);
                }
                window.forGetT = setInterval(checkGetforGetVCodeBtn, 1000);
            }
        });
		
	});
    function CheckNewPayPwd(){
        var newPayPwdId =$("#newPayPwdId").val();
        if (newPayPwdId.length <8 ||newPayPwdId.length >20 ) {
            CFW.dialog.alert('密码长度为8到20个字符', 0, null);
        }
    }
    function CheckConfirmNewPayPwd(){
        var newPayPwdId =$("#newPayPwdId").val();
        var confimPayPwdId =$("#confimPayPwdId").val();
        if (newPayPwdId !=confimPayPwdId) {
            CFW.dialog.alert('两次输入的密码不一致', 0, null);
        }
    }
    function BtnSubmitNewPayPwd(){
        var newPayPwdId =$("#newPayPwdId").val();
        var confimPayPwdId =$("#confimPayPwdId").val();
        var forGetVCode =$("#forGetVCode").val();

        if (forGetVCode =="") {
            CFW.dialog.alert('验证码不能为空', 0, null);
            return;
        }
		var reg = /^\d{6}$/;
		if(!reg.test(forGetVCode)){
			CFW.dialog.alert('验证码不正确', 0, null);
            return;
		}
		if (newPayPwdId =="") {
            CFW.dialog.alert('新支付密码不能为空', 0, null);
            return;
        }
        if (confimPayPwdId =="") {
            CFW.dialog.alert('确认支付密码不能为空', 0, null);
            return;
        }

        if (newPayPwdId.length <8 ||newPayPwdId.length >20 ) {
            CFW.dialog.alert('密码长度为8到20个字符', 0, null);
            return;
        }

        if (newPayPwdId !=confimPayPwdId) {
            CFW.dialog.alert('两次输入的密码不一致', 0, null);
            return;
        }

        $.ajax({
            url: '/pzu/rpaypass.html',
            type: "post",
            cache: false,
            data:$("#rpaypass").serialize(),
			dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () { window.location.reload(); } });
                }else{
                    CFW.dialog.alert(data.msg,1, null);
                }
            }
        });
    }
	
	function BtnSubmitUname(){

        var user_name =$("#user_name").val();
        var user_qq =$("#user_qq").val();
        var user_weixin =$("#user_weixin").val();
        if (user_name =="") {
            CFW.dialog.alert('用户名不能为空', 0, null);
            return;
        }
        if (user_name.length <2 ||user_name.length >20 ) {
            CFW.dialog.alert('用户名由2-20个字母/数字/汉字组成', 0, null);
            return;
        }
        $.ajax({
            url: '/pzu/saveucpl.html',
            type: "post",
            cache: false,
            dataType : 'json',
            data:$("#uset").serialize(),
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () {window.location.reload();} });
                }else{
                    CFW.dialog.alert(data.msg, 0, null);
                }

            }
        });
    }
	
	function btnCertCard(){

        var real_name =$("#real_name").val();
        var identity =$("#identity").val();
        if ($.trim(real_name) =="") {
            CFW.dialog.alert('真实姓名不能为空', 0, null);
            return;
        }
		if ($.trim(identity) =="") {
            CFW.dialog.alert('身份证号不能为空', 0, null);
            return;
        }
        $.ajax({
            url: '/pzu/certsave.html',
            type: "post",
            cache: false,
            dataType : 'json',
            data:$("#ucert").serialize(),
            success: function (data) {
                if (data.status == 200) {
                    CFW.dialog.alert(data.msg, 4, { listener: function () {window.location.reload();} });
                }else{
                    CFW.dialog.alert(data.msg, 0, null);
                }

            }
        });
    }
	

function setActiveMenu(obj) {
	$(".user_left_box a[href='"+ obj + "']").addClass("active");
}

$(function () {
	CFW.init();
})
</script>
{include file="common/ufooter" /}
