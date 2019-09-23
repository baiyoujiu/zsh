{include file="common/header" /}
		<link rel="stylesheet" href="__CSS__/mpicker.css" />

		<script type="text/javascript" src="__JS__/pingxing.js" ></script>
        <script type="text/javascript" src="__JS__/json.js" ></script>
	    <script type="text/javascript" src="__JS__/mPicker.min.js" ></script>
		
		<section style="background:#fff;">
			<!--header-->
			<section class="fanhui_head mrbd">
				<i class="icon-left"></i>
				<h2>注册</h2>
			</section>
			<section class="padding_lr75">
				<div class="action">
					<ul class="zhuce_users_lists">
						<li class="clearfix zhuce_iphone">
							<span class="fl">请输入手机号</span>
							<input class="fl zhuce_iphone_int inp" type="text" maxlength="12"/>
							<img class="fl zhuce_Group" src="__IMG__/zhuce_Group.png">
							<input class="fr" id="dxyz_sj" onClick="sendMessage()" value="发送验证码" />
						</li>
						<li class="clearfix zhuce_yanzhengma">
							<span class="fl">请输入验证码</span>
							<input class="fl zhuce_yanzhengma_int inp" type="text" maxlength="6"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima">
							<span class="fl">请输入密码</span>
							<input class="fl zhuce_mima_int inp" type="password" />
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima2">
							<span class="fl">请再次输入密码</span>
							<input class="fl zhuce_mima2_int inp" type="password" />
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima2">
							<span class="fl">请选择班级年级</span>
			                <input type="text" class="select-value2 zhuce_bjnj3_int fl" value="请选择班级 选择年级" >
			                <input type="hidden" class="njbj" value="" />
						</li>
                        
					</ul>
					<div class="clearfix zhuce_xieyi">
						<input class="fl" type="checkbox" checked=""/>
						<p class="fl">注册及代表同意《<i class="size_color">豌豆网服务协议</i>》</p>
					</div>
					<input class="zhuce_btn" type="submit" value="注册"/>
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
						if($(this).val()!=='' || this.value!= $(".zhuce_mima2_int").val()){
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
			});
		
			$(function() {
				var method2=$('.select-value2').mPicker({
					level:2,
					dataJson:level3,
					rows:5,
					Linkage:false,
					header:'<div class="mPicker-header">请选择班级年级</div>',
					idDefault:true,
					confirm:function(json){
						$('.njbj').val(json.name);
						console.info($('.njbj').val());
					}
				})
			});
    </script>
{include file="common/footer" /}