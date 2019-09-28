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
                    <input type="text" id="ddbh" name="ddbh" placeholder="条码号">
                        <!--订单商品详情-->
                        <div class="dingdan_detail_shops">
                            <h6>订单商品详情</h6>
                            <table border="1">
                                <tr>订单编号：<?php echo $ddbh;?></tr>
                                <?php foreach($lists as $k=>$v){?>
                                    <tr>
                                        <td>商品名称：<b class="clr-attention"><?php echo $info['order_no'].'（'.($info['group']?'拼购':'普通').'）';?></b></td>
                                        <td>数量：<b class="clr-attention"><?php echo $info['pay_status']==1?'未付款':'已付款';?></b></td>
                                        <td>已检：<b class="clr-attention"><?php echo $sstatusArr[$info['status']];?></b></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(function(){
        menuleft("orderscheck");
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
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
            }
        }

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