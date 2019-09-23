{include file="common/header" /}
<link rel="stylesheet" href="__CSS__/demo.css" />
<link rel="stylesheet" href="__CSS__/mpicker.css" />

		<script type="text/javascript" src="__JS__/demo.js" ></script>
		<script type="text/javascript" src="__JS__/dizhi_data.js" ></script>
		<script type="text/javascript" src="__JS__/pingxing.js" ></script>
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
		</script>
		<script>
			$(function(){
				$(".action :input").blur(function(){
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
				});
				//清空
				$('.zhuce_Group').click(function(){
					$(this).parent().find('.inp').val('');
					$(this).hide();
				});
			});
		</script>
	</head>
	<body>
		<section class="kuaijiexiadan">
			<section class="dd_home">
				<h2 class="fanhui_head"><i class="icon-left"></i>快速下单<em class="fr"><a href="<?php echo url('login/index');?>">去登陆</a></em></h2>
			</section>
			<!--占位-->
			<section class="zhanwei_hei35"></section>
			<section class="padding_lr10">
				<div class="action">
					<ul class="zhuce_users_lists">
						<p>快捷下单验证</p>
						<li class="clearfix zhuce_iphone">
							<input class="fl zhuce_iphone_int inp" type="text" maxlength="12" placeholder="填写获取验证码的手机号"/>
							<img class="fl zhuce_Group" src="../img/zhuce_Group.png">
							<input class="fr" id="dxyz_sj" onClick="sendMessage()" value="发送验证码" />
						</li>
						<li class="clearfix zhuce_yanzhengma">
							<input class="fl zhuce_yanzhengma_int inp" type="text" maxlength="6" placeholder="输入收到的短信验证码"/>
							<img class="fr zhuce_Group" src="../img/zhuce_Group.png">
						</li>
					</ul>
				</div>
			</section>
			<section>
				<ul class="add_dizhi_lists">
					<li class="clearfix">
						<span class="fl">收货人</span>
						<input class="fl" type="text" placeholder="收货人姓名"/>
					</li>
					<li class="clearfix">
						<span class="fl">手机号码</span>
						<input type="text" placeholder="手机或电话号码"/>
					</li>
					<li class="clearfix">
						<span class="fl">所在地区</span>
						<input type="text" class="input fl" id="address" placeholder="请选择收货地址">
					</li>
					<li class="clearfix">
						<span class="fl">详细地址</span>
						<textarea clas="fl" placeholder="街道丶楼牌号等信息"></textarea>
					</li>
				</ul>
				<div class="add_dizhi">
					<span>保存</span>
				</div>
			</section>
			<!--选择地址-->
			<section id="mymodal">
				<div class="modal-main">
					<p class="address-title">收货地址</p>
					<p class="close icon-close"></p>
					<ul class="optionwrapper">
						<li class="option-menu option-menu-one active-option">请选择</li>
						<li class="option-menu option-menu-two"></li>
						<li class="option-menu option-menu-three"></li>
					</ul>
					<div class="option-content">
						<ul class="option-group option-group-one" data-index="0" style="display: block"></ul>
						<ul class="option-group option-group-two" data-index="1"></ul>
						<ul class="option-group option-group-three" data-index="2"></ul>
					</div>
				</div>
			</section>
		</section>
	</body>
	<script>
			/*获取地址*/
			$(document).ready(function() {
				var newData = [];//新数据
				var citysArray = [];//城市
				var areaArray = [];//地区
				var chooseMenuStr = '请选择' //添加选择title
		
				function init(){
					//模拟ajax
					setTimeout(()=>{
						newData = [...data];
						// 初始化省份
						var optionGroupOne = "";
						$.each(newData,function(index, el) {
							optionGroupOne += `<li class="option-list option-list-one">
										<span>${newData[index]["n"]}</span>
										<div class="checked">
										</div>
									</li>`
						});
						
						$(".option-group-one").html(optionGroupOne)
		
					},100)
				}
		
				init();
		
				$("#mymodal").on("click",".option-menu",function(){ //菜单激活
					var i = $(this).index();
					$(this).addClass('active-option').siblings().removeClass('active-option');
					$(".option-group").eq(i).show().siblings().hide()
				})
		
				//1级 省份点击添加城市
				$("#mymodal").on("click",".option-list-one",function(){
					var parentIndex = $(this).parent().attr("data-index");
					var provinceName = $(this).text().trim();
					var provinceIndex = $(this).index();
					$(this).find('.checked').show();
					$(this).siblings().find('.checked').hide();
					// console.log(newData[provinceIndex])
					citysArray = newData[provinceIndex]["c"];
					$(".option-menu").eq(parentIndex).text(provinceName)
					var cityStr = "";
					// console.log(citysArray)
					$.each(citysArray,function(index, el) {
						cityStr += `<li class="option-list option-list-two">
								<span>${citysArray[index]["n"]}</span>
								<div class="checked">
								</div>
							</li>`
					});
					// console.log(cityStr)
					$(".option-group").hide();
					$(".optionwrapper").find(".option-menu").removeClass('active-option')
					$(".option-menu-two").html(chooseMenuStr).addClass('active-option')
					$(".option-group-two").html(cityStr).show();
					$(".option-group-three").html("");
					$(".option-menu-three").html("")
				})
		
		
				//2级 城市点击添加城镇
				$("#mymodal").on("click",".option-list-two",function(){
					var parentIndex = $(this).parent().attr("data-index");
					var cityName = $(this).text().trim();
					var cityIndex = $(this).index();
					$(this).find('.checked').show();
					$(this).siblings().find('.checked').hide();
					cityArray = citysArray[cityIndex]["a"];
					$(".option-menu").eq(parentIndex).text(cityName)
					var areaStr = "";
					$.each(cityArray,function(index, el) {
						areaStr += `<li class="option-list option-list-three">
								<span>${cityArray[index]}</span>
								<div class="checked">
								</div>
							</li>`
					});
					$(".option-group").hide();
					$(".optionwrapper").find(".option-menu").removeClass('active-option')
					$(".option-menu-three").html(chooseMenuStr).addClass('active-option')
					$(".option-group-three").html(areaStr).show();
				})
				//3级 选择城镇
				$("#mymodal").on("click",".option-list-three",function(){
					var areaName = $(this).text().trim();
					var parentIndex = $(this).parent().attr("data-index");
					var menuOne = $(".option-menu").eq(0).text();
					var menuTwo = $(".option-menu").eq(1).text();
					var addressVal = menuOne +" "+ menuTwo +" "+ areaName;
					$(this).find('.checked').show();
					$(this).siblings().find('.checked').hide();
					$(".option-menu").eq(parentIndex).text(areaName)
					$(".modal-main").animate({"bottom":"-900px"}, 400);
					setTimeout(()=>{
						$("#mymodal").fadeOut()
					},350)
					$("#address").val(addressVal)
				})
				
				$(".right").on("click",function(){
					$("#mymodal").show();
					$(".modal-main").animate({"bottom":"0"}, 400)
				})
		
		
				$(".close").on("click",function(){
					$(".modal-main").animate({"bottom":"-900px"}, 400);
					setTimeout(()=>{
						$("#mymodal").fadeOut();
					},350)
				})
		
				$("#mymodal").on("click",function(event){
					var modalMain = $(".modal-main");
					if (!modalMain.is(event.target)&& modalMain.has(event.target).length === 0) {
						$(".modal-main").animate({"bottom":"-900px"}, 400);
						setTimeout(()=>{
							$("#mymodal").fadeOut();
						},350)
					}
		
				})
			
			});
		</script>
</html>