{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/withdraw-new.css">
<link rel="stylesheet" type="text/css" href="__CSS__/dsmc.css">
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.config.js"></script> 
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.all.min.js"> </script> 
<script type="text/javascript" charset="utf-8" src="/uedit/lang/zh-cn/zh-cn.js"></script> 
<script type="text/javascript" src="__STATIC__/js/laydate.js"></script> 
<script type="text/javascript" src="__JS__/ajaxupload3.9.js"></script> 
{include file="common/uheaderNav" /}
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
            <a class="btn btn-major btn-small shopHelp" id="Addadmin" >
            <?php if($info['pay_status']==2 && $info['status']==1){?>
            <span class="butedit0" data-order="<?php echo $info['order_no'];?>">确认订单</span>
            <?php }?>
            <?php if($info['pay_status']==2 && $info['status']==2){?>
            <b class="butedit" data-order="<?php echo $info['order_no'];?>" data-s="<?php echo $statusArr[$info['status']];?>">发货</b>
            <?php }?>
            </a> </div>
          <div class="content">
            <div class="dingdan_detail"> 
              <!--订单详情-->
              <ul class="clearfix dingdan_detail_lists">
                <li class="fl">
                  <h6>订单信息</h6>
                  <dl>
                    <dd><em>订单编号：</em><span><?php echo $info['order_no'];?></span></dd>
                    <dd><em>订单金额：</em><span>￥<?php echo $info['amount']/100;?></span></dd>
                    <dd><em>订单状态：</em><span><?php echo $statusArr[$info['status']];?></span></dd>
                    <dd><em>支付方式：</em><span><?php echo $paytypeArr[$info['pay_type']];?></span></dd>
                  </dl>
                </li>
                <li class="fl">
                  <h6>配送信息</h6>
                  <dl>
                    <dd><em>配送方式：</em><span><?php echo '暂无';?></span></dd>
                    <dd><em>物流跟踪：</em><span></span></dd>
                    <dd><em>操作：</em> </dd>
                  </dl>
                </li>
                <li class="fl">
                  <h6>收货人信息</h6>
                  <dl>
                    <dd><em>收&nbsp;货&nbsp;人：</em><span><?php echo $info['address']['recname'];?></span></dd>
                    <dd><em>手机号码：</em><span><?php echo $info['address']['phone'];?></span></dd>
                    <dd><em>收货地址：</em><span><?php echo $arealist[$info['address']['province']].$arealist[$info['address']['city']].$arealist[$info['address']['area']].(($info['address']['school'] == 1 )?$stagelist[$info['address']['address']].'('.$stagealist[$info['address']['address']].')':$arealist[$info['address']['street']].$info['address']['address']);?></span></dd>
                  </dl>
                </li>
                <li class="fl">
                  <h6>发票信息</h6>
                  <dl>
                    <dd><em>是否发票：</em><span>暂无</span></dd>
                    <dd><em>发票抬头：</em><span>暂无</span></dd>
                  </dl>
                </li>
              </ul>
              <!--订单备注-->
              <div class="dingdan_detail_beizhu">
                <h6>订单备注： <span><?php echo nl2br($info['remark']);?></span> </h6>
              </div>
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
                        <td>状态</td>
                      </tr>
                    </thead>
                  </table>
                  <ul class="dingdan_detail_shops_lists">
                    <?php foreach($glist as $k=>$v){?>
                    <li class="clearfix">
                      <div class="fl food_name">
                        <img class="fl" src="<?php echo $v['pic'];?>"/>
                        <section class="fl">
                          <p><?php echo $v['name'];?></p>
                          <div class="food_name_fenlei"><span><?php echo '&nbsp'.'&nbsp'.$v['keyv'];?></span></div>
                        </section>
                      </div>
                      <div class="fl food_pic">￥<?php echo $v['price']/100;?></div>
                      <div class="fl food_mun"><?php echo $inum[$v['order_no']];?></div>
                      <div class="fl food_state"><?php echo $statusArr[$info['status']];?></div>
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
            $('#objId').val(objId);
            $('#objId1').val(objId);
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
        })

		$('.butedit').click(function(){
			var objId = $.trim($(this).data('order')),status = $.trim($(this).data('s'));
			$('#objId').val(objId);
			$('#objId1').val(objId);
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