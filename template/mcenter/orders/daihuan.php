{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
<link rel="stylesheet" type="text/css" href="__CSS__/dsmc.css">
{include file="common/uheaderNav" /}
<!-- header end -->
<!-- body -->

<div class="container" id="j-content">
  <div class="row">
    <!--left Nav start-->
    {include file="common/usnav" /}
    <!--left Nav end-->
    <div class="col-md-11 main_right">
      <div class="row">
        <form id="formPage" method="get">
          <div class="box">
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group" style="position:relative;">
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入订单编号" value="<?php echo $keyword;?>">
                      <div class="pull-right searchBtn">
                        <div class="searchBtnStyle"> <span class="addBorder"></span> <i class="iconfont icon-seach"></i>
                          <button type="submit" class="btn btnSearch">搜索</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
              <div class="personal_order_food_list">
                <table class="food_listss">
                  <thead class="food_list_title">
                    <tr>
                      <th class="food_name">宝贝</th>
                      <th class="food_price">单价</th>
                      <th class="food_number">数量</th>
                      <th class="food_prices">小计</th>
                      <th class="food_prices">租借时间</th>
                      <th class="food_prices">归还时间</th>
                      <th class="food_prices">租借商品状态</th>
                      <th class="food_transaction">操作</th>
                    </tr>
                  </thead>
                    <?php
                    $amunls = [];
                    foreach($lists as $v){
                        $amunls[$v['order_no']]['order_no'] = $v['order_no'];
                        $amunls[$v['order_no']]['goods'][] = $v;
                    }?>
                  <?php if(empty($amunls)){?>
                  <tr>
                    <th class="food_dingdan"  colspan="8"><div class="no_data">
                        <div class="no_data_w"> <img src="../img/!.png" alt="">
                          <p>您还没有订单哦~</p>
                        </div>
                      </div></th>
                  </tr>
                  <?php }else{
							foreach($amunls as $v){
								?>
                  <tr>
                    <th class="food_dingdan" colspan="8"> <div class="clearfix"> <span class="fr">订单号: <?php echo $v['order_no'];?></span> </div>
                    </th>
                  </tr>
                  <tbody class="food_list_lists">
                  <?php $goodarr = $v['goods'];foreach($goodarr as $gv){?>
                      <tr>
                          <td class="food_name"><div class="clearfix"> <img class="fl grzx_food_img" src="<?php echo $gv['pic'];?>" />
                                  <section class="fl">
                                      <p><?php echo $gv['name'];?></p>
                                      <div class="food_name_fenlei"><span><?php echo $gv['keyv'];?></span></div>
                                  </section>
                              </div></td>
                          <td class="food_price"><div class="food_price_list">
                                  <p class="yj">￥<?php echo number_format($gv['mprice']/100,2);?></p>
                                  <p class="xj">￥<?php echo number_format($gv['price']/100,2);?></p>
                              </div></td>
                          <td class="food_number"><?php echo $gv['num'];?></td>
                          <td class="food_prices"><div class="food_prices_list">
                              <p class="xj">￥<?php echo number_format($price_each = $gv['num'] * $gv['price']/100,2);?></p>
                          </div></td>
                          <td class="rent" ><?php echo '租借：'.substr($gv['rentstart'],0,10).'<br>'.'归还：'.substr($gv['rentend'],0,10);?></td>
                          <td class="send" ><?php echo '申请还书：'.substr($gv['tobacktime'],0,10).'<br>'.'入库：'.substr($gv['backtime'],0,10);?></td>
                          <td class="st"><?php echo $statusArr[$gv['status']];?></td>
                          <td >
                              <p><a href="javascript:void(0);" class="rk" data-id="<?php echo $gv['gno'];?>">确认入库</a></p>
                              <p><a href="javascript:void(0);" class="yc" data-id="<?php echo $gv['gno'];?>">异常</a></p>
                          </td>
                      </tr>
                  <?php }?>
                  </tbody>
                            <?php }}?>
                </table>
              </div>
            </div>
            <?php echo $pageStr;?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- body end! -->
<script type="text/javascript">
	menuleft("ordersdaihuan");

	$('.rk').click(function(){
		var objId =$(this).data('id'),status ='8';
        $.ajax({
            type:"POST",
            async:false,
            url:"/orders/updaihuan.html",
            dataType: "json",
            data:{objId:objId,status:status,i: Math.random()},
            success:function(result){
                if(result.status == 200){
                    window.location.reload();
                }else{
                    art.dialog.alert(result.msg);
                }
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                art.dialog.alert('网络异常，请稍后重试！');
            }
        })
	})

    $('.yc').click(function(){
        var objId =$(this).data('id'),status ='2';
        $.ajax({
            type:"POST",
            async:false,
            url:"/orders/updaihuan.html",
            dataType: "json",
            data:{objId:objId,status:status,i: Math.random()},
            success:function(result){
                if(result.status == 200){
                    window.location.reload();
                }else{
                    art.dialog.alert(result.msg);
                }
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                art.dialog.alert('网络异常，请稍后重试！');
            }
        })
    })
</script>
{include file="common/ufooter" /}