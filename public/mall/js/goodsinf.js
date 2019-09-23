// JavaScript Document
 /*详情联动*/
	   $(function(){
			var posT = $(".header").height()+$(".banner_one").height();
		 	var overstepT = $(".term").height();
		 	var heigtPt = overstepT-$(".term_nav").height();
		 	
			var domH = $(".term_nav li").height();
			var domY,moveY,index,item_top;
			$(".term_nav").on({
		        touchstart: function (e) {
		            startY = e.originalEvent.targetTouches[0].pageY;
		        },
		        touchmove: function (e) {  
		        	e.preventDefault();          
		            $("body").on({
		                touchmove: function (e) {
		                    e.preventDefault();
		                }
		            });
		            domY = $(this).offset().top;
		            moveY = e.originalEvent.targetTouches[0].pageY;
					index = parseInt((moveY-domY)/domH);
					$(".term_nav li").eq(index).addClass("on").siblings().removeClass("on");
		        
					item_top=$('.term_box').eq(index).offset().top-100;
					$(window).scrollTop(item_top);
		        },
		        touchend: function () {
		        	$("body").off("touchmove")
		        }
		 	});
		 	$(".term_nav li").click(function(){
		 		$(this).addClass("on").siblings().removeClass("on");
		 		item_top = $('.term_box').eq($(this).index()).offset()-100;
		 		$(window).scrollTop(item_top)
		 	})
		 	
		   	$(window).scroll(function(){
		   		if($(window).scrollTop()<=posT){
		   			$(".term_nav").css({
		   				"position":"fixed",
		   				"top":"-3.2rem",
		   				"display":"none",
		   				"transform": "translateY(0)",
		   			});
		   		}
		   		else if(posT<$(window).scrollTop()){
		   			$(".term_nav").css({
		   				"position":"fixed",
		   				"top":"0rem",
		   				"display":"block",
		   			});
		   			$('.more_lists_ym').hide();
		   			$('.more_btn img').val('0');
		   		}
		   		$('.term_box').each(function(){
		            var $details_item_top=$('.term_box').eq($(this).index()).offset().top;
		            var cs = $(".term_box").eq($(this).index()).height();
		            //console.log($details_item_top+" "+$(window).scrollTop())
		            if($details_item_top+cs-100>$(window).scrollTop()){
		                $('.term_nav li').removeClass('on');
		                $('.term_nav li').eq($(this).index()).addClass('on');
		                return false;
		            }
		        });
		   	})

				/*立刻购买,假如购物车*/
				$('.xq_join_btn').click(function(){
					$('.like_back').show();
					$('.like_shop_ym').show();
					$('html,body').addClass('overHidden');
				});
				$('.xq_like_btn').click(function(){
					$('.like_back').show();
					$('.like_shop_ym').show();
					$('html,body').addClass('overHidden');
				});
				$('.like_shop_close').click(function(){
					$('.like_back').hide();
					$('.like_shop_ym').hide();
					$('html,body').removeClass('overHidden');
				});
				$('.like_back').click(function(){
					$('.like_back').hide();
					$('.like_shop_ym').hide();
					$('html,body').removeClass('overHidden');
				});
				
				
				
				
				if(spnum == 1){
					var specdp = $('#gprices').html(),numd = $('.maxmun').html(),spect0d = $('.spect0').html()
					$('.spec0 li').click(function(){
						if($(this).val()==0){
							$('.spec0 li').removeClass('active');
							$(this).addClass('active');
							$('.spec0 li').val(0);
							$(this).val(1);
							$('.spect0').html($(this).html());
							$('.specv0').val($(this).data('key'));
							
							$('#gprices').html(pdata['s'+$(this).data('key')]);
							$('.maxmun').html(ndata['s'+$(this).data('key')]);
							
							
						}else if($(this).val()==1){
							$('.spec0 li').removeClass('active');
							$(this).val(0);
							$('.spect0').html(spect0d);
							$('.specv0').val('-1');
							
							$('#gprices').html(specdp);
							$('.maxmun').html(numd);
						}
					})
				}else if(spnum == 2){
					var specdp = $('#gprices').html(),numd = $('.maxmun').html(),spect0d = $('.spect0').html(),spect1d = $('.spect1').html();
					$('.spec0 li').click(function(){
						if($(this).hasClass('disabled')){
							layer.open({skin:'msg',content: '该组合不存在，请重新选择！',time:1});
							$('.spec0 li').removeClass('disabled');
							$('.spec0 li').removeClass('active');
							$(this).addClass('active');
							$('.spec0 li').val(0);
							$(this).val(1);
							$('.spect0').html($(this).html());
							$('.specv0').val($(this).data('key'));
							
							
							
							
							
							$('.spec1 li').removeClass('active');
							$('.specv1').val('-1');
							$('.spec1 li').addClass('disabled');
							$('.spec1 li').val(0);
							$('.spect1').html(spect1d);
							var thisdata = $(this).data('key');
							Object.keys(ndata).forEach(function(key){
							     if(ndata[key]){
									if(key.substr(1,1) == thisdata){
										var ckey = key.substr(2,2);
										//console.log(ckey)
										$('.spec1 .'+ckey).removeClass('disabled');
									}
								 }
								 //console.log(key,ndata[key]);
							
							});
							
							$('#gprices').html(specdp);
							$('.maxmun').html(numd);
							
							
						}else{
							if($(this).val()==0){
								$('.spec0 li').removeClass('active');
								$(this).addClass('active');
								$('.spec0 li').val(0);
								$(this).val(1);
								$('.spect0').html($(this).html());
								$('.specv0').val($(this).data('key'));
								
								$('.spec1 li').addClass('disabled');
								var thisdata = $(this).data('key');
								Object.keys(ndata).forEach(function(key){
									 if(ndata[key]){
										if(key.substr(1,1) == thisdata){
											var ckey = key.substr(2,2);
											//console.log(ckey)
											$('.spec1 .'+ckey).removeClass('disabled');
										}
									 }
								});
								
								if($('.spec1 li').hasClass('active')){
									$('#gprices').html(pdata['s'+$(this).data('key')+'s'+$('.spec1').find('.active').data('key')]);
									$('.maxmun').html(ndata['s'+$(this).data('key')+'s'+$('.spec1').find('.active').data('key')]);
								}
							}else if($(this).val()==1){
								$('.spec0 li').removeClass('active');
								$(this).val(0);
								$('.spect0').html(spect0d);
								$('.specv0').val('-1');
								$('.spec1 li').removeClass('disabled');
								
								$('#gprices').html(specdp);
								$('.maxmun').html(numd);
							}
						}
						
						
						
					});
					
					$('.spec1 li').click(function(){
						var specdp = $('#gprices').html(),numd = $('.maxmun').html(),spect0d = $('.spect0').html(),spect1d = $('.spect1').html();
						if($(this).hasClass('disabled')){
							layer.open({skin:'msg',content: '该组合不存在，请重新选择！',time:1});
							$('.spec1 li').removeClass('disabled');
							$('.spec1 li').removeClass('active');
							$(this).addClass('active');
							$('.spec1 li').val(0);
							$(this).val(1);
							$('.spect1').html($(this).html());
							$('.specv1').val($(this).data('key'));
							
							
							$('.spec0 li').removeClass('active');
							$('.specv0').val('-1');
							$('.spec0 li').addClass('disabled');
							$('.spec0 li').val(0);
							$('.spect0 li').html(spect0d);
							var thisdata = $(this).data('key');
							Object.keys(ndata).forEach(function(key){
							     if(ndata[key]>0){
									if(key.substr(3,1) == thisdata){
										var ckey = key.substr(0,2);
										//console.log(ckey)
										$('.spec0 .'+ckey).removeClass('disabled');
									}
								 }
							});
							
							$('#gprices').html(specdp);
							$('.maxmun').html(numd);
						}else{
							if($(this).val()==0){
								$('.spec1 li').removeClass('active');
								$(this).addClass('active');
								$('.spec1 li').val(0);
								$(this).val(1);
								$('.spect1').html($(this).html());
								$('.specv1').val($(this).data('key'));
								
								if($('.spec0 li').hasClass('active')){
									$('#gprices').html(pdata['s'+$('.spec0').find('.active').data('key')+'s'+$(this).data('key')]);
									$('.maxmun').html(ndata['s'+$('.spec0').find('.active').data('key')+'s'+$(this).data('key')]);

									$('.spec0 li').addClass('disabled');
									var thisdata = $(this).data('key');
									Object.keys(ndata).forEach(function(key){
										 if(ndata[key]>0){
											if(key.substr(3,1) == thisdata){
												var ckey = key.substr(0,2);
												//console.log(ckey)
												$('.spec0 .'+ckey).removeClass('disabled');
											}
										 }
									});
									
								}else{
									$('.spec0 li').addClass('disabled');
									var thisdata = $(this).data('key');
									Object.keys(ndata).forEach(function(key){
										 if(ndata[key]>0){
											if(key.substr(3,1) == thisdata){
												var ckey = key.substr(0,2);
												//console.log(ckey)
												$('.spec0 .'+ckey).removeClass('disabled');
											}
										 }
									});
								}
								
							}else if($(this).val()==1){
								$('.spec1 li').removeClass('active');
								$(this).val(0);
								$('.spect1').html(spect1d);
								$('.specv0').val('-1');
								$('.spec1 li').removeClass('disabled');
								
								$('#gprices').html(specdp);
								$('.maxmun').html(numd);
							}
						}
						
					});
					
				//3个规格	
				}
	
			
				
				//数量加
				$(".like_jia").click(function(){
					var multi=0;
					var vall=$(this).prev().val();
					var maxmun=$('.maxmun').text();
					
					if(vall>=maxmun){
						vall=maxmun;
						layer.open({
						    content: '该商品库存有限'
						    ,skin: 'msg'
						    ,time: 3 //3秒后自动关闭
					  	});
						return false;
					}
					vall++;
					$(this).prev().val(vall);
				});
				//数量减
				$(".like_jian").click(function(){
					var multi=0;
					var vall=$(this).next().val();
					var maxmun=$('.maxmun').text();
					
					if(vall<=1){
						vall=1;
						layer.open({
						    content: '该商品1件起售'
						    ,skin: 'msg'
						    ,time: 3 //3秒后自动关闭
					  	});
						return false;
					}
					vall--;
					$(this).next().val(vall);
				});
				/*加入购物车*/
				$('.tc_join_btn').click(function(){
					if($('.specv0').val()<0){
						layer.open({
						    content: '请选择'+$('.spec0 h1').html()
						    ,skin: 'msg'
						    ,time:1
					  	});
					}else if((spnum == 2) && $('.specv1').val()<0){
			        	layer.open({
						    content: '请选择'+$('.spec1 h1').html()
						    ,skin: 'msg'
						    ,time:1
					  	});
					}else{
						//加入购物车
						var num = $('.like_mun').val(),spec0 = $('.specv0').val(),spec1 = (spnum == 2)?$('.specv1').val():'';
						$.ajax({
							url: "/order/addcart.html",
							data: {gno:gno,num:num,spec0:spec0,spec1:spec1,i:Math.random()},
							type: "post",
							dataType: "json",
							success: function(data) {
							  if(data.status == 200){
								layer.open({content: '加入购物车成功',skin: 'msg',time:2});
								//$('.like_shop_close').click();
							  }else if(data.status == 221){
							  	 window.location.href = '/login/index.html';
							  }else{
								layer.open({skin:'msg',content: data.msg,time:2});
							  }
							}
						})
					}
				});
				/*立刻购买*/
				$('.tc_gm_btn').click(function(){
					if($('.specv0').val()<0){
						layer.open({
						    content: '请选择'+$('.spec0 h1').html()
						    ,skin: 'msg'
						    ,time:1
					  	});
					}else if((spnum == 2) && $('.specv1').val()<0){
			        	layer.open({
						    content: '请选择'+$('.spec1 h1').html()
						    ,skin: 'msg'
						    ,time:1
					  	});
					}else{
						//加入购物车
						var num = $('.like_mun').val(),spec0 = $('.specv0').val(),spec1 = (spnum == 2)?$('.specv1').val():'';
						$.ajax({
							url: "/order/buynow.html",
							data: {gno:gno,num:num,spec0:spec0,spec1:spec1,i:Math.random()},
							type: "post",
							dataType: "json",
							success: function(data) {
							  if(data.status == 200){
								window.location.href = '/order/index.html';
							  }else if(data.status == 221){
							  	 window.location.href = '/login/index.html';
							  }else if(data.status == 230){
							  	layer.open({skin:'msg',content: data.msg,time:2,end:function(){window.location.href = '/uinf/tovip.html';}});
							  }else{
								layer.open({skin:'msg',content: data.msg,time:2});
							  }
							}
						})
					}
				});
				
				
				$('.gcollect').click(function(){
					var obj=$(this);
					$.ajax({
						url: "/api/collect.html",
						data: {gno:gno,i:Math.random()},
						type: "post",
						dataType: "json",
						success: function(data) {
							if(data.status == 200){
								obj.toggleClass("red");
								var html = obj.hasClass('red')?'取消收藏':'收藏';
								obj.find('.spcxs').html(html);
							}else if(data.status == 221){
							  	window.location.href = '/login/index.html';
							}else{
								layer.open({skin:'msg',content: data.msg,time:2});
							}
						}
					})
				});
				
				
				
			});