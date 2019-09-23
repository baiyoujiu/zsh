{include file="common/header" /}
<style>
.zhuce_users_lists li .yf{ display:block; height:11rem; width:7rem;}
.zhuce_users_lists .yfli .zhuce_yanzhengma_int{ margin-top:3rem;}
.zhuce_iphone_int{ width:16rem;}
.zhuce_users_lists .mima span{ line-height:1rem; color:red;}
</style>
		<link rel="stylesheet" href="__CSS__/mpicker.css" />

		<script type="text/javascript" src="__JS__/pingxing.js" ></script>
        <script type="text/javascript" src="__JS__/json.js" ></script>
	    <script type="text/javascript" src="__JS__/mPicker.min.js" ></script>
		
		<section style="background:#fff;">
			<!--header-->
			<section class="fanhui_head mrbd">
				<h2>杭州勇进实验学校</h2>
			</section>
			<section class="padding_lr75">
				<div class="action">
					<form id="reg">
                	{:token('__hash__')}
                    <ul class="zhuce_users_lists">
						
                        <li class="clearfix zhuce_iphone">
							<span class="fl">手 　机　 号：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="phone" type="text" maxlength="12" placeholder="手机号，密码123456"/>
							<img class="fl zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix mima">
							<span>手机号用于核对信息用，密码：123456</span>
						</li>
						<li class="clearfix zhuce_yanzhengma">
							<span class="fl">学生　　姓名：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="students" type="text" maxlength="10" placeholder="请输入学生姓名"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_mima2">
							<span class="fl">班　　　　级：</span>
			                <input type="text" class="select-value2 zhuce_bjnj3_int fl" value="请选择年级 班级" >
			                <input type="hidden" class="njbj" value="" />
						</li>
                        
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">身高（厘米）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="height" type="number" maxlength="10" placeholder="请输入身高厘米数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma">
							<span class="fl">体重（斤数）：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="weight" type="number" maxlength="10" placeholder="请输入体重斤数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma yfli">
							<a href="__IMG__/001.jpg" target="_blank"><img class="fl yf" src="__IMG__/001.jpg"></a>
							<input class="fl zhuce_yanzhengma_int inp" name="xfu1" type="number" maxlength="10" placeholder="请输入女夏装套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma yfli">
							<a href="__IMG__/002.jpg" target="_blank"><img class="fl yf" src="__IMG__/002.jpg"></a>
							<input class="fl zhuce_yanzhengma_int inp" name="xfu2" type="number" maxlength="10" placeholder="请输入男夏装套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma yfli">
							<a href="__IMG__/003.jpg" target="_blank"><img class="fl yf" src="__IMG__/003.jpg"></a>
							<input class="fl zhuce_yanzhengma_int inp" name="xfu3" type="number" maxlength="10" placeholder="请输入运动服套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma yfli">
							<a href="__IMG__/004.jpg" target="_blank"><img class="fl yf" src="__IMG__/004.jpg"></a>
							<input class="fl zhuce_yanzhengma_int inp" name="xfu4" type="number" maxlength="10" placeholder="请输入冬装套数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma yfli">
							<a href="__IMG__/005.jpg" target="_blank"><img class="fl yf" src="__IMG__/005.jpg"></a>
							<input class="fl zhuce_yanzhengma_int inp" name="xfu5" type="number" maxlength="10" placeholder="请输入长袖T恤件数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        <li class="clearfix zhuce_yanzhengma yfli">
							<a href="__IMG__/005.jpg" target="_blank"><img class="fl yf" src="__IMG__/005.jpg"></a>
							<input class="fl zhuce_yanzhengma_int inp" name="xfu6" type="number" maxlength="10" placeholder="请输入长裤条数"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                        
					</ul>
                    <input name="gclass" id="gclass" type="hidden" value="0" />
					<input class="zhuce_btn regbtn" type="button"  style="margin:0" value="登记并提交"/>
                    </form>
                    
                    
                    <form id="login">
                    <ul class="zhuce_users_lists">
                        <li class="clearfix zhuce_iphone">
							<span class="fl">手　机　号：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="phone" type="text" maxlength="12" placeholder="登记手机号"/>
							<img class="fl zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
						<li class="clearfix zhuce_yanzhengma">
							<span class="fl">密　　　码：</span>
							<input class="fl zhuce_yanzhengma_int inp" name="password" type="password" maxlength="10" placeholder="默认密码：123456"/>
							<img class="fr zhuce_Group" src="__IMG__/zhuce_Group.png">
						</li>
                     </ul>
					<input class="zhuce_btn loginbtn" style="margin-top:2rem;" type="button" value="登陆"/>
                    </form>
				</div>
			</section>
<section class="zhanwei_hei70"></section>
<!--底部-->
<section>
    <ul class="clearfix foot_lists">
        <input class="zhuce_btn havedj" type="button"  style="margin:0" value="已登记，去登陆查看班内订购情况"/>
        <input class="zhuce_btn havedjn" type="button"  style="margin:0" value="未登记，先去登记"/>
    </ul>
</section>
</section>


	<script type="text/javascript">
			$('.havedjn').hide();
			$('#login').hide();
			$('.havedjn').click(function(){
				$(this).hide();
				$('#login').hide();
				$('.havedj').show();
				$('#reg').show();
			})
			$('.havedj').click(function(){
				$(this).hide();
				$('#reg').hide();
				$('.havedjn').show();
				$('#login').show();
			})
		
			$(function(){
				$(".action :input").blur(function(){
					if($(this).val()==''){
						$(this).parent().find('.zhuce_Group').hide();
					}else{
						$(this).parent().find('.zhuce_Group').show();
					};
				})
				
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
				
				
				$('.regbtn').click(function(){
					var returnUrl = "<?php echo $returnUrl;?>";
					$.ajax({
						url: "/login/reg2save.html",
						data: $("#reg").serialize(),
						type: "post",
						dataType: "json",
						success: function(data) {
						  if(data.status == 200){
							window.location.href = data.url;
						  }else{
							layer.open({skin:'msg',content: data.msg,time:2});
						  }
						}
					})
				})
				$('.loginbtn').click(function(){
					var returnUrl = "<?php echo $returnUrl;?>";
					$.ajax({
						url: "/login/login2.html",
						data: $("#login").serialize(),
						type: "post",
						dataType: "json",
						success: function(data) {
						  if(data.status == 200){
							window.location.href = data.url;
						  }else{
							layer.open({skin:'msg',content: data.msg,time:2});
						  }
						}
					})
				})
			});
    </script>
</body></html>