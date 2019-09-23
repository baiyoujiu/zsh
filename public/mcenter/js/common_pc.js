
// 
Function.prototype.before = function( func ) {
   	var __self = this;
   	return function() {
		if ( func.apply( this, arguments ) === false ) {
	    	return false;
	    }
    	return __self.apply( this, arguments );
   	}
}

Function.prototype.after = function( func ) {
   	var __self = this;
	return function() {
		var ret = __self.apply( this, arguments );
		if( ret === false) {
			return false;
		}
		func.apply( this, arguments );
		return ret;
	}
}

/* 检查数据类型 */
function getType(obj){
	return Object.prototype.toString.call(obj).slice(8,-1).toLowerCase();
}



// 流程步骤（构造）
var Process = function(target,lastPassed){
	this.$wrap = $(document.getElementById(target)); 	// target值为元素id值
	if(this.$wrap.length === 0) return;
	this.$bg = $(".m-process-bg .m-curper",this.$wrap);
	this.$list = $(".m-process-list",this.$wrap);
	this.steps = 0;
	this.curstep = 0;
	this.lastStepPassed = lastPassed || false;
	this.spassed = '<span class="iconfont icon-newgou"></span>';

	this.init();
};
Process.prototype = {
	init : function(){
		this.steps = this.$list.children("li").length;
		this.curstep = parseInt(this.$wrap.attr("data-curstep"),10);
		this.widthInit();
		this.setCurStep(this.curstep);
	},
	widthInit : function(){
		this.$bg.parent().css({width:100*(this.steps-1)/this.steps+"%"});
		this.$list.children("li").css({width:(100/this.steps)+"%"});
	},
	setBg : function(step){
		var cur = step || this.curstep;
		var width = 100 * (cur-1) / (this.steps-1);
		this.$bg.css({width:width+"%"});
	},
	setList : function (step){
		var cur = step || this.curstep;

		this.$list.children("li").removeClass("current passed");
		var index = 1,that = this;
		this.$list.children("li").find(".m-tag").each(function(){
			$(this).html(index++);
		});

		var $curstep = this.$list.children("li").eq(cur-1);
		$curstep.addClass("current");
		if(this.lastStepPassed && (this.steps === this.curstep)){
			$curstep.addClass("current passed");
		}
		$curstep.prevAll("li").addClass("passed");
		this.$list.find("li.passed .m-tag").each(function(){
			$(this).html(that.spassed);
		});
	},
	setCurStep : function(cur){
		this.$wrap.attr("data-curstep",cur);
		this.curstep = cur;
		this.setBg(cur);
		this.setList(cur);
	}

}
	

/*  图集预览组件（一组图片预览）
 * 	jQuery扩展方法
 *	参与该方法的图片需要添加data-bigpic或自定义属性，值必须为所要显示的图片资源(URI)
 * */
