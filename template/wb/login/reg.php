{include file="common/header" /}
<div class="banner_denglu zhuce_banner" style="background:url(__IMGPZ__/pzdlzc.jpg) no-repeat;" >
  <div class="denglu_banner">
    <div class="denglu_page zhuce_page fr">
        <!--用户名登录-->
        <section class="zhuce_page_list" style="margin-top:10px;">
          <p class="clearfix"><i class="fr"><a href="<?php echo url('login/index');?>" title="<?php echo $pzSeo['title'];?>登录">已有账号去登录</a></i></p>
          <form id="reg">
          <input name="utype" id="utype" type="hidden" value="1" />
          <!--<div class="clearfix denglu_xuanxiang">
            <p class="fl denglu_mima dl_fs" alt="xs"><span class="bor_bot02">写手</span></p>
            <p class="fl dl_fs" alt="wb"><span class="">网编</span></p>
          </div>-->
          <div class="clearfix denglu_mima_list">
            <img class="fl denglu_touxiang" src="__IMGPZ__/denglu_phone.png" alt="手机号码-<?php echo $webSet['title'];?>">
            <input class="fl inp denglu_username_int2" type="text" maxlength="15" name="phone" id="phone" placeholder="手机号码" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"/>
          </div>
          <div class="clearfix denglu_mima_list">
            <img class="fl denglu_mima1" src="__IMGPZ__/denglu_yanzhengma.png" alt="验证码-<?php echo $webSet['title'];?>">
            <input class="fl denglu_password_int3" type="text" maxlength="6" name="verifyCode" placeholder="验证码" id="verifyCode" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"/>
            <input class="fr" id="dxyz_SJ" onClick="sendMessage()" value="发送验证码" />
          </div>
          <div class="clearfix denglu_mima_list">
            <img class="fl denglu_mima1" src="__IMGPZ__/denglu_mima.png" alt="设置密码-<?php echo $webSet['title'];?>">
            <input class="fl denglu_password_int1" type="password" id="pwd" name="password" placeholder="设置密码"/>
          </div>
          <div class="clearfix denglu_mima_list">
            <img class="fl denglu_mima1" src="__IMGPZ__/zhuce_qrmim.png" alt="确认密码-<?php echo $webSet['title'];?>">
            <input class="fl denglu_password_int1" type="password" id="pwd_zc" name="confirmpass" placeholder="确认密码"/>
          </div>
          </form>
        </section>
        <p class="clearfix zhuce_xieyi"><input class="fl" type="checkbox" name="agreement_checkbox" checked/><span class="fl">我已阅读并同意《<a href="<?php echo url('newsinf/12');?>" target="_blank" title="<?php echo $pzSeo['title'];?>服务协议"><i style="cursor:pointer;"><?php echo $webSet['title'];?>服务协议</i></a>》</span></p>
        <button class="go_zc zhuce_btn denglu_btn">注册</button>
       
    </div>
    
  </div>
</div>


<!--阴影-->
<div class="popup_bg"></div>
<!--发布为空-->
<div class="text_null">
  <div class="text_null_title notice">提示</div>
  <p class="text_null_content clearfix"><i class="fhao fl"></i><span class="fl wenan">请输入想说的内容</span></p>

  <p class="clearfix text_null_btn"><span class="fr text_null_btn1">确认</span></p>
</div>

