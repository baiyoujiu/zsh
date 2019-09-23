{include file="common/header" /}
		<section style="background:#fff;">
			<!--header-->
			<section class="fanhui_head mrbd">
				<a href="javascript:history.back(-1);"><i class="icon-left"></i></a>
				<h2>登录</h2>
			</section>
			<section class="padding_lr75" id="xuanxiangka">
            	<div style="text-align:center; margin:3rem 0 1rem;">
            	<img src="__IMG__/logo.png">
                </div>
            
				<form id="login">
                	{:token('__hash__')}
					<!--用户名登录-->
					<ul style="display:block;">
						<li>
							<div class="clearfix denglu_mima_list">
								<img class="fl denglu_touxiang" src="__IMG__/denglu_touxiang.png">
								<input class="fl inp denglu_username_int" name="username" type="text" placeholder="用户名/手机号"/>
								<img class="fr denglu_Group" src="__IMG__/zhuce_Group.png">
							</div>
							<div class="clearfix denglu_mima_list">
								<img class="fl denglu_mima1" src="__IMG__/denglu_mima.png">
								<input class="fl denglu_password_int1" name="password" type="password" placeholder="密码"/>
								<input class="fl denglu_password_int2" name="password0" type="text" style="display:none;" placeholder="密码"/>
								<img class="fr denglu_xianshi" src="__IMG__/denglu_xianshi.png" >
							</div>
						</li>
					</ul>
					
					<p class="clearfix denglu_xyhmm">
						<a href="<?php echo url('login/reg');?>"><span class="fl denglu_zcxyh">注册新用户</span></a>
						<a href="#"><span class="fr denglu_wjmm">忘记密码？</span></a>
					</p>
					<input class="denglu_btn" type="button" value="登  录"/>
				</form>
			</section>
			<!--<section class="padding_lr75">
				<div class="denglu_disanfang">
					<p class="denglu_disanfang_xian">
						<i>您还可使用社交账号登录</i>
					</p>
					<ul class="clearfix denglu_disanfang_fangshi">
						<li class="fl"><img src="__IMG__/denglu_qq.png"/></li>
						<li class="fl"><img src="__IMG__/denglu_wx.png"/></li>
						<li class="fl"><img src="__IMG__/denglu_wb.png"/></li>
					</ul>
				</div>
			</section>-->
		
        
        
		<script type="text/javascript">
            $(function(){
                //监听
                $("form :input").blur(function(){
                    //用户名
                    if ($(this).is(".denglu_username_int")){
                        if($(this).val()==''){
                            $(this).parent().find('.denglu_Group').hide();
                        }else{
                            $(this).parent().find('.denglu_Group').show();
                        };
                    };
                });
                //清空
                $('.denglu_Group').click(function(){
                    $(this).parent().find('.inp').val('');
                    $(this).hide();
                });
                //用户名密码显示隐藏
                var i=0;
                $('.denglu_xianshi').click(function(){
                    i++;
                    if(i%2){
                        $(this).attr('src','__IMG__/denglu_yinchang.png');
                        $('.denglu_password_int2').show();
                        $('.denglu_password_int1').hide();
                        var j=$('.denglu_password_int1').val();
                        $('.denglu_password_int2').val(j);
                    }else{
                        $(this).attr('src','__IMG__/denglu_xianshi.png');
                        $('.denglu_password_int1').show();
                        $('.denglu_password_int2').hide();
                        var j=$('.denglu_password_int2').val();
                        $('.denglu_password_int1').val(j);
                    };
                });
				
				
				$('.denglu_btn').click(function(){
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
							  window.location.href = '/';
							}
						  }else{
							layer.open({skin:'msg',content: data.msg,time:2,end:function(){window.location.reload();}});
						  }
						}
					})
				})
                
            });
        </script>
{include file="common/footer" /}
