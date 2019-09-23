/**
 * 正常弹窗
 * @param title
 * @param ele  元素或者自定义的内容
 * @param okval 确定的值
*	@param okcallback 确定之后的返回函数
 */

function normalDialog(title,ele,okval,okcallback,cancelval,cancelcallback) {
	art.dialog({
		lock : true,
		title : title,
		background : '#000', // 背景色
		opacity : 0, // 透明度
		fixed: true,
		top: window.screen.height*0.3,
		content:ele,
		button : [ {
			name : okval,
			callback : function() {
				var that=this;
				if(okcallback){
					okcallback(that);
				}
				return false;
			},
			focus : true,
		}, {
			name : cancelval,
			callback:function(){
				if(cancelcallback){
					cancelcallback();
				}
			}
		} ]
	});
}
/**
 * 消息警告型弹窗，带标题,一个按钮
 * @param title
 * @param ele  元素
 * @param okval 确定的值
*	@param okcallback 确定之后的返回函数
 */
function attentionDialog(title,ele,okval,okcallback) {
	title = title ? title : "警告";
	ele = ele ? ele : "你确定删除吗？";
	art.dialog({
		lock : true,
		title : title,
		fixed: true,
        top: window.screen.height*0.3,
		background : '#000', // 背景色
		opacity : 0, // 透明度
		content :ele,
		button : [ {
			name : okval,
			callback : function() {
				var that=this;
				if(okcallback){
					okcallback(that);
				}
				return false;
			},
			focus : true
		}]
	});
}

/**
 * 操作型弹窗 不带标题,两个按钮
 * @param operateContext  提示文字
 * @param okval 确定的值
 *	@param okcallback 确定之后的返回函数
 *	@param cancelval 取消的值
 *	@param cancelcallback  取消之后的返回函数
 */
function operationDialog(operateContext,okval,okcallback,cancelval,cancelcallback){
	operateContext = operateContext ? operateContext : "确定删除吗？";
	okval = okval ? okval : "确定";
	cancelval = cancelval ? cancelval : "取消";

	art.dialog({
		lock : true,
		id:"operation",
		title : "",
		fixed: true,
		top: window.screen.height*0.3,
		background : '#000', // 背景色
		opacity : 0, // 透明度
		content :operateContext,
		init:function(){
			var thiz=this;
				$aui_main=$(thiz.DOM.main.context),
				$aui_header=$(thiz.DOM.header.context),
				$aui_outer=$(thiz.DOM.outer.context);
				$aui_main.css("border-top","none");
				$aui_main.find(".aui_content").css({"font-weight":"bold","font-size":"16px"})
				$aui_outer.css({"min-width":346,"min-height":160})
		},
		button : [ {
			name : okval,
			callback : function() {
				var that=this;
				if(okcallback){
					okcallback(that);
				}
				return false;
			},
			focus : true
		}, {
			name :cancelval,
			callback: function(){
				if(cancelcallback){
					cancelcallback();
				}
			}
		}],
		close:function(){
			var thiz=this,
				$aui_main=$(thiz.DOM.main.context),
				$aui_header=$(thiz.DOM.header.context),
				$aui_outer=$(thiz.DOM.outer.context),
				$aui_content=$(thiz.DOM);
				$aui_main.css("border-top","1px solid #dfdfdf");
				$aui_main.find(".aui_content").css({"font-weight":"normal","font-size":"14px"})
				$aui_outer.css({"min-width":462,"height":"auto"})
		}
	});
}
/**
 * 验证提示 自动消失
 * @param {[number]}tipFlag 0-成功，1-警告，2-错误
 * @param  {[str]} txt  [提示文字]
 * @param  {[boolean]} evt  [关闭方式，true:点击关闭；false:自动消失]
 * @param  {[number]} time [自动消失的时间]
 */
function toastTips(tipFlag,txt,callback,time,evt){
	tipFlag = tipFlag ? tipFlag : 0;
	var str;
	if(tipFlag == 0){
		statusIcon="icon-fenbubuzouyiwancheng";
		status="status-success";
	}else if(tipFlag == 1){
		statusIcon="icon-gantanhao2-copy";
		status="status-warr";
	}else{
		statusIcon="icon-biaodanyanzheng_cuowu";
		status="status-error";
	}
	str = "<div class='tips-toast'><div class='toast-box'><div class='toast-msg'><i class='iconfont "+statusIcon+" toast-icon "+status+"'></i><span class='toast-text'>"+txt+"</span></div></div></div>",
	artEl = $('.tips-toast'),
	time =time? time:2000,
	evtStyle = false;
	for(var i=1;i<arguments.length;i++){
		if(typeof arguments[i] == 'number'){
			time = arguments[i];
		}else if(typeof arguments[i] == 'boolean'){
			evtStyle = evt;
		}
	}
	if(artEl.length == 0){
		$('body').append(str);
		artEl = $('.tips-toast');
	}
	if(artEl.is(':hidden')){
		artEl.find('.toast-text').html(txt);
		artEl.addClass("tipBoxSlideDown").show();
		if(evtStyle){
			artEl.addClass('m-art-click');
			$('.m-art-click').click(function(){
				artEl.removeClass("tipBoxSlideDown").addClass("tipBoxSlideUp");
				setTimeout(function(){
					artEl.remove();
				},600)
			})
		}else{
			setTimeout(function(){
				artEl.removeClass("tipBoxSlideDown").addClass("tipBoxSlideUp");
				setTimeout(function(){
					artEl.remove();
				},600)
				if (callback) {
					callback();
				}
			},time);
		}
	}
}
/**
 * 表单验证提示
 * @param msg 提示信息
 * @param el 放在哪个元素后面
 * @param status 状态 1-正确  2-错误
 */

function vailHint(msg,el,status){
	var _errorHtml='<span class="help-block form-vailcheckHelp ui-error-icon">'+
				'<i class="iconfont icon-tishi1 error-help"></i>'+
				'<i>'+msg+'</i></span>',
	   _rightHtml='<span class="help-block form-vailcheckHelp ui-right-icon">'+
	'<i class="iconfont icon-biaodanyanzhengzhengque right-help"></i>'+
	'<i>'+msg+'</i></span>';
	if($(el).find(".form-vailcheckHelp")){
		$(".form-vailcheckHelp").remove();
	}
	switch(Number(status))
		{
		case 1:
		    $(el).append(_rightHtml);
		    break;
		case 2:
		    $(el).append(_errorHtml)
			break;
		default:
    		return false;
		}

}