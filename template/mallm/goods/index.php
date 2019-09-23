{include file="common/header" /}
		<section class="sslb_tankuang">
			<div class=" ss_searchss">
				<div class="clearfix ss_search" id="ss_search" style="position:relative;">
					<a href="javascript:history.back(-1);"><i class="icon-left fl"></i></a>
					<input class="fl search_inp" type="text" id="erji_search" value="<?php echo $keywords;?>" placeholder="输入您要搜索的商品"/>
					<div class="fr more_btn">
						<img src="__IMG__/more.png"/>
					</div>
				</div>
				<div class="yiji_saixuan">
					<ul class="clearfix yiji_saixuan_list">
						<li class="fl yiji_saixuan1<?php echo $ukarr[1]!=8?' active':'';?>" value="0">
							<em><span>综合</span><i class="icon-solid-down"></i></em>
						</li>
						<li class="fl yiji_saixuan2<?php echo $ukarr[1]==8?' active':'';?>"  data-v="8"><em>销量</em></li>
						<li class="fl yiji_saixuan3" value="0">
							<em><span>服务</span><i class="icon-solid-down"></i></em>
						</li>
						<li class="fl yiji_saixuan4">筛选<img src="__IMG__/saixuan.png" /></li>
					</ul>
					<!--综合筛选-->
					<div class="yiji_saixuan1_lists">
						<p data-v="0" class="active"><em>综合</em><i></i></p>
						<p data-v="1"><em>价格最低</em><i></i></p>
						<p data-v="2"><em>价格最高</em><i></i></p>
					</div>
					<!--服务筛选-->
					<div class="yiji_saixuan3_lists">
						<p>
							<label class="clearfix">
								<input class="fl" name="chek_btn" type="checkbox" data-v="拼购" value="1"<?php echo in_array(1, $ukarr[2])?' checked="checked"':'';?>/>
								<span class="fl">拼购</span>
							</label>
						</p>
						<?php foreach($actlists as $v){?>
                        <p>
							<label class="clearfix">
								<input class="fl" name="chek_btn" type="checkbox" data-v="<?php echo $v['name'];?>" value="<?php echo $v['id'];?>"<?php echo in_array($v['id'], $ukarr[2])?' checked="checked"':'';?>/>
								<span class="fl"><?php echo $v['name'];?></span>
							</label>
						</p>
                        <?php }?>
						<h3 class="clearfix">
							<span class="fl cz_btn">重置</span>
							<span class="fl qr_btn">确定</span>
						</h3>
					</div>
				</div>
			</div>
			<!--二级筛选-->
            <?php if($cid){?>
			<div class="erji_saixuan" style="display:none;">
				<ul class="clearfix">
					<?php foreach($attrlist as $key=>$val){?>
                    <li class="fl attr<?php echo $key;?>" data-k="<?php echo $key;?>"><span><?php echo $val['name'];?></span><i class="icon-down"></i></li>
                    <?php }?>
					<!--<li class="fl active">顺丰包邮</li>-->
				</ul>
				<div class="erji_saixuan_list">
					<div class="clearfix erji_saixuan_lists">
						<?php foreach($attrlist[0]['attritems'] as $v){?>
                        <p class="fl">
							<label class="clearfix">
								<input class="fl" type="checkbox" data-v="<?php echo $v['name'];?>" value="<?php echo $v['id'];?>"<?php echo in_array($v['id'],$attriid)?' checked="checked"':'';?>/>
								<span class="fl"><?php echo $v['name'];?></span>
							</label>
						</p>
                        <?php }?>
					</div>
					<h5 class="clearfix">
						<span class="fl cz_btn">重置</span>
						<span class="fl qr_btn">确定</span>
					</h5>
				</div>
			</div>
            <?php }?>
			<section class="zhanwei_hei01"></section>
			<!--搜索列表-->
			<section class="paixu_lists">
				<!--竖向-->
				<nav class="sousuo_lists">
					<ul class="clearfix sp_lists" >
						<?php foreach($lists as $v){?>
                        <a href="<?php echo url('goods/'.$v['gno']);?>">
                        <li class="fl">
							<img class="sp_img lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" />
							<div class="sp_lists_word">
								<h4><?php echo $v['name'];?></h4>
								<h5><?php echo $v['recommend'];?></h5>
								<p class="clearfix">
									<span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span>
									<img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
								</p>
							</div>
						</li>
                        </a>
						<?php } ?>
					</ul>
				</nav>
			</section>
		</section>
		<!--改变排列方式-->
		<section>
			<p class="pailie_list" value="0">
				<img src='__IMG__/paixu1.png' />
			</p>
			<p class="ym_zuji">
				<a href="<?php echo url('goods/track');?>"><img src='__IMG__/jilu2.png' /></a>
			</p>
		</section>
		<!--搜索弹窗-->
		<section class="ssls_tankuang">
			<div class="ss_searchs">
				<div class="clearfix ss_search">
					<i class="fl icon-left ss_search_close"></i>
					<input class="fl search_inp" type="text" id="sanji_search" value="<?php echo $keywords;?>" placeholder="输入您要搜索的商品"/>
					<span class="fl serchbut">搜索</span>
				</div>
				<ul class="guanlian_list">
					<li>1111</li>
					<li>2222</li>
					<li>3333</li>
					<li>4444</li>
					<li>1111</li>
					<li>2222</li>
					<li>3333</li>
					<li>4444</li>
				</ul>
			</div>
			<!--搜索历史-->
			<nav class="lishi_tuijian">
				<!--<section class="ss_ls" id="ss_ls">
					<h2 class="ss_ls_tit clearfix">
						<span class="fl">搜索历史</span>
						<i class="fr icon-close ss_ls_close"></i>
					</h2>
					<ul class="clearfix">
						<li class="fl">茅台</li>
						<li class="fl">五粮液</li>
						<li class="fl">汾酒</li>
						<li class="fl">二锅头</li>
						<li class="fl">洋河天之蓝</li>
						<li class="fl">洋河梦之蓝</li>
						<li class="fl">茅台</li>
						<li class="fl">五粮液</li>
						<li class="fl">汾酒</li>
						<li class="fl">二锅头</li>
					</ul>
				</section>-->
				<section class="ss_ls" id="ss_ss">
					<h2 class="ss_ls_tit clearfix">
						<span class="fl">实时热搜</span>
					</h2>
					<ul class="clearfix">
						<?php foreach($hotserchkey as $v){?>
                        <li class="fl"><?php echo $v;?></li>
                        <?php }?>
					</ul>
				</section>
			</nav>
		</section>
		<!--更多弹窗-->
		<section>
			<div class="more_lists_ym">
				<ul class="more_lists">
                    <a href="https://<?php echo request()->host();?>/">
						<li class="fl">
							<img src="__IMG__/home3.png"/>
							<p class="active">首页</p>
						</li>
					</a>
					<a href="<?php echo url('cat/index');?>">
						<li>
							<img src="__IMG__/fenlei3.png"/>
							<p>分类</p>
						</li>
					</a>
					<a href="<?php echo url('cart/index');?>">
						<li class="foot_lists_car">
							<img class="shopping-cart" src="__IMG__/shop_car4.png"/>
							<span id="num">0</span>
							<p>购物车</p>
						</li>
					</a>
					<a href="<?php echo url('uinf/index');?>">
						<li>
							<img src="__IMG__/wode3.png"/>
							<p>我的</p>
						</li>
					</a>
					<a href="<?php echo url('goods/track');?>">
						<li>
							<img src="__IMG__/jilu3.png"/>
							<p>浏览历史</p>
						</li>
					</a>
				</ul>
			</div>
		</section>
		<!--背景-->
		<div class="sousuo_bk"></div>
		<div class="sousuo_bk1"></div>
		<div class="sousuo_bk2"></div>
		<!--明细筛选-->
		<div class="yiji_saixuan4_lists">
			<section>
				<div class="saixuan4_over_y">
					
					<?php foreach($attrlist as $key=>$val){?>
                    <nav class="attrsect">
						<h2><?php echo $val['name'];?></h2>
						<ul class="clearfix">
							<?php foreach($val['attritems'] as $v){?>
                            <li class="fl" data-v="<?php echo $v['id'];?>"><?php echo $v['name'];?></li>
							<?php }?>
						</ul>
					</nav>
					<?php }?>
                    <nav class="price_sect">
						<h2>价格</h2>
						<ul class="clearfix">
							<li class="fl"><input type="number" id="minp" placeholder="最低价"/></li>
							<span class="fl">—</span>
							<li class="fl"><input type="number" id="maxp" placeholder="最高价"/></li>
						</ul>
					</nav>
					<h6 class="clearatti">清除选项</h6>
				</div>
				<h5 class="clearfix">
					<span class="fl qx_btn">取消</span>
					<span class="fl qr_btn">确认</span>
				</h5>
			</section>
		</div>
        
        <script type="text/javascript">
			var uk = {<?php foreach($ukarr as $k=>$v){ echo $k?',':'';echo $k;?>:'<?php echo $v;?>'<?php }?>};
			//已选中的属性数组
			var attridarr = [<?php foreach($attriid as $k=>$v){echo $k?','.$v:$v;}?>];
			var minp,maxp,key = '<?php echo $keywords;?>';
			var attrhtml = {<?php foreach($attrlist as $key=>$val){ echo $key?',':''; echo 'html'.$key;?>:'<?php foreach($val['attritems'] as $v){
                        echo '<p class="fl"><label class="clearfix"><input class="fl" type="checkbox" data-v="'.$v['name'].'"  value="'.$v['id'].'"/><span class="fl">'.$v['name'].'</span></label></p>';
                         }?>'<?php }?>};
			
	        $(document).ready(function(){
				//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
				$("img.lazy").lazyload({effect: "fadeIn"});
				
	            var lenInput = $('#erji_search').val().length;
	            $("#erji_search").click(function(){
	                $('.yiji_saixuan1').val('0');
					$('.yiji_saixuan1').find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
		   			$('.yiji_saixuan1_lists').hide();
		   			$('.yiji_saixuan3').val('0');
					$('.yiji_saixuan3').find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
		   			$('.yiji_saixuan3_lists').hide();
		   			$('.sousuo_bk').hide();
		   			$('.erji_saixuan_list').hide();
			   		$('.sousuo_bk2').hide();
					$('.more_lists_ym').hide();
					
					$('.ssls_tankuang').animate({
							left:'0rem'
						}, 300);
	            });
	           /* 
			   //关键字联想下拉
			   var lenInput1 = $('#sanji_search').val().length;
	            $("#sanji_search").keyup(function(){
	                lenInput1 = $(this).val().length;
	                if(lenInput1>0){
	                	$('.guanlian_list').show();
	                }else{
	                	$('.guanlian_list').hide();
	                };
	            });*/
				$('.serchbut').click(function(){
	                var kv = $('#sanji_search').val();
					$('#erji_search').val(kv);
					getgoods(kv,8);
					$('.ssls_tankuang').animate({
							left:'32rem'
						}, 300);
	            });
				$('.ssls_tankuang li').click(function(){
					var kv = $(this).html();
					$('#erji_search').val(kv);
					$('#sanji_search').val(kv);
					$('.serchbut').click();
				})
				
				
				
	            var posT = $(".header").height()+$(".banner_one").height();
	            $(window).scroll(function(){
			   		if(posT<$(window).scrollTop()){
			   			$(".term_nav").css({
			   				"position":"fixed",
			   				"top":"0rem",
			   				"display":"block",
			   			});
			   			$('.more_lists_ym').hide();
			   			$('.more_btn img').val('0');
			   		}
			   	});
				
				
				
			   	/*综合筛选*/
			   	$('.yiji_saixuan').on('click','.yiji_saixuan1',function(event){
			   		if($(this).val()==0){
						$('.erji_saixuan').css('z-index',2);
			   			$('.yiji_saixuan3').val('0');
						$('.yiji_saixuan3').find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
			   			$('.yiji_saixuan3_lists').hide();
			   			$('.erji_saixuan_list').hide();
			   			$('.sousuo_bk2').hide();
			   			$(this).val('1');
			   			$('.yiji_saixuan1_lists').show();
			   			$('.sousuo_bk').show();
			   			$('body').addClass('overflowHide');
				   		$(this).find('em').find('i').removeClass('icon-solid-down').addClass('icon-solid-up');
				   		event.stopPropagation();    //  阻止事件冒泡
			   		}else if($(this).val()==1){
						$('.erji_saixuan').css('z-index',3);
			   			$(this).val('0');
			   			$('.sousuo_bk').hide();
			   			$('.yiji_saixuan1_lists').hide();
			   			$('body').removeClass('overflowHide');
				   		$(this).find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
				   		event.stopPropagation();    //  阻止事件冒泡
			   		}
			   	});
				$('.yiji_saixuan1_lists p').click(function(){
					var v = $(this).data('v');
					getgoods(v,1);
					htmlstr = $(this).find('em').html();
					
					$('.yiji_saixuan1_lists p').removeClass('active');
					$(this).addClass('active');
					
					$('.yiji_saixuan2').removeClass('active');
					$('.yiji_saixuan1').addClass('active');
					$('.yiji_saixuan1 em span').html(htmlstr);
					
					$('.yiji_saixuan1').click();
				})
				$('.yiji_saixuan2').click(function(){
					var v = $(this).data('v');
					getgoods(v,1);
					$(this).addClass('active');
					
					$('.yiji_saixuan1_lists p').removeClass('active');
					$('.yiji_saixuan1').removeClass('active');
					$('.yiji_saixuan1 em span').html('综合');
				})
				
				
				
			   	/*服务筛选*/
			   	$('.yiji_saixuan').on('click','.yiji_saixuan3',function(event){
			   		if($(this).val()==0){
						$('.erji_saixuan').css('z-index',2);
			   			$('.yiji_saixuan1').val('0');
						$('.yiji_saixuan1').find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
			   			$('.yiji_saixuan1_lists').hide();
			   			$('.erji_saixuan_list').hide();
			   			$('.sousuo_bk2').hide();
			   			$(this).val('1');
			   			$('.yiji_saixuan3_lists').show();
			   			$('.sousuo_bk').show();
			   			$('body').addClass('overflowHide');
				   		
				   		$(this).find('em').find('i').removeClass('icon-solid-down').addClass('icon-solid-up');
				   		event.stopPropagation();    //  阻止事件冒泡
			   		}else if($(this).val()==1){
						$('.erji_saixuan').css('z-index',3);
			   			$(this).val('0');
			   			$('.sousuo_bk').hide();
			   			$('.yiji_saixuan3_lists').hide();
			   			$('body').removeClass('overflowHide');
				   		
				   		$(this).find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
				   		event.stopPropagation();    //  阻止事件冒泡
			   		}
			   	});
			   	/*服务筛选重置*/
			   	$('.cz_btn').click(function(){
			   		$('.yiji_saixuan3_lists').find('input').prop('checked',false);
			   	});
				$('.yiji_saixuan3_lists .qr_btn').click(function(){
					
					var actid=actv=''; 
					$(".yiji_saixuan3_lists input[type='checkbox']:checked").each(function(){
						 actid += '_'+$(this).val(); 
						 actv += '，'+$(this).data('v');
					});
					if(actid !=''){
						getgoods(actid.substr(1),2);
						$('.yiji_saixuan3').addClass('active');
			   			$('.yiji_saixuan3 span').html(actv.substr(1));
					}else{
						getgoods(0,2);
						$('.yiji_saixuan3').removeClass('active');
			   			$('.yiji_saixuan3 span').html('服务');
					}
					$('.yiji_saixuan3').click();
			   	});
				
				
			   	/*右侧筛选显示*/
			   	$('.yiji_saixuan').on('click','.yiji_saixuan4',function(event){
			   		$('.yiji_saixuan1').val('0');
					$('.yiji_saixuan1').find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
		   			$('.yiji_saixuan1_lists').hide();
		   			$('.yiji_saixuan3').val('0');
					$('.yiji_saixuan3').find('em').find('i').removeClass('icon-solid-up').addClass('icon-solid-down');
		   			$('.yiji_saixuan3_lists').hide();
		   			$('.sousuo_bk').hide();
		   			$('.erji_saixuan_list').hide();
			   		$('.sousuo_bk2').hide();
					
					//已选值页面处理
					$(".saixuan4_over_y .attrsect li").each(function(){
						var attrid_one = parseInt($(this).data('v'));
						var indexao = attridarr.indexOf(attrid_one);
						if (indexao > -1) {
							$(this).addClass('active');
						}else{
							$(this).removeClass('active');	
						}
					})
					
		   			$('.yiji_saixuan4_lists').show();
		   			$('.sousuo_bk1').show();
		   			$('body').addClass('overflowHide');
			   		event.stopPropagation();    //  阻止事件冒泡
			   	});
				//选项效果
				$(".saixuan4_over_y nav li").click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
					}else{
						$(this).addClass('active');
					}
				})
				//清除已选选项
				$('.clearatti').click(function(){ 
					$('.saixuan4_over_y nav li').removeClass('active');
					$('.saixuan4_over_y .price_sect input').val('');
				})
			   	/*右侧筛选隐藏*/
			   	$('.yiji_saixuan4_lists h5 .qx_btn').click(function(){
			   		$('.sousuo_bk1').hide();
		   			$('.yiji_saixuan4_lists').hide();
		   			$('body').removeClass('overflowHide');
			   	});
				
				/*右侧筛选确认*/
			   	$('.yiji_saixuan4_lists h5 .qr_btn').click(function(){
			   		$('.yiji_saixuan4_lists h5 .qx_btn').click();
					
					$(".saixuan4_over_y .attrsect li").each(function(){
						var attrid_one = parseInt($(this).data('v'));
						var indexao = attridarr.indexOf(attrid_one);
						if($(this).hasClass('active')){
							if (indexao == -1) {
								attridarr.push(attrid_one);
							}
						}else{
							if (indexao > -1) {
								attridarr.splice(indexao, 1);
							}
						}
					})
					minp = $('#minp').val();
					maxp = $('#maxp').val();
					attridv = attridarr.length>0?attridarr.join('_'):0;
					getgoods(attridv,3);
			   	});
				
				
				
				
				
			   	/*二级分类显示*/
			   	$('.erji_saixuan ul li').click(function(){
			   		$('.yiji_saixuan1').val('0');
		   			$('.yiji_saixuan1_lists').hide();
		   			$('.yiji_saixuan3').val('0');
		   			$('.yiji_saixuan3_lists').hide();
		   			$('.sousuo_bk').hide();
			   		//$('.erji_saixuan ul li').removeClass('active');
			   		$(this).addClass('active');
					
					var attrk = $(this).data('k');
					$('.erji_saixuan_lists').html(attrhtml['html'+attrk]);
					$('.erji_saixuan h5 .qr_btn').data('v',attrk);
					
					//选中值赋值
					$(".erji_saixuan input[type='checkbox']").each(function(){
						var attrid_one = parseInt($(this).val());
						var indexao = attridarr.indexOf(attrid_one);
						if (indexao > -1) {
							$(this).prop("checked",true);
						}
					})
					
			   		$('.erji_saixuan_list').show();
			   		$('.sousuo_bk2').show();
			   		$('body').addClass('overflowHide');
			   	});
			   	/*二级分类隐藏*/
			   	$('.erji_saixuan h5 .qr_btn').click(function(){
					
					var attrk = $(this).data('v');
			   		$('.erji_saixuan_list').hide();
			   		$('.sousuo_bk2').hide();
			   		$('body').removeClass('overflowHide');
					
					
					
					var attrv=''; 
					$(".erji_saixuan_list input[type='checkbox']").each(function(){
						var attrid_one = parseInt($(this).val());
						var indexao = attridarr.indexOf(attrid_one);
						if ($(this).prop('checked') == true) {
							attrv += '，'+$(this).data('v');
							//没有，则添加到已选数组
							if (indexao == -1) {
								attridarr.push(attrid_one);
							}
						}else{
							//如在已选数组中存在，则移出
							if (indexao > -1) {
								attridarr.splice(indexao, 1);
							}
						}
					});
					
					getgoods(attridarr.join('_'),3);
					
					if(attrv !=''){
						$('.attr'+attrk).addClass('active');
			   			//$('.attr'+attrk+' span').html(attrv.substr(1));
					}else{
						$('.attr'+attrk).removeClass('active');
			   			//$('.attr'+attrk+' span').html('服0务');
					}
					
			   	});
			   	/*二级筛选重置*/
			   	$('.cz_btn').click(function(){
			   		$('.erji_saixuan_list').find('input').prop('checked',false);
			   	});
				
				
			   	/*图文列表方式切换*/
			   	$('.pailie_list').click(function(){
			   		if($(this).val()==0){
			   			$('.paixu_lists nav').removeClass('sousuo_lists').addClass('sousuo_lists2');
			   			$(this).val('1');
			   			$(this).find('img').attr('src','__IMG__/paixu.png');
			   		}else if($(this).val()==1){
			   			$('.paixu_lists nav').removeClass('sousuo_lists2').addClass('sousuo_lists');
			   			$(this).val('0');
			   			$(this).find('img').attr('src','__IMG__/paixu1.png');
			   		}
			   	});
	        });
			//初始加载
			getgoods(0,1);
		
   
			function getgoods(kv,k){
				if(k==8){
					key = kv;//分类关键字搜索
				}else{
					uk[k] = kv;
				}
				//url重写
				uk[3] = uk[3]?uk[3]:0;
				var urlstr = '/list/'+uk[0]+'-'+uk[1]+'-'+uk[2]+'-'+uk[3]+'.html';
				urlstr += key?'?k='+key:'?';
				urlstr += minp?'&minp='+minp:'';
				urlstr += maxp?'&maxp='+maxp:'';
				history.pushState("", "Title", urlstr);
				
				$.ajax({
						url: "/api/getgoods.html",
						data: {uk:uk,k:key,minp:minp,maxp:maxp,i:Math.random()},
						type: "post",
						dataType: "json",
						success: function(data) {
							if(data.status == 200){
								$('.sp_lists').html(data.html);
								//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
								$("img.lazy").lazyload({effect: "show"});
							}else{
								layer.open({skin:'msg',content: data.msg,time:2});
							}
						}
					})
				
			}
    	</script>
        
       <script>var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script> 
	</body>
</html>