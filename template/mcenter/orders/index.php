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

                <!--          这个为什么后面不(能)加.html   因为用了url 就变成地址了吗？不用的话就是完整网址     -->
                <li class="active"><a href="<?php echo url('Orders/index'); ?>">订单列表</a></li>
              </ul>
            </div>
            <div class="content" style="position:relative;">
              <ul class="newpager">
                <li class="previous">
                  <div class="form-inline text-right marginTop">
                    <div class="form-group">
                      <!--搜索     -->
                      <select class="form-control" name="status" id="status">
                        <option value="0">状态</option>
                        <?php foreach ($statusArr as $k => $v) {?>
                        <option value="<?php echo $k; ?>" <?php echo ($status == $k) ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group" style="position:relative;">
                      <input class="form-control changeStyle ui-input" type="text" name="keyword" placeholder="请输入订单编号" value="<?php echo $keyword; ?>">
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
                      <th class="food_holeprice">订单总价</th>
                      <th class="food_price">驿站地址</th>
                      <th class="food_state">交易状态</th>
                      <th class="food_transaction">交易操作</th>
                    </tr>
                  </thead>
                  <?php if (empty($lists)) {?>
                  <tr>
                    <th class="food_dingdan"  colspan="8"><div class="no_data">
                        <div class="no_data_w"> <img src="../img/!.png" alt="">
                          <p>您还没有订单哦~</p>
                        </div>
                      </div></th>
                  </tr>
                  <?php } else {
    foreach ($lists as $v) {
        ?>
                  <tr>
                    <th class="food_dingdan" colspan="8"> <div class="clearfix"> <b class="fl"><?php echo $v['order_time'] . '&nbsp' . '&nbsp' . '&nbsp' . '用户名:' . $user[$v['userid']]; ?></b> <span class="fr">订单号: <?php echo $v['order_no']; ?><b class="clr-attention">（<?php echo $v['pay_status'] == 1 ? '待付款-' . $sstatusArr[$v['status']] : $sstatusArr[$v['status']]; ?>）</b></span> </div>
                    </th>
                  </tr>
                  <tbody class="food_list_lists">
                    <?php foreach ($v['glists'] as $k1 => $v1) {
            ?>
                    <tr>
                      <td class="food_name"><div class="clearfix"> <img class="fl grzx_food_img" src="<?php echo $v1['pic']; ?>" />
                          <section class="fl">
                            <p><?php echo $v1['name']; ?></p>
                            <div class="food_name_fenlei"><span><?php echo $v1['keyv']; ?></span></div>
                          </section>
                        </div></td>
                      <td class="food_price"><div class="food_price_list">
                          <p class="yj">￥<?php echo number_format($v1['mprice'] / 100, 2); ?></p>
                          <p class="xj">￥<?php echo number_format($v1['price'] / 100, 2); ?></p>
                        </div></td>
                      <td class="food_number"><?php echo $v1['num']; ?></td>
                      <td class="food_prices"><div class="food_prices_list">
                          <p class="xj">￥<?php echo number_format($price_each = $v1['num'] * $v1['price'] / 100, 2); ?></p>
                        </div></td>
                      <?php if ($k1 < 1) {
                ?>
                      <td class="food_holeprice" rowspan="<?php echo count($v['glists']); ?>">
                          <p class="xj">￥<?php echo number_format($v['amount'] / 100, 2); ?></p></td>
                      <td class="food_holeprice" rowspan="<?php echo count($v['glists']); ?>">
                          <p class="yz">
                            <?php $address = json_decode(base64_decode($v['address']), true);
                echo ($address['school'] == 1) ? $stagelist[$address['address']] : '非驿站';?>
                          </p></td>
                      <td class="food_state" rowspan="<?php echo count($v['glists']); ?>">
                          <?php echo $v['pay_status'] == 1 ? '待付款' : $sstatusArr[$v['status']]; ?>
                          <a href="<?php echo '/Orders/inf/id/' . $v['id'] . '.html'; ?>"><p class="">订单详情</p></a></td>
                      <td class="food_transaction" rowspan="<?php echo count($v['glist']); ?>">
                          <?php
//1-下单，待确认|2-卖家已确认|3-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
                if ($v['pay_status'] == 1) {
                    if ($v['status'] == 1) {
                        ?>
                          <p class="upbtn" data-no="<?php echo $v['order_no']; ?>" data-s="9">系统关闭</p>
              <?php
}
                } else {
                    //已付款订单操作
                    if ($v['status'] == 1) {
                        ?>
                           <p class="upbtn" data-no="<?php echo $v['order_no']; ?>" data-s="2">卖家确认</p>
                           <p class="upbtn" data-no="<?php echo $v['order_no']; ?>" data-s="8">取消订单</p>
                           <?php } else if ($v['status'] == 2) {?>
                           <p class="upbtn" data-no="<?php echo $v['order_no']; ?>" data-s="3">发货</p>
                           <?php } else if ($v['status'] == 3) {?>
                           <p class="upbtn" data-no="<?php echo $v['order_no']; ?>" data-s="6">系统收货</p>
                          <?php }}?>
                        </td>
                      <?php }?>
                    </tr>
                    <?php }?>
                    <?php }}?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php echo $pageStr; ?> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- body end! -->
<!-- 添加 -->
<div id="addAdmin" style="display:none;width: 500px;">
  <form class="form-horizontal" role="form" id="addLabel">
    <input type="hidden" id="objId" name="objId" value="0">
      <input type="hidden" id="status" name="status" value="0">
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname">订单编号</label>
      <div class="col-md-8">
        <input id="objId1" name="objId1" type="text" class="form-control form-plugInput ui-input" disabled>
      </div>
    </div>
    <!--物流公司选择，没有对应的物流表-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物流公司选择：</label>
      <div class="col-md-8">
        <select class="form-control" >
          <option value="">请选择物流公司</option>
          <?php foreach ($typeArr as $k => $v) {?>
          <option value="<?php echo $v['com']; ?>"><?php echo $v['name']; ?></option>
          <?php }?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物流编号：</label>
      <div class="col-md-8">
        <input  type="text" class="form-control form-plugInput ui-input"  placeholder="输入物流编号">
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  menuleft("ordersindex");

//    实现编辑，CLICK事件    物流信息


    $(function() {
    $('.upbtn').click(function(){
      var hstr = $(this).html();
      var objid = $.trim($(this).data('no')),status = $.trim($(this).data('s'));
      normalDialog(hstr, hstr, "确认", function(t) {
         $.ajax({
          type:"POST",
          async:false,
          url:"/Orders/upstatus.html",
          dataType: "json",
          data:{objid : objid,status : status,i: Math.random()},
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
        });

      }, "取消", null);

    })



    $('.butedit').click(function(){
//    预显示
      var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s'));
      $('#objId').val(objId);
      $('#objId1').val(objId);
            $('#status').val(status);
      toAddAdmin();
    })
    });

    function toAddAdmin() {
//      所有class = error 的  title  元素？
        $("title.error").remove();
        $("title.error").hide();

//      单独var  id 是干嘛用的()路由参数？？？
        var id;

//      这一行干哈的？（添加数据到 document.getElementById("addAdmin")  确认后触发事件）
        normalDialog("物流信息", document.getElementById("addAdmin"), "确认", function(t) {
      $("title.error").remove();
      $("title.error").hide();
        $.ajax({
          type:"POST",
          async:false,
          url:"/Orders/hnavsave.html",
          dataType: "json",
          data:$("#addLabel").serialize(),
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
        });
        }, "取消", null);
    }


</script>
{include file="common/ufooter" /}