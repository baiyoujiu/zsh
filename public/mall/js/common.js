$(function(){

	
	
	/*隐藏分类搜索*/
	$('.ss_search_close').click(function(){
		$('.ssls_tankuang .search_inp').val('');
		$('.guanlian_list').hide();
	    $('.ssls_tankuang').animate({
	        left:'32rem'
	    }, 300)
	});
	/*清楚历史搜索*/
	$('.ss_ls_close').click(function(){
		$('#ss_ls').hide();
	});
	
	/*分类选项卡*/
	$('.fenlei_left_list li').click(function(){
		$('.fenlei_left_list li').removeClass('active');
		$('.fenlei_right_lists nav').hide();
		$(this).addClass('active');
		$('.fenlei_right_lists nav:eq('+$(this).index()+')').show();
		//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
		$("img.lazy").lazyload({effect: "show"});
	});
	
	/*订单切换*/
	$('.dingdan_nav_list .dingdan_lists li').click(function(){
		$('.dingdan_nav_list .dingdan_lists li').removeClass('active');
		$('.dingdan_nav_list nav').hide();
		$(this).addClass('active');
		$('.dingdan_nav_list nav:eq('+$(this).index()+')').show();
	});
	/*我的账单*/
	$('.zhangdan_lists .zhangdan_title li').click(function(){
		$('.zhangdan_lists .zhangdan_title li').removeClass('active');
		$('.zhangdan_lists nav').hide();
		$(this).addClass('active');
		$('.zhangdan_lists nav:eq('+$(this).index()+')').show();
	});
	/*评价切换*/
	$('.qbdd_pj_box .qbdd_pj_title_lists li').click(function(){
		$('.qbdd_pj_box .qbdd_pj_title_lists li').removeClass('active');
		$('.qbdd_pj_box .qbdd_pj_ym').hide();
		$(this).addClass('active');
		$('.qbdd_pj_box .qbdd_pj_ym:eq('+$(this).index()+')').show();
	});
	
	/*更多显示隐藏*/
	$('.more_btn img').click(function(){
		if($(this).val()==0){
			$('.more_lists_ym').show();
			$(this).val('1');
		}else if($(this).val()==1){
			$('.more_lists_ym').hide();
			$(this).val('0');
		}
	});
	
});





