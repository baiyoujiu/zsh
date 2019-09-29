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
                <form class="form-horizontal withdraw-form" role="form" id="objForm" method="post">
                <div class="box">
                    <input id="hiddenText" type="text" style="display:none" />
                    <input type="text" id="tmh" name="tmh"  placeholder="条码号">
                    <div class="sp_lists"></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("tmh").focus();
    $(function(){
        menuleft("orderscheck");
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
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
                            layer.open({skin:'msg',content: data.msg,time:2});
                        }
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        art.dialog.alert('网络异常，请稍后重试！');
                    }
                });
                $("#tmh").val("");
            }
        }
    });
</script>
{include file="common/ufooter" /}