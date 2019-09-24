{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/withdraw-new.css">
<link rel="stylesheet" type="text/css" href="__CSS__/dsmc.css">
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
{include file="common/uheaderNav" /}
<style>
table{ margin-left:10px;}
table td{ text-align:left;}
</style>
<div class="container" id="j-content">
  <div class="row"> 
    <!--left Nav start--> 
    {include file="common/usnav" /} 
    <!--left Nav end-->
    <div class="col-md-11 main_right">
      <div class="row">
        <div class="box">
          <div class="title help-course-f">
            <ul class="nav nav-tabs" style="margin-top: 16px;padding-left: 16px;">
              <li class="active"><a href="http://www.jsg.co/orders/index.html">订单详情</a></li>
            </ul>
            <a class="btn btn-major btn-small shopHelp" id="Addadmin" href="javascript:;">
              <?php if($info['pay_status']==2 && $info['status']==1){?>
                <b class="butedit0" data-order="<?php echo $info['order_no'];?>" data-s="<?php echo $info['status'];?>" data-or="<?php echo $info['order_no'];?>">确认订单</b>
              <?php }?>
            <?php if($info['pay_status']==2 && $info['status']==2){?>
            <b class="butedit" data-order="<?php echo $info['order_no'];?>" data-s="<?php echo $info['status'];?>" data-or="<?php echo $info['order_no'];?>">发货</b>
            <?php }?>
              <?php if($info['pay_status']==2 && $info['status']==3){?>
                <b class="butedit" data-order="<?php echo $info['order_no'];?>" data-s="<?php echo $info['status'];?>" data-or="<?php echo $info['order_no'];?>">系统收货</b>
              <?php }?>
            </a> </div>
          <div class="content">
            <table border="1">
              <tr>
                <td>订单编号：<b class="clr-attention"><?php echo $info['order_no'].'（'.($info['group']?'拼购':'普通').'）';?></b></td>
                <td>支付状态：<b class="clr-attention"><?php echo $info['pay_status']==1?'未付款':'已付款';?></b></td>
                <td>订单状态：<b class="clr-attention"><?php echo $sstatusArr[$info['status']];?></b></td>
              </tr>
              <tr>
                <td>商品金额：<?php echo number_format($info['good_amount']/100,2).'<b class="clr-attention">（'.$info['goodnum'].'件）</b>';?></td>
                <td>运　　费：<?php echo number_format($info['freight']/100,2);?></td>
                <td>优惠金额：<?php echo number_format($info['camount']/100,2);?></td>
              </tr>
              <tr>
                <td>应付金额：<?php echo number_format($info['amount']/100,2);?></td>
                <td>实付金额：<b class="clr-attention"><?php echo number_format($info['pay_amount']/100,2);?></b></td>
                <td>支付方式：<b class="clr-attention"><?php echo $info['pay_status']==2?$paytypeArr[$info['pay_type']].'('.$info['trade_no'].')':'未付款';?></b></td>
              </tr>
              <tr>
                <td>下单时间：<?php echo $info['order_time'];?></td>
                <td>付款时间：<?php echo $info['pay_time'];?></td>
                <td>发货时间：<?php echo $info['send_time'];?></td>
              </tr>
              <tr>
                <td colspan="2">订单备注：<b class="clr-attention"><?php echo $info['remark'];?></b></td>
                <td>收货时间：<?php echo $info['received_time'];?></td>
              </tr>
              <tr>
                <td colspan="3"> 收货人：<?php echo $info['address']['recname'].'('.$info['address']['phone'].')';?> <?php echo $arealist[$info['address']['province']].$arealist[$info['address']['city']].$arealist[$info['address']['area']].(($info['address']['school'] == 1 )?$stagelist[$info['address']['address']].'('.$stagealist[$info['address']['address']].')':$arealist[$info['address']['street']].$info['address']['address']);?></td>
              </tr>
            </table>
            <!--订单商品详情-->
            <div class="dingdan_detail_shops">
              <h6>订单商品详情</h6>
              <div>
                <table>
                  <thead>
                    <tr>
                      <td>商品信息</td>
                      <td>单价</td>
                      <td>数量</td>
                    </tr>
                  </thead>
                </table>
                <ul class="dingdan_detail_shops_lists">
                  <?php foreach($glist as $k=>$v){?>
                  <li class="clearfix">
                    <div class="fl food_name"> <img class="fl" src="<?php echo $v['pic'];?>"/>
                      <p class="fl"><?php echo $v['name'].'<br>'.$v['keyv'];?></p>
                    </div>
                    <div class="fl food_pic">￥<?php echo $v['price']/100;?></div>
                    <div class="fl food_mun"><?php echo $v['num'];?></div>
                  </li>
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

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
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物流公司选择：</label>
      <div class="col-md-8">
        <select class="form-control" >
          <option value="">请选择物流公司</option>
          <?php foreach($typeArr as $k=>$v){?>
          <option value="<?php echo $v['com'];?>"><?php echo $v['name'];?></option>
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
$(function(){
    menuleft("ordersindex");

	$(function() {
      $('.butedit0').click(function(){
        var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s'));
        $.ajax({
          type:"POST",
          async:false,
          url:"/Orders/hnavsave.html",
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
        });
      })

		$('.butedit').click(function(){
          var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s')),objId1 = $.trim($(this).data('or'));
          $('#objId').val(objId);
          $('#objId1').val(objId1);
          $('#status').val(status);
          toAddAdmin();
		})
	});

	function toAddAdmin() {
		$("title.error").remove();
		$("title.error").hide();
		var id;
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

});
</script> 
{include file="common/ufooter" /}