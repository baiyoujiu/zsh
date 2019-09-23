{include file="common/header" /}
<section class="ds_home">
    <!--搜索-->
    <section class="home_searchs">
        <div class="clearfix home_search">
            <i class="fl icon-search"></i>
            <p class="fl search_p">输入您要找的商品</p>
        </div>
    </section>
    <!--分类明细-->
    <section>
        <!--分类明细左边-->
        <div class="fenlei_left_lists">
            <!--占位-->
            <div class="zhanwei_hei35"></div>
            <ul class="fenlei_left_list">
                <li class="active">热销商品</li>
                <?php foreach($listscat as $k=>$v){?>
                <li><?php echo $v['name'];?></li>
                <?php }?>
            </ul>
            <!--占位-->
            <div class="zhanwei_hei40"></div>
        </div>
        <!--分类明细右边-->
        <div class="fenlei_right_lists fr">
            <!--占位-->
            <div class="zhanwei_hei35"></div>
            
            <!--热门商品-->
            <nav style="display:block;">
                <ul class="fenlei_right_list">
                    <?php foreach($listchot as $k=>$v){?>
                    <a href="<?php echo url('goods/'.$v['gno']);?>">
                    <li class="clearfix">
                        <img class="fl lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>"/>
                        <div class="fl fenlei_right_list_word">
                            <h4><?php echo $v['name'];?></h4>
                            <h5><?php echo $v['recommend'];?></h5>
                            <section class="zhanwei_hei15"></section>
                            <p class="clearfix">
                                <span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span>
                                <img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
                            </p>
                        </div>
                    </li>
                    </a>
                    <?php }?>
                </ul>
            </nav>
            <!--热门商品-->
            <!--分类商品-->
            <?php foreach($listscat as $key=>$val){?>
            <nav>
                <ul class="fenlei_right_list">
                    <?php foreach($catgoods[$key] as $k=>$v){?>
                    <a href="<?php echo url('goods/'.$v['gno']);?>">
                    <li class="clearfix">
                        <img class="fl lazy" data-original="<?php $picarr = json_decode(base64_decode($v['pic']),true);echo $picarr[0];?>" />
                        <div class="fl fenlei_right_list_word">
                            <h4><?php echo $v['name'];?></h4>
                            <h5><?php echo $v['recommend'];?></h5>
                            <section class="zhanwei_hei15"></section>
                            <p class="clearfix">
                                <span class="fl"><em>￥<?php echo number_format($v['sales_price']/100,2);?></em>/<?php echo $v['units'];?></span>
                                <img class="fr buy_btn" src="__IMG__/shop_car1.png"></img>
                            </p>
                        </div>
                    </li>
                    </a>
                    <?php }?>
                    <a href="<?php echo url('list/'.$val['id']);?>">
                    <li class="clearfix catmore">
                        查看更多...
                    </li>
                    </a>
                </ul>
            </nav>
            <?php }?>
            <!--占位-->
            <div class="zhanwei_hei40"></div>
        </div>
    </section>
    
    <!--搜索弹窗-->
    <section class="ssls_tankuang">
        <div class="ss_searchs">
            <div class="clearfix ss_search">
                <i class="fl icon-left ss_search_close"></i>
                <input class="fl search_inp" type="text" id="sanji_search" placeholder="输入您要搜索的商品"/>
                <span class="fl" id="serchbut">搜索</span>
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
<script>
	$(document).ready(function(){
		//图片懒加载 effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
		$("img.lazy").lazyload({effect: "fadeIn"});
		
		/*分类搜索显示*/
		$('.search_p').click(function(){
			$('.ssls_tankuang').animate({
				left:'0rem'
			}, 300)
		});
		$('.ssls_tankuang li').click(function(){
				var kv = $(this).html();
				$('#sanji_search').val(kv);
				$('#serchbut').click();
			})
			
		$('#serchbut').click(function(){
				var kv = $('#sanji_search').val();
				window.location.href = '/list/0.html?k='+kv;
			});
		
		
		/*//关键字联想下拉
		var lenInput1 = $('#sanji_search').val().length;
		$("#sanji_search").keyup(function(){
			lenInput1 = $(this).val().length;
			if(lenInput1>0){
				$('.guanlian_list').show();
			}else{
				$('.guanlian_list').hide();
			};
		});*/
	});
</script>
{include file="common/footer" /}