$.fn.bigPhotosListShow = function (options){
	/* 默认参数 */
	var settings = {
		dataName : "data-bigpic",		/* 保存图片列表资源的属性名 */
		defaultIndex : 1, 				/* 初始显示第几张图片，默认第一张 */
		keyboardControl: true, 			/* 键盘控制开关  默认开启 */
		errorImage : "#",				/* 默认图片加载失败时显示的图片  */
		isLoop : false,					/* 是否循环切换 */
		autoPlay : false,				/* 是否自动播放 */
		delayTime : 5000				/* 播放间隔时间 */
	};
	
	var argus = $.extend({},settings,options);
	return this.each(function(){
		var	$this = $(this),
			$img = $(this).find("img["+argus.dataName+"]"),
			aPhotos = [];

		if($img.length <= 0)return;

		$img.each(function(){
			aPhotos.push($(this).attr(argus.dataName));
		});

		var _cantab_ = true,
			curIndex = argus.defaultIndex-1,
			maxIndex = aPhotos.length - 1,
			maxlen = aPhotos.length;
		
		function createSingleElement(fn){
			var $pop;
			return function(){
				return $pop || ($pop = fn.apply(this,arguments));
			};
		}
		
		/* 定义核心对象单例创建函数 */
		var createCore = function(){
			var _href = aPhotos[curIndex],
				_html = '<div class="photo-show-popup">'
							+'<table class="photo-contains"><tr><td>'
								+'<img src="'+_href+'">'
								+'<a href="javascript:void(0);" class="turn-btn turn-prev"></a>'
								+'<a href="javascript:void(0);" class="turn-btn turn-next"></a>'
								+'<a href="javascript:void(0);" class="close-btn"></a>'
								+'<span class="cur-position">'+(curIndex + 1)+"/"+maxlen+'</span>'
							+'</td></tr></table>'
						+'</div>';
				
			var $wrapCell = $(_html);
			$wrapCell.prevBtn = $(".turn-prev",$wrapCell);
			$wrapCell.nextBtn = $(".turn-next",$wrapCell);
			$wrapCell.closeBtn = $(".close-btn",$wrapCell);
			$wrapCell.corecontains = $(".photo-contains td",$wrapCell);
			$wrapCell.coreImg = $(".photo-contains img",$wrapCell);
			$wrapCell.indexCell = $(".cur-position",$wrapCell);
			return $wrapCell;
		};
		
		$img.off().on("click",showPics);
		function showPics(){
			curIndex = $img.index($(this));
			var photoPopup = createCore();
			photoPopup.appendTo("body").addClass("photo-popup-show");
			checkBtnAfterTab();
			
			/* 控件事件绑定 */
			photoPopup.closeBtn.on("click",function(){
				photoPopup.removeClass("photo-popup-show");
				$(document).off("keyup.photopopup");
				clearInterval(autoPlay);
				hideLoading();
				photoPopup.remove();

			});

			photoPopup.prevBtn.on("click",tabPrevImage);
			photoPopup.nextBtn.on("click",tabNextImage);
			
			if(argus.keyboardControl){
				/* 键盘控制 */
				$(document).on("keyup.photopopup",function(evt){
					switch(evt.which){
						/* 左键 */
						case 37 : 
							tabPrevImage();
							break;
						/* 右键 */
						case 39 :
							tabNextImage();
							break;
						/* Esc */
						case 27 :
							photoPopup.closeBtn.click();
							break;
					};
				});
			}
			
			if(argus.autoPlay){
				/* 自动播放 */
				var autoPlay = setInterval(tabNextImage,argus.delayTime);
			}
			
			/* 图片加载过程判断 */
			function tabImageCheckLoaded(url, callback, callerror){
				var img = new Image(),
					callback = callback || function(){
						hideLoading();
						photoPopup.coreImg.fadeIn(300,function(){
							_cantab_ = true;
						});
					},
					callerror = callerror || function(){
						hideLoading();
						photoPopup.coreImg.attr("src",argus.errorImage);
						photoPopup.coreImg.fadeIn(1,function(){
							_cantab_ = true;
						});
					};
				img.src = url;
				if (img.complete) { 
					callback.call(this);
					return; 
				}
				img.onload = function () {
					callback.call(this);
				};
				img.onerror = function(){
					callerror.call(this);
				}
			}
			
			/* 切换索引显示 */
			function showCurIndex(){
				photoPopup.indexCell.text((curIndex+1)+"/"+maxlen);
			}
			function showLoading(){
				$("<span class='popup-state-loading'></span>").appendTo(photoPopup);
			}
			function hideLoading(){
				$(".popup-state-loading").remove();
			}
			
			/* 非循环时按钮显示 */
			function checkBtnAfterTab(){
				if(argus.isLoop){
					return;
				}
				if(curIndex >= maxIndex){
					photoPopup.nextBtn.attr("disabled",true);
				}else if(curIndex <= 0){
					photoPopup.prevBtn.attr("disabled",true);
				}else{
					photoPopup.nextBtn.removeAttr("disabled");
					photoPopup.prevBtn.removeAttr("disabled");
				}
			}
			
			/* tab prev image */
			function tabPrevImage(){
				if(!_cantab_){
					return;
				}
				if(!argus.isLoop){
					if(curIndex <= 0){
						return;
					}
				}
				_cantab_ = false;
				curIndex = (--curIndex < 0) ? maxIndex : curIndex;
				photoPopup.coreImg.fadeOut(300,function(){
					var $this = $(this);
					$this.attr("src",aPhotos[curIndex]);
					showCurIndex();
					showLoading();
					tabImageCheckLoaded($this.attr("src"));
				});
				checkBtnAfterTab();
			}

			/* tab next image */
			function tabNextImage(){
				if(!_cantab_){
					return;
				}
				if(!argus.isLoop){
					if(curIndex >= maxIndex){
						return;
					}
				}
				_cantab_ = false;
				curIndex = (++curIndex > maxIndex) ? 0 : curIndex;
				photoPopup.coreImg.fadeOut(300,function(){
					var $this = $(this);
					$this.attr("src",aPhotos[curIndex]);
					showCurIndex();
					showLoading();
					tabImageCheckLoaded($this.attr("src"));
				});
				checkBtnAfterTab();
			}
			
		}

	});
	
}


