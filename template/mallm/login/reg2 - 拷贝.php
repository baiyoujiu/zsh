{include file="common/header" /}
<style>
.zhuce_users_lists li {line-height: 3rem;}
</style>
		<link rel="stylesheet" href="__CSS__/mpicker.css" />

		<script type="text/javascript" src="__JS__/pingxing.js" ></script>
        <script type="text/javascript" src="__JS__/json.js" ></script>
	    <script type="text/javascript" src="__JS__/mPicker.min.js" ></script>
		
		<section style="background:#fff;">
			<!--header-->
			<section class="fanhui_head mrbd">
				<a href="<?php echo url('login/index');?>"><i class="icon-left"></i></a>
				<h2>杭州勇进实验学校</h2>
			</section>
			<section class="padding_lr75">
				<div class="action">
					<form id="reg">
                	{:token('__hash__')}
                    <ul class="zhuce_users_lists">
						<li class="clearfix zhuce_iphone">
							<span class="fl">手 　机　 号：</span>
							<input class="fl zhuce_iphone_int inp" name="phone" type="text" maxlength="12" placeholder="请输入手机号"/>
							<img class="fl zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<!--<li class="clearfix zhuce_mima">
							<span class="fl">请输入密码</span>
							<input class="fl zhuce_mima_int inp" name="password" type="password" maxlength="20" />
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima2">
							<span class="fl">再次输入密码</span>
							<input class="fl zhuce_mima2_int inp" name="confirmpass" type="password" maxlength="20" />
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>-->
						<li class="clearfix zhuce_mima2">
							<span class="fl">班　　　　级：</span>
			                <input type="text" class="select-value2 zhuce_bjnj3_int fl" value="请选择年级 班级" >
			                <input type="hidden" class="njbj" value="" />
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">姓　　　　别：</span>
                            <input name="2" type="radio" value="1" checked />男　　　　
                            <input name="2" type="radio" value="1"/>女
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">学生　　姓名：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="text" maxlength="10" placeholder="请输入学生姓名"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">身高（厘米）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入身高厘米数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">体重（斤数）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入体重斤数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">夏装（套数）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入夏装套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">运动服（套数）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入运动服套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">长袖T恤（件）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入长袖T恤件数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">长裤（条数）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入长裤条数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">冬装（套数）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="number" maxlength="10" placeholder="请输入冬装套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        
					</ul>
					<!--<div class="clearfix zhuce_xieyi">
						<input class="fl" type="checkbox" checked=""/>
						<p class="fl">注册及代表同意《<i class="size_color">租书会服务协议</i>》</p>
					</div>-->
                    <input name="gclass" id="gclass" type="hidden" value="0" />
					<input class="zhuce_btn" type="button"  style="margin:0" value="提交"/>
                    </form>
				</div>
			</section>
<section class="zhanwei_hei70"></section>

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
				
				
				//班级
				var method2=$('.select-value2').mPicker({
					level:2,
					dataJson:level3,
					rows:5,
					Linkage:false,
					header:'<div class="mPicker-header">请选择班级年级</div>',
					idDefault:true,
					confirm:function(json){
						$('.njbj').val(json.name);
						$('#gclass').val(json.values);
					}
				})
				
				
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