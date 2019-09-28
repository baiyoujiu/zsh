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
            <div class="title help-course-f">
              <ul class="nav nav-tabs" style="margin-top: 16px;padding-left: 16px;">
                <li class="active"><a href="<?php echo url('orders/index');?>">订单列表</a></li>
              </ul>
              <a class="btn btn-major btn-small shopHelp" id="toprint">打印</a>
            </div>
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
                      <th class="food_prices">租借商品状态</th>
                      <th class="food_transaction">操作</th>
                    </tr>
                  </thead>
                  <?php if(empty($lists)){?>
                  <tr>
                    <th class="food_dingdan"  colspan="8"><div class="no_data">
                        <div class="no_data_w"> <img src="../img/!.png" alt="">
                          <p>您还没有订单哦~</p>
                        </div>
                      </div></th>
                  </tr>
                  <?php }else{
							foreach($lists as $v){
								?>
                  <tr>
                    <th class="food_dingdan" colspan="8"> <div class="clearfix"> <b class="fl"><?php echo $v['order_time'].'&nbsp'.'&nbsp'.'&nbsp'.'用户名:'.$user[$v['userid']];?></b> <span class="fr">订单号: <?php echo $v['order_no'];?><b class="clr-attention">（<?php echo $v['pay_status']==1?'待付款-'.$sstatusArr[$v['status']]:$sstatusArr[$v['status']];?>）</b></span> </div>
                    </th>
                  </tr>
                  <tbody class="food_list_lists">
                    <?php foreach($v['glists'] as $k1=>$v1){?>
                    <tr>
                      <td class="food_name"><div class="clearfix"> <img class="fl grzx_food_img" src="<?php echo $v1['pic'];?>" />
                          <section class="fl">
                            <p><?php echo $v1['name'];?></p>
                            <div class="food_name_fenlei"><span><?php echo $v1['keyv'];?></span></div>
                          </section>
                        </div></td>
                      <td class="food_price"><div class="food_price_list">
                          <p class="yj">￥<?php echo number_format($v1['mprice']/100,2);?></p>
                          <p class="xj">￥<?php echo number_format($v1['price']/100,2);?></p>
                        </div></td>
                      <td class="food_number"><?php echo $v1['num'];?></td>
                      <td class="food_prices"><div class="food_prices_list">
                          <p class="xj">￥<?php echo number_format($price_each = $v1['num'] * $v1['price']/100,2);?></p>
                        </div></td>
                        <?php if($k1<1){?>
                        <td class="rent" rowspan="<?php echo count($v['glists']);?>"><?php echo '租借：'.$v1['rentstart'].'<br>'.'归还：'.$v1['rentend'];?></td>
                        <td class="st" rowspan="<?php echo count($v['glists']);?>"><?php echo $statusbrr[$v1['status']];?></td>
                        <td rowspan="<?php echo count($v['glists']);?>"><a href="javascript:void(0);" class="yh" data-id="<?php echo $v1['order_no'];?>">确认已还</a></td>
                        <?php }?>
                    </tr>
                    <?php }?>
                    <?php }}?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php echo $pageStr;?> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- body end! --> 

<script type="text/javascript">
	menuleft("ordersdaihuan");

	$('.yh').click(function(){
		var objId =$(this).data('id');
        $.ajax({
            type:"POST",
            async:false,
            url:"/orders/huanshu.html",
            dataType: "json",
            data:{objId:objId,i: Math.random()},
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

    function toAddAdmin() {
        normalDialog("物流信息", document.getElementById("addAdmin"), "确认", function(t) {
			$("title.error").remove();
			$("title.error").hide();
				;
        }, "取消", null);
    }
	
	
</script> 
{include file="common/ufooter" /}