// 上传图片到服务器 接收参数 base64格式图片数据及上传成功回调函数,
function uploadImageToServer(strbtye,callback,failback){
  	$.ajax({
  		url : "/u/evaluate/uploadPic.htm",
  		type : "post",
  		data : strbtye,
  		contentType : "application/octet-stream",
  		dataType : "json",
  		success : function(data){
  			callback(data);
  		},
  		error : function(){
  			art.dialog.tips("上传图片请求失败!");
  			(typeof failback == "function") && failback();
  		}
  	});
}

//上传图片效果 回调函数参数 1.所上传的图片DOM对象img 2.所上传图片的file对象
function uploadImage(callback){
	var allowType = ["image/jpeg","image/png"],	// 所允许上传的图片类型
		maxSize = 3,	//	允许上传的图片最大尺寸 单位M
		html = '<input type="file">',
		$file = $(html);
	$file.click();
	$file.on("change",function(){
		var file = this.files[0],
			that = this;
		if(allowType.indexOf(file.type) === -1){
			return art.dialog.tips("请选择jpg或png格式的图片");
		}
		if(file.size > maxSize*1048576){
			return art.dialog.tips("允许上传图片大小不超过"+maxSize+"M");
		}

		(function(file){
			var reader = new FileReader();
			var img = new Image();
			reader.onload = function(e) {
				var data = e.target.result;
				img.src = data;
				(typeof callback == "function") && callback.call(that,img,file);
			};
			reader.readAsDataURL(file);
		}(file));
		
		this.value = "";
	});

}


// 未认证提示
function toCertificationTip(){
	art.dialog({
		lock : true,
		width : '400px',
		title : '提示',
		content: '<p style="padding:20px;">为保障您的资金账户安全，提现前请先在应用市场下载刷脸APP，在刷脸app上进行实名认证。<p>',
		background : '#000', // 背景色
		opacity : 0.1, // 透明度
		button : [
			{
				 name:'我知道了'
			},
		    {
				name : '查看帮助',
				callback : function(){
					window.open("http://www.o2osl.com/u/member/helpCenter/helpsDetai.htm?id=157");
					return false;
				},
				focus: true
		    }]
	});
}

/* 显示提示消息 参数1：消息内容。参数2：关闭弹窗时执行的回调函数 */
function onlyShowMsg(msg,callback){
	art.dialog({
		lock : true,
		width : '350px',
		padding: "30px",
		title : "提示",
		content : "<div style='text-align:center;'>"+msg+"</div>",
		button : [ 
			{
				name : '确定',
				focus : true
			}
		],
		close : (callback && (typeof callback == "function")) ? callback : new Function()
	});
}

function confirmExecute(msg,callback,cancelback){
	art.dialog({
		lock : true,
		width : '350px',
		padding: "30px",
		title : "提示",
		content : "<div style='text-align:center'>"+msg+"</div>",
		button : [ 
			{
				name : '确定',
				callback : (callback && (callback instanceof Function)) ? callback : new Function,
				focus : true
			},
			{
				name : '取消',
				callback : (cancelback && (cancelback instanceof Function)) ? cancelback : new Function
			} 
		]
	});
}

/* 获取地址参数,返回参数集合对象 */
function getLocationArgs(){
	var sArgs = location.search.slice(1).split("&"),
		oArgs = {},
		name,
		value,
		pos;
	for(var i=0,arg;arg=sArgs[i++];){
		if((pos=arg.indexOf("=")) != -1){
			name = arg.slice(0,pos);
			value = arg.slice(pos+1);
			oArgs[name]= decodeURIComponent(value);
		}
	}
	return oArgs;
}

