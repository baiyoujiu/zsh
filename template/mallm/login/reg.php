{include file="common/header" /}

		<script type="text/javascript" src="__JS__/pingxing.js" ></script>
       
		
		<section style="background:#fff;">
			<!--header-->
			<section class="fanhui_head mrbd">
				<a href="<?php echo url('login/index');?>"><i class="icon-left"></i></a>
				<h2>注册</h2>
			</section>
			<section class="padding_lr75">
				<div class="action">
					<form id="reg">
                	{:token('__hash__')}
                    <ul class="zhuce_users_lists">
						<li class="clearfix zhuce_iphone">
							<span class="fl">请输入手机号</span>
							<input class="fl zhuce_iphone_int inp" name="phone" id="phone" type="text" maxlength="11"/>
							<img class="fl zhuce_Group" src="__IMG__/zhuce_Group.png">
                            <input class="fr" id="dxyz_sj" onClick="sendMessage()" value="发送验证码" />
						</li>
						<li class="clearfix zhuce_yanzhengma">
							<span class="fl">请输入验证码</span>
							<input class="fl zhuce_yanzhengma_int inp" name="vcode" type="text" maxlength="6"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima">
							<span class="fl">请输入密码</span>
							<input class="fl zhuce_mima_int inp" name="password" type="password" maxlength="20" />
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima2">
							<span class="fl">再次输入密码</span>
							<input class="fl zhuce_mima2_int inp" name="confirmpass" type="password" maxlength="20" />
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						
					</ul>
					<div class="clearfix zhuce_xieyi">
						<input class="fl" type="checkbox" checked=""/>
						<p class="fl">注册及代表同意《<a href="<?php echo url('newsinf/8');?>"><i class="size_color">租书会注册服务协议</i></a>》</p>
					</div>
                    <input name="invite_code" type="hidden" value="<?php echo $i;?>" />
					<input class="zhuce_btn" type="button" value="注册"/>
                    </form>
				</div>
			</section>


	<script type="text/javascript">
			//var Base_URL = 'https://gp.okpea.com/';
			var InterValObj; //timer变量，控制时间
			var count = 60; //间隔函数，1秒执行
			var curCount;//当前剩余秒数
			function sendMessage() {
				curCount = count;
				//设置button效果，开始计时
				$("#dxyz_sj").attr("disabled", "true");
				$("#dxyz_sj").val( + curCount + "秒再获取");
				InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
				//timer处理函数
				function SetRemainTime() {
					if (curCount == 0) {                
						window.clearInterval(InterValObj);//停止计时器
						$("#dxyz_sj").removeAttr("disabled");//启用按钮
						$("#dxyz_sj").val("发送验证码");
						code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效    
					}
					else {
						curCount--;
						$("#dxyz_sj").attr("disabled", "true");
						$("#dxyz_sj").val( + curCount + "秒再获取");
					}
				}
			};
		
			$(function(){
				$("#dxyz_sj").click(function () {
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
							layer.open({skin:'msg',content: data.msg,time:2});
							window.clearInterval(InterValObj);//停止计时器
							$("#dxyz_sj").removeAttr("disabled");//启用按钮
							$("#dxyz_sj").val("发送验证码");
							code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
						}
					});
				});
				
				$("body").keydown(function() {
					if (event.keyCode == "13"){$('.go_zc').click();}
				});
				
				
				
				
				$(".action :input").blur(function(){
					//用户名
					if ($(this).is(".zhuce_username_int")){
						if($(this).val()==''){
							$(this).parent().find('.zhuce_Group').hide();
						}else{
							$(this).parent().find('.zhuce_Group').show();
						};
					};
					//手机号
					if ($(this).is(".zhuce_iphone_int")){
						if($(this).val()==''){
							$(this).parent().find('.zhuce_Group').hide();
						}else{
							$(this).parent().find('.zhuce_Group').show();
						};
					};
					//验证码
					if ($(this).is(".zhuce_yanzhengma_int")){
						if($(this).val()==''){
							$(this).parent().find('.zhuce_Group').hide();
						}else{
							$(this).parent().find('.zhuce_Group').show();
						};
					};
					//密码
					if ($(this).is(".zhuce_mima_int")){
						if($(this).val()==''){
							$(this).parent().find('.zhuce_Group').hide();
						}else{
							$(this).parent().find('.zhuce_Group').show();
						};
					};
					//第二遍密码
					if ($(this).is(".zhuce_mima2_int")){
						if($(this).val()!=='' && this.value!= $(".zhuce_mima_int").val()){
							$(this).parent().find('.zhuce_Group').show();
							layer.open({
							    content: '两次密码不一致！'
							    ,skin: 'msg'
							    ,time:2
						  	});
						}else{
							$(this).parent().find('.zhuce_Group').hide();
						};
					};
				});
				//清空
				$('.zhuce_Group').click(function(){
					$(this).parent().find('.inp').val('');
					$(this).hide();
				});
				
				
				$('.zhuce_btn').click(function(){
					var returnUrl = "<?php echo $returnUrl;?>";
					$.ajax({
						url: "/login/regsave.html",
						data: $("#reg").serialize(),
						type: "post",
						dataType: "json",
						success: function(data) {
						  if(data.status == 200){
							if(returnUrl){
							  window.location.href = returnUrl;
							}else{
							  window.location.href = '/';
							}
						  }else{
							layer.open({skin:'msg',content: data.msg,time:2});
						  }
						}
					})
				})
			});
    </script>
{include file="common/footer" /}