{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/withdraw-new.css" xmlns:width="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="__CSS__/dsmc.css">
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
<script type="text/javascript" src="/layer-v3.1.1/layer/layer.js"></script>
{include file="common/uheaderNav" /}
<style>
    table{ margin-left:10px;}
    table td{ text-align:left;}
    .box1{
        align-content: center;
        width:auto;
    }
    table{
        text-align: center;
        width:100%;
    }
    td{
        word-break: break-all;
    }
</style>
<div class="container" id="j-content">
    <div class="row">
        <!--left Nav start-->
        {include file="common/usnav" /}
        <!--left Nav end-->
        <div class="col-md-11 main_right">
            <div class="row">
                <form id="objForm" method="post">
                    <div class="box">
                        <div class="box1" align="center" >
                            <input  align="left:20" id="hiddenText" type="text" style="display:none" />
                            <input  type="text" id="tmh" name="tmh"  placeholder="条码号" style="height: 40px;width: 250px;">
                            <hr>
                            <table>
                                <thead>
                                <tr>
                                    <th>商品</th>
                                    <th>商品hao</th>
                                    <th>价格</th>
                                    <th>数量</th>
                                    <th>已检数量</th>
                                </tr>
                                </thead>
                                <tbody class="sp_lists"></tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    menuleft("orderscheck");
    document.getElementById("tmh").focus();
    $(function(){
        menuleft("orderscheck");
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
                if(!$('.sp_lists').html())
                {
                    $.ajax({
                        type:"POST",
                        async:false,
                        url:"/orders/checktwo.html",
                        dataType: "json",
                        data:$("#objForm").serialize(),
                        success: function(data) {
                            if(data.status == 200){
                                $('.sp_lists').html(data.html);
                            }else{
                                layer.open({skin:'msg',content: data.msg,time:2000});
                            }
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown){
                            art.dialog.alert('网络异常，请稍后重试！');
                        }
                    });
                    $("#tmh").val("");
                }else{
                    var objid = $("#tmh").val(),ddid = $("#dd").val(),ztid = $("#status").val();
                    if(objid == ddid  ){
                        alert("请确认所有订单已完成");
                    }else{
                        $.ajax({
                            type:"POST",
                            async:false,
                            url:"/orders/checkthree.html",
                            dataType: "json",
                            data:{objid : objid,ddid:ddid,ztid:ztid,i: Math.random()},
                            success: function(data) {
                                if(data.status == 200){
                                    $('.sp_lists').html(data.html);
                                }else{
                                    layer.open({skin:'msg',content: data.msg,time:2000});
                                }
                            },
                            error:function(XMLHttpRequest, textStatus, errorThrown){
                                art.dialog.alert('网络异常，请稍后重试！');
                            }
                        });
                        $("#tmh").val("");
                    }
                }
            }
        }
    });
</script>
{include file="common/ufooter" /}