// 排序变化动画函数 （第一个参数为table tr中的操作元素，第二个参数为移动方式：up/down/upfirst/downlast）
function positionMove(el,action){
	var $trigger = $(el),
		$this = $trigger.closest("tr"),
		$tar = null,
		$siblings = $this.siblings(),
		time = 200,
		act = new Function,
		move_this = 0,
		move_tar = 0,
		index = $this.index();
	if($this.attr("animated")) return false;
	switch(action){
		case "up":
			if(index === 0) return false;
			$tar = $this.prev("tr");
			act = function(){
				$this.after($tar);
			}
			move_this = 100;
			move_tar = -100;
			break;
		case "down":
			if(index === $siblings.length) return false;
			$tar = $this.next("tr");
			act = function(){
				$this.before($tar);
			}
			move_this = -100;
			move_tar = 100;
			break;
		case "upfirst":
			if(index === 0) return false;
			$tar = $this.prevAll("tr");
			act = function(){
				$this.siblings().first().before($this);
			}
			move_this = 100*index;
			move_tar = -100;
			break;
		case "downlast":

			if(index === $siblings.length) return false;
			$tar =  $this.nextAll("tr");
			act = function(){
				$this.siblings().last().after($this);
			}
			move_this = -100*($siblings.length - index);
			move_tar = 100;
			break;
	}
	$this.css({transform:"translateY("+move_this+"%)"});
	$tar.css({transform:"translateY("+move_tar+"%)"});
	act();
	setTimeout(function(){
		$this.css({transform:"translateY(0)",transition:time/1000+"s"});
		$tar.css({transform:"translateY(0)",transition:time/1000+"s"});
	},0);
	$this.attr("animated",true);
	setTimeout(function(){
		$this.css({transform:"",transition:""});
		$tar.css({transform:"",transition:""});
		$this.removeAttr("animated");
	},time);
}


// 添加推荐商品模块