<script type="text/javascript">
  //var Base_URL = 'http://gp.okpea.com/';
  var InterValObj; //timer变量，控制时间
  var count = 60; //间隔函数，1秒执行
  var curCount;//当前剩余秒数
  function sendMessage() {
    curCount = count;
    //设置button效果，开始计时
    $("#dxyz_SJ").attr("disabled", "true");
    $("#dxyz_SJ").val( + curCount + "秒再获取");
    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
    //timer处理函数
    function SetRemainTime() {
      if (curCount == 0) {
        window.clearInterval(InterValObj);//停止计时器
        $("#dxyz_SJ").removeAttr("disabled");//启用按钮
        $("#dxyz_SJ").val("发送验证码");
        code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效    
      }
      else {
        curCount--;
        $("#dxyz_SJ").attr("disabled", "true");
        $("#dxyz_SJ").val( + curCount + "秒再获取");
      }
    }
  };

  function alert_model(notice,fhao,wenan){
    $('.popup_bg').css('display','block');
    $('.text_null').css('display','block');
    $('.notice').html(notice);
    $('.wenan').html(wenan);
    if(fhao == 'true'){
      $('.fhao').removeClass('gp_cuo');
      $('.fhao').addClass('gp_dui');
    }else{
      $('.fhao').removeClass('gp_dui');
      $('.fhao').addClass('gp_cuo');
    }

    $('.popup_bg').on('click', function(){
      $('.popup_bg').css('display','none');
      $('.text_null').css('display','none');
    });
    $('.text_null_btn1').on('click', function(){
      $('.popup_bg').css('display','none');
      $('.text_null').css('display','none');
    });
  }


  $(function(){
	  
	$('.dl_fs').click(function(){
		var type = $(this).attr('alt');
		$('.dl_fs').find('span').removeClass('bor_bot02');
		$(this).find('span').addClass('bor_bot02');
		if(type == 'xs'){
			$('#utype').val(1);
		}else if(type == 'wb'){
			$('#utype').val(2);
		}
	});

      $("#dxyz_SJ").click(function () {
        var phone =  $("#phone").val();
        var xhr = $.ajax({
          url:"/login/verification.html",
          data: { mobile: phone,i:Math.random()},
          dataType: "json",
          type: "POST"
        });
        xhr.done(function (data) {
          if (data.status == 200) {
          } else {
            alert_model('提示','false',data.msg);
            window.clearInterval(InterValObj);//停止计时器
            $("#dxyz_SJ").removeAttr("disabled");//启用按钮
            $("#dxyz_SJ").val("发送验证码");
            code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
          }
        });
      });

      $("body").keydown(function() {
        if (event.keyCode == "13"){$('.go_zc').click();}
      });

      $('.go_zc').click(function(){
        if($('input[name="agreement_checkbox"]').is(':checked') == true){
          var returnUrl = "<?php echo $returnUrl;?>";
          $.ajax({
            url:'/login/regsave.html',
            cache: false,
            data: $("#reg").serialize(),
            type: 'post',
            dataType: 'json',
            success: function (data) {
              if (data.status == 200) {
                if(returnUrl){
                  window.location.href = returnUrl;
                }else{
                  window.location.href="/";
                }
              }else{
                alert_model('提示','false',data.msg);
              }
            }
          });
        }else{
          alert_model('提示','false','请先阅读并同意《<?php echo $webSet['title'];?>服务协议》');
        }
      })

  });
</script>
<div class="linkBox" >
	<div class="footcopy mt20">
        <p>
        	<a href="<?php echo url('newsinf/3');?>" title="公司简介-<?php echo $webSet['title'];?>">公司简介</a><a href="<?php echo url('newsinf/6');?>" title="联系我们-<?php echo $webSet['title'];?>">联系我们</a><a href="<?php echo url('newsinf/15');?>" title="安全保障-<?php echo $webSet['title'];?>">安全保障</a><a href="<?php echo url('newsinf/14');?>" title="网站地图-<?php echo $webSet['title'];?>">网站地图</a><a href="<?php echo url('newsinf/11');?>" title="新手指引-<?php echo $webSet['title'];?>">新手指引</a><a href="<?php echo url('newsinf/1');?>" title="常见问题-<?php echo $webSet['title'];?>">常见问题</a><a href="<?php echo url('newsinf/2');?>" title="网站公告-<?php echo $webSet['title'];?>">网站公告</a>
    	  </p>
    	</div>
</div>
<script>
var _hmt = _hmt || [];
(function() {
	var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?d498e654b748fea16fe0656245c37585";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>