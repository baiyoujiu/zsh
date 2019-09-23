{include file="common/header" /}
<div class="banner_denglu" style="background:url(__IMGPZ__/pzdlzc.jpg) no-repeat;">
  <div class="denglu_banner">
    <div class="denglu_page fr">
      <p class="denglu_page_title"><?php echo $webSet['title'];?>登陆</p>
        <div id="xuanxiangka">
          <!--用户名登录-->
          <section style="display:block;">
          	<form id="login">
            {:token('__hash__')}
            <div class="clearfix denglu_mima_list">
              <img class="fl denglu_touxiang" src="__IMGPZ__/denglu_touxiang.png" alt="用户名-<?php echo $webSet['title'];?>">
              <input class="fl inp denglu_username_int"  name="returnUrl" type="hidden" value="<?php echo $returnUrl;?>"/>
              <input class="fl inp denglu_username_int"  name="username" type="text" id="username" placeholder="请输入您的用户名/手机号"/>
            </div>
            <div class="clearfix denglu_mima_list">
              <img class="fl denglu_mima1" src="__IMGPZ__/denglu_mima.png" alt="密码-<?php echo $webSet['title'];?>">
              <input class="fl denglu_password_int1" name="password" type="password" id="password" placeholder="请输入您的密码"/>
            </div>
            </form>
          </section>
         
          <p class="clearfix denglu_xyhmm">

            <a href="<?php echo url('login/getpass');?>" title="忘记密码-<?php echo $webSet['title'];?>"><i class="fr denglu_wjmm">忘记密码?</i></a>
            <a href="<?php echo url('login/reg');?>" title="马上注册-<?php echo $webSet['title'];?>"> <i class="fr denglu_zcxyh">马上注册</i></a>

          </p>
          <div class="dl_fs">
            <button class="submit denglu_btn denglu_btnss">登录</button>
          </div>
          
        </div>
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
	  if($('.notice').html() == '登陆提示'){
	 	 window.location.reload(); 
	  }else{
      	$('.popup_bg').css('display','none');
      	$('.text_null').css('display','none');
	  }
    });
  }

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
  $(function(){
    //验证码和用户名切换
    var oxuanxiangka = document.getElementById('xuanxiangka');
    var aBtn = oxuanxiangka.getElementsByTagName('span');
    var aDiv = oxuanxiangka.getElementsByTagName('section');
    for(var i = 0;i<aBtn.length;i++){
      aBtn[i].index = i;
      aBtn[i].onclick = function(){
        for(var i = 0;i<aBtn.length;i++){
          aBtn[i].className = '';
          aDiv[i].style.display = 'none';
        }
        this.className = 'bor_bot02';
        aDiv[this.index].style.display = 'block';
      };
    }


    $('.dl_fs').click(function(){
      var type_dl = $(this).attr('alt');
      if(type_dl == 'yzm_dl'){
        $('.denglu_btnss').removeClass('submit');
        $('.denglu_btnss').addClass('submit_yzm');
      }else if(type_dl == 'mm_dl'){
        $('.denglu_btnss').removeClass('submit_yzm');
        $('.denglu_btnss').addClass('submit');
      }
    });

    $("body").keydown(function() {
      if (event.keyCode == "13"){
        $('.submit').click();
        $('.submit_yzm').click();
      }
    });


    $("#dxyz_SJ").click(function () {
      var phone =  $("#phone").val();
      var xhr = $.ajax({
        url:"/login/verification.html",
        data: {type:1, mobile: phone,i:Math.random()},
        dataType: "json",
        type: "POST",
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


    $('.dl_fs').on('click','.submit_yzm',function(){
      var yzm = $('#yzm').val();
      var phone =  $("#phone").val();
      var returnUrl = "<?php echo $returnUrl;?>";
      $.ajax({
        url: "/login/yzmlogin.html",
        data: {yzm: yzm,phone: phone,i:Math.random()},
        type: "post",
        dataType: "json",
        success: function(data) {
          if(data.status == 200){
            if(returnUrl){
              window.location.href = returnUrl;
            }else{
              window.location.href = '/pzu/inf.html';
            }
          }else{
            alert_model('提示','false',data.msg);
          }
        }
      })

    });
	
	$('.dl_fs').on('click','.submit',function(){
	  var returnUrl = "<?php echo $returnUrl;?>";
      $.ajax({
        url: "/login/login.html",
        data: $("#login").serialize(),
        type: "post",
        dataType: "json",
        success: function(data) {
          if(data.status == 200){
            if(returnUrl){
              window.location.href = returnUrl;
            }else{
              window.location.href = '/pzu/inf.html';
            }
          }else{
            alert_model('登陆提示','false',data.msg);
          }
        }
      })

    });
	
  });
</script>
<div class="linkBox" >
	<div class="footcopy mt20">
        <!--<p>
        	<a href="<?php echo url('newsinf/3');?>" title="公司简介-<?php echo $webSet['title'];?>">公司简介</a><a href="<?php echo url('newsinf/6');?>" title="联系我们-<?php echo $webSet['title'];?>">联系我们</a><a href="<?php echo url('newsinf/15');?>" title="安全保障-<?php echo $webSet['title'];?>">安全保障</a><a href="<?php echo url('newsinf/14');?>" title="网站地图-<?php echo $webSet['title'];?>">网站地图</a><a href="<?php echo url('newsinf/11');?>" title="新手指引-<?php echo $webSet['title'];?>">新手指引</a><a href="<?php echo url('newsinf/1');?>" title="常见问题-<?php echo $webSet['title'];?>">常见问题</a><a href="<?php echo url('newsinf/2');?>" title="网站公告-<?php echo $webSet['title'];?>">网站公告</a>
    	  </p>-->
    	</div>
</div>
</body>
</html>