{include file="common/uheader" /}
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.myconfig.js"></script>
<script type="text/javascript" charset="utf-8" src="/uedit/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/uedit/lang/zh-cn/zh-cn.js"></script>
<style>
    #divcss5{margin:0 auto;border:0px solid #000;width:300px;height:30px}
</style>
{include file="common/uheaderNav" /}
<div class="container" id="j-content">
    <div class="row">
        <!--left Nav start-->
        {include file="common/usnav" /}
        <!--left Nav end-->
        <div class="col-md-11 main_right">
            <div class="row">
                <div class="box">
                    <form class="form-horizontal withdraw-form" role="form" id="objForm" method="post">
                    <div id="divcss5">
                        <select class="form-control" name="type" id="tid">
                            <?php foreach($typearr as $k=>$v){?>
                                <option value="<?php echo $k;?>"<?php echo $k==$info['type']?"selected='selected'":'';?>><?php echo $v;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="content">
                        <div class="form-horizontal bank-card-new">

                                <div class="form-group alipay">
                                    <label for="bankcard" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-8">
                                        <script id="content" type="text/plain" style="width:100%;height:500px;" ></script>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bankcard" class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-8 text-left">
                                        <a class="btn btn-major btn-big saveBtn" data-t="<?php echo $k;?>">保存</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<textarea id="contentdiv" style="display:none"><?php echo $info['content']?> </textarea>


<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('content');
    var content = $("#contentdiv").val();
    ue.ready(function() {
        ue.setContent(content);
    });


    $(function(){
        menuleft("systemxitong");

        $('#tid').change(function(){
            var type = $(this).val();
            window.location.href = '/system/xitong.html?type='+type;
        })


        $('.saveBtn').click(function(){
            $.post("/System/xitongsave.html", $('#objForm').serialize(),
                function(data){
                    if (data.status == 200) {
                        $('.saveBtn').attr('disabled',true);
                        window.location.reload();
                    } else {
                        art.dialog.alert(data.msg);
                    }
                });
        })
    });
</script>
{include file="common/ufooter" /}