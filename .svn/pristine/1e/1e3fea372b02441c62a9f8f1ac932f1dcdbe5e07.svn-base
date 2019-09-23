    var dataUrl = "/center/jobDetail.html",$positionMain = $("#position-main");
	$(function(){
		jobList(id);
		var $joinList = $(".join-list li");
		$joinList.eq(0).addClass('active'); //初始化时默认第一个li选中
		$joinList.on('click',function(){ //tab栏切换
			$(this).addClass('active').siblings().removeClass('active');
		});
		iconfontFold();
	});
	function jobList(el){
		ajaxRequest(dataUrl,function(data){
			if(data.success){
				var datasList = JSON.parse(data.info),
				    strHtml = getDatasHtml(datasList);
				if(strHtml ==''){
					strListHtml = '<div class="noInfo"><p>该岗位暂未发布招聘信息</p></div>'
				}else{
					strListHtml = strHtml;
				}
				$positionMain.html(strListHtml);
				iconfontFold();
				fiexdFooter();
			}
		},{'id':el});
	}
	function getDatasHtml(datasList){
		var datasListLen = datasList.length,
			strList ='';
		if(datasListLen > 0){
			for(var i=0;i<datasList.length;i++){
				var title = datasList[i].title,
				labelList = datasList[i].labelList,
				category = datasList[i].category,
				createTimeStr = datasList[i].createTimeStr,
				content = datasList[i].content;
				var newHtml='',worryHtml='',hotHtml='';
				for(var j=0;j<labelList.length;j++){
					if(labelList[j] == "1"){
						newHtml = '<i class="iconfont icon-zhaopin_xin new"></i>';
					}else if(labelList[j] == "2"){
						worryHtml = '<i class="iconfont icon-zhaopin_ji worry"></i>';
					}else if(labelList[j] == "3"){
						hotHtml = '<i class="iconfont icon-zhaopin_re hot"></i>';
					}
				}
				var str= '<div class="position-main">'+
			             '   <ul class="join-info-lists">'+
			             '   <li>'+
			             '       <span class="dot"></span><span>'+ title +'</span>'+ newHtml + worryHtml + hotHtml +
			             '   </li>'+
			             '   <li>'+ category +'</li>'+
			             '   <li>'+ createTimeStr +'</li>'+
			             '   <li><i class="iconfont icon-loginunfold" data-info="iconfont-fold"></i></li>'+
			             '</ul>'+
			             '<div class="join-info-mian">'+
			             '    <div class="responsibilities">'+ content +'</div>'+
			             '</div>'+
			             '</div>';
				strList += str;
			}
		}else{
			strList='';
		}
		return strList;
	}
	function iconfontFold(){
		var iconfontFold = $('[data-info="iconfont-fold"]');
		$(iconfontFold).on('click',function(){
			var joinInfoMian = $(this).parent().parent().next();
			if($(joinInfoMian).css("display")=="none"){
				$(this).addClass('icon-loginfold').removeClass('icon-loginunfold');
				$(joinInfoMian).slideDown();
			}else{
				$(this).addClass('icon-loginunfold').removeClass('icon-loginfold');
				$(joinInfoMian).slideUp();
			}
		});
	}
	// ajaxRequest
	function ajaxRequest(url,success,data,error){
		try{
			var errorMsg=error||function(err){console.log(err)};
			$.ajax({
				url: url,
				type: 'post',
				dataType: ' json',
				data: data||{},
				success:success,
				error:errorMsg
				});
			}
			catch(ex){
				console.error('AJAX请求有误!错误代码:'+ex);
			}
	}