// 单个商品选择模块
function singleGoodsSelect(allgoods,selectedgoods,searchvalue){

	if(getType(allgoods) !== "array"){
		throw "参数类型错误！";
	}

	var aGoods = allgoods,		// 所有商品
		aGoods_show = [],		// 所有显示的商品
		nPageCount = 6,			// 分页显示商品数
		module = {},
		oReturn = {},
		sWrapHtml = '<div class="popup-select-goods" >\
						<ul class="popup-select-goodslist g-clearfix"></ul>\
						<div class="m-tab-pages j-goods-pages"></div>\
					</div>';
		
	
	oReturn.aGoods_selected = selectedgoods || {}; 	//已选择商品
	oReturn.goodsList = allgoods;
	
	// 初始化
	var init = (function(){	
		
		var sPagebtn = ".page",
			sPrevbtn = ".prev.passable",
			sNextbtn = ".next.passable",
			sRandomid = new Date().getTime(),
			$artWrap = $(sWrapHtml);
			
		module.$wrap = $artWrap.appendTo("body").wrap('<div style="display:none;" id="js-select-goods-'+sRandomid+'"></div>');
		module.artWrap = document.getElementById("js-select-goods-"+sRandomid);
		module.$goodslist = module.$wrap.find(".popup-select-goodslist");
		module.$pages = module.$wrap.find(".j-goods-pages");
	
		
		// 获取商品，更新数据，绑定事件

		goodsInit();

		
		// 页码
		module.$pages.on("click",sPagebtn,function(){
			var num = $(this).text();
			updateList(num);
			updatePages(num);
		});
		
		// 前一页
		module.$pages.on("click",sPrevbtn,function(){
			var num = parseInt(module.$pages.find(".active").text(),10) - 1;
			updateList(num);
			updatePages(num);
		});
		
		// 后一页
		module.$pages.on("click",sNextbtn,function(){
			var num = parseInt(module.$pages.find(".active").text(),10) + 1;
			updateList(num);
			updatePages(num);
		});

		// 选择商品
		module.$goodslist.on("change",".popup-select-goodsname",function(){
			var id = $(this).find("input[type=radio]").val();
			selectGoods(id);
		});


	}());

	
	function goodsInit(){
		setShowGoods(searchvalue);
		updateList(1);
		updatePages(1);
	}


	//检查是否已选择
	function checkSelected(id){
		if(oReturn.aGoods_selected && oReturn.aGoods_selected['id'] == id){
			return true;
		}
		return false;
	}

	//选择商品
	function selectGoods(id){
		oReturn.aGoods_selected = {};
		for(var i=0,one;one=aGoods[i++];){
			if(one['id'].toString() === id.toString()){
				oReturn.aGoods_selected = one;
				return;
			}
		}
	}

	// 显示商品的数组数据重置(type-商品类型，value-搜索字符)
	function setShowGoods(value){
		aGoods_show = aGoods;
		if(!value) return;
		var aNewShowGoods = [],
			title="",
			exp = new RegExp("("+value+")","ig"),
			matching = false;
		for(var j=0,one2;one2=aGoods_show[j++];){
			title = one2['title'];
			matching = exp.test(title);
			if(matching){
				aNewShowGoods.push(one2);
			}
		}
		aGoods_show = aNewShowGoods;
		oReturn.goodsList = aGoods_show;
	}
	
	//更新分页
	function updatePages(curpage){
		var curpage = parseInt(curpage,10),					//当前页码
			goodscount = aGoods_show.length,				//所显示的商品个数
			pages = Math.ceil(goodscount/nPageCount),		//页码总数
			maxShow = 10,									//页码最大显示个数
			pagesN = Math.ceil(pages/maxShow),				//页码组总数
			curPagesN = Math.ceil(curpage/maxShow),			//当前页码组
			scur = '',
			htmlstr = "";
		if(pages !== 0){
			if(curpage !== 1){
				htmlstr = '<a href="javascript:void 0;" class="btn btn-default prev passable">上一页</a>';
			}else{
				htmlstr = '<a href="javascript:void 0;" class="btn btn-default prev disabled">上一页</a>';
			}
			
			var start = maxShow*(curPagesN-1), 
				end = (maxShow*curPagesN > pages) ? pages : maxShow*curPagesN;
			for(var i=start;i<end;i++){
				if(curpage === i+1){
					scur = "active";
				}else{
					scur = "page";
				}
				htmlstr += '<a href="javascript:void 0;" class="btn btn-default '+scur+'">'+(i+1)+'</a>';
			}
			
			if(curpage !== pages){
				htmlstr += '<a href="javascript:void 0;" class="btn btn-default next passable">下一页</a>';
			}else{
				htmlstr += '<a href="javascript:void 0;" class="btn btn-default next disabled">下一页</a>';
			}
			
			htmlstr += "<span style='margin-left:20px;'>共 "+pages+" 页</span>";
			
		}
		module.$pages.html(htmlstr);
	}

	//更新商品列表
	function updateList(curpage){
		var curpage = parseInt(curpage,10),
			htmlstr = '',
			id,
			link,
			image,
			title,
			price,
			sellcount,
			btn;
		if(aGoods_show.length === 0 ){
			htmlstr = '<li class="m-no-content">没有您所要搜索的商品！</li>';
		}else{
			var start = nPageCount*(curpage-1), 
				end = nPageCount*curpage;
			for(var i=start,one;i<end && (one=aGoods_show[i]);i++){
				id = one['id'];
				image = one['imageurl'];
				title = one['title'];
				price = one['sellprice'];
				radio = checkSelected(id) ? '<input type="radio" class="m-select" name="singleGoodsSelect" value="'+id+'" checked>' : '<input type="radio" class="m-select" name="singleGoodsSelect" value="'+id+'">';
				htmlstr += '<li>\
								<label class="popup-select-goodsname g-clearfix">'+radio+'\
									<div class="m-pic"><img src="'+image+'"></div>\
									<div class="m-text">\
										<p class="title">'+title+'</p>\
										<p class="mess"><span class="price">￥ '+price+'</span></p>\
									</div>\
								</label>\
							</li>';

			}
		}

		module.$goodslist.html(htmlstr);
		
	}

	oReturn.module = module;

	return oReturn;
}


// 剩余秒数 转化为剩余天数小时分钟
function formatSurplusTime(seconds){
	return {
		day : Math.floor(seconds/(24*60*60)),
		hour : Math.floor(seconds%(24*60*60)/(60*60)),
		minute : Math.floor(seconds%(24*60*60)%(60*60)/60),
		second : Math.ceil(seconds%(24*60*60)%(60*60)%60),
	}
}

$(function(){
	// 页面加载完成时执行以下


	// bootstrap tool : popover
	if($('[data-toggle="popover"]').length > 0){
		//$('[data-toggle="popover"]').popover();
	}

	// 限制文字字数 ps/ data-wordslimit="10"
	$("[data-wordslimit]").each(function(){
        var words = $(this).text(),
            count = parseInt($(this).attr("data-wordslimit"),10);
        if(words.length > count){
            $(this).text(words.substr(0,count)+"...");
        }
    });

    // 评分星星显示初始化 ps/ data-star="5"
    $("[data-star]").each(function(){
        var $this = $(this),
        	$n=$this.next("span"),
            $next = $n.length ? $n : $("<span>").appendTo($this.parent()),
            star = parseInt($this.attr("data-star"),10) || 0,
            html_default = '<span class="m-star"><i class="iconfont icon-pingjiaxingxingmoren"></i></span>',
            html_color = '<span class="m-star"><i class="iconfont icon-pingjiaxingxingxuanzhong"></i></span>',
            html = "",
            next_str = "";
            
        for(var i=0;i<5;i++){
            if(i < star){
                html+=html_color;
            }else{
                html+=html_default;
            }
        }
        $this.html(html);

        switch(star){
            case 0:
            case 1:
                next_str = "差评";
                break;
            case 2:
            case 3:
                next_str = "中评";
                break;
            case 4:
            case 5:
                next_str = "好评";
                break;
        }
        $next.html(next_str);
    });
	

	// 获取验证码 (无用)
	$("[data-checkcode]").each(function(){
		var $this = $(this),
			_sendnumber_ = $this.is("[data-getnumber]"),
			origval = $this.html(),
			timer = null;

		// 绑定点击事件
		$this.on("click",function(){
			if(_sendnumber_){
				// 需要获取手机号时
				var number = $($this.attr("data-getnumber")).val(),	// 手机号码
					_res = /^1[\d]{10}$/g.test(number);
				if(!_res){
					art.dialog.tips('请填写正确的手机号码');
					return;
				}
				getCodeByNumber();
				effect();
			}else{
				// 无需获取手机号时
				getCode();
				effect();
			}
		});

		// 点击后的效果
		var effect = function(){
			var time=60,
				timer = setInterval(interval,1000);
			interval();
			$this.attr("disabled",true);
			$this.next(".get-soundscode").show();
			//art.dialog.tips('还没收到验证码？请查看短信是否被拦截',3);

			function interval(){
				if(time <= 0){
					clearInterval(timer);
					$this.removeAttr("disabled").html(origval);
				}else{
					$this.html(time +"秒后重新发送");
					time--;
				}
				
			}
		}

		// 发送手机号作为参数获取验证码
		var getCodeByNumber = function(){

			/* 后台交互的代码 */

		}
		// 无需手机号码参数获取验证码
		var getCode = function(){

			/* 后台交互的代码 */

		}



	});



	$("[data-time-surplus]").each(function(){
		var interS = 1,
			surplus = Math.ceil($(this).attr("data-time-surplus")/1000),
			timer = null;

		showTime(this);
		timer = setInterval((function(that){
			return function(){
				showTime(that);
				if(!surplus){
					clearInterval(timer);
					execallback();
				}
			}
		}(this)),interS*1000);

		function showTime(ele){
			surplus = surplus-interS > 0 ? surplus-interS : 0;
			var sur = formatSurplusTime(surplus);
			ele.innerHTML = sur.day+"天"+sur.hour+"小时"+(surplus<60&&surplus>0 ? 1 : sur.minute)+"分";
		}
		function execallback(){
			location.reload();
		}
	});



});

//名称过长截取例如：文件名过长:xxxxx...x.doc）
function fileNameEllipsis(w,h,content,ext){
	var fehtml='<div style="width:'+w+'px" height="'+h+'" data-id="fileName-ellipsis"></div>';
	if ($('[data-id="fileName-ellipsis"]').length==0) {
		$("html").append('<div style="width:'+w+'px" height="'+h+'" data-id="fileName-ellipsis"></div>');
	}
	var $fileNameellipsis=$('[data-id="fileName-ellipsis"]');
		$fileNameellipsis.html(content);
		if ($fileNameellipsis.height()>h) {
			//do to

		}
	  

}


