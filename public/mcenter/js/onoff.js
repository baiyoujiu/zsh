/* 开关按钮 */
(function($){
	$.onoff = function(options){
		$('[data-onoff]').each(function(){
			var ison = $.trim($(this).data("onoff")),
				$this = $(this);
			if(ison == "on"){
				$this.find("[data-onoff-handle]").css({"left":"26px"});
				$this.find("[data-onoff-on]").show().removeClass("hide");
				$this.find("[data-onoff-off]").hide().addClass("hide");
			}else if(ison == "off"){
				$this.find("[data-onoff-handle]").css({"left":"0"});
				$this.find("[data-onoff-on]").hide().addClass("hide");
				$this.find("[data-onoff-off]").show().removeClass("hide");
			}
		})
	}
	var ONOFF = function(action){
		switch(action){
			case "on":
				$(this).find("[data-onoff-handle]").animate({
					"left":"26px"
				},100,function(){
					$(this).closest("[data-onoff]").find("[data-onoff-on]").show().removeClass("hide");
					$(this).closest("[data-onoff]").find("[data-onoff-off]").hide().addClass("hide");
					$(this).closest("[data-onoff]").data("onoff","on").attr("data-onoff","on");
				});
				break;
			case "off":
				$(this).find("[data-onoff-handle]").animate({
					"left":"0"
				},100,function(){
					$(this).closest("[data-onoff]").find("[data-onoff-on]").hide().addClass("hide");
					$(this).closest("[data-onoff]").find("[data-onoff-off]").show().removeClass("hide");
					$(this).closest("[data-onoff]").data("onoff","off").attr("data-onoff","off");
				});
				break;
		}
	}
	$.fn.onoff = function(options){
		if(typeof options === "string"){
			return this.each(function(){
				ONOFF.call(this,options);
			});
		}
		var opts = $.extend({},$.fn.onoff.defaults,options);
		return this.each(function(){
			var that = this;
			var init = (function(){
					if(typeof opts.extra == "function"){
						opts.extra.call(that);
					}
				})();
			$(this).on("click",function(){
				var isoff = $.trim($(this).data("onoff"));
				var flag = false;
				if(isoff == "off"){
					if(typeof opts.on == "function"){
						flag = opts.on();
					}
					if(flag){
						ONOFF.call(this,"on");
					}
					
				}else if(isoff == "on"){
					if(typeof opts.on == "function"){
							flag = opts.off();
					}
					if(flag){
						ONOFF.call(this,"off");
					}
				}
			})
		});
		$.fn.onoff.defaults = {
			extra:null,
			on:null,
			off:null
		}
	}
})(jQuery);

$(function(){
	$.onoff();//初始化页面时，判断默认开关
});



