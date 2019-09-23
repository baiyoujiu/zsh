{include file="common/uheader" /}
<link rel="stylesheet" type="text/css" href="__CSS__/prolist-sell.css">
{include file="common/uheaderNav" /}
<style>
    .form-group{ display:inline-block;
    }<!-- 增加下边界-->

          .clearfix:before,.clearfix:after {content:"";display:table;}
    .clearfix:after {clear:both;overflow:hidden;}
    .clearfix {zoom:1; }

    .fl {float:left;}
    .fr {float:right;}
    .zidingyi_css{font-size:14px;margin-bottom:10px;}
    .zidingyi_css .control-label{width:120px; text-align:right; font-size:15px;}
    .zidingyi_css .col-md-6{margin-top:5px;}
</style>
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
                                <li class="active"><a href="<?php echo url('members/recharge');?>">会员费</a></li>
                            </ul>
                        </div>
                        <div class="content" style="position:relative;">
                            <ul class="newpager">
                                <li class="previous">
                                    <div class="form-inline text-right marginTop">
                                        <div class="form-group" style="position:relative;">
                                            <input class="form-control changeStyle ui-input" type="text" name="keyid"  placeholder="请输入用户长id" value="<?php echo $keyid;?>">
                                            <div class="pull-right searchBtn">
                                                <div class="searchBtnStyle"> <span class="addBorder"></span> <i class="iconfont icon-seach"></i>
                                                    <button type="submit" class="btn btnSearch">搜索</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <table class="table table-bordered" id="template">
                                <thead>
                                <tr>
                                    <th>用户名</th>
                                    <th>编号</th>
                                    <th>渠道</th>
                                    <th>充值金额</th>
                                    <th>充值时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(empty($lists)){?>
                                    <tr><td colspan="5" class="text-center">暂无内容</td></tr>
                                    <?php
                                }else{
                                    foreach($lists as $k =>$v){
                                        ?>
                                        <tr style="height: 55px;">
                                        <td><?php echo $ulists[$v['userid']];?></td>
                                        <td><?php echo $v['recharge_no'];?></td>
                                        <td><?php echo $v['recharge_note'];?></td>
                                        <td><?php echo number_format($v['amount']/100,2);?></td>
                                        <td><?php echo $v['audit_time'];?></td>

                                    <?php }?>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                            <?php echo $pageStr;?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function(){
        menuleft("membersrecharge");

        $('.butedit').click(function(){
            var objid = $.trim($(this).data('na')),status = $.trim($(this).data('s')),status = $.trim($(this).data('s')),status = $.trim($(this).data('s'));
//            $('#objid').var (objid);
//            $('#objid').var (objid);
//            $('#objid').var (objid);
//            $('#objid').var (objid);
            $.ajax({
                type:"POST",
                async:false,
                url:"/Members/ustatus.html",
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
                    art.dialog.alert('网000络异常，请稍后重试！');
                }
            });
        })
    });

</script>
{include file="common/ufooter" /}