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
                <li class="active"><a href="<?php echo url('Orders/index');?>">购物车</a></li>
              </ul>
            </div>
            <div class="content" style="position:relative;">
              <div class="personal_order_food_list">
                <table class="food_listss">
                  <thead class="food_list_title">
                    <tr>
                      <th class="food_name">宝贝</th>
                      <th class="food_name">规格</th>
                      <th class="food_name">市价</th>
                      <th class="food_name">应付款</th>
                      <th class="food_name">更新时间</th>
                    </tr>
                  </thead>
                  <?php if(empty($lists)){?>
                  <tr >
                    <th class="food_dingdan" colspan="5"><div class="no_data">
                        <div class="no_data_w"> <img src="../img/!.png" alt="">
                          <p>您还没有订单哦~</p>
                        </div>
                      </div>
                    </th>
                  </tr>
                  <?php }else{
                                    foreach($lists as $v){
                                    ?>
                  <tr>
                    <th class="food_dingdan" colspan="8"> <div class="clearfix"> <b class="fl"><?php echo decryptd($ulists[$v['userid']]);?></b> </div>
                    </th>
                  </tr>
                  <tbody class="food_list_lists">
                    <?php unset($v['info']['cgnokey']);foreach ($v['info'] as $v1){?>
                    <tr>
                      <td class="food_name"><div class="clearfix"> <img class="fl grzx_food_img" src="<?php echo $v1['pic'];?>" />
                          <section class="fl">
                            <p><?php echo $v1['name'];?></p>
                          </section>
                        </div></td>
                      <td class="food_price"><div class="clearfix"> <span>已选规格:</span>
                          <p class="yj"><?php echo $v1['keyv'];?></p>
                        </div></td>
                      <td class="food_price"><div class="food_price_list"> <span>市场价:</span>
                          <p class="yj"><?php echo number_format($v1['mprice']/100,2);?></p>
                        </div></td>
                      <td class="food_price"><div class="clearfix"> <span>应付款:</span>
                          <p class="xj"><?php echo number_format($v1['price']/100,2);?></p>
                        </div></td>
                      <td class="food_price"><div class="clearfix">
                          <p class="yj"><?php echo $v['update_time'];?></p>
                        </div></td>
                    </tr>
                    <?php }?>
                    <?php }?>
                    <?php }?>
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
    <!--物流公司选择，没有对应的物流表-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="groupname"><b class="clr-attention">*</b>物流公司选择：</label>
      <div class="col-md-8">
        <select class="form-control" name="wl_com" id="wl_com">
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
        <input id="wl_no" name="wl_no" type="text" class="form-control form-plugInput ui-input"  placeholder="输入物流编号">
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
    menuleft("orderscart");
    $(function() {
       $('.butedit').click(function(){
            var objId = $.trim($(this).data('order')),wl_com = $.trim($(this).data('com')),wl_no = $.trim($(this).data('no'));
            $('#objId').val(objId);
            $('#objId1').val(objId);
            $('#wl_com').val(wl_com);
            $('#wl_no').val(wl_no);
            toAddAdmin();
        })
    });

    function toAddAdmin() {
        $("title.error").remove();
        $("title.error").hide();

        var id;

//      添加数据到 document.getElementById("addAdmin")  确认后触发事件）
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