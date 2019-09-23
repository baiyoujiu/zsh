/* JavaScript DOCUMENT
 * author : cyy
 * create date : 2016-02-28
 * QQ : 419738633
 * */
(function(win){
	
	// 构造弹窗
	var Winpop = function(settings){
		
		this.options = null;	// 实际使用的参数
		this.$templ = null;		//
		this.$content = null;
		this.$title = null;
		this.$body = null;
		this.$close = null;
		
		// 初始化
			this._config(settings);
			this._init();
			
		}
		Winpop.prototype = {
			// 模板
		template : '<div class="winpop-window"><div class="winpop-content"><div class="winpop-header"><h3 class="winpop-title"></h3></div><div class="winpop-body"></div><a href="javascript:void 0;" class="winpop-close">&times;</a></div></div>'	
		// 默认样式
		,styleCode : '<style type="text/css" id="style-winpop">\
							.winpop-window{position:fixed;left:0;top:0;right:0;bottom:0;z-index:1000;background:rgba(0,0,0,0.6);}\
							.winpop-content{position:relative;max-width:80%;margin:200px auto 0;padding-bottom:20px;background:#fff;border-radius:5px;overflow:hidden;-webkit-box-shadow:0 0 0 10px rgba(0,0,0,.25);-moz-box-shadow:0 0 0 10px rgba(0,0,0,.25);box-shadow:0 0 0 10px rgba(0,0,0,.25);color:#666;}\
							.winpop-header{padding:10px 30px;background:#f0f0f0;border-bottom:1px solid #e5e5e5;}\
							.winpop-title{margin:0;line-height:20px;font-size:16px;font-weight:bold;}\
							.winpop-body{min-height:100px;max-height:500px;padding:20px 30px;line-height:1.6em;overflow-y:auto;}\
							.winpop-close{position:absolute;top:5px;right:5px;width:30px;height:30px;line-height:30px;font-size:30px;font-weight:bold;text-align:center;color:#888;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:50%;text-decoration:none;text-shadow:1px 2px 3px rgba(0,0,0,.3);}\
							.winpop-close:hover{color:#f33;text-shadow:1px 2px 3px rgba(0,0,0,.5);}\
							.winpop-content.transition{-webkit-transition:.5s;-moz-transition:.5s;transition:.5s;}\
							.e-scale-open{-moz-transform: translateY(0) scale(1);-webkit-transform: translateY(0) scale(1);transform: translateY(0) scale(1);}\
							.e-scale-close{-moz-transform:translateY(-100%) scale(0.01);-webkit-transform:translateY(-100%) scale(0.01);transform:translateY(-100%) scale(0.01);}\
							</style>'
		// 默认设置
		,defaults : {
			content : "内容"			// 内容
			,title : "标题"			// 标题
			,effect : "default"		// 显示&隐藏效果 : slide/fade/default
			,scrollFix : true		// 弹窗时是否限制页面滚动
			,html : true			// 内容是否可用html标签
			,css : false			// 样式是否手动写在css文件中
			,contentStyle : {}		// 给content设置样式
			,headerStyle : {}		// 给header设置样式
			,titleStyle : {}		// 给title设置样式
			,bodyStyle : {}			// 给body设置样式
			,closeStyle : {}		// 给close设置样式
			,templStyle : {}		// 给遮罩层设置样式
		}
		// 初始化
		,_init : function(){
			this.createDom();	// 创建并插入Dom元素
			this.setStyle();	// 设置样式
			this.bindEvent();	// 绑定事件
		}
		// 配置参数
		,_config : function(settings){
			var settings = (typeof settings === "object") ? settings : {};
			this.options = $.extend({},this.defaults,settings);
		}
		// 创建并插入元素
		,createDom : function(){
			this.$templ = $(this.template).appendTo("body").hide();
			this.$content = this.$templ.find(".winpop-content");
			this.$header = this.$templ.find(".winpop-header");
			this.$title = this.$templ.find(".winpop-title");
			this.$body = this.$templ.find(".winpop-body");
			this.$close = this.$templ.find(".winpop-close");
			
			this.$body[this.options.html?"html":"text"](this.options.content);
			this.$title[this.options.html?"html":"text"](this.options.title);
		}
		// 绑定事件
		,bindEvent : function(){
			var that = this;
			this.$close.on("click",function(){
				that.close();
			});
		}
		// 设置样式
		,setStyle : function(){
			if(!this.options.css && ($("#style-winpop").length === 0)) $(this.styleCode).appendTo("head");
			this.$templ.css(this.options.templStyle);
			this.$content.css(this.options.contentStyle);
			this.$header.css(this.options.headerStyle);
			this.$title.css(this.options.titleStyle);
			this.$body.css(this.options.bodyStyle);
			this.$close.css(this.options.closeStyle);
		}
		// 显示
		,open : function(){
			switch (this.options.effect){
				case "slide": 
					this.$templ.fadeIn();
					this.$content.slideUp(0).slideDown();
					break;
				case "fade":
					this.$templ.fadeIn();
					break;
				case "scale":
					this.$templ.fadeIn();
					this.$content.addClass("e-scale-close");
					this.$content.addClass("transition").addClass("e-scale-open");
					(function(that){
						setTimeout(function(){
							that.$content.removeClass("e-scale-close");
						},0);
					}(this));
					break;
				default : 
					this.$templ.show();
			}
			
			if(this.options.scrollFix) this.documentFix();
		}
		// 隐藏
		,close : function(){
			switch (this.options.effect){
				case "slide": 
					this.$templ.fadeOut();
					this.$content.slideUp();
					break;
				case "fade":
					this.$templ.fadeOut();
					break;
				case "scale":
					this.$templ.fadeOut();
					this.$content.addClass("transition").addClass("e-scale-close");
					(function(that){
						setTimeout(function(){
							that.$content.removeClass("e-scale-open");
						},0);
					}(this));
					break;
				case "default":
				default : 
					this.$templ.hide();
			}
			
			if(this.options.scrollFix) this.documentUnFix();
		}
		// 从文档中删除
		,remove : function(){
			this.$templ.remove();
		}
		// 禁止文档滚动
		,documentFix : function(){
			$("body").css({overflow:"hidden",marginRight:"17px"});
		}
		// 恢复文档滚动
		,documentUnFix : function(){
			$("body").css({overflow:"auto",marginRight:0});
		}
		// 修改弹窗内容
		,content : function(str){
			this.$body[this.options.html?"html":"text"](str);
		}
		// 修改弹出标题
		,title : function(str){
			this.$title[this.options.html?"html":"text"](str);
		}
		
	}
	win.Winpop = Winpop;


}(window));


//CFW.dialog.alert('reerewwre', 1);





$(function(){

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
	
	// 提交申请
	var win_checkout = null;
	$("#qhorder-submit").on("click",function(){
		var paypass = $('#ypaypass').val();
		$('#paypass').val(paypass);
		if(!paypass){
			alert_model('提示','false','支付密码不能为空！');
			return false;
		}


		var html_submitform = $("#template-checkout").html();
		if(!win_checkout){
			win_checkout = new Winpop({contentStyle:{width:"800px"}});
		}
		win_checkout.title("支付投资本金");
		win_checkout.content(html_submitform);
		win_checkout.open();
		win_checkout.$body.find(".return").on("click",function(){
			win_checkout.close();
		});
		
		//去支付
		win_checkout.$body.find("#goPay").on("click",function(){
			var benjin = parseInt($("#qhorder-benjin").attr("data-base"),10);
			var handes = parseInt($('#handes').val(),10);
			var futuresType = $('#futuresType').val();
			var paypass = $('#paypass').val();
			
			$.ajax({
				url: "/api/qh.html",
				data: {margin: benjin,
					type: handes,
					ftype: futuresType,
					paypass: paypass
				},
				type: "post",
				dataType: "json",
				success: function(a) {
					(a.status == 200) ? window.location ="/pzu/qhoinf.html?objno=" + a.msg : alert_model('提示','false',a.msg);
				}
			})
		});
	
		
	});
	
	//更多国际期货
	$("#more_window").on("click",function(){
		var html_submitform = $("#moreWindow").html();
		
		console.log(html_submitform);
		if(!win_checkout){
			win_checkout = new Winpop({contentStyle:{width:"920px"}});
		}
		win_checkout.title($(this).html());
		win_checkout.content(html_submitform);
		win_checkout.open();
		win_checkout.$body.find(".moreClose").on("click",function(){
			win_checkout.close();
		});
		
	});
	
	//操盘须知
	$("#traders_Know").on("click",function(){
		var html_submitform = $("#tradersKnow").html();
		
		console.log(html_submitform);
		if(!win_checkout){
			win_checkout = new Winpop({contentStyle:{width:"920px"}});
		}
		win_checkout.title($(this).html());
		win_checkout.content(html_submitform);
		win_checkout.open();
		win_checkout.$body.find(".moreClose").on("click",function(){
			win_checkout.close();
		});
		
	});
	
	//什么是期货
	$("#what_futures").on("click",function(){
		var html_submitform = $("#whatFutures").html();
		
		console.log(html_submitform);
		if(!win_checkout){
			win_checkout = new Winpop({contentStyle:{width:"920px"}});
		}
		win_checkout.title($(this).html());
		win_checkout.content(html_submitform);
		win_checkout.open();
		win_checkout.$body.find(".moreClose").on("click",function(){
			win_checkout.close();
		});
		
	});
	
	
	


	(function(){
		// 操作资金手数选择
		var $list = $(".m-qhcount-list"),
			$inputwrap = $("li.auto-value",$list),
			$input = $("input",$inputwrap),
			$tip = $(".m-tip",$inputwrap);
		var $detail = $("#qhorder-detail"),
			//本金
			$benjin = $(".qhorder-benjin",$detail),
			$allamount = $("#qhorder-allamount",$detail);
			
		$list.on("click","li",function(){
			$(this).addClass("on");
			$(this).siblings("li").removeClass("on");
			
			changeNumber($(this).attr("data-count"));
		});
		$inputwrap.on("click",function(){
			$input.focus();
		});
		$input.on("blur",function(){
			var count = checkInput(this.value);
			$(this).val(count+"手");
			$inputwrap.attr("data-count",count);

			changeNumber(count);
		});
		// 检查手动输入值 并返回值
		function checkInput(value){
			var val = parseInt(value,10);
			if( val <= 0 || isNaN(val)){
				val = 1;
			}else if(val > 100){
				val = 100;
			}
			return val;
		}
		
		// 相关数字变动
		function changeNumber(handes){
			var $detail = $("#qhorder-detail"),
			//本金
			$benjin = $(".qhorder-benjin",$detail),
			$benjino = $("#qhorder-benjino",$detail),
			//总操盘
			$allamount = $("#qhorder-allamount",$detail),
			$allamounto = $("#qhorder-allamounto",$detail),
			//配资
			$peiamount = $("#qhorder-peiamount",$detail),
			$peiamounto = $("#qhorder-peiamounto",$detail),
			//预警
			$earlyamount = $("#qhorder-earlyamount",$detail),
			$earlyamounto = $("#qhorder-earlyamounto",$detail),
			//平仓
			$unwindamount = $("#qhorder-unwindamount",$detail),
			$unwindamounto = $("#qhorder-unwindamounto",$detail);
			
			
			//结算
			var $subDetail = $("#template-checkout"),
			$settlement = $(".settlement",$subDetail),
			$oallamount = $("#qhorder-oallamount",$subDetail);
			
			
			numberEffect($benjin,handes);
			numberEffect($benjino,handes);
			numberEffect($allamount,handes);
			numberEffect($allamounto,handes);
			numberEffect($peiamount,handes);
			numberEffect($peiamounto,handes);
			
			numberEffect($earlyamount,handes);
			numberEffect($earlyamounto,handes);
			numberEffect($unwindamount,handes);
			numberEffect($unwindamounto,handes);
			
			numberEffect($settlement,handes);
			numberEffect($oallamount,handes);
			
			$('#handes').val(handes);
			$('#unCanPay').hide();
			$('#nowPay').hide();
			
			//本金
			var benjin = parseInt($("#qhorder-benjin").attr("data-base"),10);
			var ubalance = (parseInt($('#ubalance').attr("data-base")*100,10)/100).toFixed(2);

			var fee = 66000;
			$('#totalMoney').html((benjin+fee)*handes);
			$('#mon1').html(((benjin+fee)*handes/6.6).toFixed(2));
			$('#mon2').html((benjin*handes/6.6).toFixed(2));
			$('#mon3').html((fee*handes/6.6).toFixed(2));

			var fee_xhz = 13940;
			$('#totalMoney_xhz').html((benjin+fee_xhz)*handes);
			$('#mon1_xhz').html(((benjin+fee_xhz)*handes/6.6).toFixed(2));
			$('#mon2_xhz').html((benjin*handes/6.6).toFixed(2));
			$('#mon3_xhz').html((fee_xhz*handes/6.6).toFixed(2));

			var fee_fs = 13200;
			$('#totalMoney_fs').html((benjin+fee_fs)*handes);
			$('#mon1_fs').html(((benjin+fee_fs)*handes/6.6).toFixed(2));
			$('#mon2_fs').html((benjin*handes/6.6).toFixed(2));
			$('#mon3_fs').html((fee_fs*handes/6.6).toFixed(2));

			var fee_yy = 33000;
			$('#totalMoney_yy').html((benjin+fee_yy)*handes);
			$('#mon1_yy').html(((benjin+fee_yy)*handes/6.6).toFixed(2));
			$('#mon2_yy').html((benjin*handes/6.6).toFixed(2));
			$('#mon3_yy').html((fee_yy*handes/6.6).toFixed(2));

			var fee_gc = 34848;
			$('#totalMoney_gc').html((benjin+fee_gc)*handes);
			$('#mon1_gc').html(((benjin+fee_gc)*handes/6.6).toFixed(2));
			$('#mon2_gc').html((benjin*handes/6.6).toFixed(2));
			$('#mon3_gc').html((fee_gc*handes/6.6).toFixed(2));

			var fee_qz = 19800;
			$('#totalMoney_qz').html((benjin+fee_qz)*handes);
			$('#mon1_qz').html(((benjin+fee_qz)*handes/6.6).toFixed(2));
			$('#mon2_qz').html((benjin*handes/6.6).toFixed(2));
			$('#mon3_qz').html((fee_qz*handes/6.6).toFixed(2));

			var fee_fx = 13200;
			$('#totalMoney_fx').html((benjin+fee_fx)*handes);
			$('#mon1_fx').html(((benjin+fee_fx)*handes/6.6).toFixed(2));
			$('#mon2_fx').html((benjin*handes/6.6).toFixed(2));
			$('#mon3_fx').html((fee_fx*handes/6.6).toFixed(2));

			$('#total_pay').html(benjin*handes);

			//console.log(handes);

			handes = parseInt(handes,10);
			if(ubalance < (benjin * handes)){
				$('#nowPay').hide();
				$('#shortamount').html((benjin * handes)- ubalance);
				$('#unCanPay').show();
			}else{
				$('#unCanPay').hide();
				$('#nowPay').show();
			}
			
		}
		
		//初始化
		changeNumber(1);
		
		// 数字加减动态效果
		function numberEffect(ele,count){
			var $tar = $(ele),
				basenum = (parseInt($tar.attr("data-base")*100,10)/100).toFixed(2),
				start = 0,
				end = (parseInt(count,10)*basenum).toFixed(2),
				timer,
				step = Math.ceil(end/100),
				s = 1;
			
			return timer = setInterval(function(){
					if(start < end){
						$tar.text(start);
						start += step;
						s++;
					}else{
						$tar.text(end);
						clearInterval(timer);
					}
				},s);
		}

	}())
	
	
		
		
	$(".rank-list-tab").slide({titCell:".m-rank-title a",mainCell:".m-rank-cont",triggerTime:0,startFun:function(i){if(i === 1)scroll();}});
	var scroll = rankScroll();
	function rankScroll(){
		var _execed_ = false;
		return function (){
			if(!_execed_){
				setTimeout(function(){
					$(".m-rank-scroll").slide({mainCell:".m-rank-ulcont",triggerTime:0,autoPage:true,effect:"topLoop",opp:true,autoPlay:true,vis:10,scroll:1,interTime:2000,delayTime:800,mouseOverStop:false});
					_execed_ = true;
				},16);
			}
		}
	}
	
})

function showContract() {
	window.open("/contract/futuresOutContract.html?v=1.1", "期货合作操盘协议", "height=800,width=1000,top=0,left=200,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no")
}
