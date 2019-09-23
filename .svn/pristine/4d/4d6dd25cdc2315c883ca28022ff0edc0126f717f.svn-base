// JavaScript Document
$(function(){
	//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
	$("img.lazy").lazyload({effect: "fadeIn"});
	
	//数量加
	$(".shop-cart-add").click(function(){
		var multi=0;
		var vall=$(this).prev().text();
		vall++;
		$(this).prev().text(vall);
		
		if(!$(this).parents('li').find('.btn2').is(':checked')){
			$(this).parents('li').find('.btn2').click();
		}
		
		TotalPrice();
		
		var k=$(this).parents('li').find('.btn2').val()
		$.ajax({
			url: "/order/editcart.html",
			data: {t:1,k:k,i:Math.random()},
			type: "post",
			dataType: "json",
			success: function(data) {
			  if(data.status == 200){
				//layer.open({content: '加入购物车成功',skin: 'msg',time:2});
			  }else{
				layer.open({skin:'msg',content: data.msg,time:2});
			  }
			}
		})
		
	});
	//数量减
	$(".shop-cart-subtract").click(function(){
		var multi=0;
		var vall=$(this).next().text();
		if(vall<=1){
			vall=1;
			layer.open({
				content: '该商品1件起售'
				,skin: 'msg'
				,time: 2 //3秒后自动关闭
			});
			return false;
		}
		vall--;
		$(this).next().text(vall);
		if(!$(this).parents('li').find('.btn2').is(':checked')){
			$(this).parents('li').find('.btn2').click();
		}
		TotalPrice();
		
		var k=$(this).parents('li').find('.btn2').val()
		$.ajax({
			url: "/order/editcart.html",
			data: {t:2,k:k,i:Math.random()},
			type: "post",
			dataType: "json",
			success: function(data) {
			  if(data.status == 200){
				//layer.open({content: '加入购物车成功',skin: 'msg',time:2});
			  }else{
				layer.open({skin:'msg',content: data.msg,time:2});
			  }
			}
		})
	});
	//单选
	$(".btn2").click(function(){
		TotalPrice();
	});
	//多选
	$("#ckAll").click(function(){
		$("input[name='gkey[]']").prop("checked",this.checked);
		TotalPrice();
	});
	/*算价格*/
	$("input[name='gkey[]']").click(function(){
		var $subs=$("input[name='gkey[]']");
		$("#ckAll").prop("checked",$subs.length==$subs.filter(":checked").length?true:false);
		TotalPrice();
	});
	/*删除*/
	$(".delete").click(function(){
		if($("#ckAll").is(':checked')){
			$.ajax({
				url: "/order/cartdel.html",
				data: $("#fcart").serialize(),
				type: "post",
				dataType: "json",
				success: function(data) {
					if(data.status == 200){
						window.location.reload();
					}else{
						layer.open({skin:'msg',content: data.msg,time:2});
					}
				}
			})
		}else if(!$(".btn2").is(':checked')){
			layer.open({
				content: '请选择要删除的商品'
				,skin: 'msg'
				,time:2
			});
		}
		if($(".btn2").is(':checked')){
			$.ajax({
				url: "/order/cartdel.html",
				data: $("#fcart").serialize(),
				type: "post",
				dataType: "json",
				success: function(data) {
					if(data.status == 200){
						$(".btn2:checked").parent(".shop-cart-check2").parent(".index-goods").remove();
						TotalPrice();
					}else{
						layer.open({skin:'msg',content: data.msg,time:2});
					}
				}
			})
		}
	});
	//结算
	$(".sc_jiesuan_btn").click(function(){
		//有无选中
		if(!$(".btn2").is(':checked')){
			layer.open({
				content: '至少要选购1种商品'
				,skin: 'msg'
				,time:2
			});
			return false;
		}else{
			$.ajax({
				url: "/order/gobuy.html",
				data: $("#fcart").serialize(),
				type: "post",
				dataType: "json",
				success: function(data) {
					if(data.status == 200){
						window.location.href = '/order/index.html?cart=1';
					}else if(data.status == 230){
						layer.open({skin:'msg',content: data.msg,time:2,end:function(){window.location.href = '/uinf/tovip.html';}});
					}else{
						layer.open({skin:'msg',content: data.msg,time:2});
					}
				}
			})
			
		}
	});
	function TotalPrice(){
		var allprice=0;
		$(".shop-cart-listbox1").each(function(){
			var oprice=0;
			$(this).find(".btn2").each(function(){
				if($(this).is(":checked")){
					var num=$(this).parents(".index-goods").find(".shop-cart-numer").text();
					var price=parseFloat($(this).parents(".index-goods").find(".priceJs").text());
					var total=price*num;
					oprice+=total;
				}
				$(this).closest(".shop-cart-listbox1").find(".ShopTotal").val(oprice.toFixed(2));
			});
			var oneprice=parseFloat($(this).find(".ShopTotal").val());
			allprice+=oneprice;
		});
			$("#AllTotal").text(allprice.toFixed(2));
	}
});