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
                                <li class="active"><a href="<?php echo url('members/log');?>">地址管理</a></li>
                            </ul>
                        </div>
                        <div class="content" style="position:relative;">
                            <ul class="newpager">
                                <li class="previous">
                                    <div class="form-inline text-right marginTop">
                                        <div class="form-group" style="position:relative;">
                                            <input class="form-control changeStyle ui-input" type="text" name="keytel"   placeholder="请输入手机号" value="<?php echo $keytel;?>">
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
                                    <th>收货人</th>
                                    <th>用户名</th>
                                    <th>收货地址</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(empty($lists)){?>
                                    <tr><td colspan="3" class="text-center">暂无内容</td></tr>
                                    <?php
                                }else{
                                    foreach($lists as $v){
                                        ?><tr style="height: 55px;">
                                        <td><?php echo $v['username']?></td>
                                        <td><?php echo $nlists[$v['userid']]?></td>
                                        <td><?php echo $arealist[$slists[$v['userid']]].$arealist[$clists[$v['userid']]].$arealist[$qlists[$v['userid']]].(($xlists[$v['userid']] == 1 )?$stagelist[$dlists[$v['userid']]].'('.$stagealist[$dlists[$v['userid']]].')':$arealist[$jlists[$v['userid']]].$dlists[$v['userid']]);?></td>
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
    menuleft("membersaddress");
</script>

{include file="common/ufooter